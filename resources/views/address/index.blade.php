@extends('layouts.painel')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Meus Endereços</h2>
        <a href="{{route('address.create')}}" class="btn btn-lg btn-success">Criar Endereço</a>
        <hr>
    </div>


    <div class="col-12">
        <ul class="navbar-nav mr-auto">
            <form action="{{route('product.find')}}" style="width:100%;" method="get">
            <div class="input-group">
            <input type="text" name="key" class="form-control ui-autocomplete-input" id="key" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="Pesquisar" autocomplete="off">
                <div class="input-group-append">
                <button class="btn btnsm" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </div>
            </div>					
            <hr>
            </form>
        </ul>
    </div>

    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse($userAddress as $key => $end)
            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="row">
                        <div class="col-8">                    
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                    Endereço nº: {{$end->street}}
                                </button>
                            </h2>
                        </div>    
                        <div class="col-4">                    
                            <div class="btn-group pull-right">
                                <a href="{{route('address.edit', ['address' => $end->id])}}" class="btn btn-sm btn-primary">EDITAR</a>
                                <form action="{{route('address.destroy', ['address' => $end->id])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                       </div>
                    </div>    
                </div>

                <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">

                        <div class="col-md-12 mb-5">
                            <ul class="list-group">
                                <li class="list-group-item">Endereço: {{ $end->street . ' ' . $end->number}}</li>
                                <li class="list-group-item">Complemento: {{ $end->complement}}</li>
                                <li class="list-group-item">Bairro: {{ $end->district}}</li>
                                <li class="list-group-item">CEP: {{ $end->postalcode}}</li>
                                <li class="list-group-item">Cidade/UF: {{ $end->city . ' ' . $end->state}}</li>
                            </ul>    
                        </div>
                
                    </div>
                </div>
            </div>
            @empty
                <div class="alert alert-warning">Nenhum endereço encontrado!</div>
            @endforelse
        </div>

        <div class="col-md-12 mx-auto" style="display:block;margin: 0 auto;text-align:center;overflow:hidden;">
            <hr>
            <h5>Registros: {{ $userAddress->lastItem() }} de {{ $userAddress->total() }}</h5>    
                <div id="paginator" style="margin: 0 auto; display: inline-flex;">
                {{ $userAddress->links("pagination::bootstrap-4") }}
                </div>
        </div>

    </div>
</div>
@endsection