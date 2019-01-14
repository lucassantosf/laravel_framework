@auth
<!-- Quando esta logado -->
	<h4>Voce esta logado</h4>
    <h5>{{Auth::user()->name }}</h5>
    <h5>{{Auth::user()->email }}</h5>
    <h5>{{Auth::user()->id }}</h5>
@endauth

<!-- Quando não esta logado -->
@guest
	<h3>Você não esta logado</h3>
@endguest