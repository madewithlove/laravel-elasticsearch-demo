<?php

namespace Acme\Articles;

use Article;
use Illuminate\Database\Eloquent\Collection;

class EloquentArticleRepository implements ArticleRepository
{
    /**
     * @param string $query
     * @return Collection
     */
    public function search($query = "")
    {
        return Article::where('body', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }

    /**
     * @return Collection
     */
    public function all()
    {
        return Article::all();
    }
}