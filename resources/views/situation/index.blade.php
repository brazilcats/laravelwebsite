@extends('layouts.painel')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Situações</h2>
        <a href="{{route('situation.create')}}" class="btn btn-lg btn-success">Criar Situação</a>
        <hr>
    </div>


    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse($userSituation as $key => $end)
            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="row">
                        <div class="col-8">                    
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" aria-expanded="true">
                                    <div style="background: {{ $end->color }};width:10px;height:10px;display:inline-block;border-radius:50%;margin-right:10px;"></div>
                                    Situação: {{$end->name }} 
                                </button>
                            </h2>
                        </div>    
                        <div class="col-4">                    
                            <div class="btn-group pull-right">
                                <a href="{{route('situation.edit', ['situation' => $end->id])}}" class="btn btn-sm btn-primary">EDITAR</a>
                                <form action="{{route('situation.destroy', ['situation' => $end->id])}}" method="post">
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
                <div class="alert alert-warning">Nenhuma situação encontrada!</div>
            @endforelse
        </div>

        <div class="col-md-12 mx-auto" style="display:block;margin: 0 auto;text-align:center;overflow:hidden;">
            <hr>
            <h5>Registros: {{ $userSituation->lastItem() }} de {{ $userSituation->total() }}</h5>    
                <div id="paginator" style="margin: 0 auto; display: inline-flex;">
                {{ $userSituation->links("pagination::bootstrap-4") }}
                </div>
        </div>

    </div>
</div>
@endsection