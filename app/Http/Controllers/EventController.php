<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

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
        $data['event_data']->summary = substr($data['event_data']->detail, 0, 20);
        $weekList = ["日", "月", "火", "水", "木", "金", "土"];
        $data['event_data']->st_week = $weekList[date('w', strtotime($data['event_data']->st_date))];
        // var_dump($data['event_data']);exit;

        return View('event', $data);
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
