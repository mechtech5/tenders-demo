<script src="{{ asset('js/jquery.validate.js') }}"></script>
<div id="details_tab">
	<form id="details_emd_form">
		<div class="row">
			<h4 class="col-12 divider">EMD Creation</h4>
	    <div class="col-3 form-group">
	    	<label for="">EMD Made from A/c No</label>
	    	<br>
	    	<input type="text" class="form-control" value="{{$tender->emd !=null ? $tender->emd->tender_emd_ac : ''}}" name="tender_emd_ac">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Type</label>
	    	<div class="input-group ">
				<div class="btn-group radio-inline ">
					<label id="enabled_1" class="border_2 btn btn-default border bg-white">
						<input type="radio" name="tender_emd_type" {{ $tender->emd !=null ? ($tender->emd->tender_emd_type == 'dd' ? 'checked' :'' ) : ''}} value="dd" id="" >
						<span class="radiotext">DD</span>
					</label>
					<label id="req_approval_0" class="border_2 btn btn-default border bg-white">
						<input type="radio" {{ $tender->emd !=null ? ($tender->emd->tender_emd_type == 'bg' ? 'checked' :'' ) : ''}} name="tender_emd_type" value="bg" id=""  >
						<span class="radiotext" >BG</span>
					</label>
						<label id="req_approval_0" class="border_2 btn btn-default border bg-white">
						<input type="radio" {{ $tender->emd !=null ? ($tender->emd->tender_emd_type == 'fd' ? 'checked' :'' ) : ''}} name="tender_emd_type" value="fd" id=""  >
						<span class="radiotext" >FD</span>
					</label>
				</div>
			</div>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Bank Name</label>
	    	<input type="text" class="form-control" value="{{$tender->emd !=null ? $tender->emd->tender_emd_bank_name :''}}" name="tender_emd_bank_name">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Amount</label>
	    	<input type="text" class="form-control" value="{{$tender->emd !=null ? $tender->emd->tender_emd_amt :''}}" name="tender_emd_amt"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Date of creation</label>
	    		<input type="text" value="{{$tender->emd !=null ? $tender->emd->tender_emd_creat_dt :''}}" class="form-control datepicker" name="tender_emd_creat_dt"/>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Creation place</label>
	    	<select name="tender_emd_creat_place" id="" class="select2 form-control">
	    		<option value="">-- Select place --</option>
	    			@foreach($location as $loc)
						<option {{$tender->emd !=null ? ($tender->emd->tender_emd_creat_place == $loc->id ? 'selected' : '') :''}} value="{{$loc->id}}">{{$loc->name}}</option>	    		
					@endforeach	
	    	</select>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Renewal Date</label>
	    		<input value="{{$tender->emd !=null ? $tender->emd->tender_emd_renable_dt :''}}" readonly="true" type="text" class="form-control datepicker" name="tender_emd_renable_dt"/>
	    </div>
	     <div class="col-3 form-group">
	    	<label for="">Expiry Date</label>
	    		<input type="text" value="{{$tender->emd !=null ? $tender->emd->tender_emd_exp_dt :''}}" class="form-control datepicker" name="tender_emd_exp_dt"/>
	    </div>


	    <h4 class="col-12 divider">EMD Submition</h4>
  		<div class="col-3 form-group">
	    	<label for="">Client Name</label>
	    	<input type="text" value="{{$tender->emd !=null ? $tender->emd->tender_emd_sub_client :''}}" class="form-control" name="tender_emd_sub_client">
	    </div>	

	    <div class="col-3 form-group">
	    	<label for="">Person Name</label>
	    		<input type="text" value="{{$tender->emd !=null ? $tender->emd->tender_emd_sub_person :''}}" class="form-control" name="tender_emd_sub_person"/>
	    </div>    
	    <div class="col-3 form-group">
	    	<label for="">Date</label>
	    		<input type="text" value="{{$tender->emd !=null ? $tender->emd->tender_emd_sub_date:''}}" readonly="true" class="form-control datepicker" name="tender_emd_sub_date"/>
	    </div>
	     <div class="col-3 form-group">
	    	<label for="">Location Name</label>
	    	<select name="tender_emd_sub_loc" id="" class="select2 form-control">
	    		<option>-- Select Location --</option>
	    		@foreach($location as $loc)
						<option {{$tender->emd !=null ? ($tender->emd->tender_emd_sub_loc == $loc->id ? 'selected' : '') :''}} value="{{$loc->id}}">{{$loc->name}}</option>	    		
					@endforeach
	    	</select>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Submited By</label>
	    	<select name="tender_emd_sub_by" id="" class="select2 form-control">
	    		<option value="">-- Select Employee --</option>
	    		@foreach($responsi as $res)
	    			<option {{ $tender->emd ?($tender->emd->tender_emd_sub_by ? $tender->emd->tender_emd_sub_by :''):'' == $res->id ? 'selected' :''}} value="{{$res->id}}">{{$res->name}}</option>
	    		@endforeach
	    	</select>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Submited To</label>
	    	<select name="tender_emd_sub_to" id="" class="select2 form-control">
	    		<option value="">-- Select Employee --</option>
	    		@foreach($responsi as $res)
	    			<option {{$tender->emd ?($tender->emd->tender_emd_sub_to ? $tender->emd->tender_emd_sub_to :''):'' == $res->id ? 'selected' :''}} value="{{$res->id}}">{{$res->name}}</option>
	    		@endforeach
	    	</select>
	    </div>

			<h4 class="col-12 divider">Return</h4>
	    <div class="col-3 form-group">
	    	<label for="">Deposit Date</label>
	    		<input type="text" value="{{$tender->emd !=null ? ($tender->emd->tender_emd_return_date ? $tender->emd->tender_emd_return_date :''):''}}" class="form-control datepicker" name="tender_emd_return_date"/>
	    </div>   
	     <div class="col-3 form-group">
	    	<label for="">Further Submitted To</label>
	    	<input type="" class="form-control" value="{{$tender->emd !=null ? $tender->emd->tender_emd_return_furthe :''}}" name="tender_emd_return_furthe">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Received To</label>
	    	<select name="tender_emd_return_recei" id="" class="select2 form-control">
	    		<option value="">-- Select Employee --</option>
	    		@foreach($responsi as $res)
	    			<option {{$tender->emd ?($tender->emd->tender_emd_return_recei ? $tender->emd->tender_emd_return_recei :''):'' == $res->id ? 'selected' :''}} value="{{$res->id}}">{{$res->name}}</option>
	    		@endforeach
	    	</select>
	    </div>	
	     <div class="col-3 form-group">
	    	<label for="">Deposit Location</label>
	    	<select name="tender_emd_return_depo_loc" id="" class="select2 form-control">
	    		<option>-- Select Location --</option>
	    		@foreach($location as $loc)
						<option {{$tender->emd !=null ? ($tender->emd->tender_emd_return_depo_loc == $loc->id ? 'selected' : '') :''}} value="{{$loc->id}}">{{$loc->name}}</option>	    		
					@endforeach
	    	</select>
	    </div>     

	    <h4 class="col-12 divider">Closure</h4>
	    <div class="col-3 form-group">
	    	<label for="">Submitted Bank</label>
	    		<input type="text" value="{{$tender->emd !=null ? $tender->emd->tender_emd_clos_bnk :''}}" class="form-control" name="tender_emd_clos_bnk"/>
	    </div>   
	      <div class="col-3 form-group">
	    	<label for="">Location</label>
	    	<select name="tender_emd_clos_loc" id="" class="select2 form-control">
	    		<option>-- Select Location --</option>
	    		@foreach($location as $loc)
						<option {{$tender->emd !=null ? ($tender->emd->tender_emd_clos_loc == $loc->id ? 'selected' : '') :''}} value="{{$loc->id}}">{{$loc->name}}</option>	    		
					@endforeach
	    	</select>
	    </div>
	     <div class="col-3 form-group">
	    	<label for="">Date</label>
	    	<input type="" class="form-control datepicker" value="{{$tender->emd !=null ? ($tender->emd->tender_emd_clos_dt ? $tender->emd->tender_emd_clos_dt :''):''}}"  name="tender_emd_clos_dt">
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Submited By</label>
	    	<select name="tender_emd_clos_sbmt_by" id="" class="select2 form-control">
	    		<option value="">-- Select Employee --</option>
	    		@foreach($responsi as $res)
	    			<option {{$tender->emd ?($tender->emd->tender_emd_clos_sbmt_by ? $tender->emd->tender_emd_clos_sbmt_by :''):'' == $res->id ? 'selected' :''}} value="{{$res->id}}">{{$res->name}}</option>
	    		@endforeach
	    	</select>
	    </div>	

	    <div class="col-3 form-group">
	    	<label for="">Final Receipt in Hand</label>
	    	<input type="file" class="form-control" name="tender_emd_return_receipt">
	    </div>	 

		</div>	
		<div class="row ">
			<div class="col-md-12 col-sm-12 text-center">
				<input type="submit" value="Submit"  class="btn btn-primary" id="emd_form" name="submit">
			</div>
		</div>
		<input type="hidden" value="{{$tender->emd !=null ? $tender->emd->id :''}}" name="update_id">
		<input type="hidden" name="form_type" value="emd_form">
		<input type="hidden" name="tender_id" value="{{$tender_id}}">
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
	$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#details_emd_form");

