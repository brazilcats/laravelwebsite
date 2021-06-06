<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class AddressController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$userAddress = auth()->user()->address()->paginate(5);

		return view('address.index', compact('userAddress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = $request->all();
      $data['country'] = 'Brasil';
      
      $end = auth()->user()->address()->create($data);

      flash('Endereço Criado com Sucesso!')->success();
      return redirect()->route('address.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($address)
    {
		$end = auth()->user()->address()->find($address);

		return view('address.edit', compact('end'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $address)
    {
		$end = auth()->user()->address()->find($address);
		$data = $request->all();		

		$end->update($data);

    flash('Dados Atualizados com Sucesso')->success();
		return view('address.edit', compact('end'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($address)
    {
      $end = auth()->user()->address()->find($address);
	    $end->delete();

	    flash('Endereço Removido com Sucesso!')->success();
	    return redirect()->route('address.index');
    }
}
