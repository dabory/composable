<?php

namespace App\Services\DaborySearch;

use App\Exceptions\ApiException;
use Exception;
use Unirest\Request;

class SearchService
{
    public $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('SEARCH_HOST');
    }

    public function textHubSearch($dbrhubUrl, $offset, $limit, $query = '', $sort = '')
    {
        $data = [
            'DbrhubUrl' => $dbrhubUrl,
            'Query' => $query,
            'Offset' => $offset,
            'Limit' => $limit,
        ];

        return $this->callTextSearch($data, $sort);
    }

    public function dItemPick($id)
    {
        try {
            $response = Request::post($this->baseUrl . '/ditem-pick',
                [ 'Accept' => 'application/json', 'Content-Type' => 'application/json', ],

                json_encode([
                    'Page' => [
                        [ 'Id' => $id ]
                    ]
                ], JSON_UNESCAPED_UNICODE)
            );
        } catch (Exception $e) {
            throw new ApiException($e->getMessage(), 503);
        }

        if ($response->code === 200) {
            $data = json_encode($response->body ?? []);
            return json_decode($data, true);
        } else {
            return [ 'apiStatus' => $response->code, 'body' => $response->body->msg ?? _e('Action failed') ];
        }
    }

    public function textSearch($originUrl, $offset, $limit, $query = '', $sort = '')
    {
        $data = [
            'OriginUrl' => $originUrl,
            'Query' => $query,
            'Offset' => $offset,
            'Limit' => $limit,
        ];

        return $this->callTextSearch($data, $sort);
    }

    public function callTextSearch($request, $sort = '')
    {
        if ($sort) {
            $sortExplode = explode(' ', $sort);
            switch ($sortExplode[1]) {
                case 'Asc':
                    $request = array_merge($request, [ 'Asc' => $sortExplode[0] ]);
                    break;
                case 'Desc':
                    $request = array_merge($request, [ 'Desc' => $sortExplode[0] ]);
                    break;
            }
        } else {
            $request = array_merge($request, [ 'Asc' => 'ItemName' ]);
        }

        try {
            $response = Request::post($this->baseUrl . '/ditem-page',
                [ 'Accept' => 'application/json', 'Content-Type' => 'application/json', ],

                json_encode([
                    'ElaPageVars' => $request
                ], JSON_UNESCAPED_UNICODE)
            );
        } catch (Exception $e) {
            throw new ApiException($e->getMessage(), 503);
        }

        if ($response->code === 200) {
            $data = json_encode($response->body ?? []);
            return json_decode($data, true);
        } else {
            return [ 'apiStatus' => $response->code, 'body' => $response->body->msg ?? _e('Action failed') ];
        }
    }

    public function autocomplete($originUrl, $query)
    {
        $request = [
            'OriginUrl' => $originUrl,
            'Query' => $query,
        ];

        return $this->callAutocomplete($request);
    }

    public function autocompleteHub($dbrhubUrl, $query)
    {
        $request = [
            'DbrhubUrl' => $dbrhubUrl,
            'Query' => $query,
        ];

        return $this->callAutocomplete($request);
    }

    public function callAutocomplete($request)
    {
        try {
            $response = Request::get($this->baseUrl . '/autocomplete',
                [ 'Accept' => 'application/json', 'Content-Type' => 'application/json', ],

                $request
            );
        } catch (Exception $e) {
            throw new ApiException($e->getMessage(), 503);
        }

        if ($response->code === 200) {
            $data = json_encode($response->body ?? []);
            return json_decode($data, true);
        } else {
            return [ 'apiStatus' => $response->code, 'body' => $response->body->msg ?? _e('Action failed') ];
        }
    }
}
