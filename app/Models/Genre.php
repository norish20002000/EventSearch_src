<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
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
}
