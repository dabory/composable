<?php

namespace App\Console\Commands;

use App\Services\CallApiService;
use App\Services\DormantService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DeleteDormantMemberCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dormant:delete-member';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '휴면테이블 레코드 삭제하기';

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
        $dormantDefault = $this->dormantService->getSetup();

        $dt = Carbon::now()->endOfDay();
        $dt->subMonths($dormantDefault['DormantMonth']);

        $appName = $dormantDefault['GuestApp'];

        $memberDormantPage = $this->callApiService->callAppApi([
            'url' => 'member-dormant-page',
            'data' => [
                'PageVars' => [
                    'Query' => "created_on <= $dt->timestamp",
                    'Limit' => 999999
                ]
            ],
        ], $this->dormantService->getGateToken($appName), $appName);

        if ($this->callApiService->verifyApiError($memberDormantPage)) {
            return 0;
        }

        $actData = [];
        foreach ($memberDormantPage['Page'] ?? [] as $memberDormant) {
            sleep($dormantDefault['SchedulerSleepSecond']);
            $actData['member-dormant-act'][] = [ 'Id' => $memberDormant['Id'] * -1 ];

            $member = $this->callApiService->callApi([
                'url' => 'member-pick',
                'data' => [
                    'Page' => [
                        [ 'Id' => $memberDormant['Id'] ]
                    ]
                ],
                'headers' => [
                    'GateToken' => $this->dormantService->getGateToken('main')
                ]
            ])['Page'][0];

            $actData['member-act'][] = [
                'Id' => $memberDormant['Id'],
                'Email' => 'Unknown-' . Str::of( Hash::make($member['Email'] . $member['Id'] . $member['ActivateCode']) )
                        ->after('$2y$10$')->limit(10, ''),
                'Status' => '6'
            ];
        }

        if (empty($actData)) {
            return 0;
        }

        if (! $this->useActApi($actData, $dormantDefault['GuestApp'])) {
            return 0;
        }

        return 0;
    }

    public function useActApi($actData, $appName)
    {
        $memberDormantAct = $this->callApiService->callAppApi([
            'url' => 'member-dormant-act',
            'data' => [
                'Page' => $actData['member-dormant-act']
            ],
        ], $this->dormantService->getGateToken($appName), $appName);

        if ($this->callApiService->verifyApiError($memberDormantAct)) {
            return false;
        }

        $memberAct = $this->callApiService->callApi([
            'url' => 'member-act',
            'data' => [
                'Page' => $actData['member-act']
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

        if ($this->callApiService->verifyApiError($memberAct)) {
            return false;
        }

        return true;
    }
}
