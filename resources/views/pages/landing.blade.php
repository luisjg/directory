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
				<dd><a href="{{ url('members/email/steven.fitzgerald@csun.edu') }}">{{ url('members/email/steven.fitzgerald@csun.edu') }}</a></dd>	
				<!-- <dd><a href="{{ url('members/id/100010526') }}">{{ url('members/id/100010526') }}</a></dd>			 -->
			</dl>

			<h2>Departments</h2>
			<dl>
				<dt>Retrieves the list of all departments</dt>
				<dd><a href="{{ url('departments') }}">{{ url('departments') }}</a></dd>
				<dt>Retrieves the list of all aadministrative departments</dt>
				<dd><a href="{{ url('departments/administrative') }}">{{ url('departments/administrative') }}</a></dd>
				<dt>Retrieves a specific department</dt>
				<dd><a href="{{ url('departments/189') }}">{{ url('departments/189') }}</a></dd>
				<dd><a href="{{ url('departments/10132') }}">{{ url('departments/10132') }}</a></dd>
				<dt>Retrieves all members of a specific department</dt>
				<dd><a href="{{ url('departments/189/members') }}">{{ url('departments/189/members') }}</a></dd>
				<dd><a href="{{ url('departments/10132/members') }}"> {{ url('departmens/10132/members') }}</a></dd>
			</dl>

			<h2>Colleges</h2>
			<dl>
				<dt>Retrieves the list of all the colleges along with the departments associated with their college.</dt>
				<dd><a href="{{ url('colleges') }}">{{ url('colleges') }}</a></dd>
				<dt>Retrieves the list of all the chairs of the colleges</dt>
				<dd><a href="{{ url('colleges/chairs') }}">{{ url('colleges/chairs') }}</a></dd>
				<dt>Retrieves a specific college with all the departments affiliated with that college</dt>
				<dd><a href="{{ url('colleges/52') }}">{{ url('colleges/52') }}</a></dd>
				<dt>Retrieves all chairs of specific college</dt>
				<dd><a href="{{ url('colleges/52/chairs') }}">{{ url('colleges/52/chairs') }}</a></dd>
			</dl>
			
			<h2>Committees</h2>
			<dl>
				<dt>Retrieves the list of all the committees</dt>
				<dd><a href="{{ url('committees') }}">{{ url('committees') }}</a></dd>
				<dt>Retrieves information of a specific committee</dt>
				<dd><a href="{{ url('committees/atc') }}">{{ url('committees/atc') }}</a></dd>
				<dt>Retrieves all members in a committee</dt>
				<dd><a href="{{ url('committees/aggab/members') }}">{{ url('committees/aggab/members') }}</a></dd>
				<dt>Retrieves a specific member in a committee</dt>
				<dd><a href="{{ url('committees/member/009630099') }}">{{ url('committees/member/009630099') }}</a></dd>
			</dl>	

			<h2>Centers</h2>
			<dl>
				<dt>Retrieves the list of all the centers</dt>
				<dd><a href="{{ url('centers') }}">{{ url('centers') }}</a></dd>
				<dt>Retrieves a specific center</dt>
				<dd><a href="{{ url('centers/viscom') }}">{{ url('centers/viscom') }}</a></dd>
				<dt>Retrieves the list of all members in a center</dt>
				<dd><a href="{{ url('centers/viscom/members') }}">{{ url('centers/viscom/members') }}</a></dd>
			</dl>

			<h2>Institutes</h2>
			<dl>
				<dt>Retrieves the list of all institutes</dt>
				<dd><a href="{{ url('institutes') }}">{{ url('institutes') }}</a></dd>
				<dt>Retrieves a specific institute</dt>
				<dd><a href="{{ url('institutes/ichwb') }}">{{ url('institutes/ichwb') }}</a></dd>
				<dt>Retrieves the list of members in an institute</dt>
				<dd><a href="{{ url('/institutes/ichwb/members') }}">{{ url('/institutes/ichwb/members') }}</a></dd>
			</dl>
	</div>
</body>
</html>
