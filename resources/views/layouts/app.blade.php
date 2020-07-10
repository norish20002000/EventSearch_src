<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="ライブ配信イベントのまとめサイトです。ネット配信によるイベント・ライブ・エンタメ・カルチャー・講座・ワークショップなどをご紹介します。">
    <meta name="keywords" content="ライブ配信,オンラインイベント,ネット配信,生配信,無観客,まとめサイト,EventBank,イベントバンク">
    <meta name="publisher" content="株式会社イベントバンク">
    
    @hassection('title')
    <title>@yield('title')</title>
    {{-- <title>@yield('title') | {{ config('app.tile') }}</title> --}}
    @else
    <title>{{ config('app.title', 'Laravel') }}</title>
    @endif

    @hassection('og_image')
        <meta property="og:image" content=@yield('og_image') />
    @else
        <meta property="og:image" content="{{url('/image/top/logo.jpg')}}" />
    @endif

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="eventbank live">
    <meta name="twitter:description" content="event検索">    
    <meta name="twitter:image" content="https://live.eventbank.jp/image/top/logo.jpg" />

    {{-- @hasSection ('twiiter_image')
        <meta name="twitter:image" content="https://live.eventbank.jp/storage/eventimages/50000424/50000424.jpg" />
    @else
        <meta name="twitter:image" content="https://live.eventbank.jp/image/top/logo.jpg" />
    @endif --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    @if (env('APP_DEBUG'))
        <script src="{{ asset('js/vue.js') }}"></script>
    @else
        <script src="{{ asset('js/vue.min.js') }}"></script>
    @endif
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/event.css') }}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('image/favicon.ico') }}" type="image/x-icon"/>

    <!-- vuejs-datepicker -->
    <script src="https://unpkg.com/vuejs-datepicker"></script>
</head>
<body>
    <a name="TOP"></a>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class='top_logo' src="/image/top/logo.jpg">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('company')}}">会社概要</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('request')}}">情報掲載申し込み</a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
            </nav>
            <div class="navbar navbar-expand-md navbar-light bg-white shadow-sm my_container">
                <div class='container'>
                    @yield('breadcrumbs')
                </div>
                </div>
            <main class="py-4 my_py_4">
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    <script type="module">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
            });

            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
            });
            
            $('.datetimepicker').datetimepicker({
            icons: {
                // Font Awesome 5には「fa-clock-o」がなくなっているので指定する
                time: 'far fa-clock'
            },
            format: 'YYYY-MM-DD',
            locale: 'ja',
        });
    </script>
</body>
</html>
