@extends('layouts.master')
@section('content')
<style type="text/css">
	
.bg {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

.span_pseudo, .chiller_cb span:before, .chiller_cb span:after {
  content: "";
  display: inline-block;
  background: #fff;
  width: 0;
  height: 0.2rem;
  position: absolute;
  transform-origin: 0% 0%;
}

.chiller_cb {
  position: relative;
  height: 2rem;
  display: flex;
  align-items: center;
}
.chiller_cb input {
  display: none;
}
.chiller_cb input:checked ~ span {
  background: #fd2727;
  border-color: #fd2727;
}
.chiller_cb input:checked ~ span:before {
  width: 1rem;
  height: 0.15rem;
  transition: width 0.1s;
  transition-delay: 0.3s;
}
.chiller_cb input:checked ~ span:after {
  width: 0.4rem;
  height: 0.15rem;
  transition: width 0.1s;
  transition-delay: 0.2s;
}
.chiller_cb input:disabled ~ span {
  background: #ececec;
  border-color: #dcdcdc;
}
.chiller_cb input:disabled ~ label {
  color: #dcdcdc;
}
.chiller_cb input:disabled ~ label:hover {
  cursor: default;
}
.chiller_cb label {
  padding-left: 2rem;
  position: relative;
  z-index: 2;
  cursor: pointer;
  margin-bottom:0;
}
.chiller_cb span {
  display: inline-block;
  width: 1.2rem;
  height: 1.2rem;
  border: 2px solid #ccc;
  position: absolute;
  left: 16px;
  transition: all 0.2s;
  z-index: 1;
  box-sizing: content-box;
}
.chiller_cb span:before {
  transform: rotate(-55deg);
  top: 1rem;
  left: 0.37rem;
}
.chiller_cb span:after {
  transform: rotate(35deg);
  bottom: 0.35rem;
  left: 0.2rem;
}

</style>
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add Responsible Person</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('tender_responsible.store')}}" method="post">
							@csrf
							<div class="row form-group">
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2 offset-4">
									<label for="name"><b>Name <span class="text-danger">*</span></b> </label>
														
										<input type="text" name="name" class="form-control" value="{{old('name')}}">
										@error('name')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
					                	@enderror								
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2 offset-4">
									<label for="name"><b>Email ID<span class="text-danger">*</span></b> </label>
									<input class="form-control" name="email" id="" cols="30" rows="5">
									@error('email')
				                    <span class="text-danger" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                	@enderror
								</div>												
							</div>

							<div class="row form-group">
								<div class="slideOne col-md-4 col-lg-4 col-xl-4  chiller_cb offset-4">
									<label for="myCheckbox">Can Login</label>	
								   <input type="checkbox" id="myCheckbox" name="can_login" />	    
								    <span></span>
								</div>			    																	
							</div>
							<div class="col-md-12 mt-3 text-center">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('tender_responsible.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection