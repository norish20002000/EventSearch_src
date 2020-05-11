<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    /**
     * コンストラクタ
     */
    public function __construct() {

    }

    /**
     * イベントデータ取得
     * @param request
     * @return eventData
     */
    public static function getEventData($request)
    {
        $eventData = "";

        // search event data
        if ($request->search === null) {
            $eventData = DB::table('events')->where('status', 0)->get();
            // $eventData = Event::where('status', 0)->get();
            // var_dump($eventData);exit;
        } else {
            $eventData = DB::table('events')
                            ->where([
                                ['status', 0],
                                ['title', 'like', '%'.$request->search.'%'],
                            ])->get();
        }

        return $eventData;
    }

    /**
     * event by date
     * @param Request $request
     * @param Date $day
     */
    public static function getEventByDate($request, $day)
    {
        $eventData = DB::table('events')
                        ->where([
                            ['st_date', '<=', $day],
                            ['end_date', '>=', $day]
                        ])->get();
        
        return $eventData;
    }

    /**
     * event by between days
     * @param Request $request
     * @param Date $s_date
     * @param Date $e_date
     */
    public static function getEventByDays($request, $s_day, $e_day) {
        $eventData = "";

        $eventData = DB::table('events')
                        ->where([
                            ['st_date', '<=', $s_day],
                            ['end_date', '>=', $s_day]
                        ])
                        ->orwhere([
                            ['st_date', '<=', $e_day],
                            ['end_date', '>=', $e_day]
                        ])
                        ->get();

        return $eventData;
    }
}
