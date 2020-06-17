<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

class EventDate extends Model
{    
    /**
     * event date取得
     * @param int $event_id
     * @return date $eventDate
     */
    public static function getDate($event_id)
    {
        $eventDate = EventDate::
                    where('event_id', $event_id)
                    ->where('status', '=', 0)
                    // ->where('event_date', '>=', date('Y-m-d'))
                    ->orderBy('event_date') 
                    ->get();

        return $eventDate;
    }

    /**
     * event date取得
     * @param int $event_id
     * @return date $eventDate
     */
    public static function getAllDate($event_id)
    {
        $eventDate = EventDate
                    ::where('event_id', $event_id)
                    ->where('status', '=', 0)
                    ->orderBy('event_date')
                    ->get();

        return $eventDate;
    }

    /**
     * eventId list from today
     */
    public static function getEventIdListFromToday() {
        $eventDate = Eventdate::
                    where('event_dates.status', '=', 0)
                    ->where('event_date', '>=', date('Y-m-d'))
                    ->orderBy('event_date')
                    ->pluck('event_id');

// var_dump(date('H:i:s'));exit;
// var_dump($eventDate);exit;

        $eventIdList = $eventDate->unique();
// var_dump($eventIdList);exit;
        return $eventIdList;
    }

    /**
     * eventId list from today by eventId
     */
    public static function getEventIdListById($eventIdList) {
        $eventData = EventDate::
                    where('event_dates.status', '=', 0)
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
     * get eventdate between
     */
    public static function getBetween($st_date, $end_date)
    {
        $eventDate = EventDate::
                    where('status', 0)
                    ->whereBetween('event_date', [$st_date, $end_date])
                    ->get();

        return $eventDate;
    }

    /**
     * update date
     */
    public static function updateEventDate($eventId, $date)
    {
        if($date['id']) {
            // update
            $eventDate = EventDate::find($date['id']);
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

    /**
     * events
     */
    public function events()
    {
        return $this->belongsTo('App\Models\Event', 'id');
    }

    /**
     * events with sort by st_time
     */
    public function eventsWithStTimeAcd()
    {
        return $this->belongsTo('App\Models\Event', 'id')
                    ->orderBy('st_time');

    }
}
