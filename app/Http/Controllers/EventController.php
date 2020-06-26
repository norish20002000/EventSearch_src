<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Genre;
use App\Libs\Utility;

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
        // return abort(404);
        $data['event_data'] = Event::getEventDataById($id);

        // no eventData OR private to 404 view
        if (!$data['event_data'] || $this->checkEventPrivate($data['event_data'])) {
            return \abort(404);
        }

        // end_time check for google calendar
        $data['event_data']->current_date->calendar_end_datetime = $this->createEndDatetime(
                                                                                        $data['event_data']->current_date->event_date
                                                                                        , $data['event_data']->current_date->st_time
                                                                                        , $data['event_data']->current_date->end_time);
        $data['event_data']->encode_title = urlencode($data['event_data']->title);

        // st-end date
        $data['event_data']->min_date = \min($data['event_data']->date->pluck('event_date')->toArray());
        $data['event_data']->max_date = \max($data['event_data']->date->pluck('event_date')->toArray());
        // 曜日変換
        $weekList = ["日", "月", "火", "水", "木", "金", "土"];
        $data['event_data']->min_date_week = $weekList[date('w', strtotime($data['event_data']->min_date))];
        $data['event_data']->max_date_week = $weekList[date('w', strtotime($data['event_data']->max_date))];


        // 概要作成
        $data['event_data']->summary = mb_substr($data['event_data']->introduction, 0, 150).". . .";

        // 曜日変換
        // $weekList = ["日", "月", "火", "水", "木", "金", "土"];
        // foreach ($data['event_data']->date as $event) {
        //     // var_dump($event);exit;
        //     $event->st_week = $weekList[date('w', strtotime($event->event_date))];
        // }

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
        $data['event_data'] = Event::getGenreData($data['event_data']);
        $data['event_data']->genre = Genre::getGenreById($genre_id);

        return view('eventgenre', $data);
    }

    /**
     * chedk event
     * @param eventData
     * @return bool isPublic
     */
    private function checkEventPrivate($eventData)
    {
        $isPrivate = false;

        if($eventData->release_date > date('Y-m-d')) {
            $isPrivate = true; 
        }

        if($eventData->status != 0) {
            $isPrivate = true;
        }

        return $isPrivate;
    }

    /**
     * create end datetime for calendar
     */
    private function createEndDatetime($date, $stTime, $endTime) 
    {
        if (!$endTime) {
            $datetime
                = date('Ymd\THis'
                        , strtotime('+1 hour'
                                    , strtotime($date . " " . $stTime)));
        } else {
            $datetime
                = new \DateTime($date . " " . $endTime);
            $datetime = $datetime->format('Ymd\THis');
        }

        return $datetime;
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
