<?php

namespace App\Http\Controllers\Dbrbbs;

use App\Helpers\ResponseConverter;
use App\Http\Controllers\Controller;
use App\Services\CallApiService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent as Agent;

class PostController extends Controller
{
    private $callApiService;
    private $Agent;

    public function __construct(CallApiService $callApiService)
    {
        $this->callApiService = $callApiService;
        $this->Agent = new Agent();
    }

    public function postTypePage($postCode)
    {
        return $this->callApiService->callApi([
            'url' => 'list-type1-page',
            'data' => [
                'QueryVars' => [
                    'QueryName' => 'post/post-type-input',
                    'SimpleFilter' => "post_code='$postCode'",
                    'IsntPagination' => true,
                ],
                'PageVars' => [
                    'Limit' => 1
                ]
            ]
        ]);
    }

    public function list($postCode)
    {
        $postType = $this->postTypePage($postCode)['Page'][0];

        $design =  $postType['T1'];
        $design = json_decode($design, true)['Design'];

        $p = request('p');
        $page = (int)request('page', 1);
        $limit = 12;
        if ($design) {
            if ($design['PcTitleLeng'] === 0 || $design['MoTitleLeng'] === 0 ||
                $design['PcPageLeng'] === 0 || $design['MoPageLeng'] === 0) {
                notify()->error('관리자 게시판 구분페이지에서 게시판 디자인 설정을 해주세요', 'Error', 'bottomRight');
                return redirect()->to('/');
            }

            if ($this->Agent->isDesktop()) {
                $limit = (int)request('limit', $design['PcPageLeng']);
            } else {
                $limit = (int)request('limit', $design['MoPageLeng']);
            }
        }

        $simpleFilter = "post_code='$postCode' and mx.status = '1'";
        if ($p) {
            $simpleFilter = $simpleFilter . "and (post_title LIKE '%$p%' or post_contents LIKE '%$p%')";
        }

        $listType1Book = $this->callApiService->callApi([
            'url' => 'list-type1-book',
            'data' => [
                'Book' => [
                    [
                        'QueryVars' => [
                            'QueryName' => 'pro:my-page/post-list',
                            'SimpleFilter' => $simpleFilter,
                            'SubSimpleFilter' => "image_type = 'middle'",
                            'IsntPagination' => false
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => request('sort', 'mx.created_on desc')
                        ],
                        'PageVars' => [
                            'Limit' => $limit,
                            'Offset' => ($page - 1) * $limit
                        ]
                    ],
                ]
            ]
        ]);

        if ($this->callApiService->verifyApiError($listType1Book)) {
            notify()->error($listType1Book['body'], 'Error', 'bottomRight');
            return redirect()->back();
        }

        $postPage = $listType1Book['Book'][0] ?? [];

        if ($design) {
            $postPage['Page'] = collect($postPage['Page'])->map(function ($post) use ($design) {
                if ($this->Agent->isDesktop()) {
                    $post['Title'] = Str::limit($post['C6'], $design['PcTitleLeng'], '...');
                } else {
                    $post['Title'] = Str::limit($post['C6'], $design['MoTitleLeng'], '...');
                }
                $post['PcGalleryClass'] = 'col-md-' . (12 / $design['PcGalleryLeng']);
                $post['MoGalleryClass'] = 'col-' . (12 / $design['MoGalleryLeng']);

                $post['PcVideoClass'] = 'col-md-' . (12 / $design['PcVideoLeng']);
                $post['MoVideoClass'] = 'col-' . (12 / $design['MoVideoLeng']);
                return $post;
            })->toArray();
        }


        $postPage['Page'] = new LengthAwarePaginator($postPage['Page'], $postPage['PageVars']['QueryCnt'],
            $limit, $page, ['path' => request()->url()]);


        return view('dbrbbs.list', compact('postPage', 'postType', 'postCode', 'design'));
    }

