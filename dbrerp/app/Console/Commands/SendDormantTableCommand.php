<?php

namespace App\Console\Commands;

use App\Services\CallApiService;
use App\Services\DormantService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SendDormantTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dormant:send-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '휴면테이블로 보내기';

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
        $dt->subMonths($dormantDefault['ActiveMonth']);

        $memberPage = $this->callApiService->callApi([
            'url' => 'member-page',
            'data' => [
                'PageVars' => [
                    'Query' => "(last_login_on > 0 and last_login_on <= $dt->timestamp) and status != 5",
                    'Asc' => 'last_login_on',
                    'Limit' => 999999
                ]
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

//        $a = collect($memberPage['Page'])->map(function ($member) {
//            return [$member['Email'], Carbon::createFromTimestamp($member['LastLoginOn'])->format('Y-m-d')];
//        });

        $result = [];
        foreach ($memberPage['Page'] ?? [] as $member) {
            sleep($dormantDefault['SchedulerSleepSecond']);
            $result[] = $this->goToDormantAccount($member['Id'], $dormantDefault['GuestApp']);
        }

        $actData = [];
        foreach ($result as $page) {
            $actData['member-dormant-act'][] = $page['member-dormant-act'];
            $actData['member-ext-act'][] = $page['member-ext-act'];
            $actData['member-act'][] = $page['member-act'];
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

        $memberExtAct = $this->callApiService->callApi([
            'url' => 'member-ext-act',
            'data' => [
                'Page' => $actData['member-ext-act']
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

        if ($this->callApiService->verifyApiError($memberExtAct)) {
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

    public function goToDormantAccount($id, $appName)
    {
        $memberDormantPick = $this->callApiService->callAppApi([
            'url' => 'member-dormant-pick',
            'data' => [
                'Page' => [
                    [ 'Id' => (int)$id ]
                ]
            ],
        ], $this->dormantService->getGateToken($appName), $appName);

//        이미 휴면 상태이면 false 반환
        if (! $this->callApiService->verifyApiError($memberDormantPick)) {
            return false;
        }

        $memberPick = $this->callApiService->callApi([
            'url' => 'member-pick',
            'data' => [
                'Page' => [
                    [ 'Id' => (int)$id ]
                ]
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

        $member = $memberPick['Page'][0];
        $member['Status'] = '5';
        $member['SgroupIdRecom'] = $member['SgroupId'];
        unset($member['SgroupId']);

        $memberExtPick = $this->callApiService->callApi([
            'url' => 'member-ext-pick',
            'data' => [
                'Page' => [
                    [ 'Id' => (int)$id ]
                ]
            ],
            'headers' => [
                'GateToken' => $this->dormantService->getGateToken('main')
            ]
        ]);

        $page = array_merge($member, $memberExtPick['Page'][0]);
        $page['CreatedOn'] = Carbon::now()->timestamp;
        unset($page['UpdatedOn']);


        return [
            'member-dormant-act' => $page,
            'member-ext-act' => $this->initMemberExtDb((int)$member['Id']),
            'member-act' => $this->initMemberDb($member),
        ];
    }

    function initMemberExtDb($memberId)
    {
        return [ 'Id' => (int)$memberId, 'MobileNo' => '' ];
    }

    function initMemberDb($member)
    {
        $memberStructure = [
            'LastSeenOn' => 'INT', 'LastLoginOn' => 'INT', 'MemberDate' => 'STRING', 'Email' => 'UNIQUE', 'Password' => 'STRING',
            'LoginId' => 'STRING', 'SsoBrand' => 'STRING', 'SsoSub' => 'STRING',
            'NickName' => 'STRING', 'FirstName' => 'STRING', 'SurName' => 'STRING', 'IsActivated' => 'CHAR', 'IsGuest' => 'CHAR',
            'ProfileImg' => 'STRING', 'ProfileWeb' => 'STRING', 'ProfileText' => 'STRING', 'CreatedIp' => 'STRING', 'Sort' => 'CHAR', 'BuyerId' => 'INT',
            'SgroupId' => 'INT', 'SgroupCode' => 'STRING', 'LastloginIp' => 'STRING', 'IsWithdrawn' => 'CHAR', 'SsoSubId' => 'INT',
            'IsMemberApp' => 'CHAR', 'DormantMailOn' => 'INT'
        ];

        $memInitPage = ['Id' => (int)$member['Id'], 'Status' => '5'];
        foreach ($memberStructure as $key => $value) {
            switch ($value) {
                case 'UNIQUE':
                    $memInitPage[$key] = 'Unknown-' . Str::of(Hash::make($member['Email']))->after('$2y$10$')->limit(10, '');
                    break;
                case 'STRING':
                    $memInitPage[$key] = '';
                    break;
                case 'CHAR':
                    $memInitPage[$key] = '0';
                    break;
                case 'INT':
                    $memInitPage[$key] = 0;
                    break;
            }
        }

        return $memInitPage;
    }
}
