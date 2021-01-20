@extends('layouts.app', ['header' => 'News'])
@section('content')
    <h1>{{ $news->title }}</h1>
    <p>{{ $news->description }}</p>
@endsection
