<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\GenreMap;

class Genre extends Model
{
    /**
     * hasmany geremap
     */
    public function genreMap()
    {
        return $this->hasMany('App\Models\GenreMap');
    }

    /**
     * get genre by id
     * @param int $id
     */
    public static function getGenreById($id)
    {
        $genreData = DB::table('genres')->find($id);
                
        return $genreData;
    }

    /**
     * get genre status ok
     */
    public static function getGenre()
    {
        $genreData = Genre::where('status', '=', 0)
                    ->get();

        return $genreData;
    }

    /**
     * get genre by event_id
     */
//     public static function getGenreByEventData($eventData)
//     {
//         try{
//             foreach ($eventData as $event) {
//                 $genreMap = GenreMap::getGenreId($event->id)->first();
//                 // if (isset($genreMap->genre_id)) {
//                 //     $eventData->genre = self::getGenreById($genreMap->genre_id);
//                 // } else {
//                 //     $eventData->genre = "";
//                 // }
//             }
//             var_dump($genreMap);
    
//         } catch (\Exception $e) {
//             var_dump($eventData);
//             var_dump($e->getMessage());
//             return FALSE;
//         }
// var_dump($eventData);exit;
//         return $eventData;
//     }

    /**
     * event
     */
    public function events()
    {
        return $this->belongsToMany('App\Models\Event',
                                    'event_genre',
                                    'genre_id',
                                    'event_id');
    }
}
