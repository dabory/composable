<?php

use App\Helpers\Utils;
use App\Http\Controllers\Auth\FindUserPwVerifyController;
use App\Http\Controllers\Auth\FindUserPwVerifyinputController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\UserSignupVerifyController;
use App\Http\Controllers\Front\Dabory\Erp\Etc\UnderConstructionController;
use App\Http\Controllers\Dbrbbs\PostController;
use App\Services\Elasticsearch\Erp\BuyerService;
use Illuminate\Support\Facades\Route;

Route::middleware(['check.underConstruction'])->group(function () {
    Route::middleware(['check.gate.token', 'app.token.manager'])->group(function () {
    //    dd(substr(md5('baeksan-optical'), 0, 16));
    //    dd(session('user'));

        Route::middleware('check.login')->group(function () {
            Route::get('/dabory/erp/induspex/optical-pos/eyetest-sale/eyetest', Utils::makeFrontRoute('/dabory/erp/induspex/optical-pos/eyetest-sale/eyetest'));
    //        Route::get('/dabory/erp/induspex/optical-pos/simple-sale/sorder-sales', Utils::makeFrontRoute('/dabory/erp/induspex/optical-pos/simple-sale/sorder-sales'));
    //        Route::get('/dabory/erp/induspex/optical-pos/eyetest-details', Utils::makeFrontRoute('/dabory/erp/induspex/optical-pos/eyetest-details'));
    //        Route::get('/dabory/erp/coupon-credit/summary', Utils::makeFrontRoute('/dabory/erp/coupon-credit/summary'));
            Route::get('/dabory/erp/coupon-credit/reward', Utils::makeFrontRoute('/dabory/erp/coupon-credit/reward'));
            Route::get('/dabory/erp/basic-settings/etc', Utils::makeFrontRoute('/dabory/erp/basic-settings/etc'));

            Route::get('/dabory/erp/coupon-credit/credit', Utils::makeFrontRoute('/dabory/erp/coupon-credit/credit'));
            Route::get('/dabory/erp/coupon-credit/customer_tie', Utils::makeFrontRoute('/dabory/erp/coupon-credit/customer_tie'));
    //        Route::get('/dabory/erp/mms/mms', Utils::makeFrontRoute('/dabory/erp/mms/mms'));
            Route::get('/dabory/erp/master-data/item', Utils::makeFrontRoute('/dabory/erp/master-data/item'));
            Route::get('/dabory/erp/master-data/item-tabbed', Utils::makeFrontRoute('/dabory/erp/master-data/item-tabbed'));
            Route::get('/dabory/erp/master-data/post-tabbed', Utils::makeFrontRoute('/dabory/erp/master-data/post-tabbed'));
            Route::get('/dabory/erp/master-data/prompt-tabbed', Utils::makeFrontRoute('/dabory/erp/master-data/prompt-tabbed'));
            Route::get('/dabory/erp/master-data/company-tabbed', Utils::makeFrontRoute('/dabory/erp/master-data/company-tabbed'));
    //        Route::get('/dabory/erp/master-data/item-list', Utils::makeFrontRoute('/dabory/erp/master-data/item-list'));
            Route::get('/dabory/erp/balance/list-form-balance', Utils::makeFrontRoute('/dabory/erp/balance/list-form-balance'));
            Route::get('/dabory/erp/stock/genio', Utils::makeFrontRoute('/dabory/erp/stock/genio'));
            Route::get('/dabory/erp/master-data/company', Utils::makeFrontRoute('/dabory/erp/master-data/company'));
            Route::get('/dabory/erp/purchase/pquote', Utils::makeFrontRoute('/dabory/erp/purchase/pquote'));
            Route::get('/dabory/erp/purchase/porder', Utils::makeFrontRoute('/dabory/erp/purchase/porder'));
            Route::get('/dabory/erp/purchase/purch', Utils::makeFrontRoute('/dabory/erp/purchase/purch'));

            Route::get('/dabory/erp/revenue/sorder', Utils::makeFrontRoute('/dabory/erp/revenue/sorder'));
            Route::get('/dabory/erp/revenue/sales', Utils::makeFrontRoute('/dabory/erp/revenue/sales'));
    //        Route::get('/dabory/erp/purchase/summary', Utils::makeFrontRoute('/dabory/erp/purchase/summary'));
            Route::get('/dabory/erp/accounting/acc-slip', Utils::makeFrontRoute('/dabory/erp/accounting/acc-slip'));
    //        Route::get('/dabory/erp/sales/sales', Utils::makeFrontRoute('/dabory/erp/sales/sales'));
    //        Route::get('/dabory/erp/statistic/combined', Utils::makeFrontRoute('/dabory/erp/statistic/combined'));
            Route::get('/dabory/erp/basic-settings/cgroup', Utils::makeFrontRoute('/dabory/erp/basic-settings/cgroup'));
            Route::get('/dabory/erp/basic-settings/igroup', Utils::makeFrontRoute('/dabory/erp/basic-settings/igroup'));
            Route::get('/dabory/erp/basic-settings/sgroup', Utils::makeFrontRoute('/dabory/erp/basic-settings/sgroup'));
            Route::get('/dabory/erp/basic-settings/storage', Utils::makeFrontRoute('/dabory/erp/basic-settings/storage'));
            Route::get('/dabory/erp/basic-settings/branch', Utils::makeFrontRoute('/dabory/erp/basic-settings/branch'));
            Route::get('/dabory/erp/basic-settings/my-users', Utils::makeFrontRoute('/dabory/erp/basic-settings/my-users'));
            Route::get('/dabory/erp/basic-settings/item-optpro', Utils::makeFrontRoute('/dabory/erp/basic-settings/item-optpro'));
            Route::get('/dabory/erp/basic-settings/monthly-settle', Utils::makeFrontRoute('/dabory/erp/basic-settings/monthly-settle'));

            Route::get('/dabory/erp/list-type/list-media1', Utils::makeFrontRoute('/dabory/erp/list-type/list-media1'));
            Route::get('/dabory/erp/etc/media', Utils::makeFrontRoute('/dabory/erp/etc/media'));

            Route::get('/dabory/erp/list-type/test3', Utils::makeFrontRoute('/dabory/erp/list-type/test3'));
            Route::get('/dabory/erp/basic-settings/monitoring', Utils::makeFrontRoute('/dabory/erp/basic-settings/monitoring'));

            Route::get('/dabory/erp/list-type/type1', Utils::makeFrontRoute('/dabory/erp/list-type/type1'));
            Route::get('/dabory/erp/list-type/genesis-type1', Utils::makeFrontRoute('/dabory/erp/list-type/genesis-type1'));
            Route::get('/dabory/erp/list-type/setup-type1', Utils::makeFrontRoute('/dabory/erp/list-type/setup-type1'));
            Route::get('/dabory/erp/list-type/struct-type1', Utils::makeFrontRoute('/dabory/erp/list-type/struct-type1'));
            Route::get('/dabory/erp/list-type/cal-type1', Utils::makeFrontRoute('/dabory/erp/list-type/cal-type1'));

            Route::get('/dabory/erp/list-type/search-type1', Utils::makeFrontRoute('/dabory/erp/list-type/search-type1'));

            Route::get('/dabory/erp/perm/user-perm', Utils::makeFrontRoute('/dabory/erp/perm/user-perm'));
            Route::get('/dabory/erp/perm/member-perm', Utils::makeFrontRoute('/dabory/erp/perm/member-perm'));
            Route::get('/dabory/erp/perm/app-api-perm', Utils::makeFrontRoute('/dabory/erp/perm/app-api-perm'));

            Route::get('/dabory/erp/shop/item-taxo', Utils::makeFrontRoute('/dabory/erp/shop/item-taxo'));
            Route::get('/dabory/erp/shop/widget-taxo', Utils::makeFrontRoute('/dabory/erp/shop/widget-taxo'));

            Route::get('/dabory/erp/sales/squote', Utils::makeFrontRoute('/dabory/erp/sales/squote'));

            Route::get('/dabory/erp/crm/project', Utils::makeFrontRoute('/dabory/erp/crm/project'));
            Route::get('/dabory/erp/pro/post-lang', Utils::makeFrontRoute('/dabory/erp/pro/post-lang'));

            Route::get('/dabory/erp/kibana/sales/sales-aggregate', Utils::makeFrontRoute('/dabory/erp/kibana/sales/sales-aggregate'));

            Route::get('/dabory/erp/vat/svat', Utils::makeFrontRoute('/dabory/erp/vat/svat'));
            Route::get('/dabory/erp/vat/pvat', function (BuyerService $buyerService) {
    //            $a = $buyerService->getQueryAll();
    //            dd($a);
                return view('front.dabory.erp.vat.pvat');
            });
        });

        Route::get('/user-signup', [SignupController::class, 'index'])->name('user-signup.index');
        Route::post('/user-signup', [SignupController::class, 'store'])->name('user-signup.store');

        Route::get('/user-confirm', [SignupController::class, 'confirm'])->name('user-confirm');

        Route::get('/user-signup-verify', [UserSignupVerifyController::class, 'index'])->name('user-signup-verify.index');
        Route::post('/user-signup-verify', [UserSignupVerifyController::class, 'store'])->name('user-signup-verify.store');
        Route::post('/user-signup-verify-send', [UserSignupVerifyController::class, 'sendCert'])->name('user-signup-verify.send');

        Route::get('/find-user-pw-verify', [FindUserPwVerifyController::class, 'index'])->name('find-user-pw-verify.index');
        Route::post('/find-user-pw-verify', [FindUserPwVerifyController::class, 'store'])->name('find-user-pw-verify.store');

        Route::get('/find-user-pw-verifyinput', [FindUserPwVerifyinputController::class, 'emailVerifyinput'])->name('find-user-pw-verifyinput');

        Route::get('/user-password-change', [PasswordChangeController::class, 'index'])->name('user-password-change.index');
        Route::post('/user-password-change', [PasswordChangeController::class, 'store'])->name('user-password-change.store');

        Route::get('/find-user-pw-memcheck', function () {
            return view('auth.find-user-pw-memcheck');
        })->name('find-user-pw-memcheck.index');

        Route::get('/user-verify-ok', function () {
            return view('auth.user-verify-ok');
        })->name('user-verify-ok');

        Route::get('/user-activate-failed', function () {
            return view('auth.user-activate-failed');
        })->name('user-activate-failed');

        Route::get('/user-go-email', function () {
            return view('auth.user-go-email');
        })->name('user-go-email');

        Route::get('/bbs/list/{postCode}', [PostController::class, 'list'])->name('dbrbbs.list');
        Route::get('/bbs/details/{postCode}/{slug}', [PostController::class, 'details'])->name('dbrbbs.details');
        Route::middleware('check.pro.member')->group(function () {
            Route::post('/bbs/comment', [PostController::class, 'comment'])->name('dbrbbs.comment.store');
        });

        Route::get('/bbs/list/{postCode}', [PostController::class, 'list'])->name('dbrbbs.list');
        // Route::get('/under-construction', [UnderConstructionController::class, 'index'])->name('under-construction');

        Route::get('/test1', function () {
            $formB = new App\Models\Parameter\FormB(request('bpa'), '/popup-setup/form-b/shipping-charge');
            return view('front.dabory.erp.popup-setup.form-b.shipping-charge-form', $formB->getData());
        })->name('test');
    });
});



Route::get('/under-construction', [UnderConstructionController::class, 'index'])->name('under-construction');
