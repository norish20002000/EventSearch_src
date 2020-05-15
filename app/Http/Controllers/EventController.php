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
        $data['event_data']->summary = substr($data['event_data']->introduction, 0, 20);
        
        // 曜日変換
        $weekList = ["日", "月", "火", "水", "木", "金", "土"];
        foreach ($data['event_data']->date as $event) {
            // var_dump($event);exit;
            $event->st_week = $weekList[date('w', strtotime($event->event_date))];
        }
        // var_dump($data['event_data']);exit;

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
        $data['event_data']->genre = Genre::getGenreById($genre_id);

        // var_dump($data['event_data']->genre);exit;

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
