@extends('layouts.app')
@section('content')
<div>
<div>
</div>
</div>
<form method="POST" action="/eventbank/event/register">
@csrf
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
@endif
<div class='container'>
    <div class="article_title">
        @if (isset($event_data->id))
        <div class="btn_row">
            <div>
                <a href="{{route('eventopelist')}}" >
                <button type="button" class="btn btn-secondary">一覧画面</button>
                </a>
            </div>
            <div>
                <button name="copyevent" value="copyevent" type="submit" class="btn btn-primary"　data-toggle="tooltip" data-placement="bottom" title="開催日<br/>はコピーされません。" data-html="true">イベントコピー</button>
            </div>
            <div>
                <a href="{{route('eventedit')}}" >
                <button type="button" class="btn btn-secondary">新規作成画面へ移動</button>
                </a>
            </div>
        </div>
        @endif
        <div style="display:flex;"><p>必須項目</p><p style="color:red;">*</p></div>
        <div class="label_input">
            <div class="label_edit" style="display:flex; ">
                <label class='edit_label require'>タイトル</label>
            </div>
            <div class="input_area">
                <input name="title" type="text" value="{{isset($event_data->title) ? $event_data->title : ''}}">
                <input type="hidden" name="event_id" value="{{isset($event_data->id) ? $event_data->id : ''}}" >
                @if ($errors->first('title'))
                    <p class="validation">※{{$errors->first('title')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>本文</label>
            </div>
            <div class="input_area">
                <textarea class="textarea" name="introduction" type="text" >
                    {{isset($event_data->introduction) ? $event_data->introduction : ''}}
                </textarea>
                @if ($errors->first('introduction'))
                    <p class="validation">※{{$errors->first('introduction')}}</p>
                @endif
            </div>
        </div>
        <p style="color:red; margin: 20px 0px -20px 42px">*</p>
        <labelinput-component :event-date='@json(isset($event_data->date) ? $event_data->date : '')' attribute-name="event_date">
            <div slot='column_name'>
                開催日
            </div>
        </labelinput-component>
        @if ($errors->first('date.0.event_date'))
            <p class="validation">※{{$errors->first('date.0.event_date')}}</p>
        @endif
        <div class="label_input">
            <div>
                <label class='edit_label'>開始時間</label>
            </div>
            <div class="input_area" >
                <input name="st_time" type="text" value="{{isset($event_data->st_time) ? $event_data->st_time : ''}}" placeholder="10:00"></input>
                @if ($errors->first('st_time'))
                    <p class="validation">※{{$errors->first('st_time')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>終了時間</label>
            </div>
            <div class="input_area">
                <input name="end_time" type="text" value="{{isset($event_data->end_time) ? $event_data->end_time : ''}}" placeholder="17:00"></input>
                @if ($errors->first('end_time'))
                    <p class="validation">※{{$errors->first('end_time')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>日時備考</label>
            </div>
            <div class="input_area">
                <input name="summary_date" type="text" value="{{isset($event_data->date_type) ? $event_data->date_type : ''}}"></input>
                @if ($errors->first('summary_date'))
                    <p class="validation">※{{$errors->first('summary_date')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>視聴サイト名</label>
            </div>
            <div class="input_area">
                <input name="web_name" type="text" value="{{isset($event_data->web_name) ? $event_data->web_name : ''}}"></input>
                @if ($errors->first('web_name'))
                    <p class="validation">※{{$errors->first('web_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>視聴URL</label>
            </div>
            <div class="input_area">
                <input name="web_url" type="text" value="{{isset($event_data->web_url) ? $event_data->web_url : ''}}"></input>
                @if ($errors->first('web_url'))
                    <p class="validation">※{{$errors->first('web_url')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>料金個別</label>
            </div>
            <div class="input_area">
                <input name="fee_type" type="text" value="{{isset($event_data->fee_type) ? $event_data->fee_type : ''}}"></input>
                @if ($errors->first('fee_type'))
                    <p class="validation">※{{$errors->first('fee_type')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>料金</label>
            </div>
            <div class="input_area">
                <input name="fee" type="text" value="{{isset($event_data->fee) ? $event_data->fee : ''}}"></input>
                @if ($errors->first('fee'))
                    <p class="validation">※{{$errors->first('fee')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>画像URL</label>
            </div>
            <div class="input_area">
                <input name="image_url" type="text" value="{{isset($event_data->image_url) ? $event_data->image_url : ''}}"></input>
                @if ($errors->first('image_url'))
                    <p class="validation">※{{$errors->first('image_url')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>参考サイト名</label>
            </div>
            <div class="input_area">
                <input name="reference_name" type="text" value="{{isset($event_data->reference_name) ? $event_data->reference_name : ''}}"></input>
                @if ($errors->first('reference_name'))
                    <p class="validation">※{{$errors->first('reference_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>参考URL</label>
            </div>
            <div class="input_area">
                <input name="reference_url" type="text" value="{{isset($event_data->reference_url) ? $event_data->reference_url : ''}}"></input>
                @if ($errors->first('reference_url'))
                    <p class="validation">※{{$errors->first('reference_url')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>公開日</label>
            </div>
            <div class="input_area">
                <input name="release_date" type="text" value="{{isset($event_data->release_date) ? $event_data->release_date : ''}}" placeholder="2020-01-01"></input>
                @if ($errors->first('release_date'))
                    <p class="validation">※{{$errors->first('release_date')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>ジャンル</label>
            </div>
            <div class="input_area">
                <select class="custom-select" name="genre_id" value="{{isset($event_data->genre) && isset($event_data->genre->genre_id) ? $event_data->genre->genre_id : ''}}">
                    @foreach($genre as $g)
                        <option value="{{$g->id}}" 
                            {{isset($event_data->genre) && isset($event_data->genre->genre_id) && $event_data->genre->genre_id == $g->id ? 'selected':''}}>
                            {{$g->disp_name}}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="genre_map_id" value="{{isset($event_data->genre) && isset($event_data->genre->id) ? $event_data->genre->id : ''}}">
                @if ($errors->first('genre_naem'))
                    <p class="validation">※{{$errors->first('genre_name')}}</p>
                @endif
            </div>
        </div>
{{--        <div class="label_input">
            <div>
                <label class='edit_label'>ターゲット</label>
            </div>
            <div class="input_area">
                <input name="target" type="text"></input>
                @if ($errors->first('target'))
                    <p class="validation">※{{$errors->first('target')}}</p>
                @endif
            </div>
        </div>
--}}
        <div class="label_input">
            <div>
                <label class='edit_label require'>登録者団体名</label>
            </div>
            <div class="input_area">
                <input name="regi_group_name" type="text" value="{{isset($event_data->regi_group_name) ? $event_data->regi_group_name : ''}}"></input>
                @if ($errors->first('regi_group_name'))
                    <p class="validation">※{{$errors->first('regi_group_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>登録者担当名</label>
            </div>
            <div class="input_area">
                <input name="regi_name" type="text" value="{{isset($event_data->regi_name) ? $event_data->regi_name : ''}}"></input>
                @if ($errors->first('regi_name'))
                    <p class="validation">※{{$errors->first('regi_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>登録者電話番号</label>
            </div>
            <div class="input_area">
                <input name="regi_tel" type="text" value="{{isset($event_data->regi_tel) ? $event_data->regi_tel : ''}}"></input>
                @if ($errors->first('regi_tel'))
                    <p class="validation">※{{$errors->first('regi_tel')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>登録者mail</label>
            </div>
            <div class="input_area">
                <input name="regi_mail" type="text" value="{{isset($event_data->regi_mail) ? $event_data->regi_mail : ''}}"></input>
                @if ($errors->first('regi_mail'))
                    <p class="validation">※{{$errors->first('regi_mail')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'></label>
            </div>
            <div>
                <input type="radio" name="status" value="0" 
                    {{!isset($event_data) || $event_data->status == 0 ? 'checked':''}}><label class="open_label">公開</label>
                <input type="radio" name="status" value="1"
                    {{isset($event_data) && $event_data->status != 0 ? 'checked':''}}><label class="open_label">非公開</label>
            </div>
        </div>
    </div>
    <div>
        @if($event_data->upType == "update")
        <button name="update" class="btn btn-outline-primary" type="submit" value="register">編集</button>
        @elseif($event_data->upType == "register")
        <button name="register" class="btn btn-outline-danger" type="submit" value="register">登録</button>
        @endif
    </div>
</div>
</form>
@endsection
