<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Bytelength;

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
            "title" => "required|max:255",
            "introduction" => "required|max:10000",
            'date.0.event_date' => 'required|date_format:"Y-m-d"',
            "st_time_h" =>'required_with:st_time_m',
            "st_time_m" =>'required_with:st_time_h',
            "end_time_h" =>'required_with:end_time_m',
            "end_time_m" =>'required_with:end_time_h',
            // "st_time" => 'nullable|date_format:"H:i"',
            // "end_time" => 'nullable|date_format:"H:i"|after:st_time',
            "summary_date" => "max:255",
            // "web_name" => ["required", new Bytelength(50)],
            "web_name" => "required|max:255",
            "web_url" => "nullable|url|max:255",
            // "fee_type" => "required",
            "fee" => "max:255",
            'event_image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
            "reference_name" => "max:255",
            "reference_url" => "url|max:255",
            "release_date" => 'required|date_format:"Y-m-d"',
            "genre_id" => "",
            "target" => "",
            "regi_group_name" => "required|max:255",
            "regi_name" => "required|max:255",
            "regi_tel" => "max:255",
            "regi_mail" => "required|email|max:255",
            "remarks" => "max:3000"
        ];
    }

    /**
     * attribute
     */
    public function attributes()
    {
        return [
            "title" => "タイトル",
            "introduction" => "本文",
            'date.0.event_date' => "開催日",
            "st_time_h" =>'開始時',
            "st_time_m" =>'開始分',
            "end_time_h" =>'終了時',
            "end_time_m" =>'終了分',
            // "st_time" => "開始時間",
            // "end_time" => "終了時間",
            "summary_date" => "日付備考",
            "web_name" => "視聴サイト名",
            "web_url" => "視聴URL",
            "fee_type" => "料金種別",
            "fee" => "料金",
            "event_image" => "画像",
            "reference_name" => "参考サイト名",
            "reference_url" => "参考URL",
            "release_date" => "公開日",
            "genre_name" => "ジャンル名",
            "target" => "ターゲット",
            "regi_group_name" => "登録者団体名",
            "regi_name" => "登録者担当名",
            "regi_tel" => "登録者電話番号",
            "regi_mail" => "登録者mail",
            "remarks" => "備考"
        ];
    }

    /**
     * message
     */
    public function messages()
    {
        return [
            "date.0.event_date.date_format" => ":attributeの形式は、'2020-01-01'と合いません。",
            "st_time.date_format" => ":attributeの形式は、'01:01'と合いません。",
            "end_time.date_format" => ":attributeの形式は、'01:01'と合いません。",
            "end_time.after" => ':attributeには、:dateより後の時間を指定してください。',
            "release_date.date_format" => ":attributeの形式は、'2020-01-01'と合いません。",
            // 最大文字数
            "title.max" => ":attributeは、:max文字数以内で入力してください。",
            "introduction.max" => ":attributeは、:max文字数以内で入力してください。",
            "web_name.max" => ":attributeは、:max文字数以内で入力してください。",
            "web_url.max" => ":attributeは、:max文字数以内で入力してください。",
            "fee.max" => ":attributeは、:max文字数以内で入力してください。",
            "reference_name.max" => ":attributeは、:max文字数以内で入力してください。",
            "reference_url.max" => ":attributeは、:max文字数以内で入力してください。",
            "regi_group_name.max" => ":attributeは、:max文字数以内で入力してください。",
            "regi_name.max" => ":attributeは、:max文字数以内で入力してください。",
            "regi_tell.max" => ":attributeは、:max文字数以内で入力してください。",
            "regi_mail.max" => ":attributeは、:max文字数以内で入力してください。",
            "remarks.max" => ":attributeは、:max文字数以内で入力してください。",
        ];
    }
}
