<div id="details_tab">
	<form id="add_meeting_form" class="d-none">
		<div class="row">
			<div class="col-3 form-group">
	    	<label for="">Meeting Location</label>
	    	<input type="text" class="form-control" name="location"/>
	    </div>
			<div class="col-3 form-group">
	    	<label for="">Meeting date Time</label>
	    	<input type="text" class="form-control datepicker" name="time"/>
	    </div>
	    <div class="col-12">
	    	<div class="form-group">
	    		<label for="">Meeting Remarks and Conclusions</label>
	    		<textarea name="meeting_remark" class="form-control" id="" cols="30" rows="5"></textarea>
	    	</div>
	    </div>
		</div>
	</form>
	<a href="javascript:void(0)" class="btn btn-info mt-2 mb-2 pull-right add_meeting"  onclick="add_meeting()">Add</a>
	<a href="javascript:void(0)" class="btn btn-danger mt-2 mb-2 ml-2 pull-right cancel_add_meeting d-none" onclick="cancel_add_meeting()">Cancel</a>
	<a href="javascript:void(0)" class="btn btn-success mt-2 mb-2 pull-right save_meeting d-none"  onclick="save_meeting()">Save</a>
	<table class="table table-striped table-hover table-bordered">
	  <thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Date Time</th>
	      <th>Location</th>
	      <th>Remark</th>
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
	function add_meeting(){
		$('#add_meeting_form, .save_meeting, .cancel_add_meeting, .add_meeting').toggleClass('d-none');
	}
	function cancel_add_meeting(){
		$('#add_meeting_form, .save_meeting, .cancel_add_meeting, .add_meeting').toggleClass('d-none');
	}
</script>
