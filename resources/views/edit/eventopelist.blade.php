@extends('layouts.app')
@section('content')
<div class='container'>
    <div class="article_title">
    </div>
        <operation-component :event-data='@json($event_data)'></operation-component>
</div>

@endsection
