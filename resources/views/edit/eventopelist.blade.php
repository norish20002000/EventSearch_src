@extends('layouts.app')
@section('content')
    <div class='container'>
    <div class="article_title">
        <div>
            <a href="{{route('eventedit')}}" >
            {{-- <button type="button" class="btn btn-secondary">新規作成</button> --}}
            </a>
        </div>
    </div>
        <operation-component :event-data='@json($event_data)'></operation-component>
</div>

@endsection
