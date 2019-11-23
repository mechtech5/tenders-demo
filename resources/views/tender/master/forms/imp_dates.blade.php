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
	    		<input placeholder="Selected time" value="{{$online_time}}" name="online_time" type="text" class="form-control timepicker">
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
				<input placeholder="Selected time" value="{{$physical_time}}" name="physical_time" type="text" class="form-control timepicker">
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
	    		<input type="text" class="form-control timepicker " value="{{$technical_time}}" name="technical_time">
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
	    		<input type="text" class="form-control timepicker" value="{{$financial_time}}" name="financial_time">
	    	</div>
	    </div>
	    <div class="count_div">
	    <?php $count =1; ?>
		
	   	@forelse($other_date as $tender_date)

		    
		    	<?php if($count == 1){ ?>
	        	 	<a style="color:#ffffff ;margin-top:31px" class="btn btn-success pull-right add_button fa fa-plus"></a>
	        	
	        	 	<?php if($tender_date->title != '') { ?>
	        	 		<a delete-id="{{$tender_date->id }}"  style="color:#ffffff;margin-top:31px" class=" delete_reco remove_button fa fa-trash pull-right btn btn-danger"></a>
	        	 	<?php } ?>
	        	 <?php } else{ ?>
	        	 		<a delete-id="{{$tender_date->id }}" style="color:#ffffff;margin-top:31px" class="delete_reco remove_button fa fa-trash pull-right btn btn-danger"></a>
	        	<?php  } ?>
		    	<div class="multi_rows ">
		    	<div class="row remov_paren delete_row_{{$tender_date->id}}">
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Date Type</label>
		    				<input type="text" value="{{$tender_date->title}}"  class="form-control" name="title[]"/>
		    				<input type="hidden" name="update_id[]" value="{{$tender_date->id}}">
		    			</div>	    			
		    		</div>
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Date</label>
		    				<input type="text" readonly="true" value="{{$tender_date->date}}" class="form-control datepicker" name="date[]"/>
		    			</div>
		    		</div>
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Time</label>
		    				<input type="text" value="{{$tender_date->time}}" class="form-control timepicker" name="time[]"/>
		    			</div>
		    		</div>	    		
		    	</div>	    				    
		    </div>
		    <?php $count++; ?>
		    @empty
		    	<div class="multi_rows ">
		    	 	<a style="color:#ffffff ;margin-top:31px" class="btn btn-success pull-right add_button fa fa-plus"></a>
	        	
	        	<div class="row remov_paren ">
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Date Type</label>
		    				<input type="text" value=""  class="form-control" name="title[]"/>
		    			</div>	    			
		    		</div>
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Date</label>
		    				<input type="text" readonly="true" value="" class="form-control datepicker" name="date[]"/>
		    			</div>
		    		</div>
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Time</label>
		    				<input type="text" value="" class="form-control timepicker" name="time[]"/>
		    			</div>
		    		</div>	    		
		    	</div>	    				    
		    </div>
		    @endforelse
		    </div>
		    <div class="field_wrapper">
			    	
			</div>	

	    <div class="row">
			<div class="col-sm-12 col-md-12 text-center mt-3">
				<button id="submit_date_form" class="btn btn-primary">Submit</button>
			</div>
	    </div>
	    <input type="hidden" name="tender_id" id="tender_id" value="{{$tender_id}}">
	</form>
</div>

<script>
	
	$(document).ready(function(){
	 $('.timepicker').datetimepicker({        
	 	format:'hh:mm:ss',
    }); 
	 $(document).on('focus',".timepicker", function(){
	 	 $(this).datetimepicker({        
	 		format:'hh:mm:ss',
    		});
	 });


$(document).on('focus',".datepicker1", function(){
    $(this).datepicker({
    	orientation: "bottom",
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
    });
});
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

	    var maxField = 3; 	    
	    var wrapper = $('.field_wrapper');	    
		var crut =$(".count_div > div").length;
	    var x = 1;
	    if(crut !=0 ){
	    	x = crut;
	    } 
	    var fieldHTML = '<div class="multi_rows"><a style="color:#ffffff;margin-top:31px" class="remove_button fa fa-minus pull-right btn btn-danger"></a><div class="row remov_paren"><div class="col-md-4 col-sm-4"><div class="form-group"><label for="">Date Type</label>	<input type="text"  class="form-control" name="title[]"/></div></div><div class="col-md-4 col-sm-4"><div class="form-group"><label for="">Date</label><input type="text" class="form-control datepicker1" readonly="true" name="date[]"/></div></div><div class="col-md-4 col-sm-4"><div class="form-group"><label for="">Time</label><input type="text" class="form-control timepicker" name="time[]"/></div></div></div></div>	</div>'; 
	    
	    $('.add_button').click(function(){	 
	        if(x < maxField){ 
	            x++; 
	            $(wrapper).append(fieldHTML);
	            $('.multi_rows').attr('id',x)
	            $('.remove_button').attr('data-id',x)
	        }
	    });
	    
	    $(wrapper).on('click', '.remove_button', function(e){
	        e.preventDefault();
	        var id = $(this).attr('data-id');
	        $(this).parent('div').remove();
	        x--;
	    });


	    $('.delete_reco').on('click',function(){
		  	var	id = $(this).attr('delete-id');
		   	var tender_id = $('#tender_id').val();
		   	$(this).remove();		      	
	      	$.ajax({
                 url: "/delete_reco",
                 type: 'POST',
                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                 data: {id:id,tender_id:tender_id,type:'imp_date'},
                 success: function (data) {
                 	if(data == 0){
                 	 	location.reload()
                 	}
                 	else{
                 		$('.delete_row_'+id).parent('div').remove();
                 		$('.delete_notify').notify('Successfully Deleted','success');
                 	}            
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
