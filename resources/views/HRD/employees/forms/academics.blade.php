<div id="emp_academics">
	<table class="table table-striped table-hover table-bordered">
	  <thead class="thead-dark">
	    <tr>
	      <th>#</th>
	      <th>Domain of Study</th>
	      <th>Completed In</th>
	      <th>Name of Board</th>
	      <th>Grade</th>
	      <th>Special Note</th>
	      <th class="text-center">Actions</th>
	    </tr>
	  </thead>
	  <tbody id="academicsTbody">
	  </tbody>
	</table>
	<hr />
	<form id="emp_form_academics">
		<div class="row">
	    <div class="col-6 form-group">
	    	<label for="">Domain of Study</label>
	    	<input type="text" class="form-control" name="domain_of_study" placeholder="Eg. 10th, 12th, BE, MCA...">
	    </div>
	    <div class="col-6 form-group">
	    	<label for="">Name of Board/University</label>
	    	<input type="text" class="form-control" name="board_name" placeholder="Eg. CBSE, RGPV" />
	    </div>
			<div class="W-100"></div>
	    <div class="col-2 form-group">
	    	<label for="">Completed In</label>
	    	<input type="text" class="form-control" name="year_of_completion" placeholder="Eg. 2016" />
	    </div>
	    <div class="col-2 form-group">
	    	<label for="">Grade or %</label>
	    	<input type="text" class="form-control" name="grade_or_percent" placeholder="" />
	    </div>
	    <div class="col form-group">
	    	<label for="">Special Note</label>
	    	<textarea name="special_note" class="form-control" id="" cols="30" rows="10"></textarea>
	    </div>
		</div>

		<input type="hidden" id="form_type" value="academics">
	</form>
</div>
