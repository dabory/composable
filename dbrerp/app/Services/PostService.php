<?php

namespace App\Services;

use Carbon\Carbon;

class PostService
{
    private $callApiService;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
    }

    function getPostList($typeSlug, $request, $limit, $page)
    {
        $p = $request['p'] ?? '';
        $query = "(post_title like '%$p%' or post_contents like '%$p%' or pc1 like '%$p%')";
        if (isset($request['selopt1'])) {
            $formDt = Carbon::now()->startOfDay();
            $toDt = Carbon::now()->endOfDay();
            switch ($request['selopt1']) {
                case '2':
                    $formDt->subDays(7);
                    break;
                case '3':
                    $formDt->subMonths();
                    break;
                case '4':
                    $formDt->subMonths(6);
                    break;
                case '5':
                    $formDt->subYears();
                    break;
            }

            switch ($request['selopt3']) {
                case '1':
                    $query = "(post_title like '%$p%')";
                    break;
                case '2':
                    $query = "(mem.nick_name like '%$p%')";
                    break;
            }
            if ($request['selopt1'] > 0) {
                $query = "(mx.created_on between $formDt->timestamp and $toDt->timestamp) and $query";
            }
//            dump($query);
        }


        return $this->callApiService->callApi([
            'url' => 'post-list-book',
            'data' => [
                'TypeSlug' => $typeSlug,
                'PostQueryVars' => [
                    'QueryName' => 'pro:post/post-list-book',
                    'SimpleFilter' => $query
                ],
                'PostPageVars' => [
                    'Limit' => $limit,
                    'Offset' => ($page - 1) * $limit
                ]
            ]
        ]);
    }

    function getPostDetailsBook($slug, $limit, $page)
    {
        return $this->callApiService->callApi([
            'url' => 'post-details-book',
            'data' => [
                'PostSlug' => $slug,
                'PostBdQueryVars' => [
                    'QueryName' => 'pro:post/post-bd-reply',
                    'SimpleFilter' => ''
                ],
                'PostBdPageVars' => [
                    'Limit' => $limit,
                    'Offset' => ($page - 1) * $limit
                ]
            ]
        ]);
    }
}
