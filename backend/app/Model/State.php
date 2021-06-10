<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name'];

    public static function getStates($term = null) {
        return static::select('id', 'name')
            ->where("name","LIKE","%{$term}%")
            ->distinct()
            ->get();
    }
}
