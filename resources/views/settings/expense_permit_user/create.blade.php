@extends('layouts.master')
@section('content')
	<main class="app-content">
			<div class="row">
			<div class="col-md-12">
				<h1 style="font-size: 20px;">Expense Permit User</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<div class="parts-selector" id="parts-selector-1">
							<div class="parts list h-40vh">
								<h3 class="list-heading top-fixed">Select User</h3>
								<ul>
									@foreach($users as $user)
									<li id="{{$user->emp_id}}">
									<input type="hidden" name="valuUser[]" value="{{$user->emp_id}}" id="valuUser" />{{$user->emp_name}}
									</li>
									@endforeach
								</ul>
							</div>
							<div class="controls">
								<a class="moveto selected"><span class="icon"></span><span class="text">Add</span></a>
								<a class="moveto parts"><span class="icon"></span><span class="text">Remove</span></a>
							</div>

							<div class="selected list">
								<h3 class="list-heading">Add Expense Permit User</h3>

								<input type="hidden" name="grp_code" value="1" id="grp_code" />
								<ul id="e_user">							
									 @foreach($oldUsers as $oldUser)
					                    <li><input type="hidden" name="valuUser[]" value="{{$oldUser->emp_id}}" id="valuUser" />{{$oldUser->emp_name}}</li>
					                  @endforeach
								</ul>
							</div>
						</div> 
						<button class="btn btn-md btn-primary" id="submit">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</main>
<script type="text/javascript">
    $(document).ready(function() {
		$(function() {
			$( "#parts-selector-1" ).partsSelector();
		});

		$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $('#submit').on('click',function(e){
          e.preventDefault();


          var users = $("#e_user input[name='valuUser[]']")
                .map(function(){
                  return $(this).val();
                }).get();

          var grp_code = $("#grp_code").val();
        
       	
          if(users != ''){
          	$.ajax({
          		type:'POST',
          		url:"{{route('expense_permit_user.store')}}",
          		data: {grp_code:grp_code, users:users},
          		success:function(data){

          		swal({
                  text: data,
                  icon : 'success',
                });

                 setTimeout(function(){ 
                    location.reload(); 
                 }, 3000); 

          		}
          	});
          }
          else{
              swal({
                text: 'Add User',
                icon: 'warning',
              });
        
          }

        });


    });
</script>
@endsection