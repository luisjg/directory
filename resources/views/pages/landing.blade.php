<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Directory Web Service</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			color: #999;
			font-size:14px;
		}

		.welcome {
			position: absolute;
			left: 10px;
			top: 10px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			margin: 16px 0 0 0;
		}

		dl {width:600px;}
		dt {font-weight:bold;font-size:16px;margin-top:20px;}
		dd {margin:0;font-weight:normal;}
	</style>
</head>
<body>
	<div class="welcome">
		<h1>Directory Web Service</h1>

		<h2>Examples</h2>
		<dl>
			<dt>Get a listing of all individuals in Art (academic department)</dt>
			<dd><a href="{{ url('api/departments/136/people') }}">{{ url('api/departments/136/people') }}</a></dd>

			<dt>Get a listing of all individuals in Computer Science (academic department)</dt>
			<dd><a href="{{ url('api/departments/189/people') }}">{{ url('api/departments/189/people') }}</a></dd>

			<dt>Get the Academic Technology Committee with its associated members</dt>
			<dd><a href="{{ url('api/committees/atc/people') }}">{{ url('api/committees/atc/people') }}</a></dd>
			<br/>			
			For Nerces
			<dt>Retrieves the list of all the colleges along with the departments associated with their college.</dt>
			<dd><a href="{{ url('colleges') }}">{{ url('colleges') }}</a></dd>
			<dt>Retrieves the list of all academic departments</dt>
			<dd><a href="{{ url('academic_departments/189/members/brief') }}">{{ url('academic_departments/189/members/brief') }}</a></dd>
			<dd><a href="{{ url('academic_departments/189/members/full') }}">{{ url('academic_departments/189/members/full') }}</a></dd>
		</dl>
	</div>
</body>
</html>
