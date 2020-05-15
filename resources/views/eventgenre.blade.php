@extends('layouts.app')
@section('content')
<div class='container'>
    <div class="article_title">
        <h3>{{ $event_data->genre->name }}</h3>
    </div>
        <example-component :event-data='@json($event_data)'></example-component>
</div>

@endsection
