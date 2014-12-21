<?php

namespace Acme\Articles;

use Article;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchArticleRepository implements ArticleRepository
{
    /**
     * @var ArticleRepository
     */
    private $innerRepo;

    /**
     * @var Client
     */
    private $elasticsearch;

    /**
     * @param ArticleRepository $innerRepo
     * @param Client $elasticsearch
     */
    function __construct(ArticleRepository $innerRepo, Client $elasticsearch)
    {
        $this->innerRepo = $innerRepo;
        $this->elasticsearch = $elasticsearch;
    }

    /**
     * @param string $query
     * @return Collection
     */
    public function search($query = "")
    {
        $items = $this->searchOnElasticsearch($query);

        $queryResult = $this->buildModelsFromElasticsearch($items);

        return Collection::make($queryResult);
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return $this->innerRepo->all();
    }

    /**
     * @param $query
     * @return array
     */
    private function searchOnElasticsearch($query)
    {
        $items = $this->elasticsearch->search([
            'index' => 'acme',
            'type' => 'articles',
            'body' => [
                'query' => [
                    'query_string' => [
                        'query' => $query
                    ]
                ]
            ]
        ]);
        return $items;
    }

    /**
     * @param $items
     * @return array
     */
    private function buildModelsFromElasticsearch($items)
    {
        $result = $items['hits']['hits'];
        $queryResult = [];

        foreach ($result as $r)
        {
            $article = new Article();
            $article->newInstance($r['_source'], true);
            $article->setRawAttributes($r['_source'], true);
            $queryResult[] = $article;
        }
        return $queryResult;
    }
}