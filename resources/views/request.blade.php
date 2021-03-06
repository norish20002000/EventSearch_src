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
        <div class="mainte_div">
            <div>
                本サイトはメンテナンスのため、オンラインイベントの掲載受付・更新を一時休止しています。
            </div>
            <div>
                なお、休止後は従来のメールでの掲載受付を廃止します。
            </div>
            <div>
                <a href="https://www.eventbank.jp/" target="_blank">「EventBank プレス」</a>
                から情報をご登録ください。
            </div>
            <div  class="mainte_date">
                <div>
                    受付・更新の休止：7月1日（木）～7月11日（日）
                </div>
                <div>
                    EventBank プレス登録開始：7月12日（月）～
                </div>
            </div>
        </div>
        <div class="company_title_detail">
            <p>ライブ配信イベントのまとめサイト「EventBank ライブ」に掲載するライブ配信情報を受け付けています。掲載をご希望の方は、注意事項をお読みのうえ、下記の情報をお寄せください。掲載は無料です。</p>
        </div>
        <div class="company_block2">
            必要情報
        </div>
        <div>
            <div>イベント名：（ライブ配信のタイトル）</div>
            <div>紹介文：（内容や見どころを200文字程度で）</div>
            <div>配信日時：（ライブ配信日時）</div>
            <div>配信場所：（視聴するサイト名・URLなど）</div>
            <div>視聴料金：（無料／有料の場合は料金）</div>
            <div>視聴のための情報：（申し込みページや詳細情報ページのURLなどがあれば）</div>
            <div>写真：（写真をメールに添付してください）</div>
            <div>イベントバンクからのお問い合わせ先：（お名前・電話番号・メールアドレス）</div>
        <div class="company_block2">
            送付先
        </div>
        <div>
            <div>
                下記のアドレスに必要情報をメールでお送りください。
            </div>
            <div>
                info★eventbank.jp　（★を半角@に置き換えてください）
            </div>
            <div>
                メールタイトルに「ライブ配信掲載希望」とお書きください。
            </div>
        </div>
        <div class="company_block2">
            注意事項
        </div>
        <div class="ope_service">
            <li>掲載対象はライブ配信（生配信）イベントのみです（アーカイブ動画は対象外）</li>
            <div>（ライブ配信後にアーカイブされるのは構いません）</div>
            <li>ライブ配信の主催者または広報ご担当者からの情報のみ受け付けています</li>
            <li>お寄せいただいた情報からイベントバンクがセレクトして掲載します（掲載無料）</li>
            <li>イベントバンクが提携するサイトなどにも掲載されることがあります（掲載無料）</li>
            <li>お寄せいただいた情報について掲載をお約束するものではありません</li>
            <li>情報は配信日の3日前までにはお寄せください（掲載期間が長いほど、告知の効果が高まります）</li>
            <li>受付完了のメールは送信しません（送信いただいた時点で受付完了となります）</li>
            <li>掲載の可否、またその理由、掲載後のご連絡は個別に行っていません</li>
            <li>情報が変更になった場合（中止含む）はイベントバンクまでご連絡ください</li>
            <li>イベントバンクよりメールまたは電話で内容のお問い合わせをすることがあります</li>
            <li>お寄せいただいた情報はイベントバンクで適切に取り扱います</li>
        </div>
        <div class="company_block2">
            提携サイト
        </div>
        <div class="ope_service">
            お送りいただいたイベント情報（ライブ配信イベント／オンラインイベント）は、本サイト「EventBank ライブ」のほか、イベントバンクが提携する下記のサイトなどに掲載されることがあります。
        </div>
        <div class="ope_service_1">
            <li>
                <a href="https://www.walkerplus.com/online_list/" target="_blank">
                    ウォーカープラス（オンラインイベント）
                </a>
            </li>
            <li>
                <a href="https://iko-yo.net/topics/online_event" target="_blank">
                    いこーよ（おうち時間に！オンラインイベント特集）
                </a>
            </li>
        </div>
    </div>
</div>

@endsection
