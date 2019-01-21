@extends('layout_main.app',["current"=>"login"])

@section('body')

	<div class="row" id="rowLogin">
		<div class="col-md-10">

			<h2>Academia System - Área de Autenticação</h2>

		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalLogin">
			  Fazer login
			</button>
		</div>		

		<!-- Modal -->
		<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <div class="input-group input-group-sm mb-2">				  
				  <input type="text" class="form-control" placeholder="Email" name="email">
				  <input type="password" class="form-control" placeholder="Password" name="password">
				</div>
		        
		      </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-primary">Logar</button>
		      </div>

		    </div>
		  </div>		
		</div>
		<!-- End Modal -->

	</div>

@endsection

@section('jquery')
	<script type="text/javascript">
		
		

	</script>
@endsection
