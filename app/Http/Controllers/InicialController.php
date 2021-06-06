<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserSituation;

class InicialController extends Controller
{
	private $product;

	public function __construct(Product $product)
	{
		$this->product = $product;
	}

    public function index()
	{	//->inRandomOrder()->
		
		//$products = $this->product->limit(6)->orderBy('id', 'DESC')->get();
    	$total = \App\Models\UserDweller::all()->count();
    	$products = $this->product->limit(6)->inRandomOrder()->get();
    	$stores   =  \App\Models\Store::limit(3)->inRandomOrder()->get();

	    return view('welcome', compact('products', 'stores', 'total'));
    }

	public function single($slug)
	{

		$product = $this->product->whereSlug($slug)->first();

		return view('single', compact('product'));
	}


    public function edit($id)
    {

		$user = auth()->user();

		return view('edit', compact('user'));

    }


    public function update(Request $request, $id)
    {

		$user = auth()->user();
		$data = $request->all();		
		$user->update($data);

    	flash('Dados Atualizados com Sucesso')->success();
		return view('edit', compact('user'));

    }

    public function listagem()
    {
    $userdweller = \App\Models\UserDweller::orderBy('name', 'ASC')->get();
    return view('dweller.list', compact('userdweller'));
    }

    public function datatable()
    {
    $userdweller = \App\Models\UserDweller::orderBy('name', 'ASC')->get();
    return view('dweller.datatable', compact('userdweller'));
    }

    public function find(Request $request)
    {

		$streets = \App\Models\UserStreet::orderBy('name', 'ASC')->get();
    $situations = \App\Models\UserSituation::orderBy('name', 'ASC')->get();

		$street = $request->input('street','');

		$chave = $request->input('key','');

		$query = \App\Models\UserDweller::where('id', '>', 0);

		$str = preg_split('/\s+/', $chave, -1, PREG_SPLIT_NO_EMPTY); 
    
    $type = $request->input('type','Exata');

    if ($request->query('key') ) {

          if ($type == 'Exata') {

            $type = 'Exata';
            $query->where(function($query) use ($chave,$street){ 
                $query->where('street', 'like', "%{$street}%")
                ->where('number', "{$chave}")
                ->orWhere('other_number', "{$chave}");
                //->orderBy('name', 'ASC');
            })->orderBy('name', 'ASC');

          } else {

            $type = 'Geral';
            $query->where(function ($q) use ($str) {
              foreach ($str as $value) {
                //$q->whereRaw('( street like "%{$value}%" and number = {$value} )')
                $q->where('street', 'like', "%{$value}%")
                ->orWhere('number', '=', "{$value}")
                ->orWhere('other_number', '=', "{$value}")
                ->orWhere('name', 'like', "%{$value}%")
                ->orWhere('lot', 'like', "%{$value}%")
                ->orWhere('phone', 'like', "%{$value}%")
                ->orWhere('mobile_phone', 'like', "%{$value}%")
                ->orWhere('obs', 'like', "%{$value}%");
                //->orderBy('name', 'ASC');
                //->whereRaw('( street like "%{$value}%" and number = {$value} )');
              }

            })->orderBy('name', 'ASC');
          }
    }

    //dd($str);

     //dd($query->toSql());

		$userdweller = $query->orderby('name', 'ASC')->paginate(10);

		return view('find', compact('userdweller','streets','chave','type','situations'));
  
  
    }

}
















