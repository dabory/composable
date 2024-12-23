<?php

use App\Exceptions\ParameterException;
use App\Http\Controllers\Front\Dabory\Pro\Sso\SsoAppController;
use App\Http\Controllers\Front\Dabory\Myapp\Member\MemberEditController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Helpers\ProUtils;
use Illuminate\Support\Facades\Storage;

// my-app
Route::middleware(['check.gate.token', 'app.token.manager'])->group(function () {
//Route::group(['middleware' => 'check.pro.member'], function () {
    Route::group(['middleware' => 'check.pro.member'], function () {
        // Route::prefix('my-app')->name('my-app.')->group(function () {
        Route::group(['prefix' => 'my-app', 'as' => 'my-app.'], function () {
            Route::get('/country-code', function () {
                session()->put('member.CountryCode', request('code'));
                // dd(session('member'));

                return redirect()->back();
            });

            Route::post('/clear-menu-cache', function () {
                Storage::delete('dabory-footage/members/' . session('member')['MemberId'] . '/000000-member-menu-perm-page');
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
                // dd(session('member'));
                return view('front.dabory.pro.my-app.index');
            })->name('index');

            Route::get('/sso/sso-app', [SsoAppController::class, 'index']);
            Route::post('/member-edit-verify', [MemberEditController::class, 'store'])->name('member-edit-verify.store');
            Route::post('/member-edit-verify-send', [MemberEditController::class, 'sendCert'])->name('member-edit-verify-send');
            Route::get('/list-type/type1', function() {
                if (empty(request('bpa'))) { return redirect()->route('my-app.index'); }

                try {
                    $type1 = (new App\Models\Parameter\Pro\Type1(request('bpa')));
                } catch (ParameterException $e) {
                    return redirect()->route('my-app.index')->with('error', 'ErrorMessage: '.$e->getMessage().
                        ' 경로에 Parameter 형식에 맞춰서 넣어주세요.');
                }

                $menuCode = ProUtils::bpaDecoding(request('bpa'))['menu_code'];

                return view('front.dabory.pro.my-app.list-type.type1',
                    array_merge(compact('menuCode'), $type1->getData())
                );
            });
        });
    });
});

Route::post('/download/env-dabory', function () {
    $env = json_decode(request('env'), true);
    $prefix = request('prefix');

    $contents = $prefix . '_URL=' . "'" . $env['api_url'] . "'" . PHP_EOL;
    $contents .= $prefix . '_CLIENT_ID=' . "'" . $env['client_id'] . "'" . PHP_EOL;
    $contents .= $prefix . '_CLIENT_SECRET=' . "'" . $env['client_secret'] . "'" . PHP_EOL;
    $contents .= $prefix . '_BEFORE_BASE64=' . "'" . $env['before_base64'] . "'" . PHP_EOL;

    $dt = \Carbon\Carbon::now()->timezone('Asia/Seoul');
    $filename = $dt->format('ymd-His') . '.env.' . request('app_name', 'dabory');
    return response()->streamDownload(function () use ($contents) {
        echo $contents;
    }, $filename);
});
