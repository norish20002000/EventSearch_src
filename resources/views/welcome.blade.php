@extends('layouts.app')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('home'))
<form class="formsearch" method="GET" action="/">
<section class="top_banner">
    <img class="header_image" src="/image/top/top.jpg">
    <div class="content_header">
        <p>ライブ配信イベントを楽しもう</p>
        <div class="search_div">
            <input type="search" name="search" class="formsearch-input" placeholder="search" value={{$search ?? ''}} >
            <button type="submit" class="btn btn-secondary" >検索</button>
        </div>
    </div>
</section>
</form>
<div class='container'>
    <form class="formsearch" method="GET" action="/">
        {{-- <input type="search" name="search" class="formsearch-input" placeholder="search" value={{$search ?? ''}} >
        <button type="submit" class="formsearch-button"><i class="fa fa-search"></i></button> --}}
        {{-- <details>
            <summary>詳細検索</summary> --}}
            <div class="search_btns">
                <div class="search_str">
                    <p><i class="far fa-bell"></i> もうすぐ配信スタート</p>
                </div>
                <div class="search_list">
                    <button name="today" value="today" type="submit" class="p-btn">今日</button>
                    <button name="tomorrow" value="tomorrow" type="submit" class="p-btn">明日</button>
                    <button name="weekend" value="weekend" type="submit" class="p-btn">週末</button>
                    <!-- <a class="p-btn search_day" href="{{ route('todayevent') }}">今日</a>
                    <a class="p-btn search_day" href="{{ route('tomorrowevent') }}">明日</a>
                    <a class="p-btn search_day" href="{{ route('weekendevent') }}">週末</a> -->
                    {{-- <accordion-component>
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
                    </accordion-component> --}}
                </div>
            </div>
        {{-- </details> --}}
    </form>
    @if ($search_flg != "1")
    <p>{{$search_flg}}</p>
    <div class="genre">
        <div class="container">
            <div class="row justify-content-center">
                <div class='music col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '1']) }}">
                        <img src="{{ asset('image/genre/entertainment.jpg') }}">
                        <h3>エンタメ</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='fes col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '2']) }}">
                        <img src="{{ asset('image/genre/workshop.jpg') }}">
                        <h3>ワークショップ</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='live_delivery col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '3']) }}">
                        <img src="{{ asset('image/genre/culture.jpg') }}">
                        <h3>カルチャー</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='family col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '4']) }}">
                        <img src="{{ asset('image/genre/hobby.jpg') }}">
                        <h3>趣味</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='e_sports  col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '5']) }}">
                        <img src="{{ asset('image/genre/family.jpg') }}">
                        <h3>キッズ</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='e_sports  col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '6']) }}">
                        <img src="{{ asset('image/genre/animal.jpg') }}">
                        <h3>動物</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='e_sports  col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '7']) }}">
                        <img src="{{ asset('image/genre/business.jpg') }}">
                        <h3>ビシネス</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="categ_list">

    </div>
    <div>
{{--        @foreach ($event_data as $event)
            <example-component :event-data={{ $event }}></example-component>
        @endforeach
--}}
        <div>
            <p>表示件数　：　{{ $event_data->total() }}</p>
        </div>
       <example-component :event-data='@json($event_data)'></example-component>
        <div>
            {{ $event_data->links() }}
        </div>
    </div>
</div>

@endsection

