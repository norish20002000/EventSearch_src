<?php

// ホーム
Breadcrumbs::for('home', function ($trail) {
    $trail->push('TOP', url('/'));
});

// ホーム > 今日
Breadcrumbs::for('today', function ($trail, $event_data) {
    $trail->parent('home');
    $trail->push('今日', url('/'));
});

// ホーム > 明日
Breadcrumbs::for('tomorrow', function ($trail, $event_data) {
    $trail->parent('home');
    $trail->push('明日', url('/'));
});

// ホーム > 今週末
Breadcrumbs::for('weekend', function ($trail, $event_data) {
    $trail->parent('home');
    $trail->push('今週末', url('/'));
});

// ホーム > イベント
Breadcrumbs::for('event', function ($trail, $event_data) {
    $trail->parent('home');
    $trail->push('イベント', url('eventdetail/' . $event_data->id));
});

// ホーム > ジャンルエベント一覧
Breadcrumbs::for('genres', function ($trail, $event_data) {
    $trail->parent('home');
    $trail->push($event_data->genre->disp_name, url('eventgenre/' . $event_data->genre->id));
});

// ホーム > ジャンルエベント一覧 > ジャンルエベント
Breadcrumbs::for('eventgenre', function ($trail, $event_data) {
    $trail->parent('genres', $event_data);
    $trail->push('イベント', url('eventdetail/' . $event_data->genre->id));
});

// ホーム > 運営会社
Breadcrumbs::for('company', function ($trail) {
    $trail->parent('home');
    $trail->push("運営会社", url('company/'));
});

// ホーム > 情報掲載申し込み
Breadcrumbs::for('request', function ($trail) {
    $trail->parent('home');
    $trail->push("情報掲載申し込み", url('request/'));
});
