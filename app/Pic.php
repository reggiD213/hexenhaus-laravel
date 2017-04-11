<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pic extends Model
{
    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function thumbnail()
    {
        $filename = $this->filename;
        if ($filename == '../not-available.jpg') {
            return $filename;
        }

        $array = explode('_', $filename, 2);
        return $array[0] . '_thumb_' . $array[1];

    }
}
