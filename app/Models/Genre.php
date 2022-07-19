<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'genre_movie');
    }

    // public static function findOrCreate($title)
    // {
    //     $obj = static::where('title', $title)->first();

    //     if (is_null($obj)) {
    //         $obj = $obj ?: new static;
    //         $obj->title = $title;
    //         $obj->save();
    //     }

    //     return $obj;
    // }
}
