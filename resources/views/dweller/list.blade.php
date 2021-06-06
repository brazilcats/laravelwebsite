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


    </style>

<div class="row">

    <div class="col-12">

        <h2>Listagem</h2>
        <p>Moradores ordenados por nome</p>            

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Rua</th>
              <th>Número</th>
              <th>Número2</th>
              <th>Lote</th>
              <th>Cep</th>
              <th>Celular1</th>
              <th>Celular2</th>
              <th>Obs</th>
            </tr>
          </thead>
          <tbody>
            @forelse($userdweller as $key => $end)
            <tr>
              <td>{{$end->name}}</td>
              <td>{{$end->street}}</td>
              <td>{{$end->number}}</td>
              <td>{{$end->other_number}}</td>
              <td>{{$end->lot}}</td>
              <td>@if (!empty($end->userstreet->zipcode)) {{ $end->userstreet->zipcode }} @endif</td>
              <td>{{ formatPhoneNumber($end->phone) }}</td>
              <td>{{ formatPhoneNumber($end->mobile_phone) }}</td>
              <td>{{ $end->obs }}</td>
            </tr>
            @empty
                <div class="alert alert-warning">Nenhum morador encontrado!</div>
            @endforelse
          </tbody>
        </table>
     

    </div>
</div>
@endsection

