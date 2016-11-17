<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Directory Web Service</title>
	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="icon" type="image/x-icon" href="favicon.ico" type="image/x-icon">
	<!-- FONT LIBS -->
	<script type="text/javascript" src="https://use.typekit.net/gfb2mjm.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic">
	<link rel="stylesheet" href="css/metaphor.css">
</head>
<body>
	<div class="section section--sm">
	  <div class="container type--center">
	    <h1 class="giga type--thin">Directory Web Service</h1>
	    <h3 class="h1 type--thin type--gray">Delivering contact information about CSUN entities</h3>
	  </div>
	</div>
		@yield('content')
		@include('partials.csun-footer')
		@include('partials.metalab-footer')
		<script type="text/javascript">
			try{Typekit.load({ async: true });}catch(e){}
		</script>
		<script type="text/javascript" src="{{ url('js/metaphor.js') }}"></script>
</body>