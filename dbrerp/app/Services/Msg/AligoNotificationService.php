<?php

namespace App\Services\Msg;

use App\Interfaces\NotificationServiceInterface;
use App\Services\CacheService;
use Exception;
use Unirest\Request;
use Unirest\Request\Body;

class AligoNotificationService implements NotificationServiceInterface
{
    private $apiUrl = 'https://kakaoapi.aligo.in/akv10';
    protected $apiKey;
    protected $userId;
    protected $sender;
    protected $senderKey;
    private $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;

        // 환경 변수에서 값 가져오기
        $this->apiKey = env('SMS_APIKEY');
        $this->userId = env('SMS_USER');
        $this->sender = env('SMS_SENDER');
        $this->senderKey = env('SMS_SENDER_KEY');
    }

    private function getLatestTemplate($alertTalkTemplateList)
    {
        $latestTemplate = null;

        foreach ($alertTalkTemplateList as $template) {
            if ($template['Status'] !== 'S' && $template['InspStatus'] === 'APR') {
                if (is_null($latestTemplate) || $template['UpdatedDate'] > $latestTemplate['UpdatedDate']) {
                    $latestTemplate = $template;
                }
            }
        }

        return $latestTemplate;
    }

    private function prepareFormattedData($latestTemplate, $receiver, $replacementValues, $variableNames): array
    {
        // 휴대폰 번호 포맷팅: 숫자만 추출
        $formattedReceiver = preg_replace('/\D/', '', $receiver);

        // Initialize formatted data
        $formattedData = [
            'apikey' => $this->apiKey,
            'userid' => $this->userId,
            'senderkey' => $this->senderKey,
            'tpl_code' => $latestTemplate['TemplateCode'],
            'sender' => $this->sender,
            'receiver_1' => $formattedReceiver,
            'subject_1' => $latestTemplate['TemplateName'],
            'failover' => 'Y',
            'fsubject_1' => $latestTemplate['TemplateName'],
//            'testMode' => 'Y',
        ];

        // Replace variables in the MainContent
        $formattedData['message_1'] = $this->replaceVariables($latestTemplate['MainContent'], $replacementValues, $variableNames);
        $formattedData['fmessage_1'] = $this->replaceVariables($latestTemplate['Fmessage'], $replacementValues, $variableNames);

        // Handle EmphasizeTitle when EmphasizeType is 'T'
        if ($latestTemplate['EmphasizeType'] === 'T') {
            $formattedData['emtitle_1'] = $this->replaceVariables($latestTemplate['EmphasizeTitle'], $replacementValues, $variableNames);
        }

        // Replace variables in ButtonList if available
        if (isset($latestTemplate['ButtonList'][0])) {
            $buttons = [];
            $button = $latestTemplate['ButtonList'][0];
            $buttons[] = [
                'name' => $button['ButtonName'],
                'linkType' => $button['LinkType'],
                'linkM' => $this->replaceVariables($button['LinkMobile'], $replacementValues, $variableNames),
                'linkP' => $this->replaceVariables($button['LinkPC'], $replacementValues, $variableNames),
                'linkI' => $this->replaceVariables($button['LinkIOS'], $replacementValues, $variableNames),
                'linkA' => $this->replaceVariables($button['LinkAndroid'], $replacementValues, $variableNames),
            ];

            $formattedData['button_1'] = json_encode(['button' => $buttons]);
        }

        return $formattedData;
    }

    private function replaceVariables($content, $replacementValues, $variableNames)
    {
        foreach ($variableNames as $index => $variableName) {
            $placeholder = "[" . $variableName . "]";
            if (strpos($content, $placeholder) !== false) {
                $content = str_replace($placeholder, $replacementValues[$index], $content);
            }
        }
        return $content;
    }

    public function sendTemplate($brandCode, $receiver, $replacementValues, $variableNames)
    {
        $textTemplate = $this->cacheService->getSetup('text-template', $brandCode);
        $alertTalkTemplateList = $textTemplate['AlertTalkTemplateList'];

        if (! $textTemplate['SendToCustomer']) {
            return;
        }

        // 배열이나 필요한 값이 비어있을 경우 함수 종료
        if (empty($alertTalkTemplateList) || empty($this->apiKey) || empty($this->userId) || empty($this->senderKey)) {
            return;
        }

        $latestTemplate = $this->getLatestTemplate($alertTalkTemplateList);

        // $latestTemplate가 비어 있을 경우 함수 종료
        if (empty($latestTemplate)) {
            return;
        }
        $latestTemplate['Fmessage'] = $textTemplate['CustomerMessage'];

        $formattedData = $this->prepareFormattedData($latestTemplate, $receiver, $replacementValues, $variableNames);

        $response = $this->sendNotification('/alimtalk/send/', $formattedData);
        $isError = $response['code'] != 0;
//        dump($formattedData);
//        dd($response);
        if ($isError) {
            return;
        }
    }

    public function listTemplate(): array
    {
        $formattedData = [
            'apikey' => $this->apiKey,
            'userid' => $this->userId,
            'senderkey' => $this->senderKey,
        ];
        $response = $this->sendNotification('/template/list/', $formattedData);
        return $this->handleResponse($response);
    }
    public function createTemplate(array $templateData): array
    {
        $formattedData = $this->formatTemplateData($templateData);
        $response = $this->sendNotification('/template/add/', $formattedData);
        return $this->handleResponse($response);
    }

    public function modifyTemplate(array $templateData): array
    {
        $formattedData = $this->formatTemplateData($templateData);
        $formattedData['tpl_code'] = $templateData['TemplateCode'];
        $response = $this->sendNotification('/template/modify/', $formattedData);
        return $this->handleResponse($response);
    }

    public function delTemplate(array $templateData): array
    {
        $formattedData = [
            'apikey' => $this->apiKey,
            'userid' => $this->userId,
            'senderkey' => $this->senderKey,
            'tpl_code' => $templateData['TemplateCode'],
        ];

        $response = $this->sendNotification('/template/del/', $formattedData);
        return $this->handleResponse($response);
    }

    private function handleResponse(array $response): array
    {
        $isError = $response['code'] != 0;
        return [
            'error' => $isError,
            'message' => $response['message'] ?? null,
            'data' => $isError || !isset($response['data']) ? null : $response['data'],
            'list' => $isError || !isset($response['list']) ? null : $response['list'],
            'info' => $isError || !isset($response['info']) ? null : $response['info'],
        ];
    }

    public function requestTemplate(array $templateData): array
    {
        $formattedData = [
            'apikey' => $this->apiKey,
            'userid' => $this->userId,
            'senderkey' => $this->senderKey,
            'tpl_code' => $templateData['TemplateCode'],
        ];

        $response = $this->sendNotification('/template/request/', $formattedData);
        return $this->handleResponse($response);
    }

    public function sendNotification($apiName, array $template)
    {
        $headers = ['Accept' => 'application/json'];
        $fields = $template;

        // 파일이 존재한다면 'multipart/form-data' 형식으로 설정
        if (!empty($fields['image']) && file_exists($fields['image'])) {
            $headers = []; // 'multipart/form-data'는 Unirest가 자동으로 처리
            $fields['image'] = Body::file($fields['image']);
        }

        $response = Request::post($this->apiUrl . $apiName, $headers, $fields);

        if ($response->code == 200) {
            $data = json_encode($response->body ?? []);
            return json_decode($data, true);
        } else {
            throw new \Exception('Failed to send notification. Status code: ' . $response->code);
        }
    }

    private function formatTemplateData($templateData): array {
        $formattedData = [
            'apikey' => $this->apiKey,
            'userid' => $this->userId,
            'senderkey' => $this->senderKey,
            'tpl_name' => $templateData['TemplateName'],
            'tpl_content' => $this->replacePlaceholders($templateData['MainContent']),
            'tpl_emtype' => '',
            'tpl_type' => '',
        ];

        // EmphasizeType에 따른 tpl_emtype 값 설정
        switch ($templateData['EmphasizeType']) {
            case 'T':
                $formattedData['tpl_emtype'] = 'TEXT';
                $formattedData['tpl_title'] = $this->replacePlaceholders($templateData['EmphasizeTitle']);
                $formattedData['tpl_stitle'] = $templateData['EmphasizeSubtitle'];
                break;

            case 'L':
                $formattedData['tpl_emtype'] = 'IMAGE';
                $imagePath = public_path($templateData['ImageMessage']);

                if (file_exists($imagePath)) {
                    $formattedData['image'] = $imagePath;
                } else {
                    throw new Exception('이미지 파일을 찾을 수 없습니다.');
                }
                break;

            case 'N':
            default:
                $formattedData['tpl_emtype'] = 'NONE';
                break;
        }

        // TemplateType에 따른 tpl_type 및 추가 필드 설정
        switch ($templateData['TemplateType']) {
            case 'B':
                $formattedData['tpl_type'] = 'BA';
                break;

            case 'E':
                $formattedData['tpl_type'] = 'EX';
                $formattedData['tpl_extra'] = $templateData['AdditionalInfo'];
                break;

            case 'A':
                $formattedData['tpl_type'] = 'AD';
                $formattedData['tpl_advert'] = $templateData['ChannelAddedText'];
                break;

            case 'M':
                $formattedData['tpl_type'] = 'MI';
                $formattedData['tpl_extra'] = $templateData['AdditionalInfo'];
                $formattedData['tpl_advert'] = $templateData['ChannelAddedText'];
                break;

            default:
                throw new Exception('Unknown TemplateType value.');
        }

        // ButtonList 처리
        if (!empty($templateData['ButtonList'])) {
            $buttons = [];
            foreach ($templateData['ButtonList'] as $button) {
                $buttons[] = [
                    'name' => $button['ButtonName'],
                    'linkType' => $button['LinkType'],
                    'linkM' => $this->replacePlaceholders($button['LinkMobile']),
                    'linkP' => $this->replacePlaceholders($button['LinkPC']),
                    'linkI' => $this->replacePlaceholders($button['LinkIOS']),
                    'linkA' => $this->replacePlaceholders($button['LinkAndroid']),
                ];
            }

            $formattedData['tpl_button'] = json_encode(['button' => $buttons]);
        }

        return $formattedData;
    }

    private function replacePlaceholders($text) {
        return preg_replace('/\[(.*?)\]/', '#{\1}', $text);
    }
}
