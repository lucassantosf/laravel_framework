<?php

use App\Projeto;
use App\Desenvolvedor;
use App\Alocacao;

Route::get('/desenvolvedor_projeto', function () {
    
    $devs = Desenvolvedor::with('projetos2')->get();
    
    foreach ($devs as $d) {
    	echo "<p>Nome do Desenvolvedor:".$d->nome."</p>";
    	echo "<p>Cargo: ".$d->cargo."</p>";
    	if(count($d->projetos2) > 0){
    		echo "Projetos: <br>";
    		echo "<ul>";
    		foreach ($d->projetos2 as $p) {
    			echo "<li>";
    			echo "Nome :" . $p->nome ." | ";
    			echo "Horas do projeto: " . $p->estimativa_horas." | ";
    			echo "Horas trabalhadas: " . $p->pivot->horas_semanais;
    			echo "</li>";
    		}
    		echo "</ul>";
    	}
    	echo "<hr>";
    }
    
});

Route::get('/projeto_desenvolvedores', function () {
	
	$projetos = Projeto::with('desenvolvedores')->get();
	foreach ($projetos as $p) {
    	echo "<p>Nome do Projeto:".$p->nome."</p>";
    	echo "<p>Estimativa de horas: ".$p->estimativa_horas."</p>";
    	if(count($p->desenvolvedores) > 0){
    		echo "Desenvolvedores: <br>";
    		echo "<ul>";
    		foreach ($p->desenvolvedores as $d) {
    			echo "<li>";
    			echo "Nome :" . $d->nome ." | ";
    			echo "Cargo: " . $d->cargo." | ";
    			echo "Horas trabalhadas: " . $d->pivot->horas_semanais;
    			echo "</li>";
    		}
    		echo "</ul>";
    	}
    	echo "<hr>";
    }

});

Route::get('/alocar', function () {
	$proj = Projeto::find(5);
	if(isset($proj)){
		//$proj->desenvolvedores()->attach(1,['horas_semanais'=>50]); //somente um registro
		$proj->desenvolvedores()->attach([//varios registros
			2=>['horas_semanais'=>20],
			3=>['horas_semanais'=>40],
		]);
	}
});

//desfazer os relacionamentos
Route::get('/desalocar/{id_dev}/{id_proj}', function ($id_dev,$id_proj) {
	$proj = Projeto::find($id_dev);
	if(isset($proj)){
		$proj->desenvolvedores()->detach([$id_proj]);
	}
});
