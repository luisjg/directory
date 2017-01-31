@extends('layouts.master')
@section('content')
	      	<h2 id="introduction" class="type--header type--thin">Introduction</h2>
	      	The Directory web service provides contact information about CSUN entities. The web service provides a gateway to access the information via a REST-ful API. The information is retrieved by creating a specific URI and giving values to filter the data. The data is provided by CSUN Central IT. The information that is returned is a JSON object that contains contact information about a particular person, center, college, department, etc; the format of the JSON object is as follows:</p>
	      	<pre>
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
	      	<h2 id="how-to" class="type--header type--thin">How to Use</h2>
			<ol>
				<li><strong>GENERATE THE URI:</strong> Find the usage that fits your need. Browse through subcollections, instances and query types to help you craft your URI.</li>
				<li><strong>PROVIDE THE DATA:</strong> Use the URI to query your data. See the Usage Example section.</li>
				<li><strong>SHOW THE RESULTS</strong></li>
			</ol>
	      	<h2 id="collections" class="type--header type--thin">Collections</h2>
			<h3 class="type--thin">Examples</h3>
			<strong>Retrieves information of a single entity</strong> (phasing out soon)
			<ul class="list--unstyled">
				<li class="list__item"><a href="{{ url('api/members/email/steven.fitzgerald@csun.edu') }}">{!! url('api/members/email/steven.fitzgerald@csun.edu') !!}</a></li>
			</ul>
			<strong>Retrieves information of departments</strong>
			<ul class="list--unstyled">
				<li class="list__item"><a href="{{ url('api/departments') }}">{!! url('api/departments') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/administrative') }}">{!! url('api/departments/administrative') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/189') }}">{!! url('api/departments/189') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/10132') }}">{!! url('api/departments/10132') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/189/members') }}">{!! url('api/departments/189/members') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/189/coordinator') }}">{!! url('api/departments/189/coordinator') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/departments/10132/members') }}"> {!! url('api/departments/10132/members') !!}</a></li>
			</ul>
			<strong>Retrieves information of Colleges</strong>
			<ul class="list--unstyled">
				<li class="list__item"><a href="{{ url('api/colleges') }}">{!! url('api/colleges') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/colleges/chairs') }}">{!! url('api/colleges/chairs') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/colleges/52') }}">{!! url('api/colleges/52') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/colleges/52/chairs') }}">{!! url('api/colleges/52/chairs') !!}</a></li>
			</ul>
			<strong>Retrieves information about Committees</strong>
			<ul class="list--unstyled">
				<li class="list__item"><a href="{{ url('api/committees') }}">{!! url('api/committees') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/committees/atc') }}">{!! url('api/committees/atc') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/committees/aggab/members') }}">{!! url('api/committees/aggab/members') !!}</a></li>
			</ul>
			<strong>Retrieves information about Centers</strong>
			<ul class="list--unstyled">
				<li class="list__item"><a href="{{ url('api/centers') }}">{!! url('api/centers') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/centers/viscom') }}">{!! url('api/centers/viscom') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/centers/viscom/members') }}">{!! url('api/centers/viscom/members') !!}</a></li>
			</ul>
			<strong>Retrieves information about Institutes</strong>
			<ul class="list--unstyled">
				<li class="list__item"><a href="{{ url('api/institutes') }}">{!! url('api/institutes') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/institutes/ichwb') }}">{!! url('api/institutes/ichwb') !!}</a></li>
				<li class="list__item"><a href="{{ url('api/institutes/ichwb/members') }}">{!! url('api/institutes/ichwb/members') !!}</a></li>
			</ul>
	      	<h2 id="subcollections" class="type--header type--thin">Subcollections</h2>
			<h3 class="type--thin">Examples</h3>
			<strong>Retrieves information of a single entity</strong><br />
			<ul class="list--unstyled">
				<li class="list__item">
					<a href="{{ url('api/members?email=steven.fitzgerald@csun.edu') }}">{!! url('api/members?email=steven.fitzgerald@csun.edu') !!}</a>
				</li>
			</ul>
	      	<h2 id="usage-example" class="type--header type--thin">Usage Example</h2>
	      		<dl class="accordion">
		<dt class="accordion__header"> JavaScript <i class="fa fa-chevron-down fa-pull-right type--red" aria-hidden="true"></i></dt>
		<dd class="accordion__content">
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
		</dd>
		<dt class="accordion__header"> PHP <i class="fa fa-chevron-down fa-pull-right type--red" aria-hidden="true"></i></dt>
		<dd class="accordion__content">
    	<pre>
    	<code class="prettyprint lang-php">
// query all the information for Computer Science
$url = '{!! url('api/departments/189') !!}';

// call url, you can also use CURL or guzzle -> https://github.com/guzzle/guzzle
$data = file_get_contents($url);

// decode into an array
$data = json_decode($data, true);

// setup a blank array
$directory_list = [];

// loop through results and add department name and description
// and catalog number to course_list array (i.e. COMP 100)
foreach($data['department'] as $info){
	$directory_list[] = $info['name'].' '.$info['description'];
}

print_r($course_list);
			</code>
			</pre>
		</dd>
		<dt class="accordion__header"> Python <i class="fa fa-chevron-down fa-pull-right type--red" aria-hidden="true"></i></dt>
		<dd class="accordion__content">
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
		</dd>
		<dt class="accordion__header"> Ruby <i class="fa fa-chevron-down fa-pull-right type--red" aria-hidden="true"></i></dt>
		<dd class="accordion__content">
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
		</dd>
	</dl>
@stop
