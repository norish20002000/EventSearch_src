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
