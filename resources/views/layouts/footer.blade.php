<div class="footer_before">
    <div class="footer_btns">
        <div>
            @if(request()->path() != '/')
                <a href="#" onclick="history.back();return false;">
                    <button class="buttonImage"><img src="/image/icon/arrow_left.png" alt=""></button>
                    <span class="footer_str">前のページへ</span>
                </a>
            @endif
            <a href="#TOP">
                <button class="buttonImage"><img src="/image/icon/arrow_up.png"></button>
                <span class="footer_str">ページの先頭へ</span>
            </a>
            <a href="/">
                <button class="buttonImage"><img src="/image/icon/home.png"></button>
                <span class="footer_str">TOPページへ</span>
            </a>
        </div>
    </div>
</div>

<div class="footer">
    <div class="copywrite">
        <div>
            <a href="/">Top</a> ｜ <a href="{{route('request')}}">情報掲載申し込み</a> ｜ <a href="{{route('company')}}">運営会社</a>
        </div>
        <div>
            <p>Copyright© 2020 EventBank Corporation. All Rights Reserved.</p>
        </div>
    </div>
</div>
