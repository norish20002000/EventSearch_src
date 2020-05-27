<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Genre;

class EventController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
    }

    /**
     * event detail view
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function show(Request $request, $id)
    {
        $data['event_data'] = Event::getEventDataById($id);
        // $data['event_data']->sub = $data['event_data']->detail;

        // 概要作成
        $data['event_data']->summary = mb_substr($data['event_data']->introduction, 0, 150).". . .";
        //　金額カンマ
        $data['event_data']->fee = number_format(floor($data['event_data']->fee));
            // $data['event_data']->fee)

        // 曜日変換
        $weekList = ["日", "月", "火", "水", "木", "金", "土"];
        foreach ($data['event_data']->date as $event) {
            // var_dump($event);exit;
            $event->st_week = $weekList[date('w', strtotime($event->event_date))];
        }

        // 時間変換
        $data['event_data']->st_time = mb_substr($data['event_data']->st_time, 0, 5);
        $data['event_data']->end_time = mb_substr($data['event_data']->end_time, 0, 5);
        // var_dump($data['event_data']);exit;

        // referer
        if(strpos(url()->previous(), 'eventgenre') !== false) {
            $urlPathList = explode('/', parse_url(url()->previous())['path']);
            $genreId = (int)$urlPathList[2];
            $data['event_data']->genre = Genre::getGenreById($genreId);
            $data['event_data']->prePage = "genres";
        } else {
            $data['event_data']->prePage = "";
        }

        return View('event', $data);
    }

    /**
     * event genre
     * @param Request $request
     * @param int $id
     * @return View
     */
    public function genre(Request $request, $genre_id)
    {
        $data['event_data'] = Event::getEventFromGenreId($genre_id);
        $data['event_data'] = Event::getGenreData($data['event_data']);
        $data['event_data']->genre = Genre::getGenreById($genre_id);

        return view('eventgenre', $data);
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
