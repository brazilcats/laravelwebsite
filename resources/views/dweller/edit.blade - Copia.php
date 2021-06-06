@extends('layouts.painel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Seja bem-vindo(a)</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dweller.update', ['dweller' => $end->id])  }}">
                        @csrf
                        @method("PUT")

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $end->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">Endereço</label>

                            <div class="col-md-6">
                                <select name="street" id="street" class="form-control @error('street') is-invalid @enderror">
                                    <option value="">Selecione um Endereço</option>
                                    <option value="Alameda dos Cravos" @if ($end->street  == 'Alameda dos Cravos') selected @endif>Alameda dos Cravos</option> 
                                    <option value="Alameda das Hortências" @if ($end->street == 'Alameda das Hortências') selected @endif>Alameda das Hortências</option>
                                    <option value="Alameda dos Lírios" @if ($end->street == 'Alameda dos Lírios') selected @endif>Alameda dos Lírios</option>
                                    <option value="Alameda das Margaridas" @if ($end->street == 'Alameda das Margaridas') selected @endif>Alameda das Margaridas</option>
                                    <option value="Alameda das Orquídeas" @if ($end->street == 'Alameda das Orquídeas') selected @endif>Alameda das Orquídeas</option>
                                    <option value="Alameda das Papoulas" @if ($end->street == 'Alameda das Papoulas') selected @endif>Alameda das Papoulas</option>
                                    <option value="Alameda das Rosas" @if ($end->street == 'Alameda das Rosas') selected @endif>Alameda das Rosas</option>
                                    <option value="Alameda das Sempre Vivas" @if ($end->street == 'Alameda das Sempre Vivas') selected @endif>Alameda das Sempre Vivas</option>
                               </select>

                                @error('street')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">Número</label>

                            <div class="col-md-6">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ $end->number }}">

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lot" class="col-md-4 col-form-label text-md-right">Lote</label>

                            <div class="col-md-6">
                                <input id="lot" type="text" class="form-control @error('lot') is-invalid @enderror" name="lot" value="{{ $end->lot }}">

                                @error('lot')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Celular 1</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ $end->phone }}" name="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mobile_phone" class="col-md-4 col-form-label text-md-right">Celular 2</label>

                            <div class="col-md-6">
                                <input id="mobile_phone" type="text" class="form-control @error('mobile_phone') is-invalid @enderror" value="{{ $end->mobile_phone }}" name="mobile_phone">

                                @error('mobile_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="obs" class="col-md-4 col-form-label text-md-right">Obs</label>

                            <div class="col-md-6">
                                <textarea id="obs" name="obs" rows="4" cols="50" class="form-control @error('obs') is-invalid @enderror">{{ $end->obs }}</textarea>

                                @error('obs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Atualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        let phone = new Inputmask('(99) 99999-9999');
        phone.mask(document.getElementById('phone'));

        let mobile_phone = new Inputmask('(99) 99999-9999');
        mobile_phone.mask(document.getElementById('mobile_phone'));

        let lot = new Inputmask('A{1}-9{2}');
        lot.mask(document.getElementById('lot'));

    </script>
@endsection
