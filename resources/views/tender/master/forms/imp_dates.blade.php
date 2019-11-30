
	<?php
		$timestamp   = strtotime($tender->online_submission_date);
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
		   		<input type="text" placeholder="Select Date"  readonly="true" class="form-control datepicker" name="online_submission_date" value="{{$tender->online_submission_date ? $online_date :''}}">
		   	</div>	
	    	<div class="col-md-2 col-sm-2">
	    		<label for="" class="pull-right"><b>Time</b></label>
	    	</div>
	    	<div class="col-md-3 col-sm-3">
	    		<input placeholder="Select time" value="{{$tender->online_submission_date ? $online_time :''}}" name="online_time" type="text" class="form-control timepicker">
	    	</div>	
        </div>
	    <div class="row  mt-2">
	    	<div class="col-md-4 col-sm-4">
	    		<label for="" class=""><b>Tender last submission Date physical (Hard Copy)</b></label>
	    	</div>
	    	<div class="col-md-3 col-sm-3">
	    		<input type="text"  readonly="true" placeholder="Select Date" class="form-control datepicker " name="physical_submission_date" value="{{$tender->physical_submission_date ? $physical_date :''}}">
	    	</div>	
	    	<div class="col-md-2 col-sm-2">
	    		<lable class="pull-right"><b>Time</b></lable>
	    	</div>
	    	<div class="col-md-3 col-sm-3">	    		
				<input placeholder="Select time" value="{{$tender->physical_submission_date ? $physical_time :''}}" name="physical_time" type="text" class="form-control timepicker">
			</div>
	    </div>
	    <div class="row mt-2">
	    	<div class="col-sm-4 col-md-4">
	    		<label for="" class=""><b>Tender opening technical Date & Time</b></label>
	    	</div>
	    	<div class="col-sm-3 col-md-3">
	    		<input type="text" readonly="true" placeholder="Select Date" class="form-control datepicker" name="technical_opening_date" value="{{$tender->technical_opening_date ? $technical_date :''}}">
	    	</div>
	    	<div class="col-sm-2 col-md-2">	
	    		<lable class="pull-right"><b>Time</b></lable>
	    	</div>
	    	<div class="col-sm-3 col-md-3">
	    		<input type="text" placeholder="Select Time" class="form-control timepicker " value="{{ $tender->technical_opening_date ? $technical_time :''}}" name="technical_time">
	    	</div>	 
	    </div>
	    <div class="row mt-2">
	    	<div class="col-md-4 col-sm-4">
	    		<label for="" class=""><b>Tender opening financial Date & Time</b></label>
	    	</div>
	    	<div class="col-sm-3 col-md-3">
	    		<input type="text" placeholder="Select Date"  readonly="true" class="form-control datepicker" name="financial_opening_date" value="{{$tender->financial_opening_date ? $financial_date :''}}">
	    	</div>
	    	<div class="col-md-2 col-sm-2">
	    		<label class="pull-right"><b>Time</b></label>
	    	</div>
	    	<div class="col-md-3 col-sm-3">
	    		<input type="text" placeholder="Select Time" class="form-control timepicker" value="{{$tender->financial_opening_date ? $financial_time:''}}" name="financial_time">
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
		    				<input type="text" value="" class="form-control" name="title[]"/>
		    			</div>	    			
		    		</div>
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Date</label>
		    				<input type="text" readonly="true" placeholder="Select Date" value="" class="form-control datepicker" name="date[]"/>
		    			</div>
		    		</div>
		    		<div class="col-md-4 col-sm-4">
		    			<div class="form-group">
		    				<label for="">Time</label>
		    				<input type="text" value="" class="form-control timepicker" placeholder="Select Time" name="time[]"/>
		    			</div>
		    		</div>	    		
		    	</div>	    				    
		    </div>
		@endforelse
	</div>
	<div class="field_wrapper"></div>	
    <div class="row">
		<div class="col-sm-12 col-md-12 text-center mt-3">
			<button id="submit_date_form" class="btn btn-primary">Submit</button>
		</div>
    </div>
    <input type="hidden" name="tender_id" id="tender_id" value="{{$tender_id}}">
	</form>


	<div class="row">
		<h4 class="col-12 divider pb-2 mt-3" style="border-bottom: 1px solid #c7c4c4">Corrigendum</h4>				
	</div>
		<div id="details_tab">
			<form id="add_form" class="d-none" enctype="multipart/form-data">
				<div class="row">
					<div class="col-3 form-group">
			    		<label for="">Date</label>
			    		<input type="text" readonly="true" class="form-control datepicker" name="date"/>
			    	</div>
			    	<div class="col-3 form-group">
			    		<label for="">Time</label>
			    		<input type="text" class="form-control timepicker" name="time"/>
			    	</div>
			    </div>
			    <div class="row">
			    	<div class="col-12">
			    		<div class="form-group">
			    			<label for="">Changes in Term</label>
			    			<textarea name="changes" class="form-control" id="" cols="30" rows="5"></textarea>
			    		</div>
			    	</div>
				</div>
				<div class="row">
					<dir class="col-md-4">
						<input type="file" class="form-control" name="file">
					</dir>							
				</div>
				<input type="hidden" name="form_type" value="corrigendum">
				<input type="hidden" name="tender_id" id="tender_id" value="{{$tender_id}}" name="tender_id">
				<a href="javascript:void(0)" class="btn btn-danger mt-2 mb-2 ml-2 pull-right cancel d-none" onclick="cancel()">Cancel</a>
				<input type="submit" value="Save" class="btn btn-success mt-2 mb-2 pull-right save d-none">
			</form>
			<a href="javascript:void(0)" class="btn btn-info mt-2 mb-2 pull-right add"  onclick="add()">Add</a>
			
			<div id="corrig_table">
				<table class="table table-striped table-hover table-bordered">
				  <thead class="thead-dark">
				    <tr>
				      <th>#</th>
				      <th>Date Time</th>
				      <th>Changes in Terms</th>
				      <th class="text-center">Actions</th>
				    </tr>
				  </thead>
				  <tbody id="table_corrige">
			  		<?php $count = 0; ?>
		  				@foreach($tender->corrigendums as $corrigend)
					  		<tr>
					  			<td>{{ ++$count }}</td>
					  			<td>{{ $corrigend->date }}</td>
					  			<td>{{ $corrigend->changes }}</td>
					  			<td class="text-center">
					  				<a style="color: #fff" href="{{Storage::url('public/'.$tender->tender_no.'/Corrigendum/'.$corrigend->file)}}" runat="server" class="fa fa-download btn btn-primary" rel="tooltip" title="" data-original-title="Edit"></a>
					  				<a style="color: #fff" data-id="{{$corrigend->id}}" runat="server" class="fa fa-edit btn btn-success edit_corrige" rel="tooltip" title="" data-original-title="Edit"></a>
						            <a style="color: #fff" data-id="{{$corrigend->id}}" onclick="javascript:return confirm('Do You Really Want To Delete This?');" class="fa fa-times btn btn-danger corrige_delete" rel="tooltip" title="" data-original-title="Delete"></a>
					  			</td>
					  		</tr>
					  	@endforeach
				  </tbody>
				</table>
			</div>	
		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Update Meeting Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form id="u_corri_form" enctype='multipart/form-data'>
		        	<div class="row">
						<div class="col-md-3 col-sm-3">
							<label>Date</label>
						</div>
						<div class="col-md-8 col-sm-8">
							<input readonly="true" id="c_date" class="form-control datepicker">
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-3">
							<label>Time</label>
						</div>
						<div class="col-md-8 col-sm-8 mt-3">
							<input id="c_time" class="form-control timepicker">
						</div>
					</div>
					<div class="row mt-3">	
						<div class="col-md-3 col-sm-3">
							<label>Changes</label>
						</div>
						<div class="col-md-8 col-sm-8">
							<input id="c_changes" class="form-control">
						</div>
		        	</div>
		        	<div class="row mt-3">	
						<div class="col-md-3 col-sm-3">
							<label>File</label>
						</div>
						<div class="col-md-8 col-sm-8">
							<input type="file" class="form-control" name="file">
						</div>
		        	</div>
		        								
				</div>       	
		      </div>
		      <input type="hidden" id="c_id">
		      <input type="hidden" id="c_tender_id">
		      <input type="hidden" id="message" value="<?php if(session('message')!= ''){ echo session('message'); } ?>">
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" id="c_submit" class="btn btn-primary">Save changes</button>
		      </div>
		  </form>
		    </div>
		  </div>  
		</div>
	</div>
