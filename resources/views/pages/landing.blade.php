@extends('layouts.master')
@section('content')
<div class="section" id="menu">
	<div class="container">
		<div class="row">
	      <div class="col-sm-3">
	          <p class="header--sm"><strong>DOCUMENTATION</strong></p>
	          <ul class="nav">
	            <li class="nav__item"><a class="nav__link" href="#introduction">Introduction</a></li>
	            <li class="nav__item"><a class="nav__link" href="#getting-started">Getting Started</a></li>
	            <li class="nav__item"><a class="nav__link" href="#collections">Collections</a></li>
	            <li class="nav__item"><a class="nav__link" href="#subcollections">Subcollections</a></li>
	            <li class="nav__item"><a class="nav__link" href="#instances">Instances</a></li>
	            <li class="nav__item"><a class="nav__link" href="#query">Query</a></li>
	          </ul>
	      </div>

	      <div class="col-sm-9">
	      	<h2 id="introduction" class="type--header type--thin">Introduction</h2>
	      	The Directory web service provides contact information about CSUN entities. The web service provides a gateway to access the information via a REST-ful API. The information is retrieved by creating a specific URI and giving values to filter the data. The data is provided by CSUN Central IT. The information that is returned is a JSON object that contains contact information about a particular person, center, college, department, etc; the format of the JSON object is as follows:</p>
	      	<pre><code>
{
  "status": "200",
  "success": "true",
  "type": "department",
  "department": {
    "department_id": "academic_departments:189",
    "college_id": "academic_groups:52",
    "entity_type": "Academic Department",
    "name": "Computer Science",
    "description": "Welcome to the fascinating world of Computer Science, boys and girls.",
    "record_status": "Active",
    "contacts": [
      {
        "contact_id": 6247,
        "entities_id": "academic_departments:189",
        "parent_entities_id": "academic_groups:52",
        "role_position": "department",
        "precedence": 0,
        "is_displayed": 1,
        "title": "Computer Science",
        "email": "compsci@csun.edu",
        "telephone": "8186773398",
        "facsimile_telephone": "8186777208",
        "website": "http://www.csun.edu/engineering-computer-science/computer-science",
        "location": "Jacaranda Hall",
        "office": "JD 4503",
        "mail_drop": "91330-8281"
      }
    ]
  }
}	      	
			</code></pre>
	      	<h2 id="getting-started" class="type--header type--thin">Getting Started</h2>
			<ol>
				<li><strong>GENERATE THE URI:</strong> Find the usage that fits your need. Browse through subcollections, instances and query types to help you craft your URI.</li>
				<li><strong>PROVIDE THE DATA:</strong> Use the URI to query your data. See the Usage Example section.</li>
				<li><strong>SHOW THE RESULTS</strong></li>
			</ol>
	      	<h2 id="collections" class="type--header type--thin">Collections</h2>
			<h3 class="type--thin">Examples</h3>
			<strong>Retrieves information of a single entity</strong>
			<ul class="list">
				<li class="list__item"><a href="{{ url('api/members/steven.fitzgerald@csun.edu') }}">{{ url('api/members/steven.fitzgerald@csun.edu') }}</a></li>
			</ul>
			<strong>Retrieves information of departments</strong>
			<ul class="list">
				<li class="list__item"><a href="{{ url('api/departments') }}">{{ url('api/departments') }}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/administrative') }}">{{ url('api/departments/administrative') }}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/189') }}">{{ url('api/departments/189') }}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/10132') }}">{{ url('api/departments/10132') }}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/189/members') }}">{{ url('api/departments/189/members') }}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/10132/members') }}"> {{ url('api/departmens/10132/members') }}</a></li>
			</ul>
			<strong>Retrieves information of Colleges</strong>
			<ul class="list">
				<li class="list__item"><a href="{{ url('api/colleges') }}">{{ url('api/colleges') }}</a></li>
				<li class="list__item"><a href="{{ url('api/colleges/chairs') }}">{{ url('api/colleges/chairs') }}</a></li>
				<li class="list__item"><a href="{{ url('api/colleges/52') }}">{{ url('api/colleges/52') }}</a></li>
				<li class="list__item"><a href="{{ url('api/colleges/52/chairs') }}">{{ url('api/colleges/52/chairs') }}</a></li>
			</ul>
			<strong>Retrieves information about Committees</strong>
			<ul class="list">
				<li class="list__item"><a href="{{ url('api/committees') }}">{{ url('api/committees') }}</a></li>
				<li class="list__item"><a href="{{ url('api/committees/atc') }}">{{ url('api/committees/atc') }}</a></li>
				<li class="list__item"><a href="{{ url('api/committees/aggab/members') }}">{{ url('api/committees/aggab/members') }}</a></li>
			</ul>
			<strong>Retrieves information about Centers</strong>
			<ul class="list">
				<li class="list__item"><a href="{{ url('api/centers') }}">{{ url('api/centers') }}</a></li>
				<li class="list__item"><a href="{{ url('api/centers/viscom') }}">{{ url('api/centers/viscom') }}</a></li>
				<li class="list__item"><a href="{{ url('api/centers/viscom/members') }}">{{ url('api/centers/viscom/members') }}</a></li>
			</ul>
			<strong>Retrieves information about Institutes</strong>
			<ul class="list">
				<li class="list__item"><a href="{{ url('api/institutes') }}">{{ url('api/institutes') }}</a></li>
				<li class="list__item"><a href="{{ url('api/institutes/ichwb') }}">{{ url('api/institutes/ichwb') }}</a></li>
				<li class="list__item"><a href="{{ url('api/institutes/ichwb/members') }}">{{ url('api/institutes/ichwb/members') }}</a></li>
			</ul>
	      	<h2 id="subcollections" class="type--header type--thin">Subcollections</h2>
			<h3 class="type--thin">Examples</h3>
			<strong>Retrieves information of a single entity</strong><br />
			<ul class="list">
				<li class="list__item">
					<a href="{{ url('api/members?email=steven.fitzgerald@csun.edu') }}">{{ url('api/members?email=steven.fitzgerald@csun.edu') }}</a>
				</li>
			</ul>
	      	<h2 id="instances" class="type--header type--thin">Instances</h2>
	      	<h2 id="query" class="type--header type--thin">Query</h2>
	      </div>
		</div>
	</div>
</div>
@stop
