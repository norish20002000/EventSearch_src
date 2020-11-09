<div class="footer_before">
    <div class="footer_btns">
        @if(request()->path() != '/')
            <a href="#" class="footer_link" onclick="history.back();return false;">
                <button class="buttonImage"><img src="/image/icon/arrow_left.png" alt=""></button>
                <div class="footer_str">前のページ</div>
            </a>
        @endif
        <a href="#TOP" class="footer_link">
            <button class="buttonImage"><img src="/image/icon/arrow_up.png"></button>
            <div class="footer_str">ページの先頭</div>
        </a>
        <a href="/" class="footer_link">
            <button class="buttonImage"><img src="/image/icon/home.png"></button>
            <div class="footer_str">TOPページ</div>
        </a>
    </div>
</div>

<div class="footer">
    <div class="copywrite">
        <div>
            <a href="/">TOP</a> ｜ <a href="{{route('request')}}">情報掲載申し込み</a> ｜ <a href="{{route('alliance')}}">提携メディア</a> ｜ <a href="{{route('company')}}">運営会社</a>
        </div>
        <div>
            <p>Copyright© 2020 EventBank Corporation. All Rights Reserved.</p>
        </div>
    </div>
</div>
