<?php

namespace busRegistration;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{

    protected $table = "Parents";

    protected $fillable = [
        'first_name', 'last_name', 'email', 'primary_phone',
        'secondary_phone', 'address', 'city', 'province', 'postal_code',
        'comments', 'accept_rules', 'accept_video', 'accept_email', 'year'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'accept_rules' => 'boolean',
        'accept_video' => 'boolean',
        'accept_email' => 'boolean',
    ];

    /**
     * Get the children for the parents.
     */
    public function children()
    {
        return $this->hasMany('busRegistration\Child');
    }

    /**
     * Get the notification for the parents.
     */
    public function notifications()
    {
        return $this->hasMany('busRegistration\Notification');
    }
}
