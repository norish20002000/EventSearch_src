<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\EventDate;

class Event extends Model
{
    protected $fillable = [
        "title",
        "introduction",
        "st_time",
        "end_time",
        "summary_date",
        "web_name",
        "web_url",
        "fee_type",
        "fee_type",
        "image_url",
        "reference_name",
        "reference_name",
        "release_date",
        "regi_group_name",
        "regi_name",
        "regi_name",
        "regi_mail",
        "status",
    ];

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
            $eventData = Event::where('status', '=', 0)
                        ->whereIn('id', $eventIdList)
                        ->orderByRaw("FIELD(id, $eventIdStr)")
                        ->paginate(config('app.PAGINATE.LINK_NUM'));

            // $eventData = DB::table('events')
            //     ->select('events.*')
            //     ->leftJoin('event_dates', 'events.id', '=', 'event_dates.event_id')
            //     // ->whereIn('events.id', $eventIdList)
            //     // ->
            //     ->where('event_dates.event_date', '>=', date("Y-m-d"))
            //     ->groupBy(\DB::raw('events.id'))
            //     ->paginate(config('app.PAGINATE.LINK_NUM'));
        } else {
            $eventData = Event::where('status', '=', 0)
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
     * for ope
     */
    public static function getEventDataAllday($request, $status)
    {
        $eventData = Event::where('status', '=', $status)
                    ->orderBy('id', 'desc')
                    ->get();
        $eventData = self::getDaysAllday($eventData);

        return $eventData;
    }

    /**
     * event data by id
     * @param int $id
     * @return Event $eventdata
     */
    public static function getEventDataById($id)
    {
        $eventData = Event::find($id);
        $eventData->date = EventDate::getDate($id);

        return $eventData;
    }

    /**
     * 
     */
    public static function getEventDataByIdAllday($id)
    {
        $eventData = Event::find($id);
        $eventData = EventDate::getEventDateAll($eventData);

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

        if($request->search === null) {
            $eventData = Event::where('status', '=', 0)
                    ->whereIn('id', $eventIdList)
                    ->orderByRaw("FIELD(id, $eventIdStr)")
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
        } else {
            $eventData = Event::where('status', '=', 0)
                    ->whereIn('id', $eventIdList)
                    ->where('title', 'LIKE', '%'.$request->search.'%')
                    ->orderByRaw("FIELD(id, $eventIdStr)")
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
        }
        
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

        if($request->search === null) {
            $eventData = Event::where('status', '=', 0)
                        ->whereIn('id', $eventIdList)
                        ->orderByRaw("FIELD(id, $eventIdStr)")
                        ->paginate(config('app.PAGINATE.LINK_NUM'));
        } else {
            $eventData = Event::where('status', '=', 0)
                        ->whereIn('id', $eventIdList)
                        ->where('title', 'LIKE', '%'.$request->search.'%')
                        ->orderByRaw("FIELD(id, $eventIdStr)")
                        ->paginate(config('app.PAGINATE.LINK_NUM'));
        }

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
        $eventIdListGenre = EventGenre::getEventId($genre_id);
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
        // var_dump($eventIdStr);exit;
        $eventData = Event::where('status', '=', 0)
                    ->whereIn('id', $eventIdList)
                    ->orderByRaw("FIELD(id, $eventIdStr)")
                    ->paginate(config('app.PAGINATE.LINK_NUM'));
        $eventData = self::getDays($eventData);

        return $eventData;
    }

    /**
     * get genres
     */
    public static function getGenreData($eventData)
    {
        foreach ($eventData as $event) {
            $event->genre = $event->genres;
        }

        return $eventData;
    }

    /**
     * save event data
     * @param Request $request
     */
    public static function saveEventData($request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->introduction = $request->introduction;
        $event->st_time = $request->st_time;
        $event->end_time = $request->end_time;
        $event->summary_date = $request->summary_date;
        $event->web_name = $request->web_name;
        $event->web_url = $request->web_url;
        $event->fee_type = $request->fee_type; 
        $event->fee = $request->fee;
        $event->image_url = $request->image_url;
        $event->reference_name = $request->reference_name;
        $event->reference_url = $request->reference_url;
        $event->release_date = $request->release_date;
        $event->regi_group_name = $request->regi_group_name;
        $event->regi_name = $request->regi_name;
        $event->regi_tel = $request->regi_tel;
        $event->regi_mail = $request->regi_mail;
        $event->status = (int)$request->status;

        DB::transaction(function () use ($event, $request) {
            $event->save();

            foreach($request->date as $date) {
                if($date['event_date'] == null) continue;
                EventDate::saveEventDate($event->id, $date);
            }
        });

        return $event->id;
    }

    /**
     * update event
     */
    public static function updateEventData($request)
    {
        // $event = self::registerInstance($request);
        $event = Event::find($request->event_id);

        DB::transaction(function () use ($event, $request) {
            $resultEvent = $event->fill($request->all())->save();
            $cnt = 0;
            foreach($request->date as $date) {
                if($date['event_date'] == null) {
                    if($date['event_date_id']) {
                        $result = EventDate::deleteById($date['event_date_id']);
                    }
                } else {
                    $resutl = EventDate::updateEventDate($request->event_id, $date);
                }
            }
        });
    }

    /**
     * make instance
     */
    private static function registerInstance($request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->introduction = $request->introduction;
        $event->st_time = $request->st_time;
        $event->end_time = $request->end_time;
        $event->summary_date = $request->summary_date;
        $event->web_name = $request->web_name;
        $event->web_url = $request->web_url;
        $event->fee_type = $request->fee_type; 
        $event->fee = $request->fee;
        $event->image_url = $request->image_url;
        $event->reference_name = $request->reference_name;
        $event->reference_url = $request->reference_url;
        $event->release_date = $request->release_date;
        $event->regi_group_name = $request->regi_group_name;
        $event->regi_name = $request->regi_name;
        $event->regi_tel = $request->regi_tel;
        $event->regi_mail = $request->regi_mail;
        $event->status = (int)$request->status;

        return $event;
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

    /**
     * 
     */
    private static function getDaysAllday($eventData)
    {
        foreach($eventData as $event){
            $event = EventDate::getEventDateAll($event);
        }

        return $eventData;
    }

    /**
     * genre
     */
    public function genres()
    {
        return $this->belongsToMany('App\Models\Genre',
                                    'event_genre',
                                    'event_id',
                                    'genre_id');
    }
}
