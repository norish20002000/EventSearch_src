<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventFormSendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required",
            "introduction" => "required",
            'date.0.event_date' => "required",
            "st_time" => "",
            "end_time" => "",
            "summary_date" => "",
            "web_name" => "required",
            "web_url" => "",
            "fee_type" => "required",
            "fee_type" => "",
            "image_url" => "",
            "reference_name" => "",
            "reference_name" => "",
            "release_date" => "required",
            "genre_id" => "",
            "target" => "",
            "regi_group_name" => "required",
            "regi_name" => "required",
            "regi_name" => "required",
            "regi_mail" => "required",
        ];
    }

    /**
     * attribute
     */
    public function attributes()
    {
        return [
            "title" => "タイトル",
            "introduction" => "紹介文",
            'date.0.event_date' => "開催日",
            "st_time" => "開始時間",
            "end_time" => "終了時間",
            "summary_date" => "日付概要",
            "web_name" => "サイト名",
            "web_url" => "サイトURL",
            "fee_type" => "料金種別",
            "fee" => "料金",
            "image_url" => "画像URL",
            "reference_name" => "参考サイト名",
            "reference_url" => "参考サイトURL",
            "release_date" => "公開日",
            "genre_name" => "ジャンル名",
            "target" => "ターゲット",
            "regi_group_name" => "グループ名",
            "regi_name" => "登録者名",
            "regi_tel" => "電話番号",
            "regi_mail" => "メール",
        ];
    }
}
