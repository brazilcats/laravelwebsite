<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOrder;

class OrdersController extends Controller
{
	private $order;

    public function __construct(UserOrder $order)
    {
    	$this->order = $order;
    }

    public function index()
    {
        $user = auth()->user();

    	if(!$user->orders()->exists()) {
            //flash('Você não tem nenhum pedido!')->warning();
            $orders = [];

	    } else {
            $orders = $user->store->orders()->paginate(15);
        }

        return view('admin.orders.index', compact('orders'));

    }
}
