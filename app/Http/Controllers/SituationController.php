<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SituationController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$userSituation = auth()->user()->situation()->paginate(5);

		return view('situation.index', compact('userSituation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('situation.create');
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
      
      $end = auth()->user()->situation()->create($data);

      flash('Situação criada com Sucesso!')->success();
      return redirect()->route('situation.index');

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
    public function edit($situation)
    {
		$end = auth()->user()->situation()->find($situation);

		return view('situation.edit', compact('end'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $situation)
    {
		$end = auth()->user()->situation()->find($situation);
		$data = $request->all();		

		$end->update($data);

    flash('Dados Atualizados com Sucesso')->success();
		return redirect()->route('situation.index');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($situation)
    {
      $end = auth()->user()->situation()->find($situation);
	    $end->delete();

	    flash('Situação Removida com Sucesso!')->success();
	    return redirect()->route('situation.index');
    }
}
