<div id="details_tab">
	<form id="add_form" class="d-none">
		<div class="row">
			<div class="col-3 form-group">
	    	<label for="">Date Time</label>
	    	<input type="text" class="form-control datepicker" name="time"/>
	    </div>
	    <div class="col-12">
	    	<div class="form-group">
	    		<label for="">Changes in Term</label>
	    		<textarea name="changes" class="form-control" id="" cols="30" rows="5"></textarea>
	    	</div>
	    </div>
		</div>
	</form>
	<a href="javascript:void(0)" class="btn btn-info mt-2 mb-2 pull-right add"  onclick="add()">Add</a>
	<a href="javascript:void(0)" class="btn btn-danger mt-2 mb-2 ml-2 pull-right cancel d-none" onclick="cancel()">Cancel</a>
	<a href="javascript:void(0)" class="btn btn-success mt-2 mb-2 pull-right save d-none"  onclick="save()">Save</a>
	<table class="table table-striped table-hover table-bordered">
	  <thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Date Time</th>
	      <th>Changes in Terms</th>
	      <th class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody id="meetingTbody">
	  	
	  </tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		$('.select2').select2();
		$('.datepicker').datepicker({
			orientation: "bottom",
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		});
	});
	function add(){
		$('#add_form, .save, .cancel, .add').toggleClass('d-none');
	}
	function cancel(){
		$('#add_form, .save, .cancel, .add').toggleClass('d-none');
	}
</script>
