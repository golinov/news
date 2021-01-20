@extends('layouts.app', ['header' => request()->routeIs('news.index') ? 'All news' : 'Latest news'])
@include('layouts.sidebar')
@section('content')
    <ul class="list-group">
        @foreach ($news as $item)
            <li class="list-group-item">
                <a href="{{ route('news.show', $item->id) }}">
                    {{ $item->title }}
                </a>
            </li>
        @endforeach
    </ul>
    <br>
    {{ $news->withQueryString()->links() }}
@endsection
