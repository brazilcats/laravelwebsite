<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStreet extends Model
{
    protected $fillable = ['name','zipcode'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
