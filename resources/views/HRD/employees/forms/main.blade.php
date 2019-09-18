<div id="emp_main">
<form id="emp_form_main">
	<div class="container-fluid">

		<div class="row">
			<div class="col-4 form-group">
				<label for="">Name</label>
				<input type="text" class="form-control" name="name" value="{{$employee->emp_name}}" />
			</div>
			<div class="col-4 form-group">
				<label for="">Email</label>
				<input type="email" class="form-control" name="email" value="{{$employee->email}}" />
			</div>
			<div class="col-4 form-group">
				<label for="">Mobile</label>
				<input type="text" class="form-control" name="mobile" value="{{$employee->contact}}" />
			</div>
			<div class="col-12 form-group text-center">
				<button class="btn btn-info btn-sm">Update</button>
				<button class="btn btn-danger btn-sm" onclick="refresh();">Cancel</button>
			</div>
		</div>
	</div>
	<input type="hidden" name="form_type" id="form_type" value="main">
</form>
</div>
