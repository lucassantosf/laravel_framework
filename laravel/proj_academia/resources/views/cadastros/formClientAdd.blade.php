@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Incluir clientes</div>

                <div class="card-body">
                    <form>
                        @csrf
                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Dados Pessoais" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name" class="form-control" > 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="dtNasc">Data de nascimento</label>
                                <input type="text" id="dtNasc" name="dtNasc" class="form-control" placeholder="00/00/0000"> 
                            </div>
                        </div>
 
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="nomeMae">Nome da mãe ou responsável</label>
                                <input type="text" id="nomeMae" name="nomeMae" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="nomePai">Nome do pai ou responsável</label>
                                <input type="text" id="nomePai" name="nomePai" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="sexo">Sexo</label>
                                <select class="custom-select" id="sexo" name="sexo">
                                    <option selected></option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select> 
                            </div>
                        </div>
                         
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="estado_civil">Estado civil</label>
                                <select class="custom-select" id="estado_civil" name="estado_civil">
                                    <option selected></option>
                                    <option value="M">Solteiro</option>
                                    <option value="F">Casado</option>
                                    <option value="F">Amasiado</option>
                                    <option value="F">Viuvo</option>
                                    <option value="F">Separado</option>
                                </select> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="000.000.000-00"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="rg">RG</label>
                                <input type="text" id="rg" name="rg" class="form-control" placeholder="00.000.000-0"> 
                            </div>
                        </div>                         

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="RNE">RNE</label>
                                <input type="text" id="rne" name="rne" class="form-control"> 
                            </div>
                        </div> 
                        
                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Contato" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>
                        
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="phone">Tel.</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="(00)0 0000-0000"> 
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"> 
                            </div>
                        </div> 

                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Endereço" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>

                        <div class="form-group row col-md-4">
                            <label for="cep">CEP</label>
                            <div class="form-group row">
                                <div class="col-md-9">
                                    <input type="text" id="cep" name="cep" class="form-control" placeholder="00000-000">
                                </div>
                                <div class="col-md-3">
                                    <a href="#" class="list-inline-item">Consultar</a>
                                </div>
                            </div>   
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="address">Endereço</label>
                                <input type="text" id="address" name="address" class="form-control"> 
                            </div>
                        </div> 

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="number">Número</label>
                                <input type="text" id="number" name="number" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="compl">Complemento</label>
                                <input type="text" id="compl" name="compl" class="form-control"> 
                            </div>
                        </div> 
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="neigh">Bairro</label>
                                <input type="text" id="neigh" name="neigh" class="form-control"> 
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="country">Pais</label>
                                <input type="text" id="country" name="country" class="form-control"> 
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="state">Estado</label>
                                <input type="text" id="state" name="state" class="form-control"> 
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="city">Cidade</label>
                                <input type="text" id="city" name="city" class="form-control"> 
                            </div>
                        </div>
   
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {    
            $("#dtNasc").mask('00/00/0000', {reverse: true});
            $("#cpf").mask('000.000.000-00', {reverse: true});
            $("#rg").mask('00.000.000-0', {reverse: true});
            $("#phone").mask('(00)0 0000-0000', {reverse: true});
            $("#cep").mask('00000-000', {reverse: true});
        });

    </script>
@endsection