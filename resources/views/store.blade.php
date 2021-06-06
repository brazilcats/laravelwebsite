@extends('layouts.front')


@section('content')
    <div class="row front">
        <div class="col-4">
            @if($store->logo)
                <img src="{{asset('public/storage/' . $store->logo)}}" alt="Logo da Loja {{$store->name}}" class="img-fluid">
            @else
                <img src="https://via.placeholder.com/450x100.png?text=logo" alt="Loja sem logo..." class="img-fluid">
            @endif
        </div>

        <div class="col-8">
            <h2>{{$store->name}}</h2>
            <p>{{$store->description}}</p>
            <p>
                <strong>Contatos:</strong>
                <span>{{$store->phone}}</span> | <span>{{$store->mobile_phone}}</span>
            </p>
        </div>

        <div class="col-12">
            <hr>
            <h3 style="margin-bottom: 30px;">Produtos desta loja</h3>
        </div>
        @forelse($products as $key => $product)
            <div class="col-md-4">
                <div class="card" style="width: 100%;">
                    @if($product->photos->count())
                        <img src="{{asset('public/storage/' . $product->photos->first()->image)}}" alt="" class="card-img-top">
                    @else
                        <img src="{{asset('public/assets/img/no-photo.jpg')}}" alt="" class="card-img-top">
                    @endif

                    <div class="card-body">
                        <h2 class="card-title">{{$product->name}}</h2>
                        <p class="card-text">
                            {{$product->description}}
                        </p>
                        <h3>
                            R$ {{number_format($product->price, '2', ',', '.')}}
                        </h3>
                        <a href="{{route('product.single', ['slug' => $product->slug])}}" class="btn btn-success">
                            Ver Produto
                        </a>
                    </div>
                </div>
            </div>
            @if(($key + 1) % 3 == 0) </div><div class="row front"> @endif
           @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Nenhum produto encontrado para esta loja!</h3>
            </div>
        @endforelse

        <div class="col-md-12 mx-auto" style="display:block;margin: 0 auto;text-align:center;overflow:hidden;">
            <hr>
            <h5>Registros: {{ $products->lastItem() }} de {{ $products->total() }}</h5>    
                <div id="paginator" style="margin: 0 auto; display: inline-flex;">
                {{ $products->links("pagination::bootstrap-4") }}
                </div>
        </div>
       
        <div class="col-md-12" style="display:block;width:100%;margin: 0 auto;overflow:hidden;">
            <hr>
            <h3 style="margin-bottom: 30px;">Localização</h3>
            <div id="mapa">                
                                                                                                                                                                                        
                <iframe style="width: 100%;border:0;height:300px;" src="{{$store->map}}" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

            </div>
        </div>

    </div>
@endsection
