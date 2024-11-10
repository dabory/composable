<?php

namespace App\Services\Scrap;

use App\Helpers\File;
use App\Services\CallApiService;
use App\Services\MediaLibraryService;
use App\Services\Msg\MailTemplateService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Unirest\Request;

class ItemUrlScrapService
{
    const BASE_URL = 'http://222.239.248.232:19080';
    private $callApiService;
    private $mediaLibraryService;
    private $gateToken;

    public function __construct(
        CallApiService $callApiService,
        MediaLibraryService $mediaLibraryService,
        MailTemplateService $mailTemplateService
    )
    {
        $this->callApiService = $callApiService;
        $this->mediaLibraryService = $mediaLibraryService;
        $this->mailTemplateService = $mailTemplateService;
    }

    public function execute($gateToken, $request)
    {
        $this->gateToken['main'] = $gateToken;
        $this->mediaLibraryService->setGateToken($gateToken);

        $response = $this->callApi($request['ItemUrl']);
        if ($this->callApiService->verifyApiError($response)) {
            return $response;
        }

        // 만약 파싱이 에러뜨면 킹콩 상태값0으로 기록 후 개발자와 대표님한테 이메일보낸다
        if ($response['SalesPrice'] === 0) {
            $this->insertKkcouponData(0, $response, $request, '0');
            $this->sendErrorEmail('wngur6076@naver.com', 'kimhi65@gmail.com', $request);
            return [ 'apiStatus' => 604, 'body' => 'This is a solution site that does not support' ];
        } else {
            $updatedMd5 = md5(json_encode($response));
            if (! $itemId = $this->existsUpdatedMd5($updatedMd5)) {
                if (empty($response['Images'])) {
                    $mediaIds = [1, 1];
                } else {
                    $mediaIds = $this->insertMediaData($this->imageUpload($response['Images'], $response['ItemName']));
                }
                $itemId = $this->insertItemData($mediaIds, $response, $request, $updatedMd5);
            }

            $this->insertKkcouponData($itemId, $response, $request);
            $this->sendEmail($request['BuyerEmail'], $request['BuyerEmail']);
        }

    }

    private function existsUpdatedMd5($updatedMd5)
    {
        $itemPick = $this->callApiService->callApi([
            'url' => 'item-pick',
            'data' => [
                'Page' => [
                    [
                        'UpdatedMd5' => $updatedMd5,
                    ]
                ],
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);

        if ($this->callApiService->verifyApiError($itemPick)) {
            if ($itemPick['apiStatus'] === 604) {
                return false;
            }
            throw new Exception('Dabory Api Error', $itemPick['apiStatus']);
        }

        return $itemPick['Page'][0]['Id'];
    }

    private function sendErrorEmail($developerEmail, $ceoEmail, $request)
    {
        $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.kkcoupon.kkcoupon-failure-1',
            [ 'C11' => $request['BuyerEmail'], 'C12' => $request['ItemUrl'], 'C13' => $request['InitDcrate'], 'C14' => $request['Sort'], 'C15' => $request['SortDesc'] ],
            $developerEmail, sprintf('[%s] 킹콩스크랩 실패 메일', config('app.name')), $this->gateToken['main']);

        $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.kkcoupon.kkcoupon-failure-1',
            [ 'C11' => $request['BuyerEmail'], 'C12' => $request['ItemUrl'], 'C13' => $request['InitDcrate'], 'C14' => $request['Sort'], 'C15' => $request['SortDesc'] ],
            $ceoEmail, sprintf('[%s] 킹콩스크랩 실패 메일', config('app.name')), $this->gateToken['main']);
    }

    private function sendEmail($buyerEmail, $sellerEmail)
    {
        $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.kkcoupon.kkcoupon-buyer-1',
            [],
            $buyerEmail, sprintf('[%s] 킹콩쿠폰 구매자 메일', config('app.name')), $this->gateToken['main']);

