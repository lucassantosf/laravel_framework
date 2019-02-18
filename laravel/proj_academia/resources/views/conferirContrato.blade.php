@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Conferir Negociação do contrato</div>
                <form action="/cadastros/plans/postConferirNeg" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-row"> 
                        <label class="form-control center" for="id_cliente" style="text-align:center; margin: 0 auto;">Detalhes</label>
                    </div>
                    <table class="table table-borderles">
                      <tbody>
                        <tr>
                          <td>Plano</td>
                          <td>{{$plano_descricao}}</td> 
                        </tr>
                        <tr>
                          <td>Duracao</td>
                          <td>{{$duracao}}</td> 
                        </tr>
                        <tr>
                          <td>Valor do contrato</td>
                          <td>R$ {{$valor_contrato}} 
                          <input type="button" class="btn btn-primary btn-sm" id="add_desconto" value="+">
                          </td>
                        </tr>
                      </tbody> 
                    </table> 
                    <div class="form-row"> 
                        <label class="form-control center" for="id_cliente" style="text-align:center; margin: 0 auto;">Condição de Pagamento</label>
                    </div>         
                    <table class="table table-borderles">
                        <tr>
                          <td><input type="radio" value="1" name="condicao">1 Vez</td>
                          <td><input type="radio" value="2" name="condicao">2 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">3 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">4 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">5 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">6 Vezes</td> 
                        </tr>
                        <tr>
                          <td><input type="radio" value="1" name="condicao">7 Vez</td>
                          <td><input type="radio" value="2" name="condicao">8 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">9 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">10 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">11 Vezes</td> 
                          <td><input type="radio" value="2" name="condicao">12 Vezes</td> 
                        </tr>
                    </table> 

                     
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Fechar negociação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        
        $(document).ready(function() {    
             
        });
 
    </script>
@endsection