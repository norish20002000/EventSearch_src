@section('title', '検索結果｜EventBank ライブ')
@extends('layouts.app')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('genres', $event_data))
<section class="top_banner">
    <img class="header_image" src="/image/genre/{{$event_data->genre->name}}.jpg">
    <div class="content_header">
        <h3 name='genre_name'>{{ $event_data->genre->disp_name }}</h3>
        <p>気になるイベントを探してみよう</p>
    </div>
</section>
<div class='container'>
    <div class="article_title">
    </div>
        <example-component :event-data='@json($event_data)' :genre='@json($event_data->genre)'></example-component>
</div>

@endsection
