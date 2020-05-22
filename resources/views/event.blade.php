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
        <p class="title">{{ $event_data->title }}</p>
        <div>
            <div>【概要】</div>
            <p class="summary">{{ $event_data->summary }}</p>
        </div>
        <div>
            <div>【開催日時】</div>
            <div>
                @foreach ($event_data->date as $day)
                <p class="s_date">{{ $day->event_date }}({{ $day->st_week }})</p>
                @endforeach
                <p>{{ $event_data->st_time }}〜{{ $event_data->st_time }}</p>
            </div>
        </div>
    </div>
    <div class="article_mainimage">
        <img class="mainimage" width="250" src="{{ $event_data->image_url }}"/>
    </div>
    <div class="article_content">
        <div>
            <div>【説明】</div>
            <div> {!! nl2br($event_data->introduction) !!} </div>
        </div>
        <div>
            <div>【視聴サイト名】</div>
            <div>{{ $event_data->web_name }}</div>
        </div>
        <div>
            <div>【視聴URL】</div>
            <div><a href="{{ $event_data->web_url }}" target="blank">{{ $event_data->web_url }}</a></div>
        </div>
        <div>
            <div>【料金】</div>
            <div>￥{{ $event_data->fee }}</div>
        </div>
        <div>
            <div>【参考サイト名】</div>
            <div>{{ $event_data->reference_name }}</div>
        </div>
        <div>
            <div>【参考サイトURL】</div>
            <div><a href="{{ $event_data->reference_url }}">{{ $event_data->reference_url }}</a></div>
        </div>
    </div>
</div>
@endsection
