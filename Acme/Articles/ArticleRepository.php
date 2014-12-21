<?php

namespace Acme\Articles;

use Illuminate\Database\Eloquent\Collection;

interface ArticleRepository
{
    /**
     * @param string $query
     * @return Collection
     */
    public function search($query = "");

    /**
     * @return Collection
     */
    public function all();
}