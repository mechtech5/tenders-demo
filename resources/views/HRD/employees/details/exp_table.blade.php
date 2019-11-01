<table class="table table-striped table-hover table-bordered">
	<thead class="thead-dark">
		<tr>
			<th>#</th>
			<th>Company Name</th>
			<th>Job Type</th>
			<th>Monthly CTC</th>
			<th>Designation</th>
			<th>Company Location</th>
			<th>Company Email</th>
			<th>Company Website</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Certificate</th>
			<th>Reason of Leaving</th>
		</tr>
	</thead>
	<tbody id="experiencesTbody">
		
		<tr>
			<td>{{$exp->id}}</td>
			<td>{{$exp->comp_name}}</td>
			<td>{{$exp->job_type}}</td>
			<td>{{$exp->monthly_ctc}}</td>
			<td>{{$exp->desg}}</td>
			<td>{{$exp->comp_loc}}</td>
			<td>{{$exp->comp_email}}</td>
			<td>{{$exp->comp_website}}</td>
			<td>{{$exp->start_dt}}</td>
			<td>{{$exp->end_dt}}</td>
			<td><a href="{{route('employees.download', ['db_table' => 'emp_exp', $exp->id])}}"><i class="fa fa-arrow-down"></i>Download</a></td>
			<td>{{$exp->reason_of_leaving}}</td>
		</tr>
		
	</tbody>
</table>