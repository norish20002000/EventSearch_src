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

}
