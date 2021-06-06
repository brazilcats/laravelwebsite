<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDweller extends Model
{
    protected $fillable = ['name', 'street', 'number', 'other_number', 'lot', 'status', 'phone', 'mobile_phone', 'obs'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function userstreet()
    {
    	return $this->hasOne(UserStreet::class, 'name', 'street');
    }

}
