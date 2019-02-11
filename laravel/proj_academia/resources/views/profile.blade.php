@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detalhes de Cliente < <a href="/clients">Voltar</a></div>

                <div class="card-body">
                    @if(isset($client))
                        {{$client->name}}<br> 
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          Dados Pessoais
                        </button>
                        <!-- Modal de edição -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
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
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                Nome : {{$client->name}}<br>
                                                Data Nascimento : {{$client->dt_born}}<br>
                                                Nome da mãe : {{$client->name_mother}}<br>
                                                Nome do pai : {{$client->name_father}}<br>
                                                Sexo : {{$client->sexo}}<br>
                                                Estado Civil : {{$client->est_civil}}<br>
                                                Cpf : {{$client->cpf}}<br>
                                                Rg : {{$client->rg}}<br>
                                                RNE : {{$client->rne}}<br>
                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                Phone : {{$client->phone}}<br>
                                                Email : {{$client->email}}<br>
                                            </div>
                                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                Cep : {{$client->cep}}<br>
                                                Endereço : {{$client->address}}<br>
                                                Número : {{$client->number}}<br>
                                                Complemento : {{$client->comple}}<br>
                                                Bairro : {{$client->neigh}}<br>
                                                Pais : {{$client->country}}<br>
                                                Estado : {{$client->uf}}<br>
                                                Cidade : {{$client->city}}<br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Planos" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>
                        <fieldset disabled>
                            <div class="form-row">
                            <input placeholder="Histórico de Vendas" class="form-control center" style="text-align:center; margin: 0 auto;">
                            </div>
                        </fieldset><br>
                        <br> 
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
