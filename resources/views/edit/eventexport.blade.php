@extends('layouts.app')
@section('content')
<form name="form1" method="GET" action="{{ route('eventexportlist') }}">
<div class='container'>
    <div class="article_title"> 
        <div class="label_input">
            <div>
                <label >開催日</label>
            </div>
            <div>
                <input type="text" name="st_date" >
                〜
                <input type="text" name="end_date">
            </div>
        </div>
        <button type="button" onclick="submit();">exports</button>
    </div>
</div>
</form>
@endsection
