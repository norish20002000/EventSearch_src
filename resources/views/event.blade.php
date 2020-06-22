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
        <div class="date_div">
            <p>
                <div class="date_str">
                    <span><i class="far fa-calendar-alt"></i></span>
                    @if (count($event_data->date) > 1)
                        {{$event_data->min_date}}（{{$event_data->min_date_week}}）〜 {{$event_data->max_date}}（{{$event_data->max_date_week}}）
                    @else
                        {{$event_data->date->first()->event_date}}（{{$event_data->min_date_week}}）
                    @endif
                </div>
                {{-- @foreach ($event_data->date as $day)
                <div>            
                    <span><i class="far fa-calendar-alt"></i></span>
                    {{ $day->event_date }}({{ $day->st_week }})
                </div>
                @endforeach --}}
            </p>
            <div class="date_str">
                @if ($event_data->st_time || $event_data->end_time)
                    <p><i class="far fa-clock"></i> {{ $event_data->st_time }}〜{{ $event_data->end_time }}</p>
                @endif
            </div>
            @if (isset($event_data->summary_date))
                <div class="samarry_date_str">{{$event_data->summary_date}}</div>
            @endif
            <div class="date_border"></div>
        </div>
    </div>
    <div class="article_content">
        <div>
            <div><p> {!! nl2br($event_data->introduction) !!} </p></div>
        </div>
        {{-- 視聴サイト --}}
        <div>
            @if (isset($event_data->web_url))
                <div><p><i class="fas fa-video"></i><a href="{{ $event_data->web_url }}" target="blank"> {{ $event_data->web_name }}</p></a></div>
            @else
                <div><p><i class="fas fa-video"></i> {{ $event_data->web_name }}</p></div>
            @endif
        </div>
        {{-- 料金 --}}
        <div>
            <div><p><i class="fas fa-yen-sign"></i> {{ $event_data->fee }}</p></div>
        </div>
        <div>
        {{-- 参考サイト --}}
            @if (isset($event_data->reference_url))
                <div><p><i class="fas fa-laptop"></i> <a href="{{ $event_data->reference_url }}" target="blank">{{ $event_data->reference_name }}</p></a></div>
            @else
                <div><p><i class="fas fa-laptop"></i> {{ $event_data->reference_name }}</p></div>
            @endif
        </div>
    </div>
</div>
@endsection
