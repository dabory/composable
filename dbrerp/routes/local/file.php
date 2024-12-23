<?php

use App\Http\Controllers\GoogleOCRController;
use App\Services\CallApiService;
use App\Services\MediaLibraryService;
use App\Services\Msg\MailTemplateService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

Route::post('/put-msg-template', function () {
    $result = app(MailTemplateService::class)
        ->putTemplate(request('FilePath'), request('Message'), request('Theme'));

    return response([ 'error' => ! $result, 'data' => null ], 200);
});

Route::get('/google-ocr', [GoogleOCRController::class, 'index'])->name('index');
Route::post('/google-ocr', [GoogleOCRController::class, 'submit'])->name('submit');

Route::post('/pro-file-upload', function (Request $request) {
    if (!$request->hasFile('file')) {
        return response('error', 500);
    }
    $mediaLibraryService = app(MediaLibraryService::class);
    $mediaLibraryService->setGateToken(session('GateToken')['main']);
    $setup = $mediaLibraryService->getSetup('item');
    $path = $mediaLibraryService->getCurrSetupFilePath($setup);
    $file = $request->file('file');
    $image = Image::make($file);
    $fileExtension = $file->extension();

    $media = [
        'name' => date('mdYHis') . uniqid() . $file->getClientOriginalName() . '.' . $fileExtension,
        'path' => $path,
        'setup' => $setup,
        'type' => 'image'
    ];

    $hdPage = [
        'Id' => 0,
        'MediaNo' => $mediaLibraryService->lastSlipNoGet(),
        'MediaDate' => Carbon::now()->format('Ymd'),

        'MediaBrand' => $setup['BrandCode'],
        'MediaName' => $media['name'],
        'MineType' => $file->getMimeType(),
        'FileUrl' => '/' . substr($media['path'], '1') . $media['name'],
        'FileSize' => (int)round($image->filesize() / 1024),
        'MediaWidth' => $image->width(),
        'MediaHeight' => $image->height(),

        'IsClosed' => '0'
    ];

    $file->storeAs($media['path'], $media['name'], ['disk' => getDisk()]);

    if ($fileExtension === 'gif' || $fileExtension === 'webp' || $fileExtension === 'svg') {
        $bdPage = $mediaLibraryService->makeGifBd($file, $media);
    } else {
        $bdPage = $mediaLibraryService->makeImageBd($file, $media);
    }

    $mediaBact = app(CallApiService::class)->callApi([
        'url' => 'media-bact',
        'data' => [
            'HdPage' => [
                $hdPage
            ],
            'BdPage' => $bdPage
        ]
    ]);

    if (app(CallApiService::class)->verifyApiError($mediaBact)) {
        return response('error', 500);
    }

    return response()->json($mediaBact);
});
