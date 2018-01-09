<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['parent_id','order_number','school_year','paid_amount',
        'reference_number', 'transaction_number', 'card_type', 'message','auth_code',
        'transaction_date', 'receipt_id', 'transaction_time', 'transaction_complete'];


    /**
     * Get the childs parent.
     */
    public function parent()
    {
        return $this->belongsTo('busRegistration\User');
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

    public function netAmount()
    {

        return $this->children->map( function ($item, $key) {
            return $item->amount - (($item->discount_amount / 100) * $item->amount);
        })->sum();

    }

}
