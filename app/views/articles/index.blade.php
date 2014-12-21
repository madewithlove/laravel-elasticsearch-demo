<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Articles</title>
</head>
<body>
    <h1>Articles</h1>

    {{ Form::open(['method' => 'get']) }}
        {{ Form::text("q", Request::get("q"), ["placeholder" => "search"]) }}
    {{ Form::close() }}
    {{ link_to_route("articles.index", "clear search") }}

    <section>
        @foreach ($articles as $article)
        <h3>{{ $article->title }}</h3>

        {{ $article->body }}
        @endforeach
    </section>
</body>
</html>