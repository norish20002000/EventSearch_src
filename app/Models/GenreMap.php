<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GenreMap extends Model
{
    /**
     * belongto genre
     */
    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

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
     * get genre data by eventId
     */
    public function getGenreData($eventData)
    {
        foreach (GenreMap::where('event_id', '=', 11)->get() as $gm) {
            var_dump($gm->genre->id);
        }
        var_dump("end");exit;
        foreach ($eventData as $event) {
            $eventData->genre = self::getGenreId($eventData->id)->genre();

        }
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
