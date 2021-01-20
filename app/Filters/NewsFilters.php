<?php

namespace App\Filters;

final class NewsFilters extends QueryFilter
{
    public function search(string $needly = null)
    {
        return $this->builder->where(function ($query) use ($needly) {
            return $query->where('title', 'LIKE', "%$needly%")
                ->orWhere('description', 'LIKE', "%$needly%");
        });
    }

    public function category($id = null)
    {
        return !$id ?: $this->builder->where('category_id', $id);
    }

    public function popular()
    {
        return $this->builder->withCount('newsView')
            ->orderBy('news_view_count', 'desc');
    }
}
