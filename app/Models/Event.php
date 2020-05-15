<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\GenreMap;
use App\Models\EventDate;

class Event extends Model
{
    /**
     * 
     */
    public static function getEventFromToday($request)
    {
        $eventData = "";

        $eventIdList = EventDate::getEventIdListFromToday();
        $eventIdStr = implode(',', $eventIdList->toArray());
        // var_dump((count($eventIdList) > 1) ? $eventIdStr : $eventIdList);exit;

        if($request->search === null) {
            $eventData = DB::table('events')
                        ->where('status', '=', 0)
                        ->whereIn('id', $eventIdList)
                        ->orderByRaw("FIELD(id, $eventIdStr)")
                        ->paginate(config('app.PAGINATE.LINK_NUM'));
            // var_dump($eventData);exit;
            // $eventData = DB::table('events')
            //     ->select('events.*')
            //     ->leftJoin('event_dates', 'events.id', '=', 'event_dates.event_id')
            //     // ->whereIn('events.id', $eventIdList)
            //     // ->
            //     ->where('event_dates.event_date', '>=', date("Y-m-d"))
            //     ->groupBy(\DB::raw('events.id'))
            //     ->paginate(config('app.PAGINATE.LINK_NUM'));
        } else {
            $eventData = DB::table('events')
                        ->where('status', '=', 0)
                        ->whereIn('id', $eventIdList)
                        ->where('title', 'LIKE', '%'.$request->search.'%')
                        ->orderByRaw("FIELD(id, $eventIdStr)")
                        ->paginate(config('app.PAGINATE.LINK_NUM'));
        }
// var_dump($eventData);exit;
        $eventData = self::getDays($eventData);

        return $eventData;
    }

    /**
     * event data by id
     * @param int $id
     * @return Event $eventdata
     */
    public static function getEventDataById($id)
    {
        $eventData = DB::table('events')
                    ->find($id);
        $eventData->date = EventDate::getDate($id);

        return $eventData;
    }

    /**
     * event by date
     * @param Request $request
     * @param Date $day
     */
    public static function getEventByDate($request, $day)
    {
        $eventIdList = DB::table('event_dates')
                    ->where('status', '=', 0)
                    ->where('event_date', '=', $day)
                    ->pluck('event_id');
        $eventIdStr = implode(',', $eventIdList->toArray());
        $eventData = DB::table('events')
                    ->where('status', '=', 0)
                    ->whereIn('id', $eventIdList)
                    ->orderByRaw("FIELD(id, $eventIdStr)")
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
        
        $eventData = self::getDays($eventData);

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
        
        $eventIdList = DB::table('event_dates')
                    ->where('status', '=', 0)
                    ->where('event_date', '=', $s_day)
                    ->orWhere('event_date', '=', $e_day)
                    ->pluck('event_id');
        $eventIdList = $eventIdList->unique();
        $eventIdStr = implode(',', $eventIdList->toArray());
        $eventData = DB::table('events')
                    ->where('status', '=', 0)
                    ->whereIn('id', $eventIdList)
                    ->orderByRaw("FIELD(id, $eventIdStr)")
                    ->paginate(config('app.PAGINATE.LINK_NUM'));

        $eventData = self::getDays($eventData);

        return $eventData;
    }

    /**
     * getEvent from genre
     * @param int $genre_id
     * @return data eventData
     */
    public static function getEventFromGenreId($genre_id)
    {
        $eventData = "";

        // イベントid取得
        $eventIdListGenre = GenreMap::getEventId($genre_id);
        $eventIdList = EventDate::getEventIdListById($eventIdListGenre);
        $eventIdStr = implode(',', $eventIdList->toArray());
        // var_dump($eventIdListGenre);exit;
        // $eventData = DB::table('events')
        //             ->whereIn('id', $eventIdList)
        //             ->get();
        // var_dump($eventData);exit;
        // $eventIdListFromToday = DB::table('event_dates')
        //                     ->where('status', '=', 0)
        //                     ->whereIn('event_id', $eventIdList)
        //                     ->where('event_date', '>=', date('Y-m-d'))
        //                     ->groupBy('event_id')
        //                     ->pluck('event_id');
        //                     // ->get();
        // var_dump($eventIdListFromToday);exit;
        $eventData = DB::table('events')
                    ->where('status', '=', 0)
                    ->whereIn('id', $eventIdList)
                    ->orderByRaw("FIELD(id, $eventIdStr)")
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
        $eventData = self::getDays($eventData);
        // var_dump($eventData);exit;

        return $eventData;
    }

    /**
     * 
     */
    private static function getDays($eventData)
    {
        $resultEventData = $eventData;

        foreach ($resultEventData as $event) {
            $event->date = EventDate::getDate($event->id);
        }

        return $resultEventData;
    }
}
