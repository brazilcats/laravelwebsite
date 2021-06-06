<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\DwellerRequest;
use App\Models\UserStreet;

class DwellerController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $userdweller = auth()->user()->dweller()->orderBy('name', 'ASC')->paginate(20);
    $streets = auth()->user()->street()->orderBy('name', 'ASC')->get();
    $situations = auth()->user()->situation()->orderBy('name', 'ASC')->get();
    $chave = '';
    $type = 'Exata';

		return view('dweller.index', compact('userdweller','streets','situations','chave','type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $userStreet = auth()->user()->street()->orderBy('name', 'ASC')->get();
      $userSituation = auth()->user()->situation()->orderBy('name', 'ASC')->get();

	    return view('dweller.create', compact('userStreet','userSituation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DwellerRequest $request)
    {
      $data = $request->all();
      
      $data['phone'] = $this->formatPhone($data['phone']);
      $data['mobile_phone'] = $this->formatPhone($data['mobile_phone']);

      $end = auth()->user()->dweller()->create($data);

      flash('Morador Criado com Sucesso!')->success();
      return redirect()->route('dweller.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show(Request $request, $id)
    {
    $streets = auth()->user()->street()->orderBy('name', 'ASC')->get();
    $situations = auth()->user()->situation()->orderBy('name', 'ASC')->get();

		$street = $request->input('street','');

		$chave = $request->input('key','');

		$query = auth()->user()->dweller()->where('id', '>', 0);

		$str = preg_split('/\s+/', $chave, -1, PREG_SPLIT_NO_EMPTY); 
    
    $type = $request->input('type','');

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

		$userdweller = $query->orderby('created_at', 'desc')->paginate(10);

		return view('dweller.index', compact('userdweller','streets','chave','type','situations'));
  
    }

    private function formatPhone($phone)
    {
      return str_replace(['-', '(', ')', ' '], ['', '', '', ''], $phone);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($dweller)
    {
		$end = auth()->user()->dweller()->find($dweller);

    $userStreet = auth()->user()->street()->orderBy('name', 'ASC')->get();
    $userSituation = auth()->user()->situation()->orderBy('name', 'ASC')->get();

		return view('dweller.edit', compact('end', 'userStreet', 'userSituation'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $dweller)
    {
		$end = auth()->user()->dweller()->find($dweller);
		$data = $request->all();		

    $data['phone'] = $this->formatPhone($data['phone']);
    $data['mobile_phone'] = $this->formatPhone($data['mobile_phone']);

		$end->update($data);

    flash('Dados Atualizados com Sucesso')->success();
    return redirect()->route('dweller.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($dweller)
    {
      $end = auth()->user()->dweller()->find($dweller);
	    $end->delete();

	    flash('Morador Removido com Sucesso!')->success();
	    return redirect()->route('dweller.index');
    }
}
