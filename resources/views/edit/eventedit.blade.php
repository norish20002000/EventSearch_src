@extends('layouts.app')
@section('content')
<form name="myForm" method="POST" action="/eventbank/event/register" enctype="multipart/form-data">
@csrf
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
@endif
<div class='container'>
    <div class="article_title">
            @if ($errors->first())
            <p　class="validation">データ登録に失敗しました</p>
            <p class="validation">*{{$errors->first()}}</p>
        @endif
        <a href="{{route('eventexport')}}">
            <button type="button">csv</button>
        </a>
        @if (isset($event_data->id))
        <div class="btn_row">
            <div>
                <a href="{{route('eventopelist')}}" >
                <button type="button" class="btn btn-secondary">一覧画面</button>
                </a>
            </div>
            <div>
                <button name="copyevent" value="copyevent" type="button" onclick="submit((function(e){
                    var ele = document.createElement('input')
                    ele.setAttribute('type', 'hidden')
                    ele.setAttribute('name', 'copyevent')
                    ele.setAttribute('value', 'copyevent')
                    document.myForm.appendChild(ele)
                }()));" class="btn btn-primary"　data-toggle="tooltip" data-placement="bottom" title="開催日<br/>画像</br>公開日</br>はコピーされません。" data-html="true">イベントコピー
                </button>
            </div>
            <div>
                <a href="{{route('eventedit')}}" >
                <button type="button" class="btn btn-secondary">新規作成画面へ移動</button>
                </a>
            </div>
        </div>
        @endif
        <div style="display:flex;"><p>必須項目</p><p style="color:red;">*</p></div>
        @if (isset($event_data->id))
        <div class="label_input">
            <div class="label_edit">
                <label class='edit_label'>ID</label>
            </div>
            <div class="input_area">
                <label>{{$event_data->id}}</label>
            </div>
        </div>
        @endif
        <div class="label_input">
            <div class="label_edit" style="display:flex; ">
                <label class='edit_label require' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    タイトル</label>
            </div>
            <div class="input_area">
                <input name="title" type="text" value="{{old('title') ? : (isset($event_data->title) ? $event_data->title : '')}}">
                <input type="hidden" name="event_id" value="{{isset($event_data->id) ? $event_data->id : ''}}" >
                @if ($errors->first('title'))
                    <p class="validation">※{{$errors->first('title')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require' data-toggle="tooltip" data-placement="bottom" title="10000文字以内" data-html="true">
                    本文</label>
            </div>
            <div class="input_area">
                <textarea class="textarea" name="introduction" type="text"  placeholder="1000文字以内">{{old('introduction') ? old('introduction') : (isset($event_data->introduction) ? $event_data->introduction : '')}}</textarea>
                @if ($errors->first('introduction'))
                    <p class="validation">※{{$errors->first('introduction')}}</p>
                @endif
            </div>
        </div>
        <p style="color:red; margin: 20px 0px -20px 42px">*</p>
        {{-- <p>'@json(Session::getOldInput()['date'])'</p> --}}
        <labelinput-component 
            :event-date
                ='@json(old('date') ? Session::getOldInput()['date'] 
                    : (isset($event_data->date) ? $event_data->date : ''))' :old="{{ json_encode(Session::getOldInput()) }}" attribute-name="event_date">
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
                <div  class="div_flex">
                    <div>
                        {{-- <p>{{old('st_time_h')}}</p>
                        <p>{{$event_data->st_time_h}}</p> --}}
                        <select name="st_time_h">
                            <option value="" {{$event_data->st_time_h == "" ? 'selected' : ''}}></option>
                            @for ($i = 0; $i < 25; $i++)
                                <option value="{{str_pad($i, 2, 0, STR_PAD_LEFT)}}"
                                    {{(old('st_time_h') ? old('st_time_h') 
                                        : (($event_data->st_time_h) == "" ? "" 
                                            : (isset($event_data->st_time_h) ? $event_data->st_time_h 
                                                : ''))) == str_pad($i, 2, 0, STR_PAD_LEFT) ? 'selected' : ''}}
                                    >{{str_pad($i, 2, 0, STR_PAD_LEFT)}}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <span>：</span>
                    </div>
                    <div>
                        <select name="st_time_m">
                            <option value="" {{$event_data->st_time_m ? '' : 'selected'}}></option>
                            @for ($i = 0; $i < 60; $i++)
                                @if ($i % 5 == 0)
                                    <option value="{{str_pad($i, 2, 0, STR_PAD_LEFT)}}"
                                        {{(old('st_time_m') ? old('st_time_m') 
                                            : (($event_data->st_time_m) == "" ? "" 
                                                : (isset($event_data->st_time_m) ? $event_data->st_time_m
                                                    : ''))) == str_pad($i, 2, 0, STR_PAD_LEFT)  ? 'selected' : ''}}
                                    >{{str_pad($i, 2, 0, STR_PAD_LEFT)}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                @if ($errors->first('st_time_h'))
                    <p class="validation">※{{$errors->first('st_time_h')}}</p>
                @endif
                @if ($errors->first('st_time_m'))
                    <p class="validation">※{{$errors->first('st_time_m')}}</p>
                @endif
                {{-- <input name="st_time" type="text" value="{{old('st_time') ? old('st_time') : (isset($event_data->st_time) ? $event_data->st_time : '')}}" placeholder="10:00">
                @if ($errors->first('st_time'))
                    <p class="validation">※{{$errors->first('st_time')}}</p>
                @endif --}}
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>終了時間</label>
            </div>
            <div class="input_area">
                <div  class="div_flex">
                    <div>
                        <select name="end_time_h">
                            <option value="" {{$event_data->end_time_h == "" ? 'selected' : ''}}></option>
                            @for ($i = 0; $i < 25; $i++)
                                <option value="{{str_pad($i, 2, 0, STR_PAD_LEFT)}}"
                                    {{(old('end_time_h') ? old('end_time_h') 
                                        : (($event_data->end_time_h) == "" ? "" 
                                            : (isset($event_data->end_time_h) ? $event_data->end_time_h
                                                : ''))) == str_pad($i, 2, 0, STR_PAD_LEFT)  ? 'selected' : ''}}
                                    >{{str_pad($i, 2, 0, STR_PAD_LEFT)}}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <span>：</span>
                    </div>
                    <div>
                        <select name="end_time_m">
                            <option value="" {{$event_data->end_time_m == "" ? 'selected' : ''}}></option>
                            @for ($i = 0; $i < 60; $i++)
                                @if ($i % 5 == 0)
                                    <option value="{{str_pad($i, 2, 0, STR_PAD_LEFT)}}"
                                        {{(old('end_time_m') ? old('end_time_m') 
                                            : (($event_data->end_time_m) == "" ? "" 
                                                : (isset($event_data->end_time_m) ? $event_data->end_time_m
                                                    : ''))) == str_pad($i, 2, 0, STR_PAD_LEFT)  ? 'selected' : ''}}
                                    >{{str_pad($i, 2, 0, STR_PAD_LEFT)}}</option>
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                @if ($errors->first('end_time_h'))
                    <p class="validation">※{{$errors->first('end_time_h')}}</p>
                @endif
                @if ($errors->first('end_time_m'))
                    <p class="validation">※{{$errors->first('end_time_m')}}</p>
                @endif
                {{-- <input name="end_time" type="text" value="{{old('end_time') ? old('end_time') : (isset($event_data->end_time) ? $event_data->end_time : '')}}" placeholder="17:00">
                @if ($errors->first('end_time'))
                    <p class="validation">※{{$errors->first('end_time')}}</p>
                @endif --}}
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    日時備考</label>
            </div>
            <div class="input_area">
                <input name="summary_date" type="text" value="{{old('summary_date') ? old('summary_date') : (isset($event_data->summary_date) ? $event_data->summary_date : '')}}">
                @if ($errors->first('summary_date'))
                    <p class="validation">※{{$errors->first('summary_date')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    視聴サイト名</label>
            </div>
            <div class="input_area">
                <input name="web_name" type="text" value="{{old('web_name') ? old('web_name') : (isset($event_data->web_name) ? $event_data->web_name : '')}}">
                @if ($errors->first('web_name'))
                    <p class="validation">※{{$errors->first('web_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    視聴URL</label>
            </div>
            <div class="input_area">
                <input name="web_url" type="text" value="{{old('web_url') ? old('web_url') : (isset($event_data->web_url) ? $event_data->web_url : '')}}">
                @if ($errors->first('web_url'))
                    <p class="validation">※{{$errors->first('web_url')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>料金種別</label>
            </div>
            <div class="input_area">
                <select name="fee_type">
                    <option value="0" 
                        {{(old('fee_type') ? old('fee_type') 
                            : (isset($event_data->fee_type) ? $event_data->fee_type
                            : 0)) == 0 ? 'selected' : ''}}>無料
                    </option>
                    <option value="1" 
                        {{(old('fee_type') ? old('fee_type') 
                            : (isset($event_data->fee_type) ? $event_data->fee_type
                            : 0)) == 1 ? 'selected' : ''}}>有料</option>
                    </option>
                </select>

                {{-- <input name="fee_type" type="text" value="{{old('fee_type') ? old('fee_type') : (isset($event_data->fee_type) ? $event_data->fee_type : '')}}">
                @if ($errors->first('fee_type'))
                    <p class="validation">※{{$errors->first('fee_type')}}</p>
                @endif --}}
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    料金</label>
            </div>
            <div class="input_area">
                <input name="fee" type="text" value="{{old('fee') ? old('fee') : (isset($event_data->fee) ? $event_data->fee : '')}}">
                @if ($errors->first('fee'))
                    <p class="validation">※{{$errors->first('fee')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label'>画像</label>
            </div>
            <div class="input_area">
                <image-component :event-data='@json($event_data)'></image-component>
                @if ($errors->first('event_image'))
                    <p class="validation">※{{$errors->first('event_image')}}</p>
                @endif
                {{-- <input name="image_url" type="text" value="{{isset($event_data->image_url) ? $event_data->image_url : ''}}">
                @if ($errors->first('image_url'))
                    <p class="validation">※{{$errors->first('image_url')}}</p>
                @endif --}}
                {{-- <img src="{{old('image_data')}}" width="300px"> --}}
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    参考サイト名</label>
            </div>
            <div class="input_area">
                <input name="reference_name" type="text" value="{{old('reference_name') ? old('reference_name') : (isset($event_data->reference_name) ? $event_data->reference_name : '')}}">
                @if ($errors->first('reference_name'))
                    <p class="validation">※{{$errors->first('reference_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    参考URL</label>
            </div>
            <div class="input_area">
                <input name="reference_url" type="text" value="{{old('reference_url') ? old('reference_url') : (isset($event_data->reference_url) ? $event_data->reference_url : '')}}">
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
                <div class="form-group">
                    <div class="input-group date datetimepicker release_date" id="due_date" data-target-input="nearest">
                      <input type="text" name="release_date"  id="due_date-field" class="form-control datetimepicker-input" data-target="#due_date" value="{{old('release_date') ? old('release_date') : (isset($event_data->release_date) ? $event_data->release_date : '')}}" />
                      <div class="input-group-append" data-target="#due_date" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                </div>
                {{-- <input name="release_date" type="text" value="{{old('release_date') ? old('release_date') : (isset($event_data->release_date) ? $event_data->release_date : '')}}" placeholder="2020-01-01"> --}}
                @if ($errors->first('release_date'))
                    <p class="validation">※{{$errors->first('release_date')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require'>ジャンル</label>
            </div>
                {{-- <select class="custom-select" name="genre_id" value="{{isset($event_data->genre) && isset($event_data->genre->genre_id) ? $event_data->genre->genre_id : ''}}">
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
                @endif --}}
            <div class="input_area">
                @foreach ($genre01List as $genre)
                <div class="gnere_disp_name">{{ $genre->genre01->disp_name }}</div>
                <div>
                    @foreach ($genre as $genre01)
                        <label>
                            <input name="genre01[]" class="input_checkbox" 
                            type="checkbox" value="{{$genre01->id}}" 
                            {{old('genre01') ? (in_array("$genre01->id", old('genre01'), true) ? "checked" : '') : (isset($genre01s) && $genre01s->contains('id', $genre01->id) ? 'checked' : '')}}
                            />{{ $genre01->disp_name }}
                        </label>
                    @endforeach
                </div>
                @endforeach
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
                <label class='edit_label require' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    登録者団体名</label>
            </div>
            <div class="input_area">
                <input name="regi_group_name" type="text" value="{{old('regi_group_name') ? old('regi_group_name') : (isset($event_data->regi_group_name) ? $event_data->regi_group_name : '')}}">
                @if ($errors->first('regi_group_name'))
                    <p class="validation">※{{$errors->first('regi_group_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    登録者担当名</label>
            </div>
            <div class="input_area">
                <input name="regi_name" type="text" value="{{old('regi_name') ? old('regi_name') : (isset($event_data->regi_name) ? $event_data->regi_name : '')}}">
                @if ($errors->first('regi_name'))
                    <p class="validation">※{{$errors->first('regi_name')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    登録者電話番号</label>
            </div>
            <div class="input_area">
                <input name="regi_tel" type="text" value="{{old('regi_tel') ? old('regi_tel') : (isset($event_data->regi_tel) ? $event_data->regi_tel : '')}}">
                @if ($errors->first('regi_tel'))
                    <p class="validation">※{{$errors->first('regi_tel')}}</p>
                @endif
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label require' data-toggle="tooltip" data-placement="bottom" title="255文字以内" data-html="true">
                    登録者mail</label>
            </div>
            <div class="input_area">
                <input name="regi_mail" type="text" value="{{old('regi_mail') ? old('regi_mail') : (isset($event_data->regi_mail) ? $event_data->regi_mail : '')}}">
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
                    {{old('status') ? (old('status') == 0 ? 'checked' : '') : (!isset($event_data) || $event_data->status == 0 ? 'checked':'')}}><label class="open_label">公開</label>
                <input type="radio" name="status" value="1"
                    {{old('status') ? (old('status') != 0 ? 'checked' : '') : (isset($event_data) && $event_data->status != 0 ? 'checked':'')}}><label class="open_label">非公開</label>
            </div>
        </div>
        <div class="label_input">
            <div>
                <label class='edit_label' data-toggle="tooltip" data-placement="bottom" title="3000文字以内" data-html="true">
                    備考</label>
            </div>
            <div class="input_area">
                <textarea class="textarea" name="remarks" type="text">{{old('remarks') ? old('remarks') : (isset($event_data->remarks) ? $event_data->remarks : '')}}</textarea>
                @if ($errors->first('remarks'))
                    <p class="validation">※{{$errors->first('remarks')}}</p>
                @endif
            </div>
        </div>
    </div>
    <div>
        @if($event_data->upType == "update")
        <button name="update" class="btn btn-outline-primary" type="button" onclick="submit((function(e){
            var ele = document.createElement('input')
            ele.setAttribute('type', 'hidden')
            ele.setAttribute('name', 'update')
            ele.setAttribute('value', 'update')
            document.myForm.appendChild(ele)
            }()));" value="register">保存</button>
        @elseif($event_data->upType == "register")
        <button name="register" class="btn btn-outline-danger" type="button" onclick="submit((function(e){
            var ele = document.createElement('input')
            ele.setAttribute('type', 'hidden')
            ele.setAttribute('name', 'register')
            ele.setAttribute('value', 'register')
            document.myForm.appendChild(ele)
        }()));" value="register">登録</button>
        @endif
    </div>
</div>
</form>
@endsection
