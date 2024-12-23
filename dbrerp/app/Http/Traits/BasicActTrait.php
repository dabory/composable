<?php

namespace App\Http\Traits;

trait BasicActTrait
{
    public function getPage($page)
    {
        if ($page['Id'] < 0) {
            $page = ['Id' => $page['Id']];
        } else if ($page['Id'] > 0) {
            unset($page['CreatedOn']);
        } else {
            unset($page['UpdatedOn']);
        }

        return $page;
    }

    public function callActOrPick($url, $page)
    {
        return $this->callApiService->callApi([
            'url' => $url,
            'data' => [
                'Page' => $page
            ],
        ]);
    }

    public function getApiUrl($name, $type)
    {
        return $name . '-' . $type;
    }

}
