<?php

namespace Acme\Observers;

use Article;
use Elasticsearch\Client;

class ArticleElasticSearchObserver
{
    /**
     * @var Client
     */
    private $elasticSearch;

    /**
     * @param Client $elasticSearch
     */
    function __construct(Client $elasticSearch)
    {
        $this->elasticSearch = $elasticSearch;
    }

    /**
     * @param Article $article
     */
    public function created(Article $article)
    {
        $this->elasticSearch->index($this->parseToElasticSearchParam($article));
    }

    /**
     * @param Article $article
     */
    public function updated(Article $article)
    {
        $this->elasticSearch->update($this->parseToElasticSearchParam($article));
    }

    /**
     * @param Article $article
     */
    public function deleted(Article $article)
    {
        $this->elasticSearch->delete([
            'index' => 'acme',
            'type' => 'articles',
            'id' => $article->id
        ]);
    }

    /**
     * @param Article $article
     * @return array
     */
    private function parseToElasticSearchParam(Article $article)
    {
        return [
            'index' => 'acme',
            'type' => 'articles',
            'id' => $article->id,
            'body' => $article->toArray()
        ];
    }
} 