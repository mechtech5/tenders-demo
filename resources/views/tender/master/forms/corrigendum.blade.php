<div id="details_tab">
	<form id="add_form" class="d-none">
		<div class="row">
			<div class="col-3 form-group">
	    		<label for="">Date Time</label>
	    		<input type="text" readonly="true" class="form-control datepicker" name="date"/>
	    	</div>
	    	<div class="col-12">
	    		<div class="form-group">
	    			<label for="">Changes in Term</label>
	    			<textarea name="changes" class="form-control" id="" cols="30" rows="5"></textarea>
	    		</div>
	    	</div>
		</div>
		<input type="hidden" id="tender_id" value="{{$tender_id}}" name="tender_id">
	</form>
	<a href="javascript:void(0)" class="btn btn-info mt-2 mb-2 pull-right add"  onclick="add()">Add</a>
	<a href="javascript:void(0)" class="btn btn-danger mt-2 mb-2 ml-2 pull-right cancel d-none" onclick="cancel()">Cancel</a>
	<a href="javascript:void(0)" class="btn btn-success mt-2 mb-2 pull-right save d-none"  onclick="save()">Save</a>
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
  				@foreach($corrigendum as $corrigend)
			  		<tr>
			  			<td>{{ ++$count }}</td>
			  			<td>{{ $corrigend->date }}</td>
			  			<td>{{ $corrigend->changes }}</td>
			  			<td class="text-center">
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
        	<div class="row">
				<div class="col-md-4 col-sm-4">
					<label>Date</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<input id="c_date" class="form-control datepicker">
				</div>
			</div>
			<div class="row mt-3">	
				<div class="col-md-4 col-sm-4">
					<label>Changes</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<input id="c_changes" class="form-control">
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
    </div>
  </div>  
</div>

<script>
	$(document).ready(function(){
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

	function save(){
	 var data = $('#add_form').serializeArray();
	 data.push({name:'form_type',value:'corrigendum'});

		$.ajax({
				url:'/tender_details',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:data,
				success:function(data){
					if(data !=''){
						$('#table_corrige').html(data)
					}
				}
		})
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
					    $('#c_date').val(parsed_result['date'])
					    $('#c_changes').val(parsed_result['changes'])
					    $('#c_id').val(parsed_result['id'])
					    $('#c_tender_id').val(parsed_result['tender_id']);
					}
					$('#exampleModal').modal('show')
				}
		})		
	})

	$(document).on('click','#c_submit',function(){
		var id        = $('#c_id').val();
		var date      = $('#c_date').val();
		var changes   = $('#c_changes').val();
		var tender_id = $('#c_tender_id').val();
			$.ajax({
				url:'/update_meeting',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{id:id,date:date,changes:changes,tender_id:tender_id,type:'save_data_corrige'},
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
