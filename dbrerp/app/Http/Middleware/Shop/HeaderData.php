<?php

namespace App\Http\Middleware\Shop;

use App\Helpers\Utils;
use App\Services\CallApiService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HeaderData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $mainMenuPerm = Utils::getProMainMenu();
        $mainMenuPermPage = collect($mainMenuPerm['Page'])->filter(function ($menu) {
            return $menu['Sort'] === 'primary';
        })->toArray();
        $topMenuPermPage = collect($mainMenuPerm['Page'])->filter(function ($menu) {
            return $menu['Sort'] === 'top';
        })->toArray();
        $mainMenuList = Utils::formatMenuList($mainMenuPermPage, 'MenuCode');
        $topMenuList = Utils::formatMenuList($topMenuPermPage, 'MenuCode');
        dd($topMenuList);

        $headerPart = app(CallApiService::class)->callApi([
            'url' => 'list-type1-book',
            'data' => [
                'Book' => [
                    [
                        'QueryVars' => [
                            'QueryName' => 'pro:shop/wish',
                            'SubSimpleFilter' => "image_type = 'thumb'",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 100000
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'point2u::pro:shop/cart',
                            'SubSimpleFilter' => "image_type = 'thumb'",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 100000
                        ]
                    ]
                ]

            ],
        ]);

        $currentRoute = Route::currentRouteName();

        view()->share('mainMenuList', $mainMenuList);
        view()->share('topMenuList', $topMenuList);
        view()->share('headerPart', $headerPart);
        view()->share('currentRoute', $topMenuPermPage);

        return $next($request);
    }
}
