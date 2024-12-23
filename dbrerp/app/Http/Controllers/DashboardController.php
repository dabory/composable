<?php


namespace App\Http\Controllers;


use App\Services\CallApiService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function index() {
        // dd($this->getMenu());
//         dump(session('user'));
        // dump(session('GateToken'));
//        $erpThemes = preg_replace('/\s+/', '', explode(',', env('ERP_THEMES')));
//
//        if ($erpThemes[0]) {
//            return view("erp.{$erpThemes[0]}.resources.views.dashboard");
//        }


        $view = null;
        $sortMenu = session('user.SortMenu');
        if (empty($sortMenu['C7'])) {
            $view = 'pages.generic_dash';
//            return view('pages.shop_dash');
        }

        $component = explode('::', $sortMenu['C7']);
        if (count($component) === 1) {
            $view = 'pages.' . $sortMenu['C7'];
//            return view('pages.' . $sortMenu['C7']);
        }

        if ($view) {
            if ($view === 'pages.shop_dash') {
                $howManyWorkingDays = $this->callApiService->callApi([
                    'url' => 'how-many-working-days',
                    'data' => [
                        'ReturnField' => 'StartDate',
                        'EndDate' => Carbon::now()->format('Ymd'),
                        'WorkingDays' => 7,
                    ]
                ]);

                $fullFileUrl = "dabory-footage/dash/shop-dash.json";
                if (Storage::exists($fullFileUrl)) {
                    $listType1Book = json_decode(Storage::get($fullFileUrl), true);
                } else {
                    $listType1Book = $this->getShopDashData($howManyWorkingDays);
                    if ($this->callApiService->verifyApiError($listType1Book)) {
                        return redirect()->to('/user-logout');
                    }
                    Storage::put($fullFileUrl, json_encode($listType1Book));
                }


                $salesStatisticsGraph = collect($listType1Book['Book'][11]['Page'])->map(function ($data) {
                    return [
                        'type' => 'val1',
                        'date' => Carbon::createFromFormat('Y-m-d', $data['C1'])->format('Y/m/d'),
                        '매출 금액' => $data['C2'],
                        '매출 건수' => $data['C3'],
                        '고객 수' => $data['C4'],

                    ];
                });

                // Generate the complete range of dates
                $startDate = Carbon::parse($howManyWorkingDays['StartDate']);
                $endDate = Carbon::parse($howManyWorkingDays['EndDate']);

                $dateRange = collect();
                $currentDate = $startDate->copy();
                while ($currentDate <= $endDate) {
                    $dateRange->push($currentDate->format('Y/m/d'));
                    $currentDate->addDay();
                }

// Fill in missing dates with empty values
                $salesStatisticsGraph = $dateRange->map(function ($date) use ($salesStatisticsGraph) {
                    $existingEntry = $salesStatisticsGraph->firstWhere('date', $date);

                    if ($existingEntry) {
                        return $existingEntry;
                    } else {
                        return [
                            'type' => 'val1',
                            'date' => $date,
                            '매출 금액' => 0,
                            '매출 건수' => 0,
                            '고객 수' => 0,
                        ];
                    }
                })->toArray();

                return view($view, compact('listType1Book', 'salesStatisticsGraph'))
                    ->with('codeTitle', [ "status('post-item-inquiry')", "status('post-notice')" ]);
            }

            return view($view);
        }

        return redirect()->route("themes.$component[0].dashboard");
    }

    private function getShopDashData($howManyWorkingDays)
    {
//                $howManyWorkingDays['StartDate'] = '20240721';
//                $howManyWorkingDays['EndDate'] = '20240728';

        $noticeFilter = request('notice_filter', 'all');
        $reviewFilter = request('review_filter', 'all');
        $inquiryFilter = request('inquiry_filter', 'all');

        $noticeSimpleFilter = '';
        if ($noticeFilter !== 'all') {
            $noticeSimpleFilter = "mx.status = '$noticeFilter'";
        }

        $inquirySimpleFilter = '';
        if ($inquiryFilter !== 'all') {
            $inquirySimpleFilter = "mx.status = '$inquiryFilter'";
        }

        $reviewSimpleFilter = '';
        if ($reviewFilter === 'up') {
            $reviewSimpleFilter = 'mx.rating_score >= 4';
        } else if ($reviewFilter === 'down') {
            $reviewSimpleFilter = 'mx.rating_score < 4';
        }

        $listType1Book = $this->callApiService->callApi([
            'url' => 'list-type1-book',
            'data' => [
                'Book' => [
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/1-left-top',
                            'SimpleFilter' => '',
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => 'mx.created_on desc'
                        ],
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/2-left-top',
                            'SimpleFilter' => '',
                        ],
                        'ListType1Vars' => [
                            'IsDownloadList' => true,
                            'OrderBy' => 'mx.created_on desc'
                        ],
                        'PageVars' => [
                            'Limit' => 1,
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/3-left-top',
                            'SimpleFilter' => '',
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => 'mx.created_on desc'
                        ],
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/order-new',
                            'SimpleFilter' => '',
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => 'mx.created_on desc'
                        ],
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/order-delayed',
                            'SimpleFilter' => '',
                        ],
                        'ListType1Vars' => [
                            'IsDownloadList' => true,
                            'OrderBy' => 'mx.created_on desc'
                        ],
                        'PageVars' => [
                            'Limit' => 1,
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/order-cancelled',
                            'SimpleFilter' => '',
                        ],
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/post-item-inquiry',
                            'SimpleFilter' => $inquirySimpleFilter,
//                                    'TestMode' => 'query'
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => 'mx.created_on desc'
                        ],
                        'PageVars' => [
                            'Limit' => 6,
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/item-count',
                            'SimpleFilter' => '',
                        ],
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/post-notice',
                            'SimpleFilter' => $noticeSimpleFilter,
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => 'mx.created_on desc'
                        ],
                        'PageVars' => [
                            'Limit' => 4,
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/post-item-review',
                            'SimpleFilter' => $reviewSimpleFilter,
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => 'mx.created_on desc'
                        ],
                        'PageVars' => [
                            'Limit' => 4,
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/sales-statistics',
                            'SimpleFilter' => '',
                        ],
                        'ListType1Vars' => [
                            'FilterDate' => 'sorder_date',
                            'StartDate' => $howManyWorkingDays['StartDate'],
                            'EndDate' => $howManyWorkingDays['EndDate'],
                        ],
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'dashboard/generic_dash/sales-statistics-graph',
                            'SimpleFilter' => '',
                        ],
                        'ListType1Vars' => [
                            'IsDownloadList' => true,
                            'FilterDate' => 'sorder_date',
                            'StartDate' => $howManyWorkingDays['StartDate'],
                            'EndDate' => $howManyWorkingDays['EndDate'],
                        ],
                        'PageVars' => [
                            'Limit' => 100,
                        ]
                    ],
                ]
            ]
        ]);

//                dump($listType1Book);

        return $listType1Book;
    }
}