form.validate({   
    rules: {
		tender_emd_ac:{
			required: true,
			number: true,      		
		},
		tender_emd_type:{
			required: true, 		
		},
		tender_emd_bank_name:{
			required: true     		
		},
		tender_emd_amt:{
			required: true,
			number: true,      		
		},
		tender_emd_creat_dt:{
			required: true,
			date: true,      		
		},
		tender_emd_creat_place:{
			required: true,    		
		},
		tender_emd_renable_dt:{
			required: true,
			date: true,      		
		},
		tender_emd_exp_dt:{
			required: true,
			date: true,      		
		},
		tender_emd_return_depo_dt:{
			required: true,
			date: true,      		
		},
		tender_emd_return_depo_loc:{
			required: true,    		
		},
		tender_emd_sub_client:{
			required: true,    		
		},
		tender_emd_sub_person:{
			required: true,    		
		},
		tender_emd_sub_date:{
			required: true,    	
			date:true	
		},
		tender_emd_sub_loc:{
			required: true,    				
		},
		tender_emd_sub_by:{
			required: true,  
		},
		tender_emd_sub_to:{
			required: true,  
		},
		tender_emd_return_date:{
			required: true,  
		},
		tender_emd_return_furthe:{
			required: true,  
		},
		tender_emd_clos_bnk:{
			required: true,  
		},
		tender_emd_clos_loc:{
			required: true,  
		},
		tender_emd_clos_dt:{
			required: true,  
		},
		tender_emd_clos_sbmt_by:{
			required: true,  
		},
		tender_emd_return_receipt:{
			required: true,  
		},

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
      
		var data1 = $('#details_emd_form')[0];
		var data = new FormData(data1);			
		
		$.ajax({
			url:'/tender_details',
			type:'POST',
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			enctype: 'multipart/form-data',
			data:data,
			processData: false,
			contentType: false,
			success:function(data){
				$('.notify-sect').notify(data,'success');
			}
		})
    }
});


	$(document).ready(function(){
		$('.datepicker').datepicker({
			orientation: "bottom",
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
		});
	})



	function add_client(){
		$(".add_client").toggleClass('d-none');
		$(".save_client, .add_client_div, .cancel_save_client").toggleClass('d-none');
	}

	function cancel_save_client(){
		$(".add_client").toggleClass('d-none');
		$(".save_client, .add_client_div, .cancel_save_client").toggleClass('d-none');
	}


</script>
