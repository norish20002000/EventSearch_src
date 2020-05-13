<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    /**
     * event data by id
     * @param int $id
     * @return Event $eventdata
     */
    public static function getEventDataById($id)
    {
        $eventData = DB::table('events')->find($id)
                    ->paginate(config('app.PAGINATE.LINK_NUM'));;
        return $eventData;
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
            $eventData = DB::table('events')
                        ->where('status', 0)
                        ->paginate(config('app.PAGINATE.LINK_NUM'));
            // ->get();
            // $eventData = Event::where('status', 0)->get();
            // var_dump($eventData);exit;
        } else {
            $eventData = DB::table('events')
                            ->where([
                                ['status', 0],
                                ['title', 'like', '%'.$request->search.'%'],
                            ])
                            ->paginate(config('app.PAGINATE.LINK_NUM'));
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
                        ])
                        ->paginate(config('app.PAGINATE.LINK_NUM'));
        
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
                        ->paginate(config('app.PAGINATE.LINK_NUM'));

        return $eventData;
    }
}
