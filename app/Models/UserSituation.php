<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSituation extends Model
{
    protected $fillable = ['name','color'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

}
