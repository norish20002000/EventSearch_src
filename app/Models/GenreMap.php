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
        $genreIdList = DB::table('genre_maps')
                    ->where('status', '=', 0)
                    ->where('event_id', '=', $event_id)
                    ->get();

        return $genreIdList;
    }

    /**
     * get genre data
     */
    public static function getGenredata($event_id)
    {
        $genreMapList = GenreMap::where('status', '=', 0)
                    ->where('event_id', '=', $event_id)
                    ->get();
    }

    /**
     * save genreMap
     * @param int $eventId
     */
    public static function saveGenreMap($eventId, $request)
    {
        $genreMap = new GenreMap();
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
            $genreMap = GenreMap::find($request->genre_map_id);
            $genreMap->event_id = $eventId;
            $genreMap->genre_id = $request->genre_id;
        } else {
            // insert
            $genreMap = new GenreMap();
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
