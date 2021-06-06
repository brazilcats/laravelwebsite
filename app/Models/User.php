<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    public function setBirthdayAttribute( $value ) {
        $this->attributes['birthday'] = date('Y-m-d', strtotime($value));
        //(new Carbon($value))->format('Y/m/d');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'role', 'cpf', 'areacode', 'phone', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function store()
    {
    	return $this->hasOne(Store::class);
    }

    public function orders()
    {
    	return $this->hasMany(UserOrder::class);
    }

    public function address()
    {
    	return $this->hasMany(UserAddress::class);
    }

    public function street()
    {
    	return $this->hasMany(UserStreet::class);
    }

    public function situation()
    {
    	return $this->hasMany(UserSituation::class);
    }

    public function dweller()
    {
    	return $this->hasMany(UserDweller::class);
    }

    public function routeNotificationForNexmo($notification)
    {
    	$storeMobilePhoneNumber = trim(str_replace(['(', ')', ' ', '-'], '', $this->store->mobile_phone));
    	return '55' . $storeMobilePhoneNumber;
    }
}