<script>


	$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#date_form");

form.validate({   
    rules: {
		online_submission_date:{
			required: true,
			date: true,      		
		},
		physical_submission_date:{
			required: true, 	
			date: true, 	
		},
		technical_opening_date:{
			required: true,
			date: true,      		
		},
		financial_opening_date:{
			required: true,
			date: true,      		
		},
		physical_time:{
			required: true,
			time24:true
		},
		technical_time:{
			required: true,
			time24:true
		},
		online_time:{
			required: true,
			time24:true
		},
		financial_time:{
			required: true,
			time24:true
		}
    },
	messages: {
	},
	errorElement: "em",
	errorPlacement: function errorPlacement(error, element) { 
		element.after(error);
		error.addClass( "help-block" );

	 },
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
	},
	unhighlight: function (element, errorClass, validClass) {
		$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
	},
	submitHandler: function (form) {
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
    }
});

$.validator.addMethod("time24", function(value, element) { 
    return /^([01]?[0-9]|2[0-3])(:[0-5][0-9]){2}$/.test(value);
}, "Invalid time format.");
	
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
			
		})

	    var maxField = 3; 	    
	    var wrapper = $('.field_wrapper');	    
		var crut =$(".count_div > div").length;
	    var x = 1;
	    if(crut !=0 ){
	    	x = crut;
	    } 
	    var fieldHTML = '<div class="multi_rows"><a style="color:#ffffff;margin-top:31px" class="remove_button fa fa-minus pull-right btn btn-danger"></a><div class="row remov_paren"><div class="col-md-4 col-sm-4"><div class="form-group"><label for="">Date Type</label>	<input type="text" class="form-control" name="title[]"/></div></div><div class="col-md-4 col-sm-4"><div class="form-group"><label for="">Date</label><input type="text" class="form-control datepicker1" placeholder="Select Date" readonly="true" name="date[]"/></div></div><div class="col-md-4 col-sm-4"><div class="form-group"><label for="">Time</label><input type="text" placeholder="Select Time" class="form-control timepicker" name="time[]"/></div></div></div></div>	</div>'; 
	    
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
	$(document).on('click','#myCheckbox',function(){
		toggle_btn('#myCheckbox','.show_file');
	})	
