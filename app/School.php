<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{

    protected $fillable = [
        'school'
    ];


    /**
     * Get the children school at time of registering.
     */
    public function childrenCurrent()
    {
        return $this->hasMany('busRegistration\Child', 'current_school_id');
    }


    /**
     * Get the children school they will be attending from september.
     */
    public function childrenNext()
    {
        return $this->hasMany('busRegistration\Child', 'next_school_id');
    }

}
