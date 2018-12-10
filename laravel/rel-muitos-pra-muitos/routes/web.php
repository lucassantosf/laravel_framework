<?php

use App\Projeto;
use App\Desenvolvedor;
use App\Alocacao;

Route::get('/desen_proj', function () {
    
	$devs = Desenvolvedor::with('projetos')->get();
	echo "<h1>Desenvolvedores</h1>";
	foreach ($devs as $d) {
		echo "<p>Nome:".$d->nome."</p>";
		echo "<p>Cargo:".$d->cargo."</p>";
		if(count($d->projetos) > 0){
			echo "Projetos: <br>";
			echo "<ul>";
				foreach ($d->projetos as $p) {
					echo "<li>";
						echo "Nome: ".$p->nome." | ";
						echo "Horas do projeto: ".$p->estimativa_horas;
						echo " | Hora trabalhadas: ".$p->pivot->horas_semanais;
					echo "</li>";
				}
			echo "</ul>";
		}
	}
});

Route::get('/proj_devs', function () {

	$projs = Projeto::with('desenvolvedores')->get();

	foreach ($projs as $proj) {
		echo "<p>Nome:".$proj->id.$proj->nome."</p>";
		echo "<p>Estimativa:".$proj->estimativa_horas."</p>";

		if(count($proj->desenvolvedores) > 0){
			echo "Desenvolvedores: <br>";
			echo "<ul>";
				foreach ($proj->desenvolvedores as $p) {
					echo "<li>";
						echo "Nome: ".$p->nome." | ";
						echo "Cargo: ".$p->cargo;
						echo " | Horas trabalhadas: ".$p->pivot->horas_semanais;
					echo "</li>";
				}
			echo "</ul>";
			echo "<hr>";
		}
	}
});

Route::get('/alocar', function(){
	$proj = Projeto::find(5);
	if(isset($proj)){
		//$proj->desenvolvedores()->attach(1, ['horas_semanais'=>50]);
		$proj->desenvolvedores()->attach([
			2 => ['horas_semanais' =>20],
			3 => ['horas_semanais' =>40],
		]);
	}
});

Route::get('/desalocar', function(){
	$proj = Projeto::find(1);
	if(isset($proj)){
		//$proj->desenvolvedores()->attach(1, ['horas_semanais'=>50]);
		$proj->desenvolvedores()->detach([2]);
	}
});
