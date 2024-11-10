<?php

namespace App\Console\Commands;

use App\Events\DormantAccountNotify;
use App\Services\CallApiService;
use App\Services\DormantService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResendEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dormant:resend-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '휴먼계정 안내 메일 재발송';

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
    public function handle()
    {
        $this->dormantService->setMainToken();

        $memberPage = $this->callApiService->callApi([
            'url' => 'member-page',
            'data' => [
                'PageVars' => [
                    'Query' => "dormant_mail_on = -1",
                    'Limit' => 999999
                ]
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

        $result = [];
        foreach ($memberPage['Page'] ?? [] as $member) {
            $result[] = event(new DormantAccountNotify([
                'email' => $member['Email'],
                'due_date' => Carbon::now()->startOfDay()->format('Y-m-d'),
            ]));
        }

        $mailSendList = collect($result)->collapse()->collapse()->toArray();
        $mailSendPage = collect($memberPage['Page'])->map(function ($member) use ($mailSendList) {
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
