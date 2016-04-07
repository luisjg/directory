<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Directory Web Service</title>

</head>
<body>
	<div class="welcome">
		<h1 class="page-header" id="firstHeading">Directory Web Service</h1>
		<p>
			The Directory web service gives information about academic departments, financial departments, committees, centers, committees, and faculty members. This information is obtained through institutional data. The web service provides a gateway to access information via a REST-ful API. The information is retrieved by creating a specific URI and providing values to filter the data. The information returned is in a JSON format.			
		</p>
{
status: "200",
success: "true",
type: "people",
people: {
individuals_id: "members:100010526",
parent_entities_id: "departments:10132",
entity_type: "Individual",
display_name: "Steve Fitzgerald",
description: null,
record_status: "Active",
first_name: "Steven",
middle_name: null,
last_name: "Fitzgerald",
common_name: "Steven Fitzgerald",
email: "nr_steven.fitzgerald@csun.edu",
gender: "M",
biography: "Steven Fitzgerald is a Professor of Computer Science at CSUN, and his teaching focus is on operating systems, compilers, and networking. In his current role, Steve also serves as the Co-Director of the Matador Emerging Technology and Arts Laboratory (META+Lab). This group is composed of a team of students, mentored by faculty members, that develop web applications and engages in other activities to improve campus services via the use of leading-edge technologies.",
confidential: 0,
affiliation: "faculty",
rank: "Professor",
appt_year: 1994,
affiliation_status: "Inactive",
contacts: [
{
contact_id: 4071,
entities_id: "members:100010526",
parent_entities_id: "departments:10390",
role_position: "staff",
precedence: 0,
is_displayed: 1,
title: "Co-Director",
email: "steve@metalab.csun.edu",
telephone: "8186777084",
facsimile_telephone: "",
website: "https://www.csun.edu/~steve",
location: "META+Lab",
office: null,
mail_drop: "8201"
},
{
contact_id: 6338,
entities_id: "members:100010526",
parent_entities_id: "academic_departments:189",
role_position: "faculty",
precedence: 1,
is_displayed: 1,
title: "Professor",
email: "steve@csun.edu",
telephone: "8186777084",
facsimile_telephone: "",
website: "https://www.csun.edu/~steve",
location: "META+Lab",
office: null,
mail_drop: "4321"
},
{
contact_id: 6678,
entities_id: "members:100010526",
parent_entities_id: "academic_departments:487",
role_position: "faculty",
precedence: 0,
is_displayed: 1,
title: "Faculty",
email: "nr_steven.fitzgerald@csun.edu",
telephone: null,
facsimile_telephone: null,
website: null,
location: null,
office: null,
mail_drop: ""
}
]
}
}
	<h1>EXAMPLES</h1>

			<h2>Examples for people</h2>
			<dl>
				<dt>Retrieves information of a single entity</dt>
				<dd><a href="{{ url('members/email/steven.fitzgerald@csun.edu') }}">{{ url('members/email/steven.fitzgerald@csun.edu') }}</a></dd>	
				<!-- <dd><a href="{{ url('members/id/100010526') }}">{{ url('members/id/100010526') }}</a></dd>			 -->
			</dl>

			<h2>Examples for departments</h2>
			<dl>
				<dt>Retrieves the list of all departments</dt>
				<dd><a href="{{ url('departments') }}">{{ url('departments') }}</a></dd>
				<dt>Retrieves the list of all aadministrative departments</dt>
				<dd><a href="{{ url('departments/administrative') }}">{{ url('departments/administrative') }}</a></dd>
				<dd><a href="{{ url('departments/academic') }}">{{ url('departments/academic') }}</a></dd>
				<dt>Retrieves a specific department</dt>
				<dd><a href="{{ url('departments/189') }}">{{ url('departments/189') }}</a></dd>
				<dd><a href="{{ url('departments/10132') }}">{{ url('departments/10132') }}</a></dd>
				<dt>Retrieves all members of a specific department</dt>
				<dd><a href="{{ url('departments/189/members') }}">{{ url('departments/189/members') }}</a></dd>
				<dd><a href="{{ url('departments/10132/members') }}"> {{ url('departmens/10132/members') }}</a></dd>
			</dl>

			<!-- <h2>Academic Departments</h2>
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
				<dd><a href="{{ url('administrative-departments') }}">{{ url('administrative-departments') }}</a></dd>
				<dt>Retrieves a specific administrative department</dt>
				<dd><a href="{{ url('administrative-departments/10132') }}">{{ url('administrative-departments/10132') }}</a></dd>
				<dt>Retrieves all members of an administrative department</dt>
				<dd><a href="{{ url('administrative-departments/10132/members') }}">{{ url('administrative-departments/10132/members') }}</a></dd>
				<dd><a href="{{ url('administrative-departments/') }}"></a></dd>

				<dt>Retrieves a specific member in a administrative department by id</dt>
				<dd><a href="{{ url('administrative-departments/10132/member/105957681') }}">{{ url('administrative-departments/10132/member/105957681') }}</a></dd>
			</dl> -->
			<h2>Examples for colleges</h2>
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
			
			<h2>Examples for committees</h2>
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

			<h2>Examples for centers</h2>
			<dl>
				<dt>Retrieves the list of all the centers</dt>
				<dd><a href="{{ url('centers') }}">{{ url('centers') }}</a></dd>
				<dt>Retrieves a specific center</dt>
				<dd><a href="{{ url('centers/viscom') }}">{{ url('centers/viscom') }}</a></dd>
				<dt>Retrieves the list of all members in a center</dt>
				<dd><a href="{{ url('centers/viscom/members') }}">{{ url('centers/viscom/members') }}</a></dd>
			</dl>

			<h2>Examples for institutes</h2>
			<dl>
				<dt>Retrieves the list of all institutes</dt>
				<dd><a href="{{ url('institutes') }}">{{ url('institutes') }}</a></dd>
				<dt>Retrieves a specific institute</dt>
				<dd><a href="{{ url('institutes/ichwb') }}">{{ url('institutes/ichwb') }}</a></dd>
				<dt>Retrieves the list of members in an institute</dt>
				<dd><a href="{{ url('/institutes/ichwb/members') }}">{{ url('/institutes/ichwb/members') }}</a></dd>
			</dl>
			<div>
				Code Examples
			</div>
	</div>
</body>
</html>
