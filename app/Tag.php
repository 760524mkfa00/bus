<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $fillable = [
        'tag'
    ];

    /**
     * Get the children attached to tag.
     */
    public function children()
    {
        return $this->belongsToMany('busRegistration\Child', 'children_tags');
    }

}
