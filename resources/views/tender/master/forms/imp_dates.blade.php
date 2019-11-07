	<?php
		$timestamp   = (strtotime($tender->online_submission_date));
		$online_date = date('Y-n-j', $timestamp);
		$online_time = date('H:i:s', $timestamp);

		$timestamp     = (strtotime($tender->physical_submission_date));
		$physical_date = date('Y-n-j', $timestamp);
		$physical_time = date('H:i:s', $timestamp);

		$timestamp      = (strtotime($tender->technical_opening_date));
		$technical_date = date('Y-n-j', $timestamp);
		$technical_time = date('H:i:s', $timestamp);

		$timestamp      = (strtotime($tender->financial_opening_date));
		$financial_date = date('Y-n-j', $timestamp);
		$financial_time = date('H:i:s', $timestamp);
	?>

	<form id="date_form">
		<div class="row ">
		  	<div class="col-md-4 col-sm-4">
		   		<label for=""><b>Tender last submission Date online</b></label>
		   	</div>	
		   	<div class="col-md-3 col-sm-3">
		   		<input type="text"  readonly="true" class="form-control datepicker" name="online_submission_date" value="{{$online_date}}">
		   	</div>	
	    	<div class="col-md-2 col-sm-2">
	    		<label for="" class="pull-right"><b>Time</b></label>
	    	</div>
	    	<div class="col-md-3 col-sm-3">
	    		<input placeholder="Selected time" value="{{$online_time}}" name="online_time" type="text" id="timepicker" class="form-control">
	    	</div>	
        </div>
	    <div class="row  mt-2">
	    	<div class="col-md-4 col-sm-4">
	    		<label for="" class=""><b>Tender last submission Date physical (Hard Copy)</b></label>
	    	</div>
	    	<div class="col-md-3 col-sm-3">
	    		<input type="text"  readonly="true" class="form-control datepicker " name="physical_submission_date" value="{{$physical_date}}">
	    	</div>	
	    	<div class="col-md-2 col-sm-2">
	    		<lable class="pull-right"><b>Time</b></lable>
	    	</div>
	    	<div class="col-md-3 col-sm-3">	    		
				<input placeholder="Selected time" value="{{$physical_time}}" name="physical_time" type="text" id="timepicker" class="form-control">
			</div>
	    </div>
	    <div class="row mt-2">
	    	<div class="col-sm-4 col-md-4">
	    		<label for="" class=""><b>Tender opening technical Date & Time</b></label>
	    	</div>
	    	<div class="col-sm-3 col-md-3">
	    		<input type="text" readonly="true" class="form-control datepicker" name="technical_opening_date" value="{{$technical_date}}">
	    	</div>
	    	<div class="col-sm-2 col-md-2">	
	    		<lable class="pull-right"><b>Time</b></lable>
	    	</div>
	    	<div class="col-sm-3 col-md-3">
	    		<input type="text" class="form-control" value="{{$technical_time}}" name="technical_time">
	    	</div>	
	    </div>
	    <div class="row mt-2">
	    	<div class="col-md-4 col-sm-4">
	    		<label for="" class=""><b>Tender opening financial Date & Time</b></label>
	    	</div>
	    	<div class="col-sm-3 col-md-3">
	    		<input type="text"  readonly="true" class="form-control datepicker" name="financial_opening_date" value="{{$financial_date}}">
	    	</div>
	    	<div class="col-md-2 col-sm-2">
	    		<label class="pull-right"><b>Time</b></label>
	    	</div>
	    	<div class="col-md-3 col-sm-3">
	    		<input type="text" class="form-control" value="{{$financial_time}}" name="financial_time">
	    	</div>
	    </div>
	    <div class="row">
			<div class="col-sm-12 col-md-12 text-center mt-3">
				<button id="submit_date_form" class="btn btn-primary">Submit</button>
			</div>
	    </div>
	    <input type="hidden" name="tender_id" value="{{$tender_id}}">
	</form>
</div>

<script>
	$(document).ready(function(){
		//  $(function(){
	 //    	$('#datetimepicker3').datetimepicker({
	 //        	format: 'HH:mm:ss',      
		//     });
		// });

		$('.datepicker').datepicker({
			orientation: "bottom",
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
		});

		$('#submit_date_form').on('click',function(event){
			event.preventDefault();
			var data = $('#date_form').serializeArray();
			data.push({name:'form_type',value:'data_subm'});
			$.ajax({
				url:'/tender_details',
				type:'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data:data,
				success:function(data){
					$('.notify-sect').notify(data,'success');
				}
			})
		})
	});

	// function toggle_add(){
	// 	$(".myForm, .add, .save, .cancel").toggleClass('d-none');
	// }

	// function save(){
	// }
</script>
