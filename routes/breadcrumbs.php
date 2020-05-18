<?php

// ホーム
Breadcrumbs::for('home', function ($trail) {
    $trail->push('ホーム', url('/'));
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
