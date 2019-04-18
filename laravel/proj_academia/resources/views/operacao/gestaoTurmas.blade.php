 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            	<div class="card-header">
          			Gestão de turmas
            	</div>
            	<div class="card-body">
            		<div class="form-group row" style="padding-bottom: 10px">
					    <label class="col-sm-2 col-form-label"></label>
					    <label class="col-sm-3 col-form-label">Modalidade</label>
					    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm">
						  	<option></option>
						  	<option>Modal 1</option>
						  	<option>Modal 2</option>
						</select>
					</div>            		
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label"></label>
					    <label class="col-sm-3 col-form-label">Turma</label>
					    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm">
						  	<option></option>
						  	<option>Turma 1</option>
						  	<option>Turma 2</option>
						</select>
					</div>
					<table class="table table-sm table-responsive-sm table-borderless table-striped table-hover" style="font-size: 5">
						<thead>
						    <tr> 
							    <th>Cod</th>
							    <th>Hora Inicio</th>
							    <th>Hora Fim</th>
							    <th>Ocupação</th>
							    <th>Dom</th>
							    <th>Seg</th>
							    <th>Ter</th>
							    <th>Qua</th>
							    <th>Qui</th>
							    <th>Sex</th>
							    <th>Sáb</th>
						    </tr>
						</thead>
						<tbody>
						    <tr>
							    <td><a onclick="openModal()">12</a></td>
							    <td>00:00</td>
							    <td>00:00</td>
							    <td>50%</td>
							    <td><a onclick="openModal()">2</a></td>
							    <td> </td>
							    <td> </td>
							    <td><a onclick="openModal()">1</a></td>
							    <td><a onclick="openModal()">3</a></td>
							    <td><a onclick="openModal()">4</a></td>
							    <td></td>
						    </tr>
						    <tr>
							    <td><a onclick="openModal()">51</a></td>
							    <td>00:00</td>
							    <td>00:00</td>
							    <td>50%</td>
							    <td><a onclick="openModal()">3</a></td>
							    <td> </td>
							    <td> </td>
							    <td><a onclick="openModal()">4</a></td>
							    <td><a onclick="openModal()">5</a></td>
							    <td><a onclick="openModal()">2</a></td>
							    <td></td>
						    </tr> 
					  	</tbody>
					</table>
            	</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalDetailsTurma" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes Turma ABC</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body">
		    	Aluno ABC<br> 
		    	Aluno ABC<br> 
		    </div>
	    </div>
	</div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {    
            console.log('Gestão de Turmas');
        });     

        function openModal(){ 
        	$('#modalDetailsTurma').modal();
        }
    </script>
@endsection