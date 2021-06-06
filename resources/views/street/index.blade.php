@extends('layouts.painel')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Minhas Ruas</h2>
        <a href="{{route('street.create')}}" class="btn btn-lg btn-success">Criar Rua</a>
        <hr>
    </div>


    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse($userStreet as $key => $end)
            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="row">
                        <div class="col-8">                    
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" aria-expanded="true">
                                    Rua: {{$end->name }} - {{$end->zipcode }}
                                </button>
                            </h2>
                        </div>    
                        <div class="col-4">                    
                            <div class="btn-group pull-right">
                                <a href="{{route('street.edit', ['street' => $end->id])}}" class="btn btn-sm btn-primary">EDITAR</a>
                                <form action="{{route('street.destroy', ['street' => $end->id])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </div>
                       </div>
                    </div>    
                </div>

            </div>
            @empty
                <div class="alert alert-warning">Nenhuma rua encontrada!</div>
            @endforelse
        </div>

        <div class="col-md-12 mx-auto" style="display:block;margin: 0 auto;text-align:center;overflow:hidden;">
            <hr>
            <h5>Registros: {{ $userStreet->lastItem() }} de {{ $userStreet->total() }}</h5>    
                <div id="paginator" style="margin: 0 auto; display: inline-flex;">
                {{ $userStreet->links("pagination::bootstrap-4") }}
                </div>
        </div>

    </div>
</div>
@endsection