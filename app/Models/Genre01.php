<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre01 extends Model
{
    /**
     * teble name
     */
    protected $table = 'genre_01s';

    /**
     * get genre01
     */
    public static function getGenre01()
    {
        $genre01 = Genre01::where('status', 0)->get();

        return $genre01;
    }

    /**
     * events
     */
    public function events()
    {
        return $this->belongsToMany('App\Models\Event',
                                    'events',
                                    'genre_01_id',
                                    'event_id');
    }
}
