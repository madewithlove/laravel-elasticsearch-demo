<?php

namespace Acme\Providers;

use Acme\Articles\ElasticsearchArticleRepository;
use Acme\Articles\EloquentArticleRepository;
use Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('Acme\Articles\ArticleRepository', function($app)
        {
            $elasticsearchOn = (bool) $app['config']['features.elasticsearch'];

            if ($elasticsearchOn)
            {
                return new ElasticsearchArticleRepository(
                    new EloquentArticleRepository(),
                    new Client()
                );
            }

            return new EloquentArticleRepository;
        });
    }
}