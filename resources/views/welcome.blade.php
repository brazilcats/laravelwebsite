@extends('layouts.front')

@section('content')

    <div class="jumbotron">
        <h1 class="display-4">Moradores On-line</h1>
        <p class="lead">Sejam bem-vindos ao nosso portal de moradores. (mais de {{ $total }} moradores)</p>
        <hr class="my-4">
        <p>Faça o seu cadastro de usuário e comece a cadastrar os moradores do seu condomínio.</p>
        <p class="lead">
        <a class="btn btn-success btn-lg" href="{{ route('login') }}" role="button">Login</a>
        <a class="btn btn-dark btn-lg" href="{{ route('consulta.find') }}" role="button">Consultar</a>
        <a class="btn btn-primary btn-lg" href="{{ route('listagem.dweller') }}" role="button">Listagem</a>
        <a class="btn btn-light btn-lg" href="{{ route('datatable.dweller') }}" role="button">Datatable</a>
        <a class="btn btn-danger btn-lg" href="{{ route('mapa.dweller') }}" role="button">Mapa</a>
        </p>
    </div>

    <div class="row front">
    @foreach ($products as $key => $product)
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card" style="width: 100%;">
                @if ($product->photos->count())
                <img src="{{ asset('public/storage/'. $product->thumb) }}" alt="" class="card-img-top">                    
                @else
                <img src="{{ asset('public/assets/img/no-photo.jpg')}}" alt="" class="card-img-top">                    
                @endif
                <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                    <p class="card-text">{{ $product->description }}</p>
                    <h3>
                        R$ {{number_format($product->price, '2', ',', '.')}}
                    </h3>


                    <div class="row">
                        <div class="col-6">
                        <a href="{{ route('product.single', ['slug' => $product->slug])  }}" class="btn btn-success custom-class">
                        Ver Produto
                        </a>
                        </div>

                        <div class="col-6">
                        <form id="{{$product->id}}" action="{{route('cart.add')}}" method="post">
                            @csrf
                            <input type="hidden" name="product[name]" value="{{$product->name}}">
                            <input type="hidden" name="product[price]" value="{{$product->price}}">
                            <input type="hidden" name="product[slug]" value="{{$product->slug}}">
                            <input type="hidden" name="product[amount]" value="1">
                            <button class="btn btn-danger float-right custom-class btnproduto"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Comprar</button>
                        </form>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    @if (($key + 1) % 3 == 0) </div><div class="row front"> @endif
    @endforeach
    </div>

@endsection