//*******************//*********************//***********************//*********************//
//*******************//*********************//************************//********************//

$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#add_form");

form.validate({   
    rules: {
		changes:{
			required: true,
      		
		},
		date:{
			required:true,
		},
		time:{
			required: true,     		
		}
    },
	messages: {
	},
	errorElement: "em",
	errorPlacement: function errorPlacement(error, element) { 
		element.after(error);
		error.addClass( "help-block" );

	 },
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
	},
	unhighlight: function (element, errorClass, validClass) {
		$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
	},
	submitHandler: function (form) {
		var form = $('#add_form')[0];
		var data = new FormData(form);	
		$.ajax({
			url:'/tender_details',
			type:'POST',			
			processData: false,
			contentType: false,
			enctype: 'multipart/form-data',
			dataTyte: 'json',
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
			data:data,
			success:function(data){
				if(data !=''){
					$('#table_corrige').html(data)
					$("input[name='date']").val('');
					$("input[name='time']").val('');
					$("textarea[name='changes']").val('');
				}
			}
		})
	}
                      
});

	$(document).ready(function(){

		$('.timepicker').datetimepicker({
        	format: 'HH:mm:ss'
    	}); 
    	
		$('.datepicker').datepicker({
			orientation: "bottom",
			format: "yyyy-mm-dd",
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

	$(document).on('click','.edit_corrige',function(){
		var id = $(this).attr('data-id');
			$.ajax({
				url:'/update_meeting',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{id:id,type:'corrige_model'},
				success:function(data){
					var parsed_result = JSON.parse(data);  //parsing here
            		for (var key in parsed_result){					    
					    $('#c_date').val(parsed_result['date']);
					    $('#c_changes').val(parsed_result['changes']);
					    $('#c_id').val(parsed_result['id']);
					    $('#c_time').val(parsed_result['time']);					    
					    $('#c_tender_id').val(parsed_result['tender_id']);
					}
					$('#exampleModal').modal('show')
				}
		})		
	})

	$(document).on('click','#c_submit',function(){
		var id        = $('#c_id').val();
		var date      = $('#c_date').val();
		var time      = $('#c_time').val();
		var changes   = $('#c_changes').val();
		var tender_id = $('#c_tender_id').val();
		alert(tender_id);
			$.ajax({
				url:'/update_meeting',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{id:id,date:date,time:time,changes:changes,tender_id:tender_id,type:'save_data_corrige'},
				success:function(data){
					$('#exampleModal').modal('hide')
					$('#table_corrige').html(data)
					$('.notify-sect').notify($('#message').val(),'success');
				}
		})		
	})

	$(document).on('click','.corrige_delete',function(){
		var tender_id  = $('#tender_id').val();
		var id         = $(this).attr('data-id');

		$.ajax({
			url:'/delete_reco',
			type:'POST',
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
			data:{id:id,tender_id:tender_id,type:'corrige_delete'},
			success:function(data){
				$('#table_corrige').html(data)			
			}
		})		
	})

</script>
