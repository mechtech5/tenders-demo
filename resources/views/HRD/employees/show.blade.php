@extends('layouts.master')
@section('content')
	<main class="app-content">
			<ul class="nav nav-pills nav-justified">
			<li class="nav-item">
		    <a class="nav-link main" href="javascript:void(0)" onclick="getForm('main')">Main</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link official" href="javascript:void(0)" onclick="getForm('official')">Official</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link personal" href="javascript:void(0)" onclick="getForm('personal')">Personal</a>
		  </li>
		   <li class="nav-item">
		    <a class="nav-link academics" href="javascript:void(0)" onclick="getForm('academics')">Academics</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link experience" href="javascript:void(0)" onclick="getForm('experience')">Experience</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link documents" href="javascript:void(0)" onclick="getForm('documents')">Documents</a>
		  </li>

		</ul>
		<div style="margin-top: 1.5rem; padding: 1.5rem; border: 1px solid grey;">
			<div id="form-area">
				
			</div>
		</div>
		<div class="img_parent d-none">
			<img src="{{asset('images/loading1.gif')}}" alt="">
		</div>
		
	</main>
	<script>
		$(document).ready(function(){
			getForm('main');
			$('.main').addClass('active');
		});
		
		function getForm(type){
			let emp_id = '<?php echo $employee->id;?>';
			let img = $('.img_parent').html();
			$('#form-area').html(img);
			axios({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			  method: 'post',
			  url: `/hrd/employees/${type}`,
			  data: {emp_id: emp_id}
			})
			.then(response => {
				console.log(response.data);
				$('#form-area').html(response.data);
			})
				.catch(error => console.log(error.response));
					$('.nav-link').removeClass('active');
					$('.'+type).addClass('active');
		}
	</script>
@endsection