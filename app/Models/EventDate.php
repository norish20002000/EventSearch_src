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
                    ->where('status', '=', 0)
                    ->where('event_date', '>=', date('Y-m-d'))
                    ->orderBy('event_date')
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

    /**
     * event date register
     */
    public static function saveEventDate($eventId, $date)
    {
        $eventDate = new EventDate();
        $eventDate->event_id = $eventId;
        $eventDate->event_date = $date['event_date'];
        $eventDate->save();
    }

    /**
     * get eventDate all for update
     */
    public static function getEventDateAll($eventData)
    {
        $eventData->date = EventDate::where('status', '=', 0)
                    ->where('event_id', '=', $eventData->id)
                    ->orderBy('event_date')
                    ->get();

        return $eventData;
    }

    /**
     * update date
     */
    public static function updateEventDate($eventId, $date)
    {
        if($date['event_date_id']) {
            // update
            $eventDate = EventDate::find($date['event_date_id']);
            $eventDate->event_date = $date['event_date'];
        } else {
            // insert
            $eventDate = new EventDate();
            $eventDate->event_id = $eventId;
            $eventDate->event_date = $date['event_date'];
        }

        return $eventDate->save();
    }

    /**
     * delete by id
     */
    public static function deleteById($id)
    {
        $result = DB::transaction(function () use ($id) {
            EventDate::find($id)->delete();
        });

        return $result;
    }
}
