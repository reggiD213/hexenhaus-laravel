<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    public function events()
    {
        return $this->belongsToMany('App\Event');
    }

    public function setHomepageAttribute($value)
    {
        if (preg_match("#https?://#", $value) === 0) {
            $value = 'http://' . $value;
        }

        $this->attributes['homepage'] = strtolower($value);
    }

    public function setSoundcloudAttribute($value)
    {
        if (is_numeric($value)) {
            $this->attributes['soundcloud'] = $value;
            return;
        }

        //removes everything behind "/users/"
        $firstCut = strstr($value, '/users/');
        $newstring = substr($firstCut, 7);

        //remove everything from '&' leaving only the number behind
        $newstring = strstr($newstring, '&', true);

        if ($newstring != 0) {
            $this->attributes['soundcloud'] = $newstring;
            return;
        }

        $this->attributes['soundcloud'] = '';
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

        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

        $this->attributes['slug'] = $count ? "{$slug}-{$count}" : $slug;
    }

    public function getImageAttribute($value)
    {
        if (!is_file('images/uploads/bands/' . $this->id . '/' . $value)) {
            return '../not-available.jpg';
        }
        return $value;

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
