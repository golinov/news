<?php

namespace App\Http\Controllers;

use App\Events\SubscribeNews;
use App\Filters\NewsFilters;
use App\Models\Category;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * @var NewsService
     */
    private $news;

    public function __construct(NewsService $news)
    {
        $this->news = $news;
    }

    /**
     * Display a listing of the resource.
     *
     * @param NewsFilters $filters
     * @return Application|Factory|View|Response|null
     */
    public function index(NewsFilters $filters): ?View
    {
        $news = $this->news->applyFilters($filters)->paginate(10);
        $categories = Category::all();
        $search = $filters->request->search;

        return view('news.index', compact('categories', 'news', 'search'));
    }

    /**
     * @param News $news
     * @param Request $request
     * @return Application|Factory|View|Response|null
     */
    public function show(News $news, Request $request): ?View
    {
        $this->news->checkViews($news, $request);

        return view('news.show', compact('news'));
    }

    /**
     * @param NewsFilters $filters
     * @return Application|Factory|View|RedirectResponse
     */
    public function latestNews(NewsFilters $filters)
    {
        if (!Auth::user()->is_sub) {
            return back()
                ->withErrors('You need to subscribe to receive latest news');
        }
        $news = $this->news->getLatestNews($filters);
        $categories = Category::all();
        $search = $filters->request->search;

        return view('news.index', compact('news', 'categories', 'search'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse|null
     */
    public function subscription(Request $request): ?RedirectResponse
    {
        if ($request->has('subscribe')) {
            event(new SubscribeNews(Auth::user()));
        }

        return redirect('news')
            ->with('message', 'Successful');
    }
}
