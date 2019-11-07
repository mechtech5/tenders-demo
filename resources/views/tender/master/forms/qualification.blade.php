<div id="qualification">
	<form id="qualification_tab_form">
		<div class="row">
	    <div class="col-3 form-group">
	    	<label for="">Tender Allotment Status</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">-- Select Status --</option>
	    		<option value="L1">L1</option>
	    		<option value="L2">L2</option>
	    		<option value="L3">L3</option>
	    		<option value="L4">L4</option>
	    	</select>
	    </div>
		</div>
		<input type="hidden" name="tender_id" value="{{$tender_id}}">
		<input type="submit" on="quali_submit" value="Submit" class="btn btn-primary" >
	</form>
</div>

<script>
	
	function save(){
	 var data = $('#qualification').serializeArray();
	 data.push({name:'form_type',value:'qualification'});

		$.ajax({
				url:'/tender_details',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:data,
				success:function(data){
					$('#table_corrige').html(data)
				}
		})
	}	
</script>
