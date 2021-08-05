@section('title', '情報掲載申し込み｜EventBank ライブ')
@extends('layouts.app')
@section('content')
@section('breadcrumbs', Breadcrumbs::render('request'))
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
            <h2 class="company_title">
                {{-- <i class="far fa-envelope"></i>  --}}
                情報掲載申し込み</h2>
        </div>
        <div class="company_title_detail">
            <p>ライブ配信イベントのまとめサイト「EventBank ライブ」に掲載するライブ配信情報を受け付けています。掲載をご希望の方は、注意事項をお読みいただき、イベントの広報・PRサイト<a href="https://www.eventbank.jp/" target="_blank">「EventBank プレス」</a>(別サイト)でイベント情報を登録してください。イベント情報の登録・掲載は無料です。メールでの掲載の申し込みは受け付けていません。掲載をご希望の方は、別サイト<a href="https://www.eventbank.jp/" target="_blank">「EventBank プレス」</a>でイベント情報を登録してくだ さい。</p>
        </div>
        <div class="company_block2">
            掲載希望のイベント情報は下記のサイトに登録してください
        </div>
        <div>
            <div>
                イベントの広報・PRサイト<a href="https://www.eventbank.jp/" target="_blank">「EventBank プレス」</a>でイベント情報を登録してください。初めて<a href="https://www.eventbank.jp/" target="_blank">「EventBank プレス」</a>をご利用の方は、アカウント(登録者ID)の取得が必要です(無料)。すでにアカウントをお持ちの方は、Myページにログインしてイベント情報を登録してください。
            </div>
        </div>
        <div class="company_block2">
            注意事項
        </div>
        <div class="ope_service">
            <li>掲載対象はライブ配信（生配信）イベントのみです（アーカイブ動画は対象外）</li>
            <div>（ライブ配信後にアーカイブされるのは構いません）</div>
            <li>ライブ配信の主催者または広報ご担当者からの情報のみ受け付けています</li>
            <li>イベントバンクが提携するサイトなどにも掲載されることがあります（掲載無料）</li>
            <li>お寄せいただいた情報について掲載をお約束するものではありません</li>
            <li>情報はライブ配信実施日の遅くとも4日前までにはお寄せください（掲載期間が長いほど、告知の効果が高まります）</li>
            <li>情報が変更になった場合（中止含む）は<a href="https://www.eventbank.jp/" target="_blank">「EventBank プレス」</a>サイトでご自身で修正してください</li>
            <li>イベントバンクよりメールまたは電話で内容のお問い合わせをすることがあります</li>
            <li>お寄せいただいた情報はイベントバンクで適切に取り扱います</li>
        </div>
        <div class="company_block2">
            提携サイト
        </div>
        <div class="ope_service">
            <a href="https://www.eventbank.jp/" target="_blank">「EventBank プレス」</a>にご登録いただいたイベント情報（ライブ配信イベント／オンラインイベント）は、本サイト「EventBank ライブ」のほか、イベントバンクが提携する下記のサイトなどに掲載されることがあります。
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
                <a href="https://hitoshia.com/events/search/?e_categories=72" target="_blank">
                    ヒトシア(オンラインイベント)
                </a>
            </li>
        </div>
    </div>
</div>

@endsection
