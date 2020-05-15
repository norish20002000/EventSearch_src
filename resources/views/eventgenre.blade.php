@extends('layouts.app')
@section('content')
<section class="container-fluid banner">
    <img class="header_image" src="{{ asset('image/genre/music.jpg') }}">
    <div class="content_header">
        <h3>{{ $event_data->genre->name }}</h3>
        <p>気になるイベントを探してみよう</p>
    </div>
</section>
<div class='container'>
    <div class="article_title">
    </div>
        <example-component :event-data='@json($event_data)'></example-component>
</div>

@endsection
