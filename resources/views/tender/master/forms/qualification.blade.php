<div id="details_tab">
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
	</form>
</div>

<script>
	$(document).ready(function(){
		$('.select2').select2();

	});
</script>
