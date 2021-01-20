<?php

namespace App\Services;

use App\Filters\NewsFilters;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsService extends BaseService
{
    public function __construct()
    {
        $this->model = new News();
    }

    public function applyFilters(NewsFilters $filters)
    {
        return $this->model::filter($filters);
    }

    public function checkViews($news, $request)
    {
        $check = Auth::check()
            ? $news->newsView()->where('user_id', Auth::id())
            : $news->newsView()->where('ip', $request->ip())->where('user_id', null);
        if (!$check->count()) {
            $news->users()->attach([Auth::id()], ['ip' => $request->ip()]);
        }
    }

    public function getLatestNews($filters)
    {
        return $this->applyFilters($filters)
            ->whereDoesntHave('newsView', function ($query) {
                $query->where('user_id', '=', Auth::id());
            })->where('created_at', '>', Auth::user()->sub_at)->paginate(10);
    }
}
