<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Articles <small>({{ $articles->count() }})</small>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="container">
                                <form action="" method="get">
                                    <div class="form-group">
                                        <input
                                                type="text"
                                                name="q"
                                                class="form-control"
                                                placeholder="Search..."
                                                value="{{ request('q') }}"
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container">
                                @forelse ($articles as $article)
                                    <article>
                                        <h2>{{ $article->title }}</h2>

                                        <p>{{ $article->body }}</body>

                                        <p class="well">{{ implode(', ', $article->tags ?: []) }}</p>
                                    </article>
                                @empty
                                    <p>No articles found</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
