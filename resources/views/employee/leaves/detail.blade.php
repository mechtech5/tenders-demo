<table class="table table-striped table-hover table-bordered">
	<thead class="thead-dark">
		<tr>
			<th>Employee</th>
			<th>Type</th>
			<th>Leave Start</th>
			<th>Leave Ends</th>
			<th>Duration</th>
			<th>Status</th>
			<th>Reason</th>
			<th>Document</th>
			<th>Contact No</th>
			<th>Address</th>
			<th>Applicant's Remark</th>
		</tr>
	</thead>
	<tbody id="experiencesTbody">
		<tr>
			<td>{{$data['employees']->emp_name}}</td>
			<td>{{$data['leavetype']->name}}</td>
			<td>{{$data->from}}</td>
			<td>{{$data->to}}</td>
			<td>{{$data->count}}</td>
			<td>{{$data->status}}</td>
			<td>{{$data->reason}}</td>
			<td>{{$data->contact_no}}</td>
			<td></td>
			<td>{{$data->address}}</td>
			<td>{{$data->applicant_remark}}</td>
		</tr>
	</tbody>
</table>