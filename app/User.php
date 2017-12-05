<?php

namespace busRegistration;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package busRegistration
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'primary_phone',
        'secondary_phone', 'address', 'city', 'province', 'postal_code',
        'comments', 'accept_rules', 'accept_video', 'accept_email', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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

    public function setAcceptRulesAttribute($value)
    {
        $this->attributes['accept_rules'] = ($value === 'on') ? 1 : 0;
    }

    public function setAcceptVideoAttribute($value)
    {
        $this->attributes['accept_video'] = ($value === 'on') ? 1 : 0;
    }

    public function setAcceptEmailAttribute($value)
    {
        $this->attributes['accept_email'] = ($value === 'on') ? 1 : 0;
    }

    /**
     * Get the children for the parents.
     */
    public function children()
    {
        return $this->hasMany('busRegistration\Child', 'parent_id');
    }

    /**
     * Get the notification for the parents.
     */
    public function notifications()
    {
        return $this->hasMany('busRegistration\Notification', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }
    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    /**
     * Scope a query to only include active users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('active', '=', 'yes');
    }

    public function scopeParent($query)
    {
        return $query->where($this->roles()->name == 'parent');
    }

    public function fullName()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

}
