<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class EnderecoController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$userAddress = auth()->user()->address()->paginate(5);
return ('oi');
		//return view('user-address', compact('userAddress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
    public function edit($id)
    {
		$end = auth()->user()->address()->find($id);

		return view('endereco-edit', compact('end'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $end = auth()->user()->address()->find($id);
		$data = $request->all();		

		$end->update($data);

    	flash('Dados Atualizados com Sucesso')->success();
		return view('endereco-edit', compact('end'));

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
	    $product = $this->product->find($product);
	    $product->delete();

	    flash('Produto Removido com Sucesso!')->success();
	    return redirect()->route('admin.products.index');
    }
}
