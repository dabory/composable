<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Helpers\Utils;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use Exception;
use Unirest\Request;

class CallApiService
{
    const GATE_TOKEN_NOTFOUND = 505;

    public function callAppApi($request, $token, $appName)
    {
        if (empty($appName)) {
            $request['headers'] = ['GateToken' => $token];
            return $this->callApi($request);
        } else {
            $request['url'] = $token['ApiUrl'] . '/' .$request['url'];
            $request['headers'] = ['GateToken' => $token['GateToken']];
            $request['type'] = 'custom';
            return $this->callApi($request);
        }
    }

    public function callApi($request, $isAjax = false)
    {
        $type = $request['type'] ?? 'main';

        try {
            $response = Request::post(
                $this->buildUrl($request['url'], $type, $request['strong_type'] ?? null),
                $this->buildHeader($request['headers'] ?? [], $type),
                $this->buildQuery($request['data'], $request['url'])
            );
        } catch (Exception $e) {
            // gate-token-get api 는 에러떠도 넘어감
//            if ($request['url'] === 'gate-token-get') {
//                return '';
//            }

            return $this->errorResponse([
                'apiStatus' => 503,
                'body' => $e->getMessage()
            ], $isAjax);
        }

        if ($response->code == 200) {
//            return $this->errorResponse([
//                'apiStatus' => 506,
//                'body' => 'ㅁㄴㅁㄴ'
//            ], $isAjax);

            session()->put('_firstSendAPI', true);
            $data = json_encode($response->body ?? []);
            return json_decode($data, true);
        } else {
            return $this->errorResponse([
                'apiStatus' => $response->code,
                'body' => $response->body
            ], $isAjax);
        }
    }

    private function errorResponse($e, $isAjax): array
    {
//        if (! $isAjax) {
        if ($isAjax) {
            return ['apiStatus' => $e['apiStatus'], 'body' => $e['body']];
        }

        if ($e['apiStatus'] === 503 || $e['apiStatus'] === 505 || $e['apiStatus'] === 506 ||
            $e['apiStatus'] === 600 || $e['apiStatus'] === 0) {
            throw new ApiException($e['body'], $e['apiStatus']);
        } else {
//            notify()->error($e['body'], 'status code: '.$e['apiStatus'], 'bottomRight');

            return ['apiStatus' => $e['apiStatus'], 'body' => $e['body']];
        }
    }

    private function buildUrl($url, $type, $strongType): string
    {
        if ($type === 'custom') {
            return $url;
        } else if ($strongType) {
            return env('STRONG_' . strtoupper($strongType) . '_API_URL') . '/' . $url;
        }

        return config("app.api.{$type}.url") . $url;
    }

    public function getHeader($gateToken = null): array
    {
        $headers = $this->basicHeader();

        if ($gateToken) {
            $headers['GateToken'] = $gateToken;
        }

        return $headers;
    }

    public function basicHeader(): array
    {
        $userAgent = request()->header('User-Agent');
        $osStartPos = strpos($userAgent, "(") + 1;
        $osEndPos = strpos($userAgent, ")");
        $osString = substr($userAgent, $osStartPos, $osEndPos - $osStartPos);

        $result = [
            'Content-Type' => 'application/json',
            'FrontendHost' => url('/'),
            'RemoteIp' => request()->ip(),
            'Referer' => rtrim(request()->headers->get('referer'), '/'),
            'DeviceDesc' => $osString,
            'AppType' => $this->getAppType(),
        ];

        if (! session()->get('_firstSendAPI')) {
            $result = array_merge($result, ['PageTime' => now()->timestamp ]);
        }
        return $result;
    }

    private function buildHeader($headers, $type): array
    {
        if (empty($headers)) {
            if ($type === 'custom') {
                $type = 'main';
            }
            return array_merge($this->basicHeader(), ['GateToken' => session('GateToken')[$type]]);
        }

        return $headers;
    }

    private function buildQuery($query, $url)
    {
//        return Body::json($query);
        if (\Str::contains($url, '-act')) {
            $query['Page'][0]['Ip'] = "";
        }
        return json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    private function getAppType(): string
    {
        if (request()->header('X-Requested-With') === 'XMLHttpRequest') {
            return 'js';
        } else {
            return 'web';
        }
    }

    public function getGateToken($query, $type)
    {
        return $this->callApi([
            'url' => 'gate-token-get',
            'data' => $query,
            'headers' => $this->basicHeader(),
            'type' => $type
        ]);
    }

    public function setGateToken(): bool
    {
        $result = false;
        session()->forget('GateToken');

        foreach (config('app.api') as $type => $value) {
            $query = [
                'ClientId' => config("app.api.{$type}.ClientId"),
                'BeforeBase64' => config("app.api.{$type}.BeforeBase64"),
                'AppBase64' => ''
                // 'BeforeBase64' => base64_encode(sodium_crypto_box_seal(json_encode(config("app.api.{$type}.decrypted")),
                //     base64_decode(config("app.api.{$type}.public_key")))),
            ];

            if (empty($query['ClientId']) || empty($query['BeforeBase64'])) { continue; }

            $response = $this->getGateToken($query, $type);

            if (isset($response['GateToken']) && $gateToken = $response['GateToken']) {
                session()->put("GateToken.{$type}", $gateToken);
                $result = true;
            }
        }

        return $result;
    }

    public function verifyApiError($response): bool
    {
        return isset($response['apiStatus']);
    }

    public function getData(\Illuminate\Http\Request $request)
    {
        if ($request['is_user_page'] && empty(session('user'))) {
            return ['apiStatus' => 555, 'body' => 'User session not found'];
        }

        if ($request['encode_status']) {
            $request['data'] = json_decode($request['data']);
        }

//        if ($request['strong_type']) {
//            $request['url'] = env('STRONG_' . strtoupper($request['strong_type']) . '_API_URL') . '/' . $request['url'];
//            $request['type'] = 'custom';
//        }

        $response = $this->callApi([
            'url' => $request['url'],
            'data' => $request['data'],
            'headers' => $request['headers'],
            'type' => $request['type'],
            'strong_type' => $request['strong_type']
        ], true);

        if ($request['para_cache'] && ! isset($response['apiStatus'])) {
            Utils::putParamCache($request['para_cache'], $request['url'], json_encode($request['data']));
        }

        return $response;
    }
}
