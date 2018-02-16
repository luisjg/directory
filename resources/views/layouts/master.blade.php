<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Directory Web Service</title>
	<link rel="icon" type="image/x-icon" href="//www.csun.edu/sites/default/themes/csun/favicon.ico" type="image/x-icon">
	<!-- FONT LIBS -->
	<script type="text/javascript" src="//use.typekit.net/gfb2mjm.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic">
	<link rel="stylesheet" type="text/css" href="{!! url('css/metaphor.css') !!}">
	<link rel="stylesheet" type="text/css" href="{!! url('css/tomorrow.css.min') !!}">
</head>
<body>
	<div class="section section--sm">
	  <div class="container type--center">
	    <h1 class="giga type--thin">Directory Web Service</h1>
	    <h3 class="h1 type--thin type--gray">Delivering contact information about CSUN entities</h3>
	  </div>
	</div>
	<div class="section" id="menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-3" id="sidebar">
                        @include('partials.side-nav')
                    </div>
                    <div class="col-md-9" id="page">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
		 @include('partials.csun-footer')
		@include('partials.metalab-footer')
		<script type="text/javascript" src="{!! url('js/metaphor.js') !!}"></script>
		<script type="text/javascript" src="{!! url('js/run_prettify.js') !!}"></script>
</body>