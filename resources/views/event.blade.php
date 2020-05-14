@extends('layouts.app')
@section('content')
<div>
<div>
</div>
</div>
<div class='container'>
    <div class="article_title">
        <p class="title">{{ $event_data->title }}</p>
        <p class="summary">{{ $event_data->summary }}</p>
        @foreach ($event_data->date as $day)
        <p class="s_date">{{ $day->event_date }}({{ $day->st_week }})</p>
        @endforeach
        <p>{{ $event_data->st_time }}〜{{ $event_data->st_time }}</p>
    </div>
    <div class="article_mainimage">
        <img class="mainimage" width="250" src="{{ $event_data->image_url }}"/>
    </div>
    <div class="article_content">
        <div>
            <div> {{ $event_data->introduction}} </div>
        </div>
    </div>
</div>

@endsection
