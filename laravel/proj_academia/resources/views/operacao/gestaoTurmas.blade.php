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
					    @if(isset($modalidades))
					    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm" id="selectModal">
						  		<option value="0">...</option> 
						  	@foreach($modalidades as $m)
						  		<option value="{{$m->id}}">{{$m->name}}</option> 
						  	@endforeach
						</select>
						@endif
					</div>            		
					<div class="form-group row">
					    <label class="col-sm-2 col-form-label"></label>
					    <label class="col-sm-3 col-form-label">Turma</label>
					    <select style="margin-top: 5px" class="col-sm-5 form-control form-control-sm" id="selectTurma"> 
						</select><!--
						<button class="btn btn-sm btn-info" style="text-align: center;" onclick="buscarItensTurma()">Consultar</button> -->
					</div>
					<table class="table table-sm table-responsive-sm table-borderless table-striped table-hover" style="font-size: 5" >
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
						<tbody id="table_details_turma">
							
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
			
			$("#selectModal").change(function() {
			  	buscarTurmaFromModalId();
			});
 			
 			$("#selectTurma").change(function() {
			  	buscarItensFromTurmaId();
			});
        });     

        function openModal(){ 
        	$('#modalDetailsTurma').modal();
        }

        function buscarTurmaFromModalId(){ 
			$("#selectTurma").html('');
			$("#table_details_turma").html('');  
			$("#selectTurma").append('<option></option>');
        	let modal_id = $('#selectModal').val(); 
        	$.getJSON("/home/turmas/gestaoturmasview/consultarTurmasFromModalId/"+modal_id, function(data){
			    $.each(data, function(i, field){
			      	$("#selectTurma").append('<option value="'+field.id+'">'+field.name+'</option'); 
			    });
			});
        }

        function buscarItensFromTurmaId(){
        	let semana = [0,1,2,3,4,5,6];
        	let turma_id = $('#selectTurma').val(); 
        	$.getJSON("/home/turmas/gestaoturmasview/consultarItensFromTurmaId/"+turma_id, function(data){
			    $("#table_details_turma").html('');  
			    $.each(data, function(i, field){
			    	 
			      	$("#table_details_turma").append(
			      		'<tr>'+
			      			'<td>'+field.id+'</td>'+  
			      			'<td>'+field.hora_inicio+'</td>'+  
			      			'<td>'+field.hora_fim+'</td>'+  
			      			'<td>0%</td>'+  
			      			'<td>'+getCapacidade(0,field.dia_semana,field.capacidade)+'</td>'+  
			      			'<td>'+getCapacidade(1,field.dia_semana,field.capacidade)+'</td>'+  
			      			'<td>'+getCapacidade(2,field.dia_semana,field.capacidade)+'</td>'+  
			      			'<td>'+getCapacidade(3,field.dia_semana,field.capacidade)+'</td>'+  
			      			'<td>'+getCapacidade(4,field.dia_semana,field.capacidade)+'</td>'+  
			      			'<td>'+getCapacidade(5,field.dia_semana,field.capacidade)+'</td>'+  
			      			'<td>'+getCapacidade(6,field.dia_semana,field.capacidade)+'</td>'+   
			      		'</tr>'
			      	); 
			    });
			});
        }

        function getCapacidade(dia_array,field,capacidade){
        	if (dia_array==field) {
        		return '<a onclick="openModal()">'+capacidade+'</a>';
        	}else{
        		return '';
        	} 
        }
    </script>
@endsection