        $this->mailTemplateService->send('msg.dabory.pro.ko_KR.email.kkcoupon.kkcoupon-seller-1',
            [],
            $sellerEmail, sprintf('[%s] 킹콩쿠폰 판매자 메일', config('app.name')), $this->gateToken['main']);
    }

    private function insertKkcouponData($itemId, $scrap, $request, $status = '1')
    {
        $kkcouponAct = $this->callApiService->callApi([
            'url' => 'kkcoupon-act',
            'data' => [
                'Page' => [
                    [
                        'Id' => 0,
                        'TargetUri' => $request['ItemUrl'],
                        'ItemId' => $itemId,
                        'InitDcrate' => $request['InitDcrate'],
                        'BuyerEmail' => $request['BuyerEmail'],
                        'SellerEmail' => $scrap['Emails'][0] ?? '',
                        'Sort' => $request['Sort'],
                        'Status' => $status,
                        'IsClosed' => '0',
                        'IsFirstRequest' => '1',
                    ]
                ],
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);

        if ($this->callApiService->verifyApiError($kkcouponAct)) {
            throw new Exception('Dabory Api Error', $kkcouponAct['apiStatus']);
        }

        return true;
    }

    private function insertItemData($mediaIds, $scrap, $request, $updatedMd5)
    {
        $mediaId = 0;
        if (count($mediaIds) > 0) {
            $mediaId = array_shift($mediaIds);
        }

//        $domainName = explode('.', $scrap['DomainName'])[0];
        $linkproMd5 = md5($request['ItemUrl']);
        $itemCategory = empty($scrap['ItemCategory']) ? '' : $scrap['ItemCategory'];
        $itemAct = $this->callApiService->callApi([
            'url' => 'item-act',
            'data' => [
                'Page' => [
                    [
                        'Id' => 0,
                        'IgroupId' => 526,
                        'ItemCode' => Str::limit($linkproMd5, 21, ''),
                        'ItemSlug' => $linkproMd5,
                        'ItemName' => $scrap['ItemName'],
//                        'SubName' => $scrap['BrandName'],
                        'SalesPrc' => (string)$scrap['SalesPrice'],
                        'CountUnit' => $scrap['Currency'],
                        'ShortDesc' => $scrap['ShortDesc'],
                        'ItemDesc' => $scrap['OriginDesc'],
                        'CurrStkQty' => '999999',
                        'IsStyle' => '0',
                        'IsSelfOption' => '0',
                        'IsntPro' => '2',
                        'OfferCredit' => '0',
                        'RewardRate' => '0',
                        'RewardAmt' => '0',
                        'MediaId' => $mediaId,
                        'LinkproCategory' => $itemCategory,
                        'LinkproBrand' => $scrap['BrandName'],
                        'LinkproDomain' => $scrap['DomainName'],
                        'LinkproUrl' => $request['ItemUrl'],
                        'LinkproMd5' => $linkproMd5,
                        'UpdatedMd5' => $updatedMd5,
                    ]
                ],
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);

        if ($this->callApiService->verifyApiError($itemAct)) {
            throw new Exception('Dabory Api Error', $itemAct['apiStatus']);
        }

        $itemId = $itemAct['Page'][0]['Id'];
        $itemThmRq = [ 'Id' => $itemId ];
        foreach ($mediaIds as $i => $mediaId) {
            $index = $i + 1;
            $itemThmRq["MediaId$index"] = $mediaId;
        }

        $itemThmAct = $this->callApiService->callApi([
            'url' => 'item-thm-act',
            'data' => [
                'Page' => [
                    $itemThmRq
                ],
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);

        if ($this->callApiService->verifyApiError($itemThmAct)) {
            throw new Exception('Dabory Api Error', $itemThmAct['apiStatus']);
        }

        return $itemId;
    }

    private function insertMediaData($mediaList): array
    {
        $mediaAct = [];
        foreach ($mediaList as $media) {
            $mediaBact = $this->callApiService->callApi([
                'url' => 'media-bact',
                'data' => [
                    'HdPage' => [
                        $media['hd_page']
                    ],
                    'BdPage' => $media['bd_page']
                ],
                'headers' => [
                    'GateToken' => $this->gateToken['main']
                ]
            ]);

            if ($this->callApiService->verifyApiError($mediaBact)) {
                throw new Exception('Dabory Api Error', $mediaBact['apiStatus']);
            }

            $mediaAct[] = $mediaBact;
        }

        return collect($mediaAct)->pluck('HdPage')
            ->collapse()->pluck('Id')->toArray();
    }

    private function imageUpload($images, $itemName): array
    {
        $setup = $this->mediaLibraryService->getSetup('item');
        $path = $this->mediaLibraryService->getCurrSetupFilePath($setup);

        $mediaList = [];
        foreach ($images as $i => $imageUrl) {
            // 이미지 최대 수 11개
            if ($i === 11) { break; }
            $file = File::createFromUrl($imageUrl);
            $image = Image::make($file);
            $fileExtension = $file->extension();

            $media = [
                'name' => date('mdYHis') . uniqid() . $file->getClientOriginalName() . '.' . $fileExtension,
                'path' => $path,
                'setup' => $setup,
                'type' => 'image'
            ];

            $mediaList[$i]['hd_page'] = [
                'Id' => 0,
                'MediaNo' => $this->lastSlipNoGet(),
                'MediaDate' => Carbon::now()->format('Ymd'),

                'MediaBrand' => $setup['BrandCode'],
                'MediaName' => "$itemName-$i",
                'MineType' => $file->getMimeType(),
                'FileUrl' => '/' . substr($media['path'], '1') . $media['name'],
                'FileSize' => (int)round($image->filesize() / 1024),
                'MediaWidth' => $image->width(),
                'MediaHeight' => $image->height(),

                'IsClosed' => '0'
            ];

            $file->storeAs($media['path'], $media['name'], ['disk' => getDisk()]);

            if ($fileExtension === 'gif' || $fileExtension === 'webp' || $fileExtension === 'svg') {
                $mediaList[$i]['bd_page'] = $this->mediaLibraryService->makeGifBd($file, $media);
            } else {
                $mediaList[$i]['bd_page'] = $this->mediaLibraryService->makeImageBd($file, $media);
            }
        }

        return $mediaList;
    }

    private function callApi($itemUrl)
    {
        $response = Request::post(self::BASE_URL . '/product-page-get',
            [ 'Accept' => 'application/json', 'Content-Type' => 'application/json', ],

            json_encode([
                'Products' => [
                    [ 'Uri' => $itemUrl ]
                ],
            ], JSON_UNESCAPED_UNICODE)
        );

        if ($response->code === 200) {
            $data = json_encode($response->body ?? []);
            $data = json_decode($data, true);
            return $data['ProductPage'][0];
        } else {
            return [ 'apiStatus' => $response->code, 'body' => $response->body->msg ?? _e('Action failed') ];
        }
    }

    private function getCurrSetupFilePath($setup): string
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

    private function getSetup()
    {
        $response = $this->callApiService->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'media-body',
                'BrandCode' => 'item'
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            throw new Exception('Dabory Api Error', $response['apiStatus']);
        }

        $response['BrandCode'] = 'item';
        return $response;
    }

    private function lastSlipNoGet(): string
    {
        $response = $this->callApiService->callApi([
            'url' => 'last-slip-no-get',
            'data' => [
                'TableName' => 'common/media',
                'YYMMDD' => Carbon::now()->format('ymd'),
            ],
            'headers' => [
                'GateToken' => $this->gateToken['main']
            ]
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            throw new Exception('Dabory Api Error', $response['apiStatus']);
        }

        return Carbon::now()->format('ymd') . '-' . $response['LastSlipNo'];
    }
}
