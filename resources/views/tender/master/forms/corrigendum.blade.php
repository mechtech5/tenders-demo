

<script>


$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#add_form");

form.validate({   
    rules: {
		changes:{
			required: true,
      		
		},
		date:{
			required:true,
		},
		time:{
			required: true,     		
		}
    },
	messages: {
	},
	errorElement: "em",
	errorPlacement: function errorPlacement(error, element) { 
		element.after(error);
		error.addClass( "help-block" );

	 },
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
	},
	unhighlight: function (element, errorClass, validClass) {
		$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
	},
	submitHandler: function (form) {
		$.ajax({
			url:'/tender_details',
			type:'POST',
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
			data:$('#add_form').serialize(),
			success:function(data){
				if(data !=''){
					$('#table_corrige').html(data)
					$("input[name='date']").val('');
					$("input[name='time']").val('');
					$("textarea[name='changes']").val('');
				}
			}
		})
	}
                      
});


	$(document).ready(function(){

		$('.timepicker').datetimepicker({
        	format: 'HH:mm:ss'
    	}); 
    	
		$('.datepicker').datepicker({
			orientation: "bottom",
			format: "yyyy-mm-dd",
			autoclose: true,
			todayHighlight: true
		});
	});
	
	function add(){
		$('#add_form, .save, .cancel, .add').toggleClass('d-none');
	}
	function cancel(){
		$('#add_form, .save, .cancel, .add').toggleClass('d-none');
	}

	$(document).on('click','.edit_corrige',function(){
		var id = $(this).attr('data-id');
			$.ajax({
				url:'/update_meeting',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{id:id,type:'corrige_model'},
				success:function(data){
					var parsed_result = JSON.parse(data);  //parsing here
            		for (var key in parsed_result){					    
					    $('#c_date').val(parsed_result['date'])
					    $('#c_changes').val(parsed_result['changes'])
					    $('#c_id').val(parsed_result['id'])
					    $('#c_tender_id').val(parsed_result['tender_id']);
					}
					$('#exampleModal').modal('show')
				}
		})		
	})

	$(document).on('click','#c_submit',function(){
		var id        = $('#c_id').val();
		var date      = $('#c_date').val();
		var changes   = $('#c_changes').val();
		var tender_id = $('#c_tender_id').val();
			$.ajax({
				url:'/update_meeting',
				type:'POST',
				headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
				data:{id:id,date:date,changes:changes,tender_id:tender_id,type:'save_data_corrige'},
				success:function(data){
					$('#exampleModal').modal('hide')
					$('#table_corrige').html(data)
					$('.notify-sect').notify($('#message').val(),'success');
				}
		})		
	})

	$(document).on('click','.corrige_delete',function(){
		var tender_id  = $('#tender_id').val();
		var id         = $(this).attr('data-id');

		$.ajax({
			url:'/delete_reco',
			type:'POST',
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
			data:{id:id,tender_id:tender_id,type:'corrige_delete'},
			success:function(data){
				$('#table_corrige').html(data)			
			}
		})		
	})

</script>
