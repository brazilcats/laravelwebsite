<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class StreetController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$userStreet = auth()->user()->street()->paginate(5);

		return view('street.index', compact('userStreet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('street.create');
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
      
      $end = auth()->user()->street()->create($data);

      flash('Rua Criada com Sucesso!')->success();
      return redirect()->route('street.index');

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
    public function edit($street)
    {
		$end = auth()->user()->street()->find($street);

		return view('street.edit', compact('end'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $street)
    {
		$end = auth()->user()->street()->find($street);
		$data = $request->all();		

		$end->update($data);

    flash('Dados Atualizados com Sucesso')->success();
		return redirect()->route('street.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($street)
    {
      $end = auth()->user()->street()->find($street);
	    $end->delete();

	    flash('Rua Removida com Sucesso!')->success();
	    return redirect()->route('street.index');
    }
}
