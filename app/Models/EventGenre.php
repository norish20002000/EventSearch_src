<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventGenre extends Model
{
    /**
     * teble name
     */
    protected $table = 'event_genre';

    /**
     * get event_id
     * @param int $genre_id
     * @return $eventIdList
     */
    public static function getEventId($genre_id)
    {
        $eventIdList = DB::table('event_genre')
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
        $genreIdList = DB::table('event_genre')
                    ->where('status', '=', 0)
                    ->where('event_id', '=', $event_id)
                    ->get();

        return $genreIdList;
    }

    /**
     * save genreMap
     * @param int $eventId
     */
    public static function saveGenreMap($eventId, $request)
    {
        $genreMap = new EventGenre();
        $genreMap->genre_id = $request->genre_id;
        $genreMap->event_id = $eventId;

        DB::beginTransaction();
        try {
            $result = $genreMap->save();
            DB::commit();

            return $result;
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    /**
     * update genreMap
     */
    public static function updateGenreMap($eventId, $request)
    {
        if($request->genre_map_id) {
            // update
            $genreMap = EventGenre::find($request->genre_map_id);
            $genreMap->event_id = $eventId;
            $genreMap->genre_id = $request->genre_id;
        } else {
            // insert
            $genreMap = new EventGenre();
            $genreMap->event_id = $eventId;
            $genreMap->genre_id = $request->genre_id;
        }
// var_dump($genreMap);exit;
        $result = DB::transaction(function () use ($genreMap) {
            $result = $genreMap->save();

            return $result;
        });

        return $result;
    }
}
