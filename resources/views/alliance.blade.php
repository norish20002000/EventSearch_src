@section('title', '提携メディア募集｜EventBank ライブ')
@extends('layouts.app')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('alliance'))
<section class="top_banner">
    <img class="header_image" src="/image/top/top.jpg">
    <div class="content_header">
        <p class="header_p_center">ライブ配信イベントを楽しもう。</p>
    </div>
</section>
<div class='container'>
    <div class="article_title">
        <div class="company_block">
            {{-- <img src="/image/icon/building.png" class="icon_com"> --}}
            <h2 class="company_title">提携メディア募集</h2>
        </div>
        <div>
            <div>
                イベントバンクでは、ライブ配信イベント（オンラインイベント）情報の掲載メディア（サイト・アプリなど）を募集中です。
                イベント主催者発の新鮮なライブ配信イベントの情報をイベントバンクが定期的にご提供します。(原則として毎日配信)
                ライブ配信イベントの情報はCSV形式またはTSV形式で、写真（画像）はJPEG形式でご提供。
                イベントの新しい楽しみ方として定着したライブ配信イベントの情報を、貴社メディアのコンテンツとしてぜひご活用ください。</div>
        </div>
        <div class="company_block2">
            提携メディア
        </div>
        <div class="ope_service">
            現在提携中のメディアは以下の通りです。
        </div>
        <div class="ope_service_1">
            <li>
                <a href="https://www.walkerplus.com/online_list/" target="_blank">
                    ウォーカープラス（オンラインイベント）
                </a>
            </li>
            <li>
                <a href="https://iko-yo.net/topics/online_event" target="_blank">
                    いこーよ（オンラインイベント特集）
                </a>
            </li>
            <li>
                <a href="https://hitoshia.com/events/search/?e_categories=72">
                    ヒトシア(オンラインイベント)
                </a>
            </li>
        </div>
        <div class="company_block2">
            お問い合わせ
        </div>
        <div class="ope_service">
            ライブ配信イベント情報の詳細（ご提供頻度・データフォーマット・料金など ）につきましては、
            <a href="https://www.eventbank.jp/about/inquiry.do" target="_blank">
                こちら
            </a> 
            からお問い合わせください。
            なお、ご利用方法によってはご提供できない場合があります。ご了承ください。
        </div>
    </div>
</div>

@endsection
