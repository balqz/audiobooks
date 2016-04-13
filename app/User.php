<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birth_date_at', 'phone_number',
        'gender', 'relationship_status', 'location'
    ];

    protected $table = "user";

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }

    public function audiobook()
    {
        return $this->belongsToMany('App\AudioBook', 'purchase', 'user_id', 'audiobook_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany('App\AudioBook', 'wishlist', 'user_id', 'audiobook_id');
    }

    public function review()
    {
        return $this->hasMany('App\Review');
    }

}
