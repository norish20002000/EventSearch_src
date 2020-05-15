<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventDate extends Model
{
    /**
     * event date取得
     * @param int $event_id
     * @return date $eventDate
     */
    public static function getDate($event_id)
    {
        $eventDate = DB::table('event_dates')
                    ->where('event_id', $event_id)
                    ->get();

        return $eventDate;
    }

    /**
     * eventId list from today
     */
    public static function getEventIdListFromToday() {
        $eventData = DB::table('event_dates')
                    ->where('status', '=', 0)
                    ->where('event_date', '>=', date('Y-m-d'))
                    ->orderBy('event_date')
                    ->pluck('event_id');
                    // ->get();
                    // var_dump($eventData->groupBy('event_id'));exit;

        $eventIdList = $eventData->unique();
// var_dump($eventIdList);exit;
        return $eventIdList;
    }

    /**
     * eventId list from today by eventId
     */
    public static function getEventIdListById($eventIdList) {
        $eventData = DB::table('event_dates')
                    ->where('status', '=', 0)
                    ->whereIn('event_id', $eventIdList)
                    ->where('event_date', '>=', date('Y-m-d'))
                    ->orderBy('event_date')
                    ->pluck('event_id');
        $eventIdList = $eventData->unique();
          
        return $eventIdList;
    }
}
