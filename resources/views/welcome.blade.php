@extends('layouts.app')
@section('content')
<div class='container'>
    <div>
        <form class="formsearch" method="GET" action="/">
            <input type="search" name="search" class="formsearch-input" placeholder="search" value={{$search ?? ''}} >
            <button type="submit" class="formsearch-button"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <details>
        <summary>詳細検索</summary>
        <div class="search_list">
            <a class="p-btn search_day" href="{{ route('todayevent') }}">今日</a>
            <a class="p-btn search_day" href="{{ route('tomorrowevent') }}">明日</a>
            <a class="p-btn search_day" href="{{ route('weekendevent') }}">週末</a>
            <accordion-component slot="body">
                <div slot="title">その他</div>
                <div slot="body">
                    <p>期間指定</p>
                    <div>
                        <input type="text" name="search_st_date" placeholder="開始">
                        〜
                        <input type="text" placeholder="終了">
                        <button type="button">検索</button>
                    </div>
                </div>
            </accordion-component>
        </div>
    </details>
    <div class="genre">
        <div class='music'>
            <a href="{{ route('eventgenre', ['genre_id' => '1']) }}">
            <img src="{{ asset('image/genre/music.jpg') }}">
            <h3>音楽</h3>
            <input type="hidden" name="genre1">
        </div>
        <div class='fes'>
            <a href="{{ route('eventgenre', ['genre_id' => '2']) }}">
            <img src="{{ asset('image/genre/fes.jpg') }}">
            <h3>フェス</h3>
            <input type="hidden" name="genre1">
        </div>
        <div class='live_delivery'>
            <a href="{{ route('eventgenre', ['genre_id' => '3']) }}">
            <img src="{{ asset('image/genre/live_delivery.jpg') }}">
            <h3>ライブ配信</h3>
            <input type="hidden" name="genre1">
        </div>
        <div class='family'>
            <a href="{{ route('eventgenre', ['genre_id' => '4']) }}">
            <img src="{{ asset('image/genre/family.jpg') }}">
            <h3>ライブ配信</h3>
            <input type="hidden" name="genre1">
        </div>
        <div class='e_sports'>
            <a href="{{ route('eventgenre', ['genre_id' => '5']) }}">
            <img src="{{ asset('image/genre/e_sports.jpg') }}">
            <h3>eスポーツ</h3>
            <input type="hidden" name="genre1">
        </div>
    </div>
    <div class="categ_list">

    </div>
    <div>
{{--        @foreach ($event_data as $event)
            <example-component :event-data={{ $event }}></example-component>
        @endforeach
--}}        
       <example-component :event-data='@json($event_data)'></example-component>
        {{ $event_data->links() }}
    </div>
    {{-- @foreach ($event_data as $event)
        {{$event->summary}}
        <example-component :event-data="{{ $event }}"></example-component>
    @endforeach
    --}}
</div>

@endsection

