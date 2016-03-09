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
		
<!-- 			<dt>Get a listing of all individuals in Art (academic department)</dt>
			<dd><a href="{{ url('api/departments/136/people') }}">{{ url('api/departments/136/people') }}</a></dd>

			<dt>Get a listing of all individuals in Computer Science (academic department)</dt>
			<dd><a href="{{ url('api/departments/189/people') }}">{{ url('api/departments/189/people') }}</a></dd>

			<dt>Get the Academic Technology Committee with its associated members</dt>
			<dd><a href="{{ url('api/committees/atc/people') }}">{{ url('api/committees/atc/people') }}</a></dd> -->

			<h2>Single Entity</h2>
			<dl>
				<dt>Retrieves information of a single entity</dt>
				<dd><a href="{{ url('members/email/steven.fitzgerald@csun.edu') }}">{{ url('members/email/steven.fitzgerald@csun.edu') }}</a></dd>	
				<!-- <dd><a href="{{ url('members/id/100010526') }}">{{ url('members/id/100010526') }}</a></dd>			 -->
			</dl>

			<h2>Members</h2>
			<dl>
				<dt>Retrieves the list of all members in an  academic departments</dt>
				<dd><a href="{{ url('academic-departments/189/members/full') }}">{{ url('academic-departments/189/members/full') }}</a></dd>	
				<dd><a href="{{ url('academic-departments/189/members/brief') }}">{{ url('academic-departments/189/members/brief') }}</a></dd>			
			</dl>

			<h2>Academic Departments</h2>
			<dl>
				<dt>Retrieves the list of all academic departments</dt>
				<dd><a href="{{ url('academic-departments') }}">{{ url('academic-departments') }}</a></dd>
				<dt>Retrieves a specific academic department</dt>
				<dd><a href="{{ url('academic-departments/189') }}">{{ url('academic-departments/189') }}</a></dd>
				<dt>Retrieves all the members of an academic department</dt>
				<dd><a href="{{ url('academic-departments/189/members/full') }}">{{ url('academic-departments/189/members/full') }}</a></dd>				
				<dd><a href="{{ url('academic-departments/189/members/brief') }}">{{ url('academic-departments/189/members/brief') }}</a></dd>
				<dt>Retrieves a specific person in a department by their email with their contact info</dt>
				<dd><a href="{{ url('academic-departments/189/member/steve@csun.edu') }}">{{ url('academic-departments/189/member/steve@csun.edu') }}</a></dd>
			</dl>
			<h2>Administrative Departments</h2>
			<dl>
				<dt>Retrieves all of the administrative departments</dt>
				<dd><a href="{{ url('administrative_departments') }}">{{ url('administrative_departments') }}</a></dd>
				<dt>Retrieves a specific administrative department</dt>
				<dd><a href="{{ url('administrative_departments/10132') }}">{{ url('administrative_departments/10132') }}</a></dd>
				<dt>Retrieves all members of an administrative department</dt>
				<dd><a href="{{ url('administrative_departments/10132/members') }}">{{ url('administrative_departments/10132/members') }}</a></dd>
				<dd><a href="{{ url('administrative_departments/') }}"></a></dd>

				<dt>Retrieves a specific member in a administrative department by id</dt>
				<dd><a href="{{ url('administrative_departments/10132/member/105957681') }}">{{ url('administrative_departments/10132/member/105957681') }}</a></dd>
			</dl>
			<h2>Colleges</h2>
			<dl>
				<dt>Retrieves the list of all the colleges along with the departments associated with their college.</dt>
				<dd><a href="{{ url('colleges') }}">{{ url('colleges') }}</a></dd>
				<dt>Retrieves the list of all the chairs of the colleges</dt>
				<dd><a href="{{ url('colleges/chairs') }}">{{ url('colleges/chairs') }}</a></dd>
				<dt>Retrieves a specific college with all the departments affiliated with that college</dt>
				<dd><a href="{{ url('colleges/52') }}">{{ url('colleges/52') }}</a></dd>
			</dl>
			<h2>Committees</h2>
			<dl>
				<dt></dt>
				<dd></dd>
			</dl>	
	</div>
</body>
</html>
