<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GenreMap extends Model
{
    /**
     * get event_id
     * @param int $genre_id
     * @return $eventIdList
     */
    public static function getEventId($genre_id)
    {
        $eventIdList = DB::table('genre_maps')
                        ->where('status', '=', 0)
                        ->where('genre_id', $genre_id)
                        // ->get();
                        ->pluck('event_id');

        return $eventIdList;
    }

    /**
     * get genre_id
     */
    public static function getGenreId($event_id)
    {
        $genreIdList = DB::table(genre_maps)
                    ->where('status', '=', 0)
                    ->where('event_id', '=', $event_id)
                    ->pluck('genre_id');

        return $genreIdList;
    }
}
