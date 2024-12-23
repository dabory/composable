<?php

use App\Helpers\Utils;
use App\Http\Controllers\Front\Dabory\Myapp\Sso\SsoAppController;
use App\Http\Controllers\Front\Dabory\Myapp\Member\MemberEditController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Helpers\ProUtils;
use Illuminate\Support\Facades\Storage;


Route::middleware(['check.gate.token', 'app.token.manager'])->group(function () {
//Route::middleware(['check.gate.token', 'check.company.sort', 'app.token.manager'])->group(function () {
//Route::group(['middleware' => 'check.pro.member'], function () {
    Route::group(['middleware' => 'check.pro.member'], function () {
        // Route::prefix('my-app')->name('my-app.')->group(function () {
        Route::group(['prefix' => 'dabory/myapp', 'as' => 'myapp.'], function () {
            Route::get('/list-type/type1', Utils::makeFrontRoute('/dabory/erp/list-type/type1'));
            Route::get('/list-type/list-media1', Utils::makeFrontRoute('/dabory/erp/list-type/list-media1'));
            Route::get('/master-data/item', Utils::makeFrontRoute('/dabory/erp/master-data/item'));
            Route::get('/basic-settings/item-optpro', Utils::makeFrontRoute('/dabory/erp/basic-settings/item-optpro'));

            Route::get('/change-sort-menu/{sort_menu_id}', function ($sortMenuId) {
                $sortMenuPage = ProUtils::getSortMenu()['Page'] ?? [];
                $filterSortMenu = collect($sortMenuPage)->filter(function ($sortMenu) use($sortMenuId) {
                    return $sortMenu['Id'] === (int)$sortMenuId;
                })->first();
                session()->put('member.SortMenu', $filterSortMenu);

                return redirect()->to($filterSortMenu['C4']);
            })->name('change-sort-menu');

            Route::get('/country-code', function () {
                session()->put('member.CountryCode', request('code'));
                // dd(session('member'));

                return redirect()->back();
            });

            Route::get('/sso/sso-app', [SsoAppController::class, 'index']);
            Route::post('/member-edit-verify', [MemberEditController::class, 'store'])->name('member-edit-verify.store');
            Route::post('/member-edit-verify-send', [MemberEditController::class, 'sendCert'])->name('member-edit-verify-send');

            Route::post('/clear-menu-cache', function () {
                Storage::delete('dabory-footage/members/' . session('member')['MemberId'] . '/member-menu');
            });

            Route::get('/clear-cache', function () {
                Artisan::call('event:clear');
                Artisan::call('cache:clear');
                Artisan::call('optimize:clear');
                Artisan::call('route:clear');
                Artisan::call('view:clear');
//                Storage::deleteDirectory('dabory-footage/members/' . session('member')['MemberId']);
                Storage::deleteDirectory('dabory-footage/members');

                return redirect()->back();
            })->name('clear.cache');

            Route::get('/', function() {
                // sortTpye 첫번 째 세션에 저장
                $sessionSortMenu = session()->get('member.SortMenu');
                $sortMenuPage = ProUtils::getSortMenu()['Page'] ?? [];
                if (empty($sortMenuPage)) {
                    $sortMenu = '';
                } else if ($sessionSortMenu) {
                    $sortMenu = $sessionSortMenu;
                } else {
                    $sortMenu = $sortMenuPage[0];
                }

                if($sortMenu === ''){
                    session()->flash('error', '설정된 MEMBER 메뉴가 없습니다. 관리자에게 문의하세요.');
                    return redirect()->back();
                }

                $component = explode('::', $sortMenu['C7']);
                if (count($component) === 1) {
                    if($component[0] !== 'generic_dash'){
                        $view = 'pages.' . $sortMenu['C7'];
                    }else{
                        $view = 'front.dabory.myapp.index';
                    }

                }
                session()->put('member.SortMenu', $sortMenu);
                // dd(session('member'));
                return view($view);
            })->name('index');
        });
    });
});
