<div id="details_tab">
	<form id="add_meeting_form" class="d-none">
		<div class="row">
			<div class="col-3 form-group">
		    	<label for="">Meeting Location</label>
		    	<input type="text" class="form-control" name="location"/>
		    </div>
			<div class="col-3 form-group">
		    	<label for="">Meeting date</label>
		    	<input type="text" class="form-control datepicker" readonly="true" name="date"/>
		    </div>
		    <div class="col-3 form-group">
		    	<label for="">Meeting Time</label>
		    	<input type="text" class="form-control timepicker" name="time"/>
		    </div>

	    </div>		
	    <div class="col-12">
	    	<div class="form-group">
	    		<label for="">Minutes Of Meeting</label>
	    		<textarea name="minutes_of_meeting" class="form-control" id="" cols="30" rows="5"></textarea>
	    	</div>
	    </div>

	    <div class="col-12">
	    	<div class="form-group">
	    		<label for="">Meeting Remarks and Conclusions</label>
	    		<textarea name="remarks" class="form-control" id="" cols="30" rows="5"></textarea>
	    	</div>
	    </div>

		<input type="hidden" id="tender_id" name="tender_id" value="{{$tender_id}}">
		 <a href="javascript:void(0)" class="btn btn-danger mr-1 mt-2 mb-2 ml-2 pull-right cancel_add_meeting d-none" onclick="cancel_add_meeting()">Cancel</a>
	    <input class="btn btn-success mt-2 mb-2 pull-right save_meeting d-none" value="Save" type="submit">	   
	</form>
</div>
	
<a href="javascript:void(0)" class="btn btn-info mt-2 mb-2 pull-right add_meeting"  onclick="add_meeting()">Add</a>
	
	<div id="table_refresh">
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
		  <tbody>
		  	<?php $count = 0; ?>
		  	@foreach($tender->prebids as $prebids)
		  		<tr>
		  			<td>{{++$count}}</td>
		  			<td>{{$prebids->date}}</td>
		  			<td>{{$prebids->location}}</td>
		  			<td>{{$prebids->remarks}}</td>
		  			<td class="text-center">
		  				<a style="color: #fff" data-id="{{$prebids->id}}" runat="server" class="fa fa-edit btn btn-success edit_meeting" rel="tooltip" title="" data-original-title="Edit"></a>
	                    <a style="color: #fff" data-id="{{$prebids->id}}" onclick="javascript:return confirm('Do You Really Want To Delete This?');" class="fa fa-times btn btn-danger meeting_delete" rel="tooltip" title="" data-original-title="Delete"></a>
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
        	<div class="row">
				<div class="col-md-4 col-sm-4">
					<label>Meeting Location</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<input id="m_location" class="form-control">
				</div>
			</div>
			<div class="row mt-3">	
				<div class="col-md-4 col-sm-4">
					<label>Meeting Date</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<input id="m_date" class="form-control datepicker">
				</div>
        	</div>
        	<div class="row mt-3">	
				<div class="col-md-4 col-sm-4">
					<label for="">Meeting Time</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<input type="text" id="m_time" class="form-control timepicker"/>
				</div>
        	</div>
        	<div class="row mt-3">	
				<div class="col-md-4 col-sm-4">
					<label>Minutes Of Meeting</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<textarea id="m_minutes" name="" class="form-control"></textarea>
				</div>				
        	</div>
        	<div class="row mt-3">	
				<div class="col-md-4 col-sm-4">
					<label>Meeting Remarks</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<textarea id="m_remarks" name="" class="form-control"></textarea>
				</div>
				<input type="hidden" id="m_id">
				<input type="hidden" id="m_tender_id">
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="m_submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>  
</div>
<input type="hidden" id="message" value="<?php if(session('message') !='' ){ echo session('message'); } ?>">
<script>
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
	

$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#add_meeting_form");

form.validate({   
    rules: {
		location:{
			required: true,
      		
		},
		date:{
			required:true,
		},
		time:{
			required: true,     		
		},
		remarks:{
			required: true,
		},
		minutes_of_meeting:{
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
			var data = $('#add_meeting_form').serializeArray();
			data.push({name:'form_type',value:'prebid'});
			$.ajax({
					url:'/tender_details',
					type:'POST',
					headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
					data:data,
					success:function(data){
						if(data != ''){
							$('#table_refresh').html(data)
							$("input[name='location']").val('');
							$("input[name='date']").val('');
							$("input[name='time']").val('');
							$("textarea[name='remarks']").val('');	
							$("textarea[name='minutes_of_meeting']").val('');	

						}
					}
			})
	    }
                      
});

	function add_meeting(){
		$('#add_meeting_form, .save_meeting, .cancel_add_meeting, .add_meeting').toggleClass('d-none');
	}
	function cancel_add_meeting(){
		$('#add_meeting_form, .save_meeting, .cancel_add_meeting, .add_meeting').toggleClass('d-none');
	}

	$(document).on('click','.edit_meeting',function(){
		var id = $(this).attr('data-id');
			$.ajax({
				url:'/update_meeting',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{id:id,type:'model'},
				success:function(data){
					console.log(data)
					var parsed_result = JSON.parse(data);  //parsing here
            		for (var key in parsed_result){
					    $('#m_location').val(parsed_result['location'])
					    $('#m_date').val(parsed_result['date'])
					    $('#m_time').val(parsed_result['time'])
					    $('#m_remarks').val(parsed_result['remarks'])
					    $('#m_id').val(parsed_result['id'])
					    $('#m_tender_id').val(parsed_result['tender_id']);
					    $('#m_minutes').val(parsed_result['minutes_of_meeting']);
					}
					$('#exampleModal').modal('show')
				}
		})		
	})

	$(document).on('click','#m_submit',function(){
		var id        = $('#m_id').val();
		var location  = $('#m_location').val();
		var date      = $('#m_date').val();
		var time      = $('#m_time').val();
		var minutes   = $('#m_minutes').val();		 
		var remarks   = $('#m_remarks').val();
		var tender_id = $('#m_tender_id').val();		
			$.ajax({
				url:'/update_meeting',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{id:id,location:location,date:date,remarks:remarks,tender_id:tender_id,type:'save_data','minutes':minutes,'time':time},
				success:function(data){
					if(data['error'] != 'error'){
						$('#exampleModal').modal('hide')
						$('#table_refresh').html(data)
						$('.notify-sect').notify($('#message').val(),'success');
					}
					else{
						$('#exampleModal').modal('hide')
						$('.notify-sect').notify('Data Not Save','error');
					}
				}
		})		
	})

	$(document).on('click','.meeting_delete',function(){
		var tender_id  = $('#tender_id').val();
		var id         = $(this).attr('data-id');
		$.ajax({
			url:'/delete_reco',
			type:'POST',
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
			data:{id:id,tender_id:tender_id,type:'prebid_delete'},
			success:function(data){
				$('#table_refresh').html(data)			
			}
		})		
	})

</script>
