@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">                
                <div class="card-header">Forma de Pagamento                    
                </div>
                
                <div class="card-body">
                    <form action="#" method="POST"> @csrf
                    <input type="checkbox" name="dinheiro">Dinheiro<br>
                    <input type="checkbox" name="cartao">Cartão de Crédito<br>
                    <input type="checkbox" name="cartaod">Cartão de Débito<br>
                    <input type="checkbox" name="cartao">Cheque<br>
                    <input type="checkbox" name="cartao">Transferencia<br>
                </div>
                <div class="card-footer"> 
                    <button type="submit" class="btn btn-sm btn-primary">Pagar</button>
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


