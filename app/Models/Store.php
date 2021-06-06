<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\StoreReceiveNewOrder;
use App\Traits\Slug;

class Store extends Model
{
	use HasFactory, Slug;

	protected $fillable = ['name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function orders()
	{
		return $this->belongsToMany(UserOrder::class, 'order_store', null, 'order_id');
	}

	public function notifyStoreOwners(array $storesId = [])
	{
		$stores = $this->whereIn('id', $storesId)->get();

		$stores->map(function($store){
			return $store->user;
		})->each->notify(new StoreReceiveNewOrder());
	}
}
