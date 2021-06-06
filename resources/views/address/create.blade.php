@extends('layouts.painel')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Seja bem-vindo(a)</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('address.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="street" class="col-md-4 col-form-label text-md-right">Endereço</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control @error('street') is-invalid @enderror" name="street" value="{{old('street')}}" required autofocus>

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
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{old('number')}}" required>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="complement" class="col-md-4 col-form-label text-md-right">Complemento</label>

                            <div class="col-md-6">
                                <input id="complement" type="text" class="form-control @error('complement') is-invalid @enderror" name="complement" value="{{old('complement')}}" required>

                                @error('complement')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">Bairro</label>

                            <div class="col-md-6">
                                <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" value="{{old('district')}}" name="district" required>

                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="postalcode" class="col-md-4 col-form-label text-md-right">Cep</label>

                            <div class="col-md-6">
                                <input id="postalcode" type="text" class="form-control @error('postalcode') is-invalid @enderror" value="{{old('postalcode')}}" name="postalcode" required>

                                @error('postalcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">Estado</label>

                            <div class="col-md-6">
                                <select name="state" id="state" required class="form-control @error('state') is-invalid @enderror">
                                    <option value="">Informe o Estado</option>
                                    <option value="AC" @if (old('state') == 'AC') selected @endif>Acre</option>
                                    <option value="AL" @if (old('state') == 'AL') selected @endif>Alagoas</option>
                                    <option value="AM" @if (old('state') == 'AM') selected @endif>Amazonas</option>
                                    <option value="AP" @if (old('state') == 'AP') selected @endif>Amapá</option>
                                    <option value="BA" @if (old('state') == 'BA') selected @endif>Bahia</option>
                                    <option value="CE" @if (old('state') == 'CE') selected @endif>Ceará</option>
                                    <option value="DF" @if (old('state') == 'DF') selected @endif>Distrito Federal</option>
                                    <option value="ES" @if (old('state') == 'ES') selected @endif>Espirito Santo</option>
                                    <option value="GO" @if (old('state') == 'GO') selected @endif>Goiás</option>
                                    <option value="MA" @if (old('state') == 'MA') selected @endif>Maranhão</option>
                                    <option value="MG" @if (old('state') == 'MG') selected @endif>Minas Gerais</option>
                                    <option value="MS" @if (old('state') == 'MS') selected @endif>Mato Grosso do Sul</option>
                                    <option value="MT" @if (old('state') == 'MT') selected @endif>Mato Grosso</option>
                                    <option value="PA" @if (old('state') == 'PA') selected @endif>Pará</option>
                                    <option value="PB" @if (old('state') == 'PB') selected @endif>Paraíba</option>
                                    <option value="PE" @if (old('state') == 'PE') selected @endif>Pernambuco</option>
                                    <option value="PI" @if (old('state') == 'PI') selected @endif>Piauí</option>
                                    <option value="PR" @if (old('state') == 'PR') selected @endif>Paraná</option>
                                    <option value="RJ" @if (old('state') == 'RJ') selected @endif>Rio de Janeiro</option>
                                    <option value="RN" @if (old('state') == 'RN') selected @endif>Rio Grande do Norte</option>
                                    <option value="RO" @if (old('state') == 'RO') selected @endif>Rondonia</option>
                                    <option value="RR" @if (old('state') == 'RR') selected @endif>Roraima</option>
                                    <option value="RS" @if (old('state') == 'RS') selected @endif>Rio Grande do Sul</option>
                                    <option value="SC" @if (old('state') == 'SC') selected @endif>Santa Catarina</option>
                                    <option value="SE" @if (old('state') == 'SE') selected @endif>Sergipe</option>
                                    <option value="SP" @if (old('state') == 'SP') selected @endif>São Paulo</option>
                                    <option value="TO" @if (old('state') == 'TO') selected @endif>Tocantins</option>
                               </select>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">Cidade</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" value="{{old('city')}}" name="city">

                                @error('city')
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
        let postalcode = new Inputmask('99999999');
        postalcode.mask(document.getElementById('postalcode'));

    </script>
@endsection
