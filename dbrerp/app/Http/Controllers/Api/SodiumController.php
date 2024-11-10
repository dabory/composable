<?php

namespace App\Http\Controllers\Api;

use App\Helpers\File;
use Illuminate\Support\Facades\Validator;
use Unirest\Request\Body;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Unirest\Request as Unirest;
use App\Services\CallApiService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SodiumController extends Controller
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    public function store(Request $request)
    {
        $arr = $request->getContent();
        $data = json_decode($arr);

        try {
            $decrypted = sodium_crypto_box_seal_open(base64_decode($data->BeforeBase64), base64_decode($data->Key));
            return $decrypted;
            $retObj = array('AfterBase64' => base64_encode($decrypted));

            return response()->json($retObj);
        } catch (\Throwable $th) {
            return $this->apiArrayResponseBuilder(400, 'Error, data failed to request.'. $arr);
        }
    }

    public function apiArrayResponseBuilder($statusCode = null, $message = null, $data = [])
    {
        $arr = [
            'status_code' => (isset($statusCode)) ? $statusCode : 500,
            'message' => (isset($message)) ? $message : 'error'
        ];
        if (count($data) > 0) {
            $arr['data'] = $data;
        }

        return response()->json($arr, $arr['status_code']);
    }

    public function textSend2(Request $request)
    {
        // $request = Utils::getParamFile('/etc/request/text-send');

        $msgType = 'MMS';
        $mainText = $request['TextVars']['TemplateText'];
        if ($request['TextVars']['TemplateCode']) {
            $gateTokenResponse = $this->callApiService->callApi([
                'url' => 'gate-token-get',
                'data' => [
                    'ClientId' => config("app.api.main.ClientId"),
                    'BeforeBase64' => base64_encode(sodium_crypto_box_seal(json_encode(config("app.api.main.decrypted")),
                        base64_decode(config("app.api.main.public_key")))),
                ],
            ]);

            if (isset($gateTokenResponse['apiStatus'])) { return response()->json($gateTokenResponse);  }

            $response = $this->callApiService->callApi([
                'url' => 'text-template-pick',
                'data' => [
                    'Page' => [ [  'textCode' => $request['TextVars']['TemplateCode'] ] ]
                ],
                'headers' => ['GateToken' => $gateTokenResponse['GateToken']]
            ]);
            $mainText = $response['Page'][0]['MainText'];
            // dbr_text_template에서 TemplateCode이용해서 MmsImages 목록을 가져온다.
            $mmsImages = $response['Page'][0]['MmsImages'];
            switch ($response['Page'][0]['Sort']) {
                case '0':
                    $msgType = 'SMS';
                    break;
                case '1':
                    $msgType = 'LMS';
                    break;
                case '2':
                    $msgType = 'MMS';
                    $mmsImageUrl = explode(',', $mmsImages)[0];

                    // 밑에 주석풀면 외부 이미지 url 테스트
                    // $mmsImage = 'https://naxon.dev/assets/img/portrait.jpg';

                    if (\Str::contains($mmsImageUrl, [url('/'), 'localhost', '127.0.0.1'])) {
                        // 파일저장 url이 localhost -> file path 가져온다.
                        $mmsImagePath = explode(url('/'), $mmsImageUrl)[1];
                        $image = Body::file(Storage::disk('erp')->path($mmsImagePath));
                    } else {
                        // 파일저장 url이 외부이면 php 업로드 임시폴더 위치에 파일을 써준다.
                        $file = File::createFromUrl($mmsImageUrl);
                        $image = Body::file($file, File::mimeType($file->path()), "{$file->getClientOriginalName()}.{$file->extension()}");
                    }
                    break;
            }
        }

        $data = [
            'key' => 'pdrtbljgiyisp6sgghouoxarlr1g8f7t',
            'user_id' => 'bseyewear',
            'sender' => '01090148146',
            'title' => $request['TextVars']['TemplateTitle'],
            'cnt' => count($request['Page']),
            'msg_type' => $msgType,
            'image' => isset($image) ? $image : '',
        ];

        foreach ($request['Page'] as $i => $item) {
            $data['rec_' . ($i + 1)] = $item['Receiver'];

            $templateText = $mainText;
            foreach ($item['ReplaceVars'] as $replaceVar) {
                if (isset($replaceVar['VarValue'])) {
                    $templateText = Str::replace("{{$replaceVar['VarName']}}", $replaceVar['VarValue'], $templateText);
                }
            }
            $data['msg_' . ($i + 1)] = $templateText;
        }

        $response = Unirest::post(
            'https://apis.aligo.in/send_mass/',
            ['Accept' => 'application/json'],
            $data,
        );

        if (isset($file)) {
            // php 업로드 임시폴더에서 파일을 지워준다.
            unlink($file->path());
        }

        return response()->json($response);
    }

    public function imageTest(Request $request)
    {
        $data['key'] = "pdrtbljgiyisp6sgghouoxarlr1g8f7t";//인증키
        $data['user_id'] = "bseyewear"; // SMS 아이디

        $data['sender'] ="01090148146"; // 발신번호
        $data['receiver'] = '01086276076'; // 수신번호
        $data['msg'] = '%고객명%님. 안녕하세요. API TEST SEND';
        $data['msg_type'] = 'MMS';

        $image = '/uploads/2021/10/수지1.jpg';

        $body = Body::multipart($data, [
            'image' => Storage::disk('erp')->path($image)
        ]);

        $response = Unirest::post(
            'https://apis.aligo.in/send/',
            ['Accept' => 'application/json'],
            $body
        );

        return response()->json($response);
    }

    public function textSend()
    {
        if (request('password') !== 'juhyeok') {
            return $this->apiArrayResponseBuilder(401, 'Unauthorized');
        }

        if (request('mode') === '.env.dabory') {
            return response()->json(config('app.api'));
        }

        $gateTokenResponse = $this->callApiService->callApi([
            'url' => 'gate-token-get',
            'data' => [
                'ClientId' => request('ssohost_client_id'),
                'BeforeBase64' => request('ssohost_before_base64')
            ],
        ]);

        if (request('mode') === 'sso-app-page') {
            $response = $this->callApiService->callApi([
                'url' => 'sso-app-page',
                'data' => [
                    'PageVars' => [
                        'Desc' => 'Id',
                        'Limit' => 999999,
                        'Offset' => 0
                    ]
                ],
                'headers' => ['GateToken' => $gateTokenResponse['GateToken']]
            ]);
            return response()->json($response['Page']);
        }

        $response = $this->callApiService->callApi([
            'url' => 'sso-app-pick',
            'data' => [
                'Page' => [
                    [ 'ClientId' => request('target_client_id', config('app.api.main.ClientId')) ]
//                    [ 'ClientId' => request('tartarget_client_idget_client_id', config('app.api.main.ClientId')) ]
                ]
            ],
            'headers' => ['GateToken' => $gateTokenResponse['GateToken']]
        ]);

        try {
            $decrypted = sodium_crypto_box_seal_open(
                base64_decode(request('target_before_base64', config('app.api.main.BeforeBase64'))),
                base64_decode($response['Page'][0]['DbrKeyPair'])
            );
        } catch (\SodiumException $e) {
            return $this->apiArrayResponseBuilder(400, 'Error, data failed to request.');
        }

        return response()->json($decrypted);
    }

    public function prjectIndex()
    {
        $response = json_decode( Storage::disk('erp')->get('json/project.json'), true );
        $project = $response['project'];

        $project = collect($project)->map(function ($project) {
            $project['desc'] = Str::limit($project['desc'], 30);
            return $project;
        });

        return response()->json([
            'project' => $project,
            'count' => count($project)
        ]);
    }

    public function prjectStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'desc' => 'required',
            'image' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $response = json_decode( Storage::disk('erp')->get('json/project.json'), true );

        $newProject = array_merge([ 'id' => $response['project'][count($response['project']) - 1]['id'] + 1 ], request()->all());

        $response['project'][] = $newProject;
        Storage::disk('erp')->put('json/project.json', json_encode($response));

        return response()->json($newProject);
    }


    public function prjectUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|max:255',
            'desc' => 'required',
            'image' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $response = json_decode( Storage::disk('erp')->get('json/project.json'), true );
        $updateProject = request()->all();

        $check = false;
        for ($i = 0; $i < count($response['project']); $i++) {
            if ($response['project'][$i]['id'] === $updateProject['id']) {
                $response['project'][$i] = $updateProject;
                $check = true;
            }
        }

        if (! $check) {
            return response()->json('업데이트 데이터가 존재하지 않습니다', 404);
        }

        Storage::disk('erp')->put('json/project.json', json_encode($response));

        return response()->json($updateProject);
    }

    public function prjectShow($id)
    {
        $response = json_decode( Storage::disk('erp')->get('json/project.json'), true );

        $data = collect($response['project'])->filter(function ($project) use ($id) {
            return  $project['id'] === (int)$id;
        })->first();

        if (! $data) {
            return response()->json('상세 데이터가 존재하지 않습니다', 404);
        }

        return response()->json($data);
    }

    public function prjectDestroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $response = json_decode( Storage::disk('erp')->get('json/project.json'), true );
        $deleteId = request('id');

        $deleteData = collect($response['project'])->filter(function ($project) use ($deleteId) {
            return  $project['id'] === $deleteId;
        })->first();

        if (! $deleteData) {
            return response()->json('삭제 데이터가 존재하지 않습니다', 404);
        }

        $response['project'] = collect($response['project'])->filter(function ($project) use ($deleteId) {
           return  $project['id'] !== $deleteId;
        })->values()->toArray();

        Storage::disk('erp')->put('json/project.json', json_encode($response));

        return response()->json($deleteData);
    }
}
