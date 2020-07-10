@section('og_image', $event_data->image_url)
@section('twitter_title', $event_data->title)
@section('twitter_descrip', $event_data->introduction)
@section('twitter_image', url($event_data->image_url))
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
<section class="event_banner" style="background:url({{ $event_data->image_url }}) center / cover">
    <div class="article_mainimage">
        @if ($event_data->image_url)
            <a href="{{$event_data->web_url}}" target="blank">
            <img class="mainimage" src="{{ $event_data->image_url }}"/>
            </a>
        @endif
    </div>
</section>
<div class='container'>
    <div class="article_title">
        @if ($event_data->genres)
        <div class="genres_div">
            @foreach ($event_data->genres as $genre)
                <a href="{{route('eventgenre', ['genre_id' =>$genre->id])}}">
                    <span class="genre_tag">{{$genre->disp_name}} </span>
                </a>
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
    <div class="sns_btns">
        {{-- <a href="https://twitter.com/share?url={{request()->fullUrl()}}&text=「{{$event_data->title}}」%0a%23EventBank%0a" target="blank"> --}}
        <a href="https://twitter.com/share?url={{request()->fullUrl()}}&text=「{{$event_data->encode_title}}」" target="blank">
                <img class="sns_image" src="/image/sns/sns_tw.png">
        </a>
        <a href="http://www.facebook.com/share.php?u={{request()->fullUrl()}}&t=「{{$event_data->encode_title}}」" target="blank">
            <img class="sns_image" src="/image/sns/sns_fb.png">
        </a>
        <a href="http://line.me/R/msg/text/?{{request()->fullUrl()}}%0D%0A「{{$event_data->encode_title}}」" target="blank">
            <img class="sns_image" src="/image/sns/sns_line.png">
        </a>
    </div>
    <div class="calendar_btns">
        <div>【カレンダーに追加】</div>
    <a href="https://www.google.com/calendar/render?action=TEMPLATE&text={{$event_data->encode_title}}&dates={{$event_data->current_date->calendar_st_datetime}}/{{$event_data->current_date->calendar_end_datetime}}&details=「{{$event_data->encode_title}}」<div>{{request()->fullUrl()}}</div>" target="blank">
            <img style="margin: -5px 0 0 -6px" width="50px" src="/image/sns/googleCalendar.png">
        </a>
    </div>
</div>
@endsection
