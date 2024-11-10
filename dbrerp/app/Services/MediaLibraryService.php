<?php

namespace App\Services;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Services\CallApiService;
use Intervention\Image\ImageManagerStatic;


class MediaLibraryService
{
    private $callApiService;
    private $gateToken;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function setGateToken($gateToken)
    {
        $this->gateToken = $gateToken;
    }

    public function getCurrSetupFilePath($setup): string
    {
        $monthYearFolder = '';
        $subDir = '';

        if ($setup['SubDir']) {
            $subDir = $setup['BrandCode'] . '/';
        }

        if ($setup['DateFolderType'] === '0') {
            $monthYearFolder = date('/Y/m/');
        } else if ($setup['DateFolderType'] === '1') {
            $monthYearFolder = date('/Y/m/d/');
        }

        return '/uploads' . $monthYearFolder . $subDir;
    }

    public function getSetup($brandCode)
    {
        $response = $this->callApiService->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'media-body',
                'BrandCode' => $brandCode
            ],
            'headers' => $this->callApiService->getHeader($this->gateToken)
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            throw new Exception('Dabory Api Error', $response['apiStatus']);
        }

        $response['BrandCode'] = $brandCode;
        return $response;
    }

    public function lastSlipNoGet(): string
    {
        $response = $this->callApiService->callApi([
            'url' => 'last-slip-no-get',
            'data' => [
                'TableName' => 'common/media',
                'YYMMDD' => Carbon::now()->format('ymd'),
            ],
            'headers' => $this->callApiService->getHeader($this->gateToken)
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            throw new Exception('Dabory Api Error', $response['apiStatus']);
        }

        return Carbon::now()->format('ymd') . '-' . $response['LastSlipNo'];
    }

    public function makeGifBd($file, $media)
    {
        $setup = $media['setup'];

        $fullName = $media['name'];
        $extension = $file->extension();
//        $extension = $file->extension();
        $onlyName = explode('.' . $extension, $fullName)[0];

        $bdPage = [];
        $reSizeList = collect($setup)->except(['IsCutThumbImage', 'IsCutThumbMobImage', 'DateFolderType', 'BrandCode', 'SubDir', 'IsMonthYearFolder'])->toArray();

        foreach ($reSizeList as $key => $item) {
            if ($item['Width'] === 0 || $item['Height'] === 0) {
                continue;
            }

            if (Str::contains(strtolower($key), 'mob')) {
                $mob = preg_replace('/_size$/', '', Str::snake($key));
                $filePath = "{$onlyName}_{$mob}.{$extension}";
            } else {
                $filePath = "{$onlyName}_{$item['Width']}x{$item['Height']}.{$extension}";
            }

            $toFilePath = "{$media['path']}{$filePath}";
            $file->storeAs($media['path'], $filePath, ['disk' => getDisk()]);

            array_push($bdPage, [
                'ImageType' => explode('size', strtolower($key))[0],
                'BdFileUrl' => $toFilePath,
                'BdFileSize' => round($file->getSize() / 1024),
                'BdWidth' => $item['Width'],
                'BdHeight' => $item['Height'],
            ]);
        }

        return $bdPage;
    }

    public function makeImageBd($file, $media, $isCropImage = true)
    {
        $setup = $media['setup'];

        $fullName = $media['name'];
        $extension = $file->extension();
//        $extension = $file->extension();
        $onlyName = explode('.' . $extension, $fullName)[0];

        $bdPage = [];
        $reSizeList = collect($setup)->except(['IsCutThumbImage', 'IsCutThumbMobImage', 'DateFolderType', 'BrandCode', 'SubDir', 'IsMonthYearFolder'])->toArray();

        foreach ($reSizeList as $key => $item) {
            if ($item['Width'] === 0 || $item['Height'] === 0) {
                continue;
            }

//            $img = Image::make($file)
//                ->resize($item['Width'], null, function ($constraint) {
//                    $constraint->aspectRatio();
//                });

            $img = Image::make($file)
                ->resize($item['Width'], null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('webp');


//            if ($key == 'ThumbSize' && !$setup['IsCutThumbImage']) {
//                $img = Image::make($file)
//                    ->resize($item['Width'], null, function ($constraint) {
//                        $constraint->aspectRatio();
//                    });
//            } else {
//                $img = Image::make($file)
//                    ->resize($item['Width'], $item['Height']);
//            }

            if (Str::contains(strtolower($key), 'mob')) {
                $mob = preg_replace('/_size$/', '', Str::snake($key));
                $filePath = "{$onlyName}_{$mob}.webp";
            } else {
                $filePath = "{$onlyName}_{$img->width()}x{$img->height()}.webp";
            }
//            $filePath = "{$onlyName}_{$mob}{$img->width()}x{$img->height()}.{$extension}";
            $formPath = "{$media['path']}Resize_{$filePath}";
            $toFilePath = "{$media['path']}{$filePath}";

            // 로컬 일 때
            // $img->save(Storage::disk(getDisk())->path($formPath));

            $fileSize = 0;
            $bdWidth = 0;
            $bdHeight = 0;

            if ($isCropImage) {
                // S3 일 떄
                $img->encode();
                Storage::disk(getDisk())->put($formPath, $img->__toString(), ['visibility' => 'public']);
                //

                $fileSize = round($img->filesize() / 1024);
                $bdWidth = $img->width();
                $bdHeight = $img->height();

                if (Storage::disk(getDisk())->exists($toFilePath)) {
                    Storage::disk(getDisk())->delete($toFilePath);
                }

                Storage::disk(getDisk())->move($formPath, $toFilePath);
            }

            array_push($bdPage, [
                'ImageType' => explode('size', strtolower($key))[0],
                'BdFileUrl' => $toFilePath,
                'BdFileSize' => $fileSize,
                'BdWidth' => $bdWidth,
                'BdHeight' => $bdHeight,
            ]);
        }

        return $bdPage;
    }
}
