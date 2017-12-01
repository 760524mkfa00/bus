<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    protected $fillable = [
        'grade'
    ];


    /**
     * Get the children in grades.
     */
    public function children()
    {
        return $this->hasMany('busRegistration\Child');
    }

}
