<div id="details_tab">
	<form id="responsibilities_tab_form">
		<div class="row">
	    <div class="col-3 form-group">
	    	<label for="">Synopsis Creation</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">-- Select Employee --</option>
	    		@foreach($responsi as $res)
	    			<option value="{{$res->id}}">{{$res->name}}</option>
	    		@endforeach	
	    	</select>
	    </div>
	    <div class="col-3 form-group">
	    	<label for="">Tender Filling	</label>
	    	<select name="type" id="" class="select2 form-control">
	    		<option value="">-- Select Employee --</option>
	    	</select>
	    </div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('.select2').select2();
	});
</script>
