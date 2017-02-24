<?php

namespace App\Articles;

use App\Article;
use Illuminate\Database\Eloquent\Collection;

class DatabaseArticlesRepository implements ArticlesRepository
{
    public function search(string $search = ""): Collection
    {
        return Article::where(function ($query) use ($search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            })
            ->get();
    }
}