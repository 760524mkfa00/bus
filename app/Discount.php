<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{

    protected $fillable = [
        'discount'
    ];

    /**
     * Get the children attached to tag.
     */
    public function children()
    {
        return $this->hasMany('busRegistration\Child', 'discount_id');
    }

}
