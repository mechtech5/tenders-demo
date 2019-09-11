<div id="details_tab">
	<form id="">
		<div class="row">
	    <div class="row col-12 text-center">
	    	<label for="" class="col-4"><b>Tender last submission Date online</b></label>
	    	<input type="text" class="form-control datepicker col-4" name="title">
	    	<div class="col-4">Timer</div>
	    </div>
	    <div class="row col-12 text-center mt-2">
	    	<label for="" class="col-4"><b>Tender last submission Date online</b></label>
	    	<input type="text" class="form-control datepicker col-4" name="title">
	    	<div class="col-4">Timer</div>
	    </div>
	    <div class="row col-12 text-center mt-2">
	    	<label for="" class="col-4"><b>Tender last submission Date online</b></label>
	    	<input type="text" class="form-control datepicker col-4" name="title">
	    	<div class="col-4">Timer</div>
	    </div>
	    <div class="row col-12 text-center mt-2">
	    	<label for="" class="col-4"><b>Tender last submission Date online</b></label>
	    	<input type="text" class="form-control datepicker col-4" name="title">
	    	<div class="col-4">Timer</div>
	    </div>
	    <div class="text-right">
				<a href="javascript:void(0)" onclick="toggle_add()" class="btn btn-info btn-xs add">
					<i class="fa fa-plus"></i>Add
				</a>
				<span class="btn btn-success btn-xs save d-none">Save</span>
				<a href="javascript:void(0)" onclick="toggle_add()" class="btn btn-danger btn-xs cancel d-none">Cancel</a>
			</div>
			<div class="myForm row col-12 mt-2 d-none">
		    <div class="col-4 form-group">
		    	<label for="">Column Name</label>
		    	<input type="text" class="form-control" name="time"/>
		    </div>
			   <div class="col-4 form-group">
		    	<label for="">Column Value</label>
		    	<input type="text" class="form-control datepicker" name="time"/>
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

	function toggle_add(){
		$(".myForm, .add, .save, .cancel").toggleClass('d-none');
	}

	function save(){
	}
</script>
