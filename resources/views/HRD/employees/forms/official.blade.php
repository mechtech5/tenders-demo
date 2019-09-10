<div id="emp_official">
<form id="emp_form_official">
	<div class="container-fluid">

		<div class="row">

			<div class="col-4 form-group">
				<label for="">Emp Code</label>
				<input type="text" class="form-control" name="emp_code" value="" required />
			</div>

			<div class="col-4 form-group">
				<label for="">Emp Status</label>
				<select name="emp_status_id" class="form-control" id="">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
			</div>

			<div class="col-4 form-group">
				<label for="">Emp Type</label>
				<select name="emp_type_id" id="" class="form-control">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
			</div>

			<div class="W-100"></div>

			<div class="col-4 form-group">
				<label for="">Joining Date</label>
				<input type="text" class="form-control datepicker" name="join_date" value="" />
			</div>

			<div class="col-4 form-group">
				<label for="">Probation Period (in months)</label>
				<input type="text" class="form-control" name="probation_period" value="" />
			</div>

			<div class="col-4 form-group">
				<label for="">Confirmation Date</label>
				<input type="text" class="form-control datepicker" name="confirm_date" value="" />
			</div>

			<div class="W-100"></div>
			<div class="col-3 form-group">
				<label for="">Bank Account Name</label>
				<input type="text" name="bank_acc_name" value="" class="form-control">
			</div>
			<div class="col-3 form-group">
				<label for="">Bank Account No.</label>
				<input type="text" name="bank_acc_no" value="" class="form-control">
			</div>
			<div class="col-3 form-group">
				<label for="">IFSC Code</label>
				<input type="text" name="bank_ifsc" value="" class="form-control">
			</div>
			<div class="col-3 form-group">
				<label for="">Branch Name</label>
				<input type="text" name="bank_branch" value="" class="form-control">
			</div>
			<div class="W-100"></div>
			<div class="col-3 form-group">
				<label for="">Aadhar Card</label>
				<input type="text" name="aadhar_no" value="" class="form-control">
			</div>
			<div class="col-3 form-group">
				<label for="">PAN Card</label>
				<input type="text" name="pan_no" value="" class="form-control">
			</div>
			<div class="col-3 form-group">
				<label for="">Voter ID</label>
				<input type="text" name="voter_id" value="" class="form-control">
			</div>
			<div class="col-3 form-group">
				<label for="">PF No.</label>
				<input type="text" name="pf_no" value="" class="form-control">
			</div>
			<div class="W-100"></div>
			<div class="col-3 form-group">
				<label for="">UAN No.</label>
				<input type="text" name="uan_no" value="" class="form-control">
			</div>
			<div class="W-100"></div>
			<div class="col-3 form-group">
				<label for="">Mode of Payment</label>
				<select name="mode_of_payment" id="" class="form-control">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
			</div>
			<div class="col-3 form-group">
				<label for="">Company's Reference Name</label>
				<input type="text" class="form-control" value="" name="co_ref_name">
			</div>
			<div class="col-3 form-group">
				<label for="">Company's Reference Contact</label>
				<input type="text" class="form-control" value="" name="co_ref_contact">
			</div>
			<div class="W-100"></div>
			<div class="col-4 form-group">
				<label for="">Nominee Name</label>
				<input type="text" class="form-control" value="" name="nominee_name">
			</div>
			<div class="col-4 form-group">
				<label for="">Nominee Aadhar</label>
				<input type="text" class="form-control" value="" name="nominee_aadhar">
			</div>
			<div class="col-4 form-group">
				<label for="">Nominee Contact</label>
				<input type="text" class="form-control" value="" name="nominee_contact">
			</div>
		</div>
	</div>
	<input type="hidden" name="form_type" id="form_type" value="official">
</form>
</div>

<script>
	$(document).ready(function(){

	});
</script>
