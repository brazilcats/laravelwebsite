@extends('layouts.front')

@section('content')


<style>

    .pagination {
    display:block;
    white-space: nowrap;
    }

    #paginator {
    overflow-x: auto;
    overflow-y: hidden;
    }

    .page-item {
    display: inline-block;  
    }

    .callout1 {
  padding: 20px;
  border: 1px solid gray;
  border-left-width: 5px;
  border-top-width: 0px;
  }

  .callout2 {
  padding: 20px;
  border: 1px solid brown;
  border-left-width: 5px;
  border-top-width: 0px;
  }

  .callout3 {
  padding: 20px;
  border: 1px solid green;
  border-left-width: 5px;
  border-top-width: 0px;
  }

  .callout4 {
  padding: 20px;
  border: 1px solid red;
  border-left-width: 5px;
  border-top-width: 0px;
  }

    </style>

<div class="row">
 
    <div class="col-12">
        <ul class="navbar-nav mr-auto">
            <form action="{{route('consulta.find', '1')}}" style="width:100%;" method="get">

                <div class="input-group">
                    <select name="street" id="street" class="form-control">
                        @foreach($streets as $key => $street)
                        <option value="{{$street->name}}"> {{$street->name}}</option> 
                        @endforeach
                    </select>
                </div>        
  
                <div class="input-group">


                    <div class="form-check my-1 mx-1">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" value="Exata" @if($type == 'Exata') checked @endif name="type">Número
                        </label>
                      </div>
                      <div class="form-check my-1 mx-2">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" value="Geral" @if($type == 'Geral') checked @endif name="type">Geral
                        </label>
                      </div>


                    <input type="text" name="key" class="form-control ui-autocomplete-input" id="key" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="Pesquisar" autocomplete="off" autofocus>
                    <div class="input-group-append">
                    <button class="btn btnsm" type="submit"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                    </div>
                </div>	


                  <div style="text-align:right;">

                    @foreach($situations as $chavex => $sit)
                        <div style="background: {{$sit->color}};width:10px;height:10px;display:inline-block"></div> {{$sit->name}}
                    @endforeach

                  </div>



                <hr>
            </form>
        </ul>
    </div>

    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse($userdweller as $key => $end)
            <div class="card">
                <div class="card-header callout1" id="headingOne">
                    <div class="row">
                        <div class="col-8">                    
                            <h2 class="mb-0">
                                <button class="btn btn-link" style="white-space: nowrap;" type="button" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapseOne">

                                    @if ($end->status != null) 
                                    @foreach($situations as $chavex => $sit)
                                        @if ($end->status == $sit->id)
                                            <div style="background: {{$sit->color}};width:10px;height:10px;display:inline-block;border-radius:50%;margin-right:10px;"></div>
                                        @endif
                                    @endforeach
                                    @endif

                                    <span>{{$end->name}}</span>

                                </button>
                            </h2>
                        </div>    
                    </div>    
                </div>

                <div id="collapse{{$key}}" class="collapse @if($key == 0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">

                        <div class="col-md-12 mb-5">
                            <ul class="list-group">
                                <li class="list-group-item">Endereço: {{ $end->street . ' - ' . $end->number . ' / ' . $end->other_number}}</li>
                                <li class="list-group-item">Lote: {{ $end->lot}}</li>
                                <li class="list-group-item">Cep: @if (!empty($end->userstreet->zipcode)) {{ $end->userstreet->zipcode }} @endif</li>
                                <li class="list-group-item">Celular 1: {{ formatPhoneNumber($end->phone) }}</li>
                                <li class="list-group-item">Celular 2: {{ formatPhoneNumber($end->mobile_phone) }}</li>
                                <li class="list-group-item">Obs: {{ $end->obs }}</li>
                            </ul>    
                        </div>
                
                    </div>
                </div>
            </div>
            @empty
                <div class="alert alert-warning">Nenhum morador encontrado!</div>
            @endforelse
        </div>

        <div class="col-md-12 mx-auto" style="display:block;margin: 0 auto;text-align:center;overflow:hidden;">
            <hr>
            <h5>Registros: {{ $userdweller->lastItem() }} de {{ $userdweller->total() }}</h5>    
                <div id="paginator">
                {{ $userdweller->appends(array('key' => $chave))->links("pagination::bootstrap-4") }}
                </div>
        </div>


    </div>
</div>
@endsection

