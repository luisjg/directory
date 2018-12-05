@extends('layouts.master')

@section('title')
	Documentation
@endsection

@section('description')
	{{ env('APP_NAME') }} Web Service Documentation
@endsection

@section('content')
	<h2 id="introduction">Introduction</h2>
	<p>The {{ env('APP_NAME') }} web service provides contact information about CSUN entities. The web service provides a
	gateway to access the information via a REST-ful API. The information is retrieved by creating a specific URI and
	giving values to filter the data. The data is provided by CSUN Central IT. The information that is returned is a
	JSON object that contains contact information about a particular person, center, college, department, etc; the
	format of the JSON object is as follows:</p>
	<pre class="prettyprint">
		<code>
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
		</code>
	</pre>
	<h2 id="getting-started">Getting Started</h2>
	<ol>
		<li><strong>GENERATE THE URI:</strong> Find the usage that fits your need. Browse through subcollections, instances and query types to help you craft your URI.</li>
		<li><strong>PROVIDE THE DATA:</strong> Use the URI to query your data. See the Usage Example section.</li>
		<li><strong>SHOW THE RESULTS</strong></li>
	</ol>
	<h2 id="collections">Collections</h2>
	<h3>Examples</h3>
	<strong>Retrieves information of a single entity</strong> (phasing out soon)
	<ul>
		<li><a href="{{ url('api/members/email/'.$email) }}">{!! url('api/members/email/'.$email) !!}</a></li>
	</ul>
	<strong>Retrieves information of Departments</strong>
	<ul>
		<li><a href="{{ url('api/departments') }}">{!! url('api/departments') !!}</a></li>
		<li><a href="{{ url('api/departments/administrative') }}">{!! url('api/departments/administrative') !!}</a></li>
		<li><a href="{{ url('api/departments/189') }}">{!! url('api/departments/189') !!}</a></li>
		<li><a href="{{ url('api/departments/10132') }}">{!! url('api/departments/10132') !!}</a></li>
		<li><a href="{{ url('api/departments/189/members') }}">{!! url('api/departments/189/members') !!}</a></li>
		<li><a href="{{ url('api/departments/189/faculty/all') }}">{!! url('api/departments/189/faculty/all') !!}</a></li>
		<li><a href="{{ url('api/departments/189/faculty/all/degrees') }}">{!! url('api/departments/189/faculty/all/degrees') !!}</a></li>
		<li><a href="{{ url('api/departments/189/coordinator') }}">{!! url('api/departments/189/coordinator') !!}</a></li>
		<li><a href="{{ url('api/departments/10132/members') }}"> {!! url('api/departments/10132/members') !!}</a></li>
	</ul>
	<strong>Retrieves information of Colleges</strong>
	<ul>
		<li><a href="{{ url('api/colleges') }}">{!! url('api/colleges') !!}</a></li>
		<li><a href="{{ url('api/colleges/chairs') }}">{!! url('api/colleges/chairs') !!}</a></li>
		<li><a href="{{ url('api/colleges/52') }}">{!! url('api/colleges/52') !!}</a></li>
		<li><a href="{{ url('api/colleges/52/chairs') }}">{!! url('api/colleges/52/chairs') !!}</a></li>
	</ul>
	<strong>Retrieves information about Committees</strong>
	<ul>
		<li><a href="{{ url('api/committees') }}">{!! url('api/committees') !!}</a></li>
		<li><a href="{{ url('api/committees/atc') }}">{!! url('api/committees/atc') !!}</a></li>
		<li><a href="{{ url('api/committees/aggab/members') }}">{!! url('api/committees/aggab/members') !!}</a></li>
	</ul>
	<strong>Retrieves information about Centers</strong>
	<ul>
		<li><a href="{{ url('api/centers') }}">{!! url('api/centers') !!}</a></li>
		<li><a href="{{ url('api/centers/viscom') }}">{!! url('api/centers/viscom') !!}</a></li>
		<li><a href="{{ url('api/centers/viscom/members') }}">{!! url('api/centers/viscom/members') !!}</a></li>
	</ul>
	<strong>Retrieves information about Institutes</strong>
	<ul>
		<li><a href="{{ url('api/institutes') }}">{!! url('api/institutes') !!}</a></li>
		<li><a href="{{ url('api/institutes/ichwb') }}">{!! url('api/institutes/ichwb') !!}</a></li>
		<li><a href="{{ url('api/institutes/ichwb/members') }}">{!! url('api/institutes/ichwb/members') !!}</a></li>
	</ul>
	<strong>Retrieves Faculty Listings</strong>
	<ul>
		<li><a href="{{ url('api/members/faculty/all') }}">{!! url('api/members/faculty/all') !!}</a></li>
		<li><a href="{{ url('api/members/faculty/tenure-track') }}">{!! url('api/members/faculty/tenure-track') !!}</a></li>
		<li><a href="{{ url('api/members/faculty/tenure-track/a') }}">{!! url('api/members/faculty/tenure-track/a') !!}</a></li>
		<li><a href="{{ url('api/members/faculty/emeriti') }}">{!! url('api/members/faculty/emeriti') !!}</a></li>
		<li><a href="{{ url('api/members/faculty/emeriti/degrees/m') }}">{!! url('api/members/faculty/emeriti/degrees/m') !!}</a></li>
		<li><a href="{{ url('api/members/faculty/lecturer') }}">{!! url('api/members/faculty/lecturer') !!}</a></li>
	</ul>
	<h2 id="subcollections">Subcollections</h2>
	<h3>Examples</h3>
	<strong>Retrieves information of a single entity</strong><br />
	<ul>
		<li>
			<a href="{{ url('api/members?email='.$email) }}">{!! url('api/members?email='.$email) !!}</a>
		</li>
		<li>
			<a href="{{ url('api/members?members_id=103166750') }}">{!! url('api/members?members_id=103166750') !!}</a>
		</li>
	</ul>
	<h2 id="code-samples">Usage Example</h2>
	<div class="accordion">
		<div class="card">
			<div id="jquery-header" class="card-header">
				<p class="mb-0">
					<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jquery-body" aria-expanded="true" aria-controls="jquery-body">
						JQuery
					</button>
				</p>
			</div>
			<div id="jquery-body" class="collapse" aria-labelledby="jquery-header">
				<div class="card-body">
					<pre>
						<code class="prettyprint lang-js">
