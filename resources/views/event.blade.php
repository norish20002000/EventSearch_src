@extends('layouts.app')
@section('content')
<div>
<div>
</div>
</div>
@if ($event_data->prePage === "genres")
@section('breadcrumbs', Breadcrumbs::render('eventgenre', $event_data))
@else
@section('breadcrumbs', Breadcrumbs::render('event', $event_data))
@endif
<div class='container'>
    <div class="article_title">
        <h1 class="title">{{ $event_data->title }}</h1>
        <div>
            <div>【概要】</div>
            <p class="summary">{{ $event_data->summary }}</p>
        </div>
        <div>
            <div>【開催日】</div>
            <div>
                @foreach ($event_data->date as $day)
                <div>{{ $day->event_date }}({{ $day->st_week }})</div>
                @endforeach
                <div>【開催時間】</div>
                <p>{{ $event_data->st_time }}〜{{ $event_data->end_time }}</p>
            </div>
        </div>
    </div>
    <div class="article_mainimage">
        <img class="mainimage" width="250" src="{{ $event_data->image_url }}"/>
    </div>
    <div class="article_content">
        <div>
            <div>【説明】</div>
            <div><p> {!! nl2br($event_data->introduction) !!} </p></div>
        </div>
        <div>
            <div>【視聴サイト名】</div>
            <div><p>{{ $event_data->web_name }}</p></div>
        </div>
        <div>
            <div>【視聴URL】</div>
            <div><p><a href="{{ $event_data->web_url }}" target="blank">{{ $event_data->web_url }}</a></p></div>
        </div>
        <div>
            <div>【料金】</div>
            <div><p> ￥{{ $event_data->fee }}</p></div>
        </div>
        <div>
            <div>【参考サイト名】</div>
            <div><p>{{ $event_data->reference_name }}</p></div>
        </div>
        <div>
            <div>【参考サイトURL】</div>
            <div><p><a href="{{ $event_data->reference_url }}" target="blank">{{ $event_data->reference_url }}</a></p></div>
        </div>
    </div>
</div>
@endsection
