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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>

    <div class="col-12">

        <h2>Datatable</h2>
        <p>Ordenação variavel</p>            

        <table id="tabela" class="table table-striped table-bordered" style="width:100%">
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
              <tfoot>
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
            </tfoot>
        </table>
     

    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
<script>
$(document).ready(function() {
    $('#tabela').DataTable();
} );
</script>
@endsection