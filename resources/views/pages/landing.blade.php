<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Directory Web Service</title>

</head>
<body>
		<h1 class="page-header" id="firstHeading">Directory Web Service</h1>
	<div class="welcome">
		<p>
		<h2>Introduction</h2>
			The Directory web service gives information about academic departments, financial departments, centers, committees, and faculty members. This information is obtained through institutional data. The web service provides a gateway to access information via a REST-ful API. The information is retrieved by creating a specific URI and providing values to filter the data. The information returned is in a JSON format.			
		</p>
	    <div class="container">
	      <pre class="code--block code--block__default">
{  
   status:"200",
   success:"true",
   type:"people",
   people:{  
      individuals_id:"members:100010526",
      parent_entities_id:"departments:10132",
      entity_type:"Individual",
      display_name:"Steve Fitzgerald",
      description:null,
      record_status:"Active",
      first_name:"Steven",
      middle_name:null,
      last_name:"Fitzgerald",
      common_name:"Steven Fitzgerald",
      email:"nr_steven.fitzgerald@csun.edu",
      gender:"M",
      biography:"Steven Fitzgerald is a Professor of Computer Science at CSUN, and his teaching focus is on operating systems, compilers, and networking. In his current role, Steve also serves as the Co-Director of the Matador Emerging Technology and Arts Laboratory (META+Lab). This group is composed of a team of students, mentored by faculty members, that develop web applications and engages in other activities to improve campus services via the use of leading-edge technologies.",
      confidential:0,
      affiliation:"faculty",
      rank:"Professor",
      appt_year:1994,
      affiliation_status:"Inactive",
      contacts:[  
         {  
            contact_id:4071,
            entities_id:"members:100010526",
            parent_entities_id:"departments:10390",
            role_position:"staff",
            precedence:1,
            is_displayed:1,
            title:"Co-Director",
            email:"steve@metalab.csun.edu",
            telephone:"8186777084",
            facsimile_telephone:"",
            website:"https://www.csun.edu/~steve",
            location:"META+Lab",
            office:null,
            mail_drop:"8201"
         },
         {  
            contact_id:6338,
            entities_id:"members:100010526",
            parent_entities_id:"academic_departments:189",
            role_position:"faculty",
            precedence:0,
            is_displayed:1,
            title:"Professor",
            email:"steve@csun.edu",
            telephone:"8186777084",
            facsimile_telephone:"",
            website:"https://www.csun.edu/~steve",
            location:"META+Lab",
            office:null,
            mail_drop:"4321"
         },
         {  
            contact_id:6678,
            entities_id:"members:100010526",
            parent_entities_id:"academic_departments:487",
            role_position:"faculty",
            precedence:2,
            is_displayed:1,
            title:"Faculty",
            email:"nr_steven.fitzgerald@csun.edu",
            telephone:null,
            facsimile_telephone:null,
            website:null,
            location:null,
            office:null,
            mail_drop:""
         }
      ]
   }
}
	    </pre>
	  </div>
	<div>
	  <h2>How To Use</h2>
	      <ol class="list--circles">
	        <li class="">Generate a unique URI.
	        </li>
	        <li class="">Use the constructed URI to send a query request.</li>
	        <li class="">Browse through the returned JSON and use as needed.</li>
	      </ol>	  		
	</div>


<div id="sidebar" class="col-md-2 col-sm-12">
	<div class="side-menu">
		<ul>
		    <li><a href="#faculty" class="h5 item item-1">Faculty Members</a></li>
		    <li><a href="#departments" class="h5 item item-2">Departments</a></li>
		    <li><a href="#colleges" class="h5 item item-3">Colleges</a></li>
		    <li><a href="#committees" class="h5 item item-4">Committees</a></li>
		    <li><a href="#institutes" class="h5 item item-5">Institutes</a></li>
		</ul>
	</div>