// this example assumes jQuery integration for ease of use
// and a &lt;div&gt; element with the ID of "directory-results"

// query the information for computer science
var url = '{!! url('api/departments/189') !!}';
$(document).ready(function() {

	// perform a shorthand AJAX call to grab the information
	$.get(url, function(data) {

		// get the department information
		var department = data.department;
		$(department).each(function(index, info) {

			// append each course to the content of the element
			$('#directory-results').append('&lt;p&gt;' + info.name + ' ' + info.description + '&lt;/p&gt;');

		});
		
	});

});
						</code>
					</pre>
				</div>
			</div>
		</div>
		<div class="card">
			<div id="php-header" class="card-header">
				<p class="mb-0">
					<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#php-body" aria-expanded="true" aria-controls="php-body">
						PHP
					</button>
				</p>
			</div>
			<div id="php-body" class="collapse" aria-labelledby="php-header">
				<div class="card-body">
					<pre>
						<code class="prettyprint lang-php">
// query all the information for Computer Science
$url = "https://api.metalab.csun.edu/directory/api/departments/189";

//add extra necessary options
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);

$data = file_get_contents($url, false, stream_context_create($arrContextOptions));

// encode into an array
$data = json_decode($data, true);

// print the results
print_r($data['department']['name']);
						</code>
					</pre>
				</div>
			</div>
		</div>
		<div class="card">
			<div id="python-header" class="card-header">
				<p class="mb-0">
					<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#python-body" aria-expanded="true" aria-controls="python-body">
						Python
					</button>
				</p>
			</div>
			<div id="python-body" class="collapse" aria-labelledby="python-header">
				<div class="card-body">
					<pre>
						<code class="prettyprint lang-py">
#python
import urllib2
import json

#query all the information for Computer Science
url = u'{!! url('api/departments/189') !!}'

#try to read the data	
try:
   u = urllib2.urlopen(url)
   data = u.read()
except Exception as e:
	data = {}

#decode into an array
data = json.loads(data)

#setup a blank array
directory_list = []

#loop through results and add department name
#and description subject to direcotyr_list
for info in data['department']:
	directory_list.append(info['name'] + ' ' + info['description'])

print directory_list
						</code>
					</pre>
				</div>
			</div>
		</div>
		<div class="card">
			<div id="ruby-header" class="card-header">
				<p class="mb-0">
					<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#ruby-body" aria-expanded="true" aria-controls="ruby-body">
						Ruby
					</button>
				</p>
			</div>
			<div id="ruby-body" class="collapse" aria-labelledby="ruby-header">
				<div class="card-body">
					<pre>
						<code class="prettyprint lang-rb">
require 'net/http'
require 'json'

#query all the information for Computer Science
source = '{!! url('api/departments/189') !!}'

#call data
response = Net::HTTP.get_response(URI.parse(source))

#get body of the response
data = response.body

#put the parsed data
puts JSON.parse(data)
						</code>
					</pre>
				</div>
			</div>
		</div>
	</div>
@stop
