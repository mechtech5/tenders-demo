<div id="details_tab">
	<form id="responsibilities_tab_form">
		<div class="row">
		    <div class="col-3 form-group">
		    	<label for="">Synopsis Creation</label>
		    	<select name="synopsis_id" id="" class="select2 form-control">
		    		<option value="">-- Select Employee --</option>
		    		@foreach($responsi as $res)
		    			<option {{ $tender->responsibl ? ($tender->responsibl->synopsis_id ? $tender->responsibl->synopsis_id :''):'' == $res->id ? 'selected':''}} value="{{$res->id}}">{{$res->name}}</option>
		    		@endforeach	
		    	</select>
		    </div>
		    <div class="col-3 form-group">
		    	<label for="">Tender Filling	</label>
		    	<select name="filling_id" id="" class="select2 form-control">
		    		<option value="">-- Select Employee --</option>
		    		@foreach($responsi as $res)
		    			<option {{$tender->responsibl ? ($tender->responsibl->filling_id ? $tender->responsibl->filling_id : ''):'' == $res->id ? 'selected':''}} value="{{$res->id}}">{{$res->name}}</option>
		    		@endforeach	
		    	</select>
		    </div>
		    <div class="col-3 form-group">
	    	<label for="">Market Survey</label>
	    	<select name="market_survey_id" id="" class="select2 form-control">
		    		<option value="">-- Select Employee --</option>
		    		@foreach($responsi as $res)
		    			<option {{$tender->responsibl ? ($tender->responsibl->market_survey_id ? $tender->responsibl->market_survey_id:''):'' == $res->id ? 'selected':''}} value="{{$res->id}}">{{$res->name}}</option>
		    		@endforeach	
		    	</select>
		    </div>
		    <div class="col-3 form-group">
		    	<label for="">Rate Aanalysis</label>
		    	<select name="rate_analysis_id" id="" class="select2 form-control">
		    		<option value="">-- Select Employee --</option>
		    		@foreach($responsi as $res)
		    			<option {{$tender->responsibl ? ($tender->responsibl->rate_analysis_id ? $tender->responsibl->rate_analysis_id :''):'' == $res->id ? 'selected':''}} value="{{$res->id}}">{{$res->name}}</option>
		    		@endforeach	
		    	</select>
		    </div>
		</div>
		<input type="hidden" name="update_id" value="{{$tender->responsibl ? ($tender->responsibl->id ? $tender->responsibl->id:''):''}}">
		<input type="hidden" name="tender_id" value="{{$tender_id}}">
		<input type="hidden" value="responsibilites" name="form_type">
		<div class="row">
			<div class="col-sm-12 text-center">
				<input type="submit" name="submit" value="Submit" class="btn btn-primary">
			</div>	
		</div>
	</form>
</div>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script> 

$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#responsibilities_tab_form");

form.validate({   
    rules: {
		synopsis_id:{
			required: true,
		},
		filling_id:{
			required:true,
		},
		market_survey_id:{
			required: true
		},
		rate_analysis_id:{
			required: true
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
        $.ajax({
             url: "/tender_details",
             type: 'POST',
             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
             data: $('#responsibilities_tab_form').serialize(),
             success: function (data) {
             	$('.notify-sect').notify(data,'success');
             	$('html,body').animate({scrollTop: 0}, 1500);
             	window.setTimeout(function(){location.reload()},4000)
            }
       })
    }
                      
});

</script>
