@extends('layouts.app')
@section('content')
<div>
<div>
</div>
</div>
<div class='container'>
    <div class="article_title">
        <example-component :event-data='@json($event_data)'></example-component>
</div>

@endsection
