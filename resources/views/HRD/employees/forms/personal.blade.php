<div id="emp_basic">
<form id="emp_form_basic">
	<div class="container-fluid">
		<div class="row">
			<div class="col-2 form-group">
				<label for="">Title</label>
				<select name="emp_title" class="form-control">
					<option value=""> -- Select --</option>
				</select>
			</div>
			<div class="col-3 form-group">
				<label for="">First Name</label>
				<input type="text" class="form-control" name="first_name" value="" />
			</div>
			<div class="col-3 form-group">
				<label for="">Middle Name</label>
				<input type="text" class="form-control" name="middle_name" value="" />
			</div>
			<div class="col-4 form-group">
				<label for="">Last Name</label>
				<input type="text" class="form-control" name="last_name" value="" />
			</div>
			<div class="w-100"></div>
			<div class="col-2 form-group">
				<label for="">Gender</label>
				<br>
				{{-- female: style="color:#fff; background-color:#fd75e3; border-color:#b145bf; --}}
				{{-- male: style="color:#fff; background-color:#6b82a4; border-color:#49719d;"  --}}
				<div class="btn-group btn-group-toggle" data-toggle="buttons">
				  <label class="btn btn-secondary">
				    <input type="radio" name="gender" value="m" autocomplete="off"> Male
				  </label>
					<label class="btn btn-secondary active focus ">
				    <input type="radio" name="gender" value="f" autocomplete="off"> Female
				  </label>
				</div>
			</div>
			<div class="col-3 form-group">
				<label for="">Date of Birth</label>
				<input type="text" name="date_of_birth" class="form-control datepicker" value="">
			</div>
			<div class="col-5 form-group">
				<label for="">Place of Birth</label>
				<input type="text" name="place_of_birth" class="form-control" value="">
			</div>
			<div class="col-2 form-group">
				<label for="">Blood Group</label>
				<select name="blood_group" id="" class="form-control">
					<option value="">-- select --</option>
				</select>
			</div>
			<div class="w-100"></div>
			<div class="col form-group">
				<label for="">Caste</label>
				<select name="caste" id="" class="form-control">
					<option value="">-- select --</option>
				</select>
			</div>
			<div class="col form-group">
				<label for="">Religion</label>
				<select name="religion" id="" class="form-control">
					<option value="">-- select --</option>
				</select>
			</div>
			<div class="col form-group">
				<label for="">Nationality</label>
				<select name="nationality" class="form-control" id="">
					<option value="">-- select --</option>
				</select>
			</div>


		</div>
		<hr />
		<div class="row">
			<div class="col">
				<span><p class="text-center">Current Residence</p></span>
				<div class="form-group col-md-8 offset-md-2">
					<textarea name="address1" id="address1" class="form-control" cols="30" rows="10"></textarea>
				</div>
			</div>

			<div class="col">
				<span><p class="text-center">Permanent Residence</p></span>
				
				<div class="form-group col-md-8 offset-md-2">
					<textarea name="address2" class="form-control" id="address2" cols="30" rows="10"></textarea>
				</div>
			
			</div>
		</div>
		<div class="custom-control custom-checkbox bg-dark text-white" style="background-color: #fff;">
	  	<input type="checkbox" class="custom-control-input" id="check-address">
	  	<label class="custom-control-label" for="check-address">Permanent Residence same as current</label>
		</div>
		<hr />
		<div class="row">
			<div class="col form-group">
				<label for="">Alternate Mobile</label>
				<input type="text" name="alternate_contact" class="form-control" value="">
			</div>
			<div class="col form-group">
				<label for="">Landline Contact</label>
				<input type="text" name="landline_contact" class="form-control" value="">
			</div>
			<div class="col form-group">
				<label for="">Alternate Email</label>
				<input type="email" name="alternate_email" class="form-control" value="">
			</div>
		</div>

		<input type="hidden" name="form_type" id="form_type" value="basic">
	</div>
</form>
</div>

<script>
$(document).ready(function(){
	
});
</script>
