@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-sm-12 col-md-12 text-center" style="top: -22px; left: -111px;">
				<span class="notify-sect"></span>
			</div>
		</div>
		<h4 class='text-center'>Title</h4>
		<hr>		
		<div class="row">
			<span class="">
				<label class="">PROPERTY : </label>
				<span class="font-weight-bold">Attribute</span>
				{{-- <input value="attribute_balue" type="text" class="form-control" readonly> --}}
			</span>
			<span class="mr-2 ml-2">|</span>
			<span class="">
				<label>PUBLISH DATE : </label>
					<span class="font-weight-bold">Attribute</span>
				{{-- <input type="text" class="form-control" value="01-09-2019" readonly> --}}
			</span>
		</div>
		<ul class="nav nav-pills nav-justified mt-3">
			<li class="nav-item">
		    <a class="nav-link details" href="javascript:void(0)" onclick="getForm('details',{{$id}})">Details</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link imp_dates" href="javascript:void(0)" onclick="getForm('imp_dates',{{$id}})">Imp Dates</a>
		  </li>
		   <li class="nav-item">
		    <a class="nav-link responsibilities" href="javascript:void(0)" onclick="getForm('responsibilities',{{$id}})">Responsibilities</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link prebid" href="javascript:void(0)" onclick="getForm('prebid',{{$id}})">Prebid</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link corrigendum" href="javascript:void(0)" onclick="getForm('corrigendum',{{$id}})">Corrigendum</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link qualification" href="javascript:void(0)" onclick="getForm('qualification',{{$id}})">Qualification</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link emd" href="javascript:void(0)" onclick="getForm('emd')">EMD</a>
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
	<input type="hidden" name="tender_id" value="{{$id}}">
	<script>
		$(document).ready(function(){
			getForm('details');
			$('.details').addClass('active');
		});
		function getForm(type,id){
			let tender_id = '<?php echo $tender->id;?>';
			let img = $('.img_parent').html();
			$('#form-area').html(img);
			axios({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			  method: 'post',
			  url: `/tender_master/${type}`,
			  data: {tender_id: tender_id}
			})
			.then(response => {
				$('#form-area').html(response.data);
			})
				.catch(error => console.log(error.response));
					$('.nav-link').removeClass('active');
					$('.'+type).addClass('active');
		}
	</script>
@endsection