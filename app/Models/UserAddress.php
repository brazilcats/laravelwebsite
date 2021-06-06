<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = ['street', 'number', 'complement', 'district', 'postalcode', 'city', 'state', 'country'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
