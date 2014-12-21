<?php

namespace Acme\Providers;

use Acme\Observers\ArticleElasticSearchObserver;
use Article;
use Elasticsearch\Client;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Article::observe($this->app->make('Acme\Observers\ArticleElasticSearchObserver'));
    }

    public function register()
    {
        $this->app->bindShared('Acme\Observers\ArticleElasticSearchObserver', function()
        {
            return new ArticleElasticSearchObserver(new Client());
        });
    }
}