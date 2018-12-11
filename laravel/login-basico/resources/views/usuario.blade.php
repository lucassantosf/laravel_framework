
@auth
	<h4> Voce esta logado</h4>
    <p>{{Auth::user()->id}}</p>
    <p>{{Auth::user()->email}}</p>
    <p>{{Auth::user()->name}}</p>
@endauth

@guest
	<h4> Voce não esta logado</h4>
@endguest
