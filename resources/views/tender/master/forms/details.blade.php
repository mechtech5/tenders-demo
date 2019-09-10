<div id="details_tab">
	<form id="details_tab_form">
		<div class="row">
	    <div class="col-3 form-group">
	    	<label for="">Title</label>
	    	<input type="text" class="form-control" name="title">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Publish date</label>
	    	<input type="text" class="form-control datepicker" name="publish_date"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Type</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">--Select Type--</option>
	    	</select>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Category</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">-- Select Category --</option>
	    	</select>
	    </div>
	    <div class="w-100"></div>
	    <div class="col-12">
	    	<div class="form-group">
	    		<label for="">Description</label>
	    		<textarea name="description" class="form-control" id="" cols="30" rows="5"></textarea>
	    	</div>
	    	<hr>
	    </div>
		<div class="col-12 row">
				<div class="col-4 mb-4">
					<select name="" id="" class="form-control select2">
						<option value="">-Select Contact Person-</option>
						<option value="1">One</option>
						<option value="2">Two</option>
						<option value="3">Three</option>
					</select>
			</div>
			<div class="col-4 add_client_div d-none">
				<input type="text" class='form-control' name="client_name">
			</div>
			<div class="col-2 pull-right">
				<a href="javascript:void(0)" onclick="add_client()" class="btn btn-info btn-xs add_client"><i class="fa fa-plus"></i>Add</a>
				<span class="btn btn-info btn-xs save_client d-none">Save</span>
				<a href="javascript:void(0)" onclick="add_client()" class="btn btn-danger btn-xs cancel_save_client d-none">Cancel</a>
			</div>
		</div>
			<div class="col-3">
	    	<div class="form-group">
	    		<label for="">Contact Name</label>
	    		<input type="text" class="form-control" name="contact_name"/>
	    	</div>
	    </div>
	    <div class="col-3">
	    	<div class="form-group">
	    		<label for="">Email</label>
	    		<input type="text" class="form-control" name="email"/>
	    	</div>
	    </div>
	     <div class="col-3">
	    	<div class="form-group">
	    		<label for="">Designation</label>
	    		<input type="text" class="form-control" name="designation"/>
	    	</div>
	    </div>
	     <div class="col-3">
	    	<div class="form-group">
	    		<label for="">Contact number</label>
	    		<input type="text" class="form-control" name="contact_num"/>
	    	</div>
	    </div>
		</div>	
	</form>
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

	function add_client(){
		$(".add_client").toggleClass('d-none');
		$(".save_client, .add_client_div, .cancel_save_client").toggleClass('d-none');
	}

	function cancel_save_client(){
		$(".add_client").toggleClass('d-none');
		$(".save_client, .add_client_div, .cancel_save_client").toggleClass('d-none');
	}
</script>