    public function details($postCode, $slug)
    {
        $limit = (int)request('limit', 3);
        $page = (int)request('page', 1);

        $post = $this->postPick(['PostSlug' => $slug]);
        $postId = $post['Id'];
        $postTypeId = $post['PostTypeId'];

//        $postType = $this->postTypePick(['Id' => (int)$postTypeId]);
//        dump($postCode);
//        dd($slug);
        $listType1Book = $this->callApiService->callApi([
            'url' => 'list-type1-book',
            'data' => [
                'Book' => [
                    [
                        'QueryVars' => [
                            'QueryName' => 'pro:my-page/post-details',
                            'SimpleFilter' => "post_code = '$postCode' and mx.id = $postId",
                            'SubSimpleFilter' => "image_type = 'big'",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 1
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'pro:my-page/post-details-prenext',
                            'SimpleFilter' => "mx.id = (select max(id) from pro_post where id < $postId and post_type_id = $postTypeId)",
                            'SubSimpleFilter' => "",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 1
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'pro:my-page/post-details-prenext',
                            'SimpleFilter' => "mx.id = (select min(id) from pro_post where id > $postId and post_type_id = $postTypeId)",
                            'SubSimpleFilter' => "",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 1
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'post/post-type-input',
                            'SimpleFilter' => "mx.id = $postTypeId",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 1
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'post/post-type-input',
                            'SimpleFilter' => "post_code='$postCode'",
                            'IsntPagination' => true,
                        ],
                        'PageVars' => [
                            'Limit' => 1
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'post/blog-bd-list-std',
                            'SimpleFilter' => "mx.post_id = {$postId} and mx.parent_id = 0",
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => ''
                        ],
                        'PageVars' => [
                            'Limit' => $limit,
                            'Offset' => ($page - 1) * $limit
                        ]
                    ],
                    [
                        'QueryVars' => [
                            'QueryName' => 'post/blog-bd-list-std',
                            'SimpleFilter' => "mx.post_id = {$postId} and mx.parent_id != 0",
                        ],
                        'ListType1Vars' => [
                            'OrderBy' => ''
                        ],
                        'PageVars' => [
                            'Limit' => 100,
                            'Offset' => 0
                        ]
                    ]
                ]
            ]
        ]);

//        dd($listType1Book);
        if ($this->callApiService->verifyApiError($listType1Book)) {
            notify()->error($listType1Book['body'], 'Error', 'bottomRight');
            return redirect()->back();
        }

        $post = $listType1Book['Book'][0]['Page'][0];
        $prePost = $listType1Book['Book'][1]['Page'];
        $nextPost = $listType1Book['Book'][2]['Page'];
        $postType = $listType1Book['Book'][4]['Page'][0];
        $comments = $listType1Book['Book'][5]['Page'];
        $replays = $listType1Book['Book'][6]['Page'];

        $comments = ResponseConverter::joinFor($comments, $replays, 'C5', 'Id', 'ReplyPage');

        $comments = new LengthAwarePaginator($comments, $listType1Book['Book'][5]['PageVars']['QueryCnt'],
            $limit, $page, ['path' => request()->url()]);

        return view('dbrbbs.details', compact('post', 'prePost', 'nextPost', 'postCode', 'postType', 'comments'));
    }

    public function comment()
    {
        $response = $this->callApiService->callApi([
            'url' => 'post-bd-act',
            'data' => [
                'Page' => [
                    [
                        'Id' => 0,
                        'PostId' => (int)request('post_id'),
                        'BdContents' => request('bd_contents'),
                        'ParentId' => (int)request('parent_id'),
                        'SeqNo' => (int)request('seq_no'),
                        'ChildLastSeq' => (int)request('child_last_seq'),
                    ]
                ],
            ]
        ]);

        if ($this->callApiService->verifyApiError($response)) {
            notify()->error($response['body'], 'Error', 'bottomRight');
            return redirect()->back();
        }

        notify()->success(_e('Action completed'), 'Success', 'bottomRight');
        return redirect()->back();
    }

    public function postPick($page)
    {
        $postPick = $this->callApiService->callApi([
            'url' => 'post-pick',
            'data' => [
                'Page' => [
                    $page
                ],
            ]
        ]);

        return $postPick['Page'][0];
    }
}
