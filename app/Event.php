<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['datetime', 'created_at', 'updated_at'];

    public function bands()
    {
        return $this->belongsToMany('App\Band');
    }

    public function gallery()
    {
        return $this->hasOne('App\Gallery');
    }

    public function printPrice()
    {
        return number_format($this->price, 2, ',', '.');
    }

    public function date()
    {
        return $this->datetime->toDateString();
    }

    public function time()
    {
        return $this->datetime->format('H:i');
    }

    public function printDate()
    {
        return $this->datetime->formatLocalized('%A, %d.%m.%Y');
    }

    public function printTime()
    {
        return $this->datetime->formatLocalized('%H:%M');
    }

    public function getImageAttribute($value)
    {
        if (!is_file('images/uploads/events/' . $this->id . '/' . $value)) {
            return '../not-available.jpg';
        }
        return $value;
    }

    public function thumbnail()
    {
        $image = $this->image;
        if ($image == '../not-available.jpg') {
            return $image;
        }

        $array = explode('_', $image, 2);
        return $array[0] . '_thumb_' . $array[1];

    }

    /**
     * Generate slug correctly
     *
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $slug = str_slug($value);

        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$' and id != '{$this->id}'")->count();
        $this->attributes['slug'] = $count ? "{$slug}-{$count}" : $slug;
    }

    public function scopeUpcomming($query)
    {
        return $query->where('datetime', '>', Carbon::today());
    }

    public function scopeBygone($query)
    {
        return $query->where('datetime', '<', Carbon::now());
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
