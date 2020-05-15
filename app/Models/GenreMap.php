<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GenreMap extends Model
{
    public static function getEventId($genre_id)
    {
        $eventIdList = DB::table('genre_maps')
                        ->where('status', '=', 0)
                        ->where('genre_id', $genre_id)
                        // ->get();
                        ->pluck('event_id');

        return $eventIdList;
    }
}