</div>
		<div class="docs-content col-md-10 col-sm-12">
			<h2>Example URI's for each entity.</h2>
					<div>
						<h2 class="page-header" id="faculty">Faculty</h2>
							<dt>Retrieves information of a single faculty member.</dt>
							<dd><a href="{{ url('members/email/nr_steven.fitzgerald@csun.edu') }}">{{ url('members/email/nr_steven.fitzgerald@csun.edu') }}</a></dd>	
							<!-- <dd><a href="{{ url('members/id/100010526') }}">{{ url('members/id/100010526') }}</a></dd>			 -->
						<dl>
						</dl>
					</div>

					<div>
						<h2 class="page-header" id="departments">Departments</h2>
						<dl>
							<dt>Retrieves the list of all academic and administrative departments</dt>
							<dd><a href="{{ url('departments') }}">{{ url('departments') }}</a></dd>
							<dt>Retrieves the list of all academic departments</dt>
							<dd><a href="{{ url('departments/academic') }}">{{ url('departments/academic') }}</a></dd>
							<dt>Retrieves the list of all administrative departments</dt>
							<dd><a href="{{ url('departments/administrative') }}">{{ url('departments/administrative') }}</a></dd>
							<dt>Retrieves information if a single department</dt>
							<dd><a href="{{ url('departments/189') }}">{{ url('departments/189') }}</a></dd>
							<dd><a href="{{ url('departments/10132') }}">{{ url('departments/10132') }}</a></dd>
							<dt>Retrieves all members of a specific department</dt>
							<dd><a href="{{ url('departments/189/members') }}">{{ url('departments/189/members') }}</a></dd>
							<dd><a href="{{ url('departments/10132/members') }}"> {{ url('departmens/10132/members') }}</a></dd>
						</dl>
					</div>
					<div>
						<h2 class="page-header" id="secHeading">Colleges</h2>
						
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
					</div>

					<div>
						<h2 class="page-header" id="secHeading">Committees</h2>
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
					</div>
						

					<div>	
						<h2 class="page-header" id="secHeading">Centers</h2>
						
						<dl>
							<dt>Retrieves the list of all the centers</dt>
							<dd><a href="{{ url('centers') }}">{{ url('centers') }}</a></dd>
							<dt>Retrieves a specific center</dt>
							<dd><a href="{{ url('centers/viscom') }}">{{ url('centers/viscom') }}</a></dd>
							<dt>Retrieves the list of all members in a center</dt>
							<dd><a href="{{ url('centers/viscom/members') }}">{{ url('centers/viscom/members') }}</a></dd>
						</dl>
					</div>

					<div>		
						<h2 class="page-header" id="secHeading">Institutes</h2>
						<dl>
							<dt>Retrieves the list of all institutes</dt>
							<dd><a href="{{ url('institutes') }}">{{ url('institutes') }}</a></dd>
							<dt>Retrieves a specific institute</dt>
							<dd><a href="{{ url('institutes/ichwb') }}">{{ url('institutes/ichwb') }}</a></dd>
							<dt>Retrieves the list of members in an institute</dt>
							<dd><a href="{{ url('/institutes/ichwb/members') }}">{{ url('/institutes/ichwb/members') }}</a></dd>
						</dl>	
					</div>

		</div>
	<h2>Code Examples</h2>
		  <div id="tabpanel" role="tabpanel" class="tabpanel">
		        <!-- Nav tabs -->
		        <ul class="nav nav-tabs" role="tablist">
		          <li role="presentation" class="active"><a href="#php" aria-controls="php" role="tab" data-toggle="tab">PHP</a></li>

		          <li role="presentation"><a href="#python" aria-controls="python" role="tab" data-toggle="tab">Python</a></li>

		          <li role="presentation"><a href="#ruby" aria-controls="ruby" role="tab" data-toggle="tab">Ruby</a></li>

		          <li role="presentation"><a href="#js" aria-controls="js" role="tab" data-toggle="tab">JavaScript</a></li>

		        </ul>

		        <!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="php">
      <pre class="prettyprint">
//Generate the URL
$url = 'http://localhost:8888/directory/public/departments';
//Perform the query
$data = file_get_contents($url);
//Decode JSON
$data = json_decode($data, true);
//Create an empty array
$department_list = [];

//loop the list of data
foreach ($data['departments'] as $department) {
	$department_list = $department['name'] . ' ' . $department['department_id'];
}

print_r($department_list);
    </pre>
  </div>


  <div role="tabpanel" class="tab-pane" id="python">
      <pre class="prettyprint">

import urllib2
import json

url = u'http://localhost:8888/directory/public/departments'

try:
	u = urllib2.urlopen(url)
	data = u.read()
		exception Exception as e
			data = {}

data = json.loads(data)

department_list = []

//iterate over JSON
for department in data['departments']:
	department_list.append(department['name'] + ' ' + department['department_id'])

print department_list
    </pre>
    </div>

    <div role="tabpanel" class="tab-pane" id="ruby">

      <pre class="prettyprint">

		require 'net/http'
		require 'json'
		//Generate the URL 
		source = 'http://localhost:8888/directory/public/departments'

		response = Net::HTTP.get_response(URI.parse(source))

		data = response.body
		
		puts JSON.parse(data)

      </pre>

    </div>


    <div role="tabpanel" class="tab-pane" id="js">
      <pre class="prettyprint">

		//Generate the url
		var url = 'http://localhost:8888/directory/public/departments'
		$(document).ready(function() {
			$.get(url, function(data) {
				$var department_list = data.departments;
				$(department_list).each(function(name, department_id) {
					$(#department-result).append(department.name + ' ' + department.department_id)
				});
			});
		});

    </pre>
 </div>
    </div>
  </div>

</body>
</html>
