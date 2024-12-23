<?php

namespace App\Services\Elasticsearch;

use App\Foundation\ElasticsearchClient;

class ElasticsearchService
{
    /**
     * @var ElasticsearchClient
     */
    private $client;

    /**
     * @param ElasticsearchClient $client
     */
    public function __construct(ElasticsearchClient $client)
    {
        $this->client = $client;
    }

    public function getQueryAll($query)
    {
        $query = "
            $query
        ";

        return $this->executeSql($query);
    }

    public function executeSql($query)
    {
        return $this->client->client()->sql()->query([
            'body' => [ 'query' => $query ]
        ])['rows'];
    }

    public function getQueryByKeyword($keyword)
    {
        return "SELECT serial_number
                FROM taling___products_product___v1
                WHERE
                (
                    MATCH(name_nori, '$keyword') OR MATCH(name_jamo, '$keyword') OR MATCH(name_chosung, '$keyword')
                    OR
                    MATCH(display_name_nori, '$keyword') OR MATCH(display_name_jamo, '$keyword') OR MATCH(display_name_chosung, '$keyword')
                    OR
                    MATCH(description_nori, '$keyword') OR MATCH(description_jamo, '$keyword') OR MATCH(description_chosung, '$keyword')
                    OR
                    MATCH(market_name_nori, '$keyword') OR MATCH(market_name_jamo, '$keyword') OR MATCH(market_name_chosung, '$keyword')
                    OR
                    MATCH(category_name_nori, '$keyword') OR MATCH(category_name_jamo, '$keyword') OR MATCH(category_name_chosung, '$keyword')
                )
                ORDER BY score() DESC";
    }
}
