<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{

    protected $fillable = [
        'parent_id', 'first_name', 'last_name', 'address', 'city', 'province', 'postal_code', 'current_school_id',
        'next_school_id', 'grade_id', 'medical_information', 'international', 'int_start_date', 'int_end_date',
        'paid', 'seat_assigned', 'processed', 'map_system_id', 'year'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'int_start_date', 'int_end_date'
    ];


    /**
     * Get the childs parent.
     */
    public function parent()
    {
        return $this->belongsTo('busRegistration\User', 'parent_id');
    }

    /**
     * Get the child's grade.
     */
    public function grade()
    {
        return $this->belongsTo('busRegistration\Grade');
    }

    /**
     * Get the child's school they currently attend.
     */
    public function currentSchool()
    {
        return $this->belongsTo('busRegistration\School', 'current_school_id');
    }

    /**
     * Get the child's school from september.
     */
    public function nextSchool()
    {
        return $this->belongsTo('busRegistration\School', 'next_school_id');
    }

    /**
     * Get the tags attached to child.
     */
    public function tags()
    {
        return $this->belongsToMany('busRegistration\Tag', 'children_tags');
    }



}
