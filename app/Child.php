<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{

    protected $fillable = [
        'order_id', 'first_name', 'last_name', 'address', 'city', 'province', 'postal_code', 'current_school_id',
        'next_school_id', 'grade_id', 'medical_information', 'international', 'int_start_date', 'int_end_date',
        'paid', 'seat_assigned', 'processed', 'map_system_id', 'year', 'student_note', 'amount', 'discount_id',
        'discount_amount'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'int_start_date', 'int_end_date'
    ];


    /**
     * Get the childs parent.
     */
    public function order()
    {
        return $this->belongsTo('busRegistration\Order', 'order_id');
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
        return $this->belongsToMany('busRegistration\Tag', 'children_tags', 'children_id');
    }

    /**
     * Get the child's school from september.
     */
    public function discount()
    {
        return $this->belongsTo('busRegistration\Discount', 'discount_id');
    }

    /**
     * This section is the scopes for searching on the students index screen
     */

    public function scopeSearchSeat($query, $seat)
    {
        if ($seat) $query->where('seat_assigned', $seat);
    }

    public function scopeSearchPaid($query, $paid)
    {
        if ($paid) $query->where('paid', $paid);
    }

    public function scopeSearchSubsidy($query, $subsidy)
    {
        if ($subsidy) $query->where('subsidy', $subsidy);
    }

    public function scopeSearchInternational($query, $international)
    {
        if ($international) $query->where('international', $international);
    }

    public function scopeSearchProcessed($query, $processed)
    {
        if ($processed) $query->where('processed', $processed);
    }

    // Could be multiple tags
    public function scopeSearchTag($query, $tag)
    {
        if ($tag) $query->whereHas('tags',  function($query) use ($tag) {
            $query->where('id', '=', $tag);
        })->get();
    }

    public function scopeSearchCreated($query, $created)
    {

        if ($created) $query->whereDate('created_at', $created);

    }

    public function scopeSearchStudentName($query, $studentName)
    {
        if ($studentName) $query->where('first_name', 'like', "%{$studentName}%")
                                ->orWhere('last_name', 'like', "%{$studentName}%");
    }


    public function fullName()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function netAmount()
    {
        if($this->discount_amount > 0) {
            $discount = ($this->discount_amount / 100) * $this->amount;
            return round($this->amount - $discount, 2);
        }

        return $this->amount;
    }

    public function totalOutstanding()
    {
        return $this->netAmount() - ($this->paid ?? 0);
    }

    public function countMe()
    {
        return $this->count();
    }

}
