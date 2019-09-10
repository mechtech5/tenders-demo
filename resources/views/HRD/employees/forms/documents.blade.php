<div id="emp_docs">
	<table class="table table-striped table-hover table-bordered">
	  <thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Document Title</th>
	      <th>File</th>
	      <th>Note</th>
	      <th class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody id="docsTbody">
	  	
	  </tbody>
	</table>
	<hr />
	<form>
		<div class="row">
	    <div class="col form-group">
	    	<label for="">Document Title</label>
	    	<select name="docTitle" id="docTitle" class="form-control select2">
	    		<option value="">--- Please Select ---</option>
	    	</select>
	    </div>
	    <div class="col form-group">
	    	<label for="">Attachment</label>
	    	<input type="file" name="docFile" id="docFile">
	    </div>
	    <div class="col form-group">
	    	<label for="">Note</label>
	    	<textarea name="docSpecialNote" id="docSpecialNote" class="form-control" cols="30" rows="10"></textarea>
	    </div>
		</div>
		<input type="hidden" id="form_type" value="docs">
	</form>
</div>

<script>
	$(document).ready(function(){
		$('.select2').select2();
		// $('.datepicker').datepicker({
		// 	orientation: "bottom",
		// 	format: "dd/mm/yyyy",
		// 	autoclose: true,
		// 	todayHighlight: true
		// });
	});
</script>
