<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<title>
		App
	</title>
	<meta name="csrf-token" content="{{csrf_token()}}" charset="utf-8">
	<style type="text/css">
		body{
			padding: 20px;
		}
		.navbar{
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		@component('component_navbar',["current"=>$current])

		@endcomponent
		<div class="main">
			@hasSection('body')
				@yield('body')
			@endif
		</div>
	</div>

	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>