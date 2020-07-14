@extends('layouts.app')
@section('content')
<form name="form1" method="GET" action="{{ route('eventexportlist') }}">
<div class='container'>
    <div class="article_title"> 
        <div class="label_input">
            <div>
                <label >開催日</label>
            </div>            
            <div class="st_end_picker">
                <div class="form-group">
                    <div class="input-group date datetimepicker" id="due_date" data-target-input="nearest">
                      <input type="text" name="st_date"  id="due_date-field" class="form-control datetimepicker-input" data-target="#due_date" />
                      <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                </div>
                    {{-- <input id="birthdate" type="text" class="form-control datepicker" name="birthdate" > --}}
                {{-- <input type="text" name="st_date" class="datapicker"> --}}
                〜
                <div class="form-group">
                    <div class="input-group date datetimepicker" id="due_date1" data-target-input="nearest">
                      <input type="text" name="end_date"  id="due_date-field" class="form-control datetimepicker-input" data-target="#due_date" />
                      <div class="input-group-append" data-target="#due_date1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                </div>
                    {{-- <input type="text" name="end_date"> --}}
            </div>
        </div>
        <input class="btn btn-primary" type="submit" name="csv_export" value="csv出力">
        <input class="btn btn-success" type="submit" name="image_export" value="画像zip出力">
    </div>
</div>
</form>
@endsection
