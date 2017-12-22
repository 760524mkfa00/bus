<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['parent_id','order_number','school_year','paid_amount'];


    /**
     * Get the childs parent.
     */
    public function parent()
    {
        return $this->belongsTo('busRegistration\User', 'parent_id');
    }


    /**
     * Get the children for the parents.
     */
    public function children()
    {
        return $this->hasMany('busRegistration\Child', 'order_id', 'id');
    }

//    public function countChild()
//    {
//        return $this->children->count();
//    }

}
