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
    public static function getEventFromToday()
    {
        $eventIdList = EventDate::getEventIdListFromToday();
        // var_dump($eventIdList);exit;
        $eventData = DB::table('events')
                    ->whereIn('id', $eventIdList)
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
// var_dump($eventData);exit;
        $eventData = DB::table('events')
                    ->select('events.*')
                    ->leftJoin('event_dates', 'events.id', '=', 'event_dates.event_id')
                    ->where('event_dates.event_date', '>=', date("Y-m-d"))
                    ->groupBy(\DB::raw('events.id'))
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
        $eventData = self::getDays($eventData);

        return $eventData;
        ;
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
        $eventIdList = DB::table('event_dates')
                    ->where('event_date', '=', $day)
                    ->pluck('event_id');
        $eventData = DB::table('events')
                    ->whereIn('id', $eventIdList)
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
        
        $eventData = self::getDays($eventData);

        // foreach ($eventData as $event) {
        //     $event->date = EventDate::getDate($event->id);
        // }
        // $eventData = DB::table('events')
        //                 ->where([
        //                     ['st_date', '<=', $day],
        //                     ['end_date', '>=', $day]
        //                 ])
        //                 ->paginate(config('app.PAGINATE.LINK_NUM'));
        
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
                    ->where('event_date', '=', $s_day)
                    ->orWhere('event_date', '=', $e_day)
                    ->pluck('event_id');
        $eventData = DB::table('events')
                    ->whereIn('id', $eventIdList)
                    ->groupBy('id')
                    ->paginate(config('app.PAGINATE.LINK_NUM'));

        $eventData = self::getDays($eventData);

        // $eventData = DB::table('events')
        //                 ->where([
        //                     ['st_date', '<=', $s_day],
        //                     ['end_date', '>=', $s_day]
        //                 ])
        //                 ->orwhere([
        //                     ['st_date', '<=', $e_day],
        //                     ['end_date', '>=', $e_day]
        //                 ])
        //                 ->paginate(config('app.PAGINATE.LINK_NUM'));

        return $eventData;
    }

    /**
     * getEvent from genre
     * @param int $genre_id
     * @return data eventData
     */
    public static function getEventFromGenreId($genre_id)
    {
        // イベントid取得
        $eventIdList = GenreMap::getEventId($genre_id);
        // var_dump($eventIdList);exit;
        // $eventData = DB::table('events')
        //             ->whereIn('id', $eventIdList)
        //             ->get();
        // var_dump($eventData);exit;
        $eventIdListFromToday = DB::table('event_dates')
                            ->whereIn('event_id', $eventIdList)
                            ->where('event_date', '>=', date('Y-m-d'))
                            ->groupBy('event_id')
                            ->pluck('event_id');
                            // ->get();
        // var_dump($eventIdListFromToday);exit;
        $eventData = DB::table('events')
                    ->whereIn('id', $eventIdListFromToday)
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
