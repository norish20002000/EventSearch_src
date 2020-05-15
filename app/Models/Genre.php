<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    public static function getGenreById($id)
    {
        $genreData = DB::table('genres')->find($id);
                
        return $genreData;
    }
}
