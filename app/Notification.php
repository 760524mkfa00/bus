<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'parent_id', 'notification'
    ];


    /**
     * Get the tags attached to child.
     */
    public function parent()
    {
        return $this->belongsTo('busRegistration\User', 'parent_id');
    }
}
