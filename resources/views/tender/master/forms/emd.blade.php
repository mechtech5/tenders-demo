<div id="details_tab">
	<form id="details_tab_form">
		<div class="row">
			<h4 class="col-12 divider">EMD</h4>
	    <div class="col-3 form-group">
	    	<label for="">EMD Made from A/c No</label>
	    	<br>
	    	<input type="text" class="form-control" name="emd">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Type</label>
	    	<div class="input-group ">
					<div class="btn-group radio-inline ">
						<label id="enabled_1" class="border_2 btn btn-default border bg-white">
							<input type="radio" name="type" value="" id="" >
							<span class="radiotext">DD</span>
						</label>
						<label id="req_approval_0" class="border_2 btn btn-default border bg-white">
							<input type="radio" name="type" value="" id=""  >
							<span class="radiotext" >BG</span>
						</label>
							<label id="req_approval_0" class="border_2 btn btn-default border bg-white">
							<input type="radio" name="type" value="0" id=""  >
							<span class="radiotext" >FD</span>
						</label>
					</div>
				</div>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Bank Name</label>
	    	<input type="text" class="form-control" name="emd">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Amount</label>
	    	<input type="text" class="form-control" name="amount"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Date of creation</label>
	    		<input type="text" class="form-control datepicker" name="creation_date"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Creation place</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">-- Select place --</option>
	    	</select>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Renewal Date</label>
	    		<input type="text" class="form-control datepicker" name="renewal_date"/>
	    </div>
	     <div class="col-3 form-group">
	    	<label for="">Expiry Date</label>
	    		<input type="text" class="form-control datepicker" name="exp_date"/>
	    </div>
			<h4 class="col-12 divider">EMD Return Receive</h4>
  		<div class="col-3 form-group">
	    	<label for="">Bank Name</label>
	    	<input type="text" class="form-control" name="emd">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Amount</label>
	    	<input type="text" class="form-control" name="amount"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Date</label>
	    		<input type="text" class="form-control datepicker" name="date"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Deposit Date</label>
	    		<input type="text" class="form-control datepicker" name="deposit_date"/>
	    </div>
			<div class="col-3 form-group">
	    	<label for="">Deposit Bank</label>
	    	<input type="text" class="form-control" name="emd">
	    </div>
	     <div class="col-3 form-group">
	    	<label for="">Deposit Location</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">-- Select Location --</option>
	    	</select>
	    </div>
	     <div class="col-3 form-group">
	    	<label for="">Responsibility Of</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">-- Select Employee --</option>
	    	</select>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Final Receipt in Hand</label>
	    	<input type="text" class="form-control" name="emd">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Closure</label>
	    	<input type="text" class="form-control" name="emd">
	    </div>
		</div>	
	</form>
</div>
<style>
	.divider{
		border-bottom: solid 1px #c7c4c4;
    padding-bottom: 14px;
    margin-bottom: 16px;
	}
	.border_2{
		border:2px solid #ced4da !important;
	}
</style>
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
