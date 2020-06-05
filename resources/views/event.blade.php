@section('title', $event_data->title . '｜EventBank ライブ')
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
        <div class="article_mainimage">
            @if ($event_data->image_url)
                <a href="{{$event_data->web_url}}" target="blank">
                <img class="mainimage" src="{{ $event_data->image_url }}"/>
                </a>
            @endif
        </div>
        @if ($event_data->genres)
        <div class="genres_div">
            @foreach ($event_data->genres as $genre)
                <span class="genre_tag">{{$genre->disp_name}} </span>
            @endforeach
        </div>
        @endif
        <div>
            <h1 class="title" style="clear: left;margin:">{{ $event_data->title }}</h1>
        </div>
        <div>
            <p>
                @foreach ($event_data->date as $day)
                <div>            
                    <span><i class="far fa-calendar-alt"></i></span>
                    {{ $day->event_date }}({{ $day->st_week }})
                </div>
                @endforeach
            </p>
            <div>
                <p><i class="far fa-clock"></i> {{ $event_data->st_time }}〜{{ $event_data->end_time }}</p>
            </div>
        </div>
    </div>
    <div class="article_content">
        <div>
            <div><p> {!! nl2br($event_data->introduction) !!} </p></div>
        </div>
        {{-- 視聴サイト --}}
        <div>
            <div><p><i class="fas fa-video"></i><a href="{{ $event_data->web_url }}" target="blank"> {{ $event_data->web_name }}</p></a></div>
        </div>
        {{-- 料金 --}}
        <div>
            <div><p><i class="fas fa-yen-sign"></i> {{ $event_data->fee }}</p></div>
        </div>
        <div>
            <div>【参考サイト】</div>
            <div><p><i class="fas fa-laptop"></i> <a href="{{ $event_data->reference_url }}" target="blank">{{ $event_data->reference_name }}</p></a></div>
        </div>
    </div>
</div>
@endsection
