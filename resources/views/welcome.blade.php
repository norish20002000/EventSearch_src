@extends('layouts.app')
@section('content')
@if ($search_type == "")
    @section('breadcrumbs', Breadcrumbs::render('home'))
@elseif ($search_type == "today")
    @section('breadcrumbs', Breadcrumbs::render('today', $event_data))
@elseif ($search_type == "tomorrow")
    @section('breadcrumbs', Breadcrumbs::render('tomorrow', $event_data))
@elseif ($search_type == "weekend")
    @section('breadcrumbs', Breadcrumbs::render('weekend', $event_data))
@else
    @section('breadcrumbs', Breadcrumbs::render('home'))
@endif
<form class="formsearch" method="GET" action="/">
<section class="top_banner">
    <img class="header_image" src="/image/top/top.jpg">
    <div class="content_header">
        <div>
        <p class="header_p">ライブ配信イベントを楽しもう。</p>
        <div class="search_div">
            <input type="search" name="search" class="formsearch-input" placeholder="search" value="{{$search ?? ''}}" >
            <button type="submit" class="btn btn-secondary search_str_btn" >検索</button>
        </div>
        </div>
    </div>
</section>
</form>
<div class='container'>
    <form name="formsearch" class="formsearch" method="GET" action="/">
        {{-- <input type="search" name="search" class="formsearch-input" placeholder="search" value={{$search ?? ''}} >
        <button type="submit" class="formsearch-button"><i class="fa fa-search"></i></button> --}}
        {{-- <details>
            <summary>詳細検索</summary> --}}
            <div class="search_btns">
                    <div class="search_str">
                        <p class="release_str"><img class="bell_img" src="/image/icon/bell.png"> もうすぐ配信開始</p>
                    </div>
                    <div class="search_list">
                        {{-- <button name="today" class="p-btn" type="button" onclick="submit((function(e){
                            var ele = document.createElement('input')
                            ele.setAttribute('type', 'hidden')
                            ele.setAttribute('name', 'today')
                            ele.setAttribute('value', 'today')
                            document.formsearch.appendChild(ele)
                            }()));" value="today">今日</button> --}}
                        <button type="submit" class="p-btn" name="today" value="today">今日</button>
                        <button type="submit" class="p-btn" name="tomorrow" value="tomorrow">明日</button>
                        <button type="submit" class="p-btn" name="weekend" value="今週末">今週末</button>
                        {{-- <button name="today" value="today" type="submit" class="p-btn">今日</button> --}}
                            {{-- <button name="tomorrow" value="tomorrow" type="submit" class="p-btn">明日</button>
                            <button name="weekend" value="weekend" type="submit" class="p-btn">今週末</button> --}}
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
    @if ($search_type == "")
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
                        <h3>ワークショップ・講座</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='live_delivery col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '3']) }}">
                        <img src="{{ asset('image/genre/culture.jpg') }}">
                        <h3>カルチャー・学び</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='family col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '4']) }}">
                        <img src="{{ asset('image/genre/hobby.jpg') }}">
                        <h3>趣味・レジャー</h3>
                        <input type="hidden" name="genre1">
                    </a>
                </div>
                <div class='e_sports  col-lg-4 col-xs-12'>
                    <a href="{{ route('eventgenre', ['genre_id' => '5']) }}">
                        <img src="{{ asset('image/genre/family.jpg') }}">
                        <h3>キッズ・ファミリー</h3>
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
        {{-- <div>
            <p>表示件数　：　{{ $event_data->total() }}</p>
        </div> --}}
       <example-component :event-data='@json($event_data)'></example-component>
        <div style="padding-left: 15px" class="d-block d-sm-none">
            <div>
            {{ $event_data->links('vendor.pagination.original_pagination_view') }}
            </div>
        </div>
        <div class="d-none d-sm-block">
            {{ $event_data->links() }}
        </div>
    </div>
</div>

@endsection

