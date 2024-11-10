<?php

namespace App\Services\Msg;

use App\Helpers\File;
use App\Services\CallApiService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailTemplateService
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function testSend($component, $data, $toMail, $subject)
    {
        Mail::send($component, ['data' => $data],
            function ($message) use ($toMail, $subject) {
                $message->to($toMail);

                $message->subject($subject);
            }
        );

        if (count(Mail::failures()) > 0){
            return false;
        }

        return true;
    }

    public function send($component, $data, $toMail, $subject, $gateToken = null)
    {
        $data = $this->getSetup($data, $gateToken);

        Mail::send($component, ['data' => $data],
            function ($message) use ($toMail, $subject) {
                $message->to($toMail);

                $message->subject($subject);
            }
        );

        if (count(Mail::failures()) > 0){
            return false;
        }

        return true;
    }

    public function putTemplate($filePath, $message, $theme)
    {
        $countryCode = session('user')['CountryCode'] ?? config('constants.countries')[0];

        if ($theme) {
            $fullFilePath = public_path("themes/{$theme}/resources/views/msg/dabory/pro/{$countryCode}/email/{$filePath}.blade.php");
        } else {
            $fullFilePath = resource_path("views/msg/dabory/pro/{$countryCode}/email/{$filePath}.blade.php");
        }
//        $exists = file_exists($fullFilePath);

//        $message = Str::replace('{{%24', '{{$', $message);
//        $message = Str::replace('{{msset(%24', '{{msset($', $message);
        return File::forceFilePutContents($fullFilePath, $message);
    }

    private function getSetup($data, $gateToken)
    {
        $headers = [];
        if ($gateToken) {
            $headers = [
                'GateToken' => $gateToken
            ];
        }
        $setup = $this->callApiService->callApi([
            'url' => 'setup-get',
            'data' => [
                'SetupCode' => 'email-header-footer',
            ],
            'headers' => $headers
        ]);

        return array_merge([
            'C1' => $setup['Logo'],
            'C2' => $setup['Url'],
            'C3' => $setup['Name'],
            'C4' => $setup['Footer'],
        ], $data);
    }
}
