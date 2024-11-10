<?php

use App\Facades\ProApiCacheFacade;
use App\Helpers\File;
use App\Helpers\Utils;
use App\Exports\Type1Export;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\CaptchaServiceController;
use App\Http\Controllers\DBUpdateController;
use App\Http\Controllers\EnvSettingController;
use App\Imports\Type1Import;
use App\Services\CallApiService;
use Illuminate\Http\Request;

use App\Models\Parameter\FormA;
use App\Models\Parameter\FormB;
use App\Models\Parameter\Modal;
use App\Models\Parameter\Manual;
use Barryvdh\DomPDF\Facade as PDF;

use App\Models\Parameter\ListMedia1;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\CountryCodeController;
use App\Http\Controllers\Api\OpenAIController;
use Spatie\Sitemap\SitemapGenerator;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['check.logout'])->group(function () {
    Route::get('/sitemap', function () {
        SitemapGenerator::create('https://blanker.daboryhost.com')
            ->writeToFile(public_path('sitemap.xml'));
        return redirect()->back();
    });

    Route::get('/checkphp', function () {
        return phpinfo();
    });
    Route::get(env('USER_LOGIN_ROUTE', '/user-login') ?: '/user-login', [LoginController::class, 'index'])->middleware('check.gate.token')->name('user-login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('check.gate.token')->name('login.post');

    Route::get('/db-update', [DBUpdateController::class, 'index'])->name('db-update.index');
    Route::post('/db-update', [DBUpdateController::class, 'store'])->name('db-update.store');
});

Route::middleware(['check.login'])->group(function () {
    Route::get('/dabory/erp', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/user-logout', [LoginController::class, 'logout'])->name('user-logout');

    Route::get('/tabbed-menu-hash/{hash}', function ($hash) {
        $menuList = Utils::getMainMenu('all');
        $menuPages = Utils::bpaEncoding($menuList['Page'])->toArray();
        $menu = collect($menuPages)->filter(function ($menu) use ($hash) {
            return $menu['TabbedMenuHash'] === $hash;
        })->first();
        $url = $menu['PageUri'] . '?bpa=' . $menu['bpa'] . '&id=' . request('id');
        return redirect()->to($url);
    });

    Route::post('/cert/mail', [\App\Http\Controllers\CertController::class, 'mail']);
    Route::post('/cert/mobile', [\App\Http\Controllers\CertController::class, 'mobile']);
    Route::post('/superuser-email-change', function () {
        $mailCert = session()->get('mailCert');
        $smsCertCurrent = session()->get('smsCert.current');
        $smsCertNew = session()->get('smsCert.new');

        if (request('Type') === 0 && request('EmailVerifyNumber', '??????') != $mailCert['number']) {
            return response()->json(['error' => true, 'message' => '메일 인증번호 오류']);
        }

        if (request('Type') === 1 && request('MobileVerifyNumber', '??????') != $smsCertCurrent['number']) {
            return response()->json(['error' => true, 'message' => '현재 모바일폰에서 확인한 인증번호 오류']);
        }

        if (request('Type') === 2 && request('NewMobileVerifyNumber', '??????') != $smsCertNew['number']) {
            return response()->json(['error' => true, 'message' => '변경 관리자 모바일폰에서 확인한 인증번호 오류']);
        }

        return response()->json(['error' => false, 'message' => 'Success']);
    });

    Route::get('/user-query-turbo/{table}', function ($table) {
        $response = app(CallApiService::class)->callApi([
            'url' => 'query-turbo',
            'data' => [
                'TableName' => $table,
                'QueryVars' => [
                    'MyFilter' => '',
                    'QueryName' => '',
                    'FilterName' => '',
                    'FilterValue' => '',
                    'SimpleFilter' => 'mx.id between 1 and 10000',
                    'SubSimpleFilter' => '',
                    'IsntPagination' => true,
                    'TestMode' => '',
                ]
            ],
        ]);

        if (app(CallApiService::class)->verifyApiError($response)) {
            return response([
                'body' => 'Api Server Error',
                'apiStatus' => 500
            ], 200);
        }

        notify()->success(_e('Action completed'), 'Success', 'bottomRight');
        return redirect()->back();
    })->name('user.query.turbo');

    // Route::post('/ajax/get-data', [ApiController::class, 'getData']);
    Route::get('/country-code', [CountryCodeController::class, 'store']);

    Route::get('/change-sort-menu/{sort_menu_id}', function ($sortMenuId) {
        $sortMenuPage = Utils::getSortMenu()['Page'] ?? [];
        $filterSortMenu = collect($sortMenuPage)->filter(function ($sortMenu) use($sortMenuId) {
            return $sortMenu['Id'] === (int)$sortMenuId;
        })->first();
        session()->put('user.SortMenu', $filterSortMenu);

        return redirect()->to($filterSortMenu['C4']);
    })->name('change-sort-menu');
});

// admin, pro 공용
// Route::get('/dabory/ssologin/callback', [DaborySSOController::class, 'login'])->middleware('check.gate.token')->name('dabory.ssologin.login');
// Route::get('/dabory/ssologin', [DaborySSOController::class, 'redirectToProvider'])->middleware('check.gate.token')->name('dabory.redirectToProvider');
Route::post('/ajax/openai-completion', [OpenAIController::class, 'getCompletion'])->middleware('check.gate.token')->name('openAi');
Route::get('/social/{provider}/callback', [SocialController::class, 'login'])->middleware('check.gate.token')->name('social.login');
Route::post('/social/{provider}/callback', [SocialController::class, 'login'])->middleware('check.gate.token');
Route::get('/social/{provider}', [SocialController::class, 'redirectToProvider'])->middleware('check.gate.token')->name('social.redirectToProvider');

Route::post('/ajax/get-data', [ApiController::class, 'getData']);

Route::post('/find-gate-token', function () {
    if (! request()->has('app_name')) {
        return response('error', 500);
    }

    $appName = request('app_name');
    if (session()->has("GateToken.$appName")) {
        return response(session()->get("GateToken.$appName"), 200);
    }

    return response(session()->get("GateToken.$appName"), 200);
});


Route::post('/md5', function () {
    return md5(request('str'));
});

Route::get('/generate-keys', function () {
    $keyPair = sodium_crypto_box_keypair();
    $publicKey = sodium_crypto_box_publickey($keyPair);
    return array(base64_encode($publicKey),base64_encode($keyPair));
});

Route::get('/extract-keys', function () {
    $keyPair = base64_decode(request('key_pair'));
    $publicKey = sodium_crypto_box_publickey($keyPair);
    return base64_encode($publicKey);
});

Route::post('/crypto/sodium', function () {
    $data = json_decode(request()->getContent(), true);
    $decrypted = $data['decrypted'];
    if ($data['json_encode']) {
        $decrypted = json_encode( $decrypted );
    }

    return base64_encode(sodium_crypto_box_seal($decrypted,
        base64_decode( $data['public_key'] )));
});

Route::get('/user-clear-cache', function () {
    Artisan::call('event:clear');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    // Storage::deleteDirectory('dabory-footage/users/' . session('user')['UserId']);
    Storage::deleteDirectory('dabory-footage/users');
    Storage::deleteDirectory('dabory-footage/pro');
    Storage::deleteDirectory('dabory-footage/basic/slip-form-init');

    Storage::deleteDirectory('dabory-footage/members');
    ProApiCacheFacade::deleteCachedDirectory();

    app(\App\Services\CacheService::class)->putMainMenu();
    app(\App\Services\CacheService::class)->putEtcBrand();
    app(\App\Services\CacheService::class)->putSetup();
    app(\App\Services\CacheService::class)->putThemeSetup();

//     app(\App\Services\CacheService::class)->putTabbedMenuHash();

    return redirect()->back();
})->name('user.clear.cache');

Route::post('/clear-menu-cache', function () {
    Storage::deleteDirectory('dabory-footage/users/' . session('user')['UserId'] . '/user-menu');
});

Route::get('/506', function () {
    return view('errors.506');
})->name('506');

// js에서 에러 예외처리 할 때 사용
Route::get('/505', function () {
    session()->flush();

    return view('errors.505');
})->name('505');

Route::get('/503', function () {
    session()->flush();

    return view('errors.503');
})->name('503');

Route::get('/600', function () {
    session()->flush();

    return view('errors.600');
})->name('600');

Route::get('/pro-route-std', function () {
    return view('pro-route-std');
})->name('pro-route-std');

Route::get('/pro-route-custom', function () {
    return view('pro-route-custom');
})->name('pro-route-custom');

Route::get('/captcha-validation', [CaptchaServiceController::class, 'capthcaFormValidate']);
Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);


Route::get('/test', function () {
    return view('eyetest-more');
});

Route::get('/eyetest-more-ui', function () {
    return view('front.dabory.erp.test-ui.eyetest-more-ui');
});

// demo gettext
Route::get('/demo-gettext', function () {
    // return _e('admin');
    // return _e('file moved');
    return _e('%s file moved to %s', 'aaa.php', 'bbb.php');
});

// test-tailwind-css
Route::get('/tailwind-css-test', function () {
    return view('main.tailwind-css-test');
});

// 테스트떄문에 에러토큰으로 변경 (GateToken Not Found Test)
Route::post('/token-change', function () {
    session()->put('GateToken.erp', 'duoICbFSNRRoxXoIaC0G');
    return response('');
});

Route::get('/test/image-ui', function () {
    return view('test.image-ui');
});

Route::get('/geolocation', function () {
    return view('geolocation');
});

Route::get('/barcode/{listToken}', [BarcodeController::class, 'index'])->name('barcode');


Route::middleware('check.gate.token')->group(function () {
    Route::post('/blades', function () {
        if (request('data')) {
            $key = request('key') ?? 'moealSetFile';

            if (empty(request('class_name'))) {
                return view(request('path_to_blade'), [$key => request('data')]);
            } else {
                return view(request('path_to_blade'), array_merge(request('class_name'), [$key => request('data')]));
            }
        }
        return view(request('path_to_blade'));
    });

    Route::post('/pro-skin-directories', function () {
        $directories = App\Helpers\File::getSkinDirectories();

        return response($directories, 200);
    });

    Route::post('/breadcrumb', function () {
        $breadcrumb = breadcrumb(request('igroup_code'));

        return response($breadcrumb, 200);
    });

    Route::post('/set-general-info', [EnvSettingController::class, 'setGeneralInfo']);
    Route::post('/set-aws-s3', [EnvSettingController::class, 'setAwsS3']);
    Route::post('/set-aligo-text-send', [EnvSettingController::class, 'setAligoTextSend']);

    Route::post('/excel-import', function (Request $request) {
        if (!$request->hasFile('file')) {
            return response('error', 500);
        }

        $data = Excel::toArray(new Type1Import, $request->file('file'));
        return response($data, 200);
    });

    Route::post('/sub-image-upload', function (Request $request) {
        $formExt = pathinfo(request('form_file_path'), PATHINFO_EXTENSION);
        $toExt = pathinfo(request('to_file_path'), PATHINFO_EXTENSION);

        if ($formExt !== $toExt) {
            Storage::disk(getDisk())->delete(request('form_file_path'));
            return response('보정 파일과 이전 파일의 확장자가 다릅니다.', 202);
        }

        Storage::disk(getDisk())->delete(request('to_file_path'));

        Storage::disk(getDisk())->move(request('form_file_path'), request('to_file_path'));

        return response('success', 200);
    });

    Route::post('/sub-image-correction', function (Request $request) {
        if (!$request->hasFile('file')) {
            return response('error', 500);
        }

        $path = '/uploads';
        $response = Storage::disk(getDisk())->put($path, $request->file('file'), ['visibility' => 'public']);

        return response($response, 200);
    });

    Route::post('/file-exists', function () {
        if (Storage::disk(getDisk())->exists(request('file_path'))) {
            return response(true, 200);
        }
        return response(false, 200);
    });

    Route::post('/seo-meta-file-list', function (Request $request) {
        $publicPath = public_path();
        $files = \File::files($publicPath);

// Filter root files (not in subdirectories)
        $rootFiles = array_filter($files, function ($file) use ($publicPath) {
            return $file->getPath() == $publicPath;
        });

// Extract only the names of the root files
        $rootFileNames = array_map(function ($file) {
            return $file->getFilename();
        }, $rootFiles);

        return $rootFileNames;
    });

    // Route::get('/under-construction', function () {
    //     $underConstrunctionPath = env('UNDER_CONSTRUCTION_PATH');
    //     if(empty($underConstrunctionPath)){
    //         $viewPath = 'under-construction';
    //     }else{
    //         $pathSegments = explode('::', $underConstrunctionPath);
    //         if(count($pathSegments) < 2){
    //             dd('2보다작음');
    //         }else{
    //             $theme = $pathSegments[0];
    //             $path = $pathSegments[1];
    //             $viewPath = str_replace('/', '.', $path);
    //             $viewDirectory = daboryPath('themes/' . $theme . '/pro/resources/views');

    //             // 뷰 경로 설정
    //             View::addNamespace($theme, $viewDirectory);
    //             $viewPath = "{$theme}::{$viewPath}";
    //         }

    //     }

    //     return view($viewPath);
    // });


    Route::post('/brand-image-file-list', function (Request $request) {
        $filePath = daboryPath("themes/" . env('DBR_THEME') . "/pro/resources/assets/brand-images");
        $files = \File::allFiles($filePath);

    // Filter root files (not in subdirectories)
        $rootFiles = array_filter($files, function ($file) use ($filePath) {
            return $file->getPath() == $filePath;
        });

    // Extract only the names of the root files
        $rootFileNames = array_map(function ($file) {
            return $file->getFilename();
        }, $rootFiles);

        return $rootFileNames;
    });

    Route::post('/seo-meta-file-upload', function (Request $request) {
        if (!$request->hasFile('file')) {
            return response('error', 500);
        }

        $file = $request->file('file');
        $file->storeAs('/', request('fileName'), ['disk' => 'erp']);

        return response($file, 201);
    });

    Route::post('/brand-image-file-upload', function (Request $request) {
        if (!$request->hasFile('file')) {
            return response('error', 500);
        }

        $file = $request->file('file');
        $file->storeAs('/themes/'.env('DBR_THEME').'/pro/resources/assets/brand-images', request('fileName'), ['disk' => 'dabory']);

        return response($file, 201);
    });

    Route::post('/brand-image-file-delete', function () {
        $file_path_list = json_decode(request('file_path_list'), true);
        $filePath = "themes/" . env('DBR_THEME') . "/pro/resources/assets/brand-images";
        $fullPaths = array_map(function ($file) use ($filePath) {
            return $filePath . '/' . $file;
        }, $file_path_list);

        Storage::disk('dabory')->delete($fullPaths);

        return response('success', 200);
    });


    Route::post('/upload-batch', function (Request $request) {
        $mediaList = request('media_list');

        foreach ($mediaList as $media) {
            $mediaPath = substr($media['path'], '1') . $media['name'];
            try {
                $file = File::pathToUploadedFile(Storage::disk(getDisk())->path($mediaPath));
            } catch (Exception $e) {
                return response([
                    'body' => $media['path'] . $media['name'] . ' 파일이 존재하지 않아서 Upload Batch 실행 취소했습니다',
                    'apiStatus' => 501
                ], 200);
            }

            $image = Image::make($file);

            $mediaAct = app(CallApiService::class)->callApi([
                'url' => 'media-act',
                'data' => [
                    'Page' => [
                        [
                            'Id' => $media['media_id'],
                            'FileUrl' => "/{$mediaPath}",
                            'FileSize' => (int)round($image->filesize() / 1024),
                            'MediaWidth' => $image->width(),
                            'MediaHeight' => $image->height(),
                        ]
                    ],
                ],
            ]);

            if (app(CallApiService::class)->verifyApiError($mediaAct)) {
                return response([
                    'body' => 'Api Server Error',
                    'apiStatus' => 500
                ], 200);
            }

            $bdPage = app(App\Services\MediaLibraryService::class)
                ->makeImageBd($file, $media, request('is_crop_image'));

            $mediaBdPage = collect($bdPage)->map(function ($item) use ($media) {
                return [
                    'Id' => 0,
                    'MediaId' => $media['media_id'],
                    'ImageType' => $item['ImageType'],
                    'BdFileUrl' => $item['BdFileUrl'],
                    'BdFileSize' => (int)$item['BdFileSize'],
                    'BdWidth' => $item['BdWidth'],
                    'BdHeight' => $item['BdHeight'],
                ];
            })->toArray();

            if (count($mediaBdPage) > 0) {
                $mediaBdAct = app(CallApiService::class)->callApi([
                    'url' => 'media-bd-act',
                    'data' => [
                        'Page' => $mediaBdPage
                    ],
                ]);

                if (app(CallApiService::class)->verifyApiError($mediaBdAct)) {
                    return response([
                        'body' => 'Api Server Error',
                        'apiStatus' => 500
                    ], 200);
                }
            }
        }

        return response('success', 201);
    });

    Route::post('/post-attached-files', function (Request $request) {
        $mediaLibraryService = app(App\Services\MediaLibraryService::class);
        $mediaLibraryService->setGateToken(session('GateToken')['main']);
        $setup = $mediaLibraryService->getSetup('post');
        $path = $mediaLibraryService->getCurrSetupFilePath($setup);
        $attachedFiles = '';
        for ($i = 0; $i < $request['fileCount']; $i++) {
            $file = $request->file('file' . $i);
            $file->storeAs($path, $file->getClientOriginalName(), ['disk' => getDisk()]);
            $attachedFiles .= $path . $file->getClientOriginalName() . '|';
        }
        $attachedFiles = rtrim($attachedFiles, '|');

        return response()->json($attachedFiles);
    });


    Route::post('/file-upload', function (Request $request) {
        if (!$request->hasFile('file')) {
            return response('error', 500);
        }
        // $type = $request->input('type');
        $media = json_decode(request('media'), true);
        $file = $request->file('file');

        // if (isset($type) && !empty($type)) {
        //     $path = $media['path'] ?? 'default/path'; // 기본 경로 설정
        //     $filePath = \Storage::disk(getDisk())->put($path, $file);
        //     // return $filePath;
        //     return response($filePath, 201);
        // }
         $file->storeAs($media['path'], $media['name'], ['disk' => getDisk()]);

        $bdPage = [];
        if ($media['type'] == 'image') {
            $fileExtension = Str::lower($file->extension());
            if ($fileExtension === 'gif' || $fileExtension === 'webp' || $fileExtension === 'svg') {
                $bdPage = app(App\Services\MediaLibraryService::class)->makeGifBd($file, $media);
            } else {
                $bdPage = app(App\Services\MediaLibraryService::class)->makeImageBd($file, $media);
            }
        }

        return response($bdPage, 201);
    });

    Route::post('/file-delete', function () {
        $file_path_list = json_decode(request('file_path_list'), true);
        Storage::disk(getDisk())->delete($file_path_list);

        return response('success', 200);
    });

    Route::post('/cache-api', function () {
        $cacheData = Utils::getParamCache(request('menu_code'), request('api_name'));
        if (request('query_name')) {
            $cacheData = Utils::getParamCache(request('menu_code'), request('api_name'), request('query_name'));
        }
        return $cacheData;
    });

    Route::post('/download/report', function () {
        $report = json_decode(request('report'), true);
        switch ($report['type']) {
            case 'pdf':
                $customPaper = array(0, 0, $report['size'], $report['size']);
                $table['head'] = $report['head'];
                $table['body'] = $report['body'];
                $pdf = PDF::loadView('pdf.table', compact('table'))->setPaper($customPaper, 'landscape');
                return $pdf->download("{$report['title']}.pdf");
            case 'excel':
                $report['body'] = collect($report['body'])->prepend($report['head']);

                return Excel::download(new Type1Export($report['body']), "{$report['title']}.xlsx");
        }
    });

    Route::post('/paras', function () {
        $themeDir = request('theme_dir', 'empty');
        $paraType = request('para_type');
        $pathToPara = request('path_to_para');
        $bpa = request('bpa', '');

        try {
            if ($paraType == 'modal') {
                $para = (new Modal($pathToPara, $themeDir))->getData();
            } else if ($paraType == 'formA') {
                $para = (new FormA($bpa, $pathToPara, $themeDir))->getData('data');
            } else if ($paraType == 'formB') {
                $para = (new FormB($bpa, $pathToPara, $themeDir))->getData('data');
            } else if ($paraType == 'manual') {
                $para = (new Manual($pathToPara, $bpa))->getData();
            } else if ($paraType == 'listMedia1') {
                $para = (new ListMedia1($bpa, $pathToPara))->getData('data');
            }
        } catch (Exception $e) {
            return response([
                'body' => $e->getMessage(),
                'apiStatus' => 404
            ], 200);
        }

        return $para;
    });
});
