@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalhes de Cliente < <a href="/clients">Voltar</a></div>

                <div class="card-body">
                    @if(isset($client))
                        {{$client->name}} 
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="">
                          Dados Pessoais
                        </button>
                        <!-- Modal de edição -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="/incluir/clientsEdit" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{$client->name}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dados</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Contato</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Endereço</a>
                                            </li>
                                        </ul>
                                        <input type="hidden" name="id" value="{{$client->id}}">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><br>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Nome</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="name" id="name" value="{{$client->name}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Data Nascimento</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="dt_born" id="dt_born" value="{{$client->dt_born}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Nome da mãe</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="name_mother" id="name_mother" value="{{$client->name_mother}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Nome do pai</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="name_father" id="name_father" value="{{$client->name_father}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Sexo</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="sexo" id="sexo" value="{{$client->sexo}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Estado Civil</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="est_civil" id="est_civil" value="{{$client->est_civil}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Cpf</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="cpf" id="cpf" value="{{$client->cpf}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Rg</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="rg" id="rg" value="{{$client->rg}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">RNE</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="rne" id="rne" value="{{$client->rne}}">
                                                    </div>
                                                </div>  
                                            </div>

                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Fone</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="phone" id="phone" value="{{$client->phone}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-2">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="email" id="email" value="{{$client->email}}">
                                                    </div>
                                                </div>  

                                            </div>

                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"><br>
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Cep &nbsp<button class="btn btn-primary list-inline-item btn-sm" id="consultarCep" onclick="consultar()" type="button">Consultar</button></label>

                                                    
                                                    <div class="col-sm-7">
                                                        <input type="text" class="form-control" name="cep" id="cep" value="{{$client->cep}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Endereço</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="address" id="address" value="{{$client->address}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Número</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="number" id="number" value="{{$client->number}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Complemento</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="comple" id="comple" value="{{$client->comple}}">
                                                    </div>
                                                </div>  

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Bairro</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="neigh" id="neigh" value="{{$client->neigh}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Pais</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="country" id="country" value="{{$client->country}}">
                                                    </div>
                                                </div>  
                                                
                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Estado</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="uf" id="uf" value="{{$client->uf}}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="name" class="col-sm-4">Cidade</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="city" id="city" value="{{$client->city}}">
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>

                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Planos" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>
                        @if($isAtivo)
                            {{$plano_details->name}} <a href="/clients/estornarContrato/{{$planoC->id}}/{{$planoC->cliente_id}}" class="btn btn-outline-danger bt-sm">Estornar</a><br><hr>
                            Duracao do contrato <br><hr>
                            <label id="dt_inicio">{{$planoC->dt_inicio}}</label>
                            <label id="dt_fim">{{$planoC->dt_fim}}</label>
                            <!--<input type="text" name="dt_inicio" id="" value="{{$planoC->dt_inicio}}" disabled>
                            <input type="text" name="dt_fim" id="" value="{{$planoC->dt_fim}}" disabled>-->
                            <div class="progress">
                              <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                            Valor Total Plano: R$ {{$planoC->value_total}} <br><br>                            
                        @else
                            <a href="/clients/novoContrato/{{$client->id}}">Novo Contrato</a>
                        @endif
                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Histórico de Parcelas" class="form-control center" style="text-align:center; margin: 0 auto;">
                                <div id="parcelas_historico">
                                    @if(isset($parcelas))
                                        @foreach($parcelas as $p)
                                            Cod Parcela - {{$p->id}} - Cod Contrato {{$p->venda_id}} - R$ {{$p->value}} - 
                                            <span class="border border-1 border-danger rounded">{{$p->status}}</span><br>
                                        @endforeach
                                    @endif                  
                                </div>
                            </div>
                        </fieldset>
                    @endif
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
            $("#dt_born").mask('00/00/0000', {reverse: true});
            $("#cpf").mask('000.000.000-00', {reverse: true});
            $("#rg").mask('00.000.000-0', {reverse: true});
            $("#phone").mask('(00)0 0000-0000', {reverse: true});
            $("#cep").mask('00000-000', {reverse: true});
            
            //cod verificar diferenca de datas
            //var date1 = new Date("7/11/2010");
            //var date2 = new Date("12/12/2019");
            //var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            //var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
            //alert(diffDays);

            dt_inicio = $("#dt_inicio").html();
            dt_fim = $("#dt_fim").html();
            
            from1 = dt_inicio; 
            numbers1 = from1.match(/\d+/g); 
            date1 = new Date(numbers1[2], numbers1[1]-1,numbers1[0]);
            
            from2 = dt_fim; 
            numbers2 = from2.match(/\d+/g);
            date2 = new Date(numbers2[2], numbers2[1]-1, numbers2[0]);
            
            timeDiff = Math.abs(date2.getTime() - date1.getTime());
            diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
            
            alert(diffDays);

            today = new Date();
            alert(today);

        });

        function consultar(){

            cep = $('#cep').val();
            cep = cep.replace('-','');
            if(cep.length < 8) return false;
            if (cep != "" || cep.length >= 8) {
                $.getJSON("https://viacep.com.br/ws/"+cep+"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Atualiza os campos com os valores da consulta.
                    $("#address").val(dados.logradouro);
                    $("#compl").val(dados.complemento);
                    $("#neigh").val(dados.bairro);
                    $("#city").val(dados.localidade);
                    $("#country").val('Brasil');
                    $("#uf").val(dados.uf);
                }//end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        $("#cep").val('');
                        alert("CEP não encontrado.");
                    }
                });

            }else{
                alert('Cep em branco!');
            }
        }
    </script>
@endsection


