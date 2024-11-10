<?php

namespace App\Console\Commands;

use App\Events\DormantAccountNotify;
use App\Services\CallApiService;
use App\Services\DormantService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class SendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dormant:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '휴먼계정 안내 메일 발송';

    private $callApiService;
    private $dormantService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CallApiService $callApiService, DormantService $dormantService)
    {
        parent::__construct();
        $this->callApiService = $callApiService;
        $this->dormantService = $dormantService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $now = CarbonImmutable::now()->toDateTimeLocalString();
        file_put_contents(storage_path('logs/sample.log'), $now . PHP_EOL, FILE_APPEND);

        $this->dormantService->setMainToken();

        $dormantDefault = $this->dormantService->getSetup();

        $formDt = Carbon::now()->startOfDay();
        $toDt = Carbon::now()->endOfDay();
        $toDt->subMonths($dormantDefault['ActiveMonth'])->addDays($dormantDefault['AdvancedNoticeDays']);
        $formDt->subMonths($dormantDefault['ActiveMonth']);

        $memberPage = $this->callApiService->callApi([
            'url' => 'member-page',
            'data' => [
                'PageVars' => [
                    'Query' => "(last_login_on between $formDt->timestamp and $toDt->timestamp) and dormant_mail_on = 0",
                    'Asc' => 'last_login_on',
                    'Limit' => 999999
                ]
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

        $memberList = collect($memberPage['Page'])->map(function ($member) {
            $member['LastLoginAt'] = Carbon::createFromTimestamp($member['LastLoginOn']);
            return $member;
        });

//        $dormantList = [];
//        while ($formDt->timestamp <= $toDt->timestamp) {
//            $dormantList[] = collect($memberList)->filter(function ($member) use ($formDt) {
//                return $member['LastLoginAt']->format('Y-m-d') === $formDt->format('Y-m-d');
//            })->toArray();
//
//            $formDt->addDays($dormantDefault['NoticeIntervalDays']);
//        }
//
//        $dormantList = collect($dormantList)->collapse()->toArray();
        $dormantList = $memberList->toArray();
        $result = [];

//        dd($dormantList);
        foreach ($dormantList ?? [] as $member) {
            $result[] = event(new DormantAccountNotify([
                'email' => $member['Email'],
                'due_date' => Carbon::createFromTimestamp($member['LastLoginOn'])->addMonths($dormantDefault['ActiveMonth'])->format('Y-m-d'),
            ]));
        }

        $mailSendList = collect($result)->collapse()->collapse()->toArray();
        $mailSendPage = collect($dormantList)->map(function ($member) use ($mailSendList) {
            if ($mailSendList[$member['Email']]) {
                $dormantMailOn = Carbon::now()->timestamp;
            } else {
                $dormantMailOn = -1;
            }

            return ['Id' => $member['Id'], 'DormantMailOn' => $dormantMailOn];
        })->toArray();

        if (empty($mailSendPage)) {
            return 0;
        }

        $memberAct = $this->callApiService->callApi([
            'url' => 'member-act',
            'data' => [
                'Page' => $mailSendPage
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

        return 0;
    }
}

