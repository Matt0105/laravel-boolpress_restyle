<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
        /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user() {
        return $this->belongsTo("App\User");
    }

    public function category() {
        return $this->belongsTo("App\Model\Category");
    }

    public function tags() {
        return $this->belongsToMany("App\Model\Tag")->withTimestamps();
    }
    
}
