@section('title', '運営会社｜EventBank ライブ')
@extends('layouts.app')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('company'))
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
            <h2 class="company_title">運営会社</h2>
        </div>
        <div>
            <div>オンラインイベント、ライブ配信イベントを楽しもう！</div>
            <div>ライブ配信イベントのまとめサイト「EventBank ライブ」</div>
        </div>
        <div class="company_block2">
            株式会社イベントバンク
        </div>
        <div>
            <span>〒101-0051</span><br>
            <p>東京都千代田区神田神保町2-48　3510（サンコードー）ビル2F_</p>
            <a href="https://www.eventbank.jp/about/inquiry.do?act=input" target="blank"><p>お問い合わせ</p></a>

            <div>
                設立：2008年3月
            </div>
            <div>
                資本金：1,000万円
            </div>
            <div>
                代表取締役社長：福井 慶一郎
            </div>
            <div>
                事業内容：イベント・祭事ほか各種地域情報の収集提供 ／ イベント関連メディアの企画・制作・運営 ／ 観光・レジャー・アミューズメント情報の収集提供 ／ イベント・観光情報のデータベース作成提供 ／ イベント取材・レポーティング ／ ほか
            </div>
            <div>
                グループ会社：<a href="https://www.jorte.com/" target="blank">株式会社ジョルテ</a>
            </div>
        </div>
        <div class="company_block2">
            運営サービス
        </div>
        <div class="ope_service">
            <li>お祭り・イベントの広報・PRサイト「<a href="https://www.eventbank.jp/" target="blank">EventBank プレス</a>」</li>
            <li>イベント会社・イベント会場の総合ガイド「<a href="https://partners.eventbank.jp/" target="blank">EventBank パートナーズ</a>」</li>
            <li>地域のイベント情報を手軽に活用できるサービス「<a href="https://api.eventbank.jp/" target="blank">EventBank API</a>」</li>
            <li>ライブ配信イベントのまとめサイト「EventBank ライブ」</li>
        </div>
    </div>
</div>

@endsection
