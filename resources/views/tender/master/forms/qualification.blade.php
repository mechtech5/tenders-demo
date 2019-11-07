<div id="qualification">
	<form id="qualification_tab_form">
		<div class="row">
	    <div class="col-3 form-group">
	    	<label for="">Tender Allotment Status</label>
	    	<select name="allotment_status" id="allotment_status" class="select2 form-control">
	    		<option value="">-- Select Status --</option>
	    		<option {{ $tender->allotment_status == 'L1' ? 'selected':'' }} value="L1">L1</option>
	    		<option {{ $tender->allotment_status == 'L2' ? 'selected':'' }} value="L2">L2</option>
	    		<option {{ $tender->allotment_status == 'L3' ? 'selected':'' }} value="L3">L3</option>
	    		<option {{ $tender->allotment_status == 'L4' ? 'selected':'' }} value="L4">L4</option>
	    	</select>
	    </div>
		</div>
		<input type="hidden" id="tender_id" name="tender_id" value="{{$tender_id}}">
		<input type="submit" id="quali_submit" value="Submit" class="btn btn-primary" >
	</form>
</div>

<script>
	
	$(document).on('click','#quali_submit',function(event){
		event.preventDefault()
		 var status    = $('#allotment_status').val();
		 var tender_id = $('#tender_id').val();

		$.ajax({
				url:'/tender_details',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{status:status,tender_id:tender_id,form_type:'qualification'},
				success:function(data){						
					$('.notify-sect').notify(data,'success');
				}
		})
	})	
</script>
