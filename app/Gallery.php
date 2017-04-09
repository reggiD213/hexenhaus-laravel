<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function pics()
    {
        return $this->hasMany('App\Pic');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
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
