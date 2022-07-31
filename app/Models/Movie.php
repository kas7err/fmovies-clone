<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'imdb_id',
        'year',
        'type',
        'length',
        'plot',
        'rating',
        'rating_votes',
        'poster_url',
        'thumbnail_url',
        'trailer',
        'cast',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->title);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }

    /**
     * Scope a query to filter Movies
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filter)
    {
        if (Arr::exists($filter, 'genre'))
            $query->whereHas('genres', function ($query) use ($filter) {
                return $query->whereIn('genre_id', $filter['genre']);
            });

        if (Arr::exists($filter, 'type')) {
            $types = array_map(function ($type) {
                return $type === 'TV-Series' ? 'TV' : $type;
            }, $filter['type']);
            $query->whereIn('type', $types);
        }

        if (Arr::exists($filter, 'year')) {
            $decades = $this->getDecade($filter['year']);
            $query->whereIn('year', $filter['year']);
            if (count($decades) > 0) {
                foreach ($decades as $d) {
                    $query->orWhereBetween('year', [(int) $d, (int) $d + 9]);
                }
            }
        }

        if (Arr::exists($filter, 'sort')) {
            if ($filter['sort'] == 'default') {
                return $query;
            }
        }

        return $query->orderBy($filter['sort'], 'desc');
    }

    private function getDecade($years)
    {
        $data = [];
        foreach ($years as $year) {
            if (str_ends_with($year, 's')) $data[] = $year;
        }
        return $data;
    }
}
