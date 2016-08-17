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
		h2 {
			text-decoration: underline;
		}

		dl {width:600px;}
		dt {font-weight:bold;font-size:16px;margin-top:20px;}
		dd {margin:0;font-weight:normal;}
	</style>
</head>
<body>
	<div class="welcome">
		<h1>Directory Web Service</h1>

		<h1>EXAMPLES</h1>

			<h2>Single Entity</h2>
			<dl>
				<dt>Retrieves information of a single entity</dt>
				<dd><a href="{{ url('api/members/email/steven.fitzgerald@csun.edu') }}">{{ url('api/members/email/steven.fitzgerald@csun.edu') }}</a></dd>	
				{{-- <dd><a href="{{ url('members/id/100010526') }}">{{ url('members/id/100010526') }}</a></dd>			 --}}
			</dl>

			<h2>Departments</h2>
			<dl>
				<dt>Retrieves the list of all departments</dt>
				<dd><a href="{{ url('api/departments') }}">{{ url('api/departments') }}</a></dd>
				<dt>Retrieves the list of all aadministrative departments</dt>
				<dd><a href="{{ url('api/departments/administrative') }}">{{ url('api/departments/administrative') }}</a></dd>
				<dt>Retrieves a specific department</dt>
				<dd><a href="{{ url('api/departments/189') }}">{{ url('api/departments/189') }}</a></dd>
				<dd><a href="{{ url('api/departments/10132') }}">{{ url('api/departments/10132') }}</a></dd>
				<dt>Retrieves all members of a specific department</dt>
				<dd><a href="{{ url('api/departments/189/members') }}">{{ url('api/departments/189/members') }}</a></dd>
				<dd><a href="{{ url('api/departments/10132/members') }}"> {{ url('api/departmens/10132/members') }}</a></dd>
			</dl>

			<h2>Colleges</h2>
			<dl>
				<dt>Retrieves the list of all the colleges along with the departments associated with their college.</dt>
				<dd><a href="{{ url('api/colleges') }}">{{ url('api/colleges') }}</a></dd>
				<dt>Retrieves the list of all the chairs of the colleges</dt>
				<dd><a href="{{ url('api/colleges/chairs') }}">{{ url('api/colleges/chairs') }}</a></dd>
				<dt>Retrieves a specific college with all the departments affiliated with that college</dt>
				<dd><a href="{{ url('api/colleges/52') }}">{{ url('api/colleges/52') }}</a></dd>
				<dt>Retrieves all chairs of specific college</dt>
				<dd><a href="{{ url('api/colleges/52/chairs') }}">{{ url('api/colleges/52/chairs') }}</a></dd>
			</dl>
			
			<h2>Committees</h2>
			<dl>
				<dt>Retrieves the list of all the committees</dt>
				<dd><a href="{{ url('api/committees') }}">{{ url('api/committees') }}</a></dd>
				<dt>Retrieves information of a specific committee</dt>
				<dd><a href="{{ url('api/committees/atc') }}">{{ url('api/committees/atc') }}</a></dd>
				<dt>Retrieves all members iwn a committee</dt>
				<dd><a href="{{ url('api/committees/aggab/members') }}">{{ url('api/committees/aggab/members') }}</a></dd>
			</dl>	

			<h2>Centers</h2>
			<dl>
				<dt>Retrieves the list of all the centers</dt>
				<dd><a href="{{ url('api/centers') }}">{{ url('api/centers') }}</a></dd>
				<dt>Retrieves a specific center</dt>
				<dd><a href="{{ url('api/centers/viscom') }}">{{ url('api/centers/viscom') }}</a></dd>
				<dt>Retrieves the list of all members in a center</dt>
				<dd><a href="{{ url('api/centers/viscom/members') }}">{{ url('api/centers/viscom/members') }}</a></dd>
			</dl>

			<h2>Institutes</h2>
			<dl>
				<dt>Retrieves the list of all institutes</dt>
				<dd><a href="{{ url('api/institutes') }}">{{ url('api/institutes') }}</a></dd>
				<dt>Retrieves a specific institute</dt>
				<dd><a href="{{ url('api/institutes/ichwb') }}">{{ url('api/institutes/ichwb') }}</a></dd>
				<dt>Retrieves the list of members in an institute</dt>
				<dd><a href="{{ url('api/institutes/ichwb/members') }}">{{ url('api/institutes/ichwb/members') }}</a></dd>
			</dl>
	</div>
</body>
</html>
