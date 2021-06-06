@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Painel de Controle</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>Seja bem-vindo(a) ao nosso Painel de controle!</h5>
                    <p> Clique em Loja e crie sua loja para começar a trabalhar</p> 


                    <div class="row">

                        <div class="col-md-6 col-lg-4">
                            <a href="{{route('admin.stores.index')}}" class="servico-item mx-auto" style="color:#000;text-decoration: none;margin-bottom:10px;">
                                <div style="text-align:center;height:180px; width:100%; background: rgb(96,116,116); background: linear-gradient(0deg, rgba(96,116,116,1) 0%, rgba(255,255,255,1) 100%);">
                                <h4 style="padding: 10px 0">Loja</h4>
                                <i class="fa fa-globe" style="font-size: 4rem; margin: 10px auto;"></i>
                                </div>
                                <div class="btn btn-dark btn-sm btn-block">Entrar</div>
                            </a>
                        </div>
              
                        <div class="col-md-6 col-lg-4">
                            <a href="{{route('admin.products.index')}}" class="servico-item mx-auto" style="color:#000;text-decoration: none;margin-bottom:10px;">
                                <div style="text-align:center;height:180px; width:100%; background: rgb(96,116,116); background: linear-gradient(0deg, rgba(96,116,116,1) 0%, rgba(255,255,255,1) 100%);">
                                <h4 style="padding: 10px 0">Produtos</h4>
                                <i class="fa fa-shopping-cart" style="font-size: 4rem; margin: 10px auto;"></i>
                                </div>
                                <div class="btn btn-dark btn-sm btn-block">Entrar</div>
                            </a>
                        </div>
              
                        <div class="col-md-6 col-lg-4">
                            <a href="{{route('admin.categories.index')}}" class="servico-item mx-auto" style="color:#000;text-decoration: none;margin-bottom:10px;">
                                <div style="text-align:center;height:180px; width:100%; background: rgb(69,73,79); background: rgb(96,116,116); background: linear-gradient(0deg, rgba(96,116,116,1) 0%, rgba(255,255,255,1) 100%);">
                                <h4 style="padding: 10px 0">Categorias</h4>
                                <i class="fa fa-home" style="font-size: 4rem; margin: 10px auto;"></i>
                                </div>
                                <div class="btn btn-dark btn-sm btn-block">Entrar</div>
                            </a>
                        </div>
              
              
                       </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
