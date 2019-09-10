<div id="emp_experiences">
	<table class="table table-striped table-hover table-bordered">
	  <thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Company Name</th>
	      <th>Monthly CTC</th>
	      <th>Designation</th>
	      <th>Start Date</th>
	      <th>End Date</th>
	      <th>Reason of Leaving</th>
	      <th class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody id="experiencesTbody">
	  
	  </tbody>
	</table>
	<hr />
	<form id="emp_form_experiences">
		<div class="row">
	    <div class="col-3 form-group">
	    	<label for="">Company Name</label>
	    	<input type="text" class="form-control" name="company_name">
	    </div>
	    <div class="col-2 form-group">
	    	<label for="">Monthly CTC</label>
	    	<input type="text" class="form-control" name="monthly_ctc"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Designation</label>
	    	<input type="text" class="form-control" name="designation"/>
	    </div>
	    <div class="col-2 form-group">
	    	<label for="">Start Date</label>
	    	<input type="text" class="form-control datepicker" name="start_date"/>
	    </div>
	    <div class="col-2 form-group">
	    	<label for="">End Date</label>
	    	<input type="text" class="form-control datepicker" name="end_date"/>
	    </div>
	    <div class="w-100"></div>
	    <div class="col-12">
	    	<div class="form-group">
	    		<label for="">Reason of Leaving</label>
	    		<textarea name="reason_of_leaving" class="form-control" id="" cols="30" rows="10"></textarea>
	    	</div>
	    </div>
		</div>

		<input type="hidden" id="form_type" value="experiences">
	</form>
</div>

<script>
	$(document).ready(function(){
		$('.select2').select2();
		$('.datepicker').datepicker({
			orientation: "bottom",
    	format: "yyyy-mm-dd",
    	autoclose: true,
    	todayHighlight: true
    });
	});
</script>
