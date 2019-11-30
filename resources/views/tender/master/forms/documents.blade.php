<div id="emp_docs">
	<form id="upload_form" enctype='multipart/form-data'>
		<div class="row">
		    <div class="col form-group">
		    	<label for="">Document Title</label>
		    	<input type="" name="doc_title" class="form-control">
		    </div>
		    <div class="col form-group">
		    	<label for="">Attachment</label>
		    	<input style="width: 311px;" type="file" name="file" id="file"><br>
		    </div>
		    <div class="col form-group">
		    	<label for="">Note</label>
		    	<textarea style="max-height: 101px;" name="note" id="note" class="form-control" cols="30" rows="10"></textarea>
		    </div>
		</div>
		<div class="row mb-5 mt-3">
			<div class="col-md-12 col-sm-12 text-center" >
				<input type="submit" id="submit_doc" value="Submit" class="btn btn-primary"> 
			</div>
		</div>	
		<input type="hidden" name="form_type" value="doc">
		<input type="hidden" name="tender_id" value="{{$tender_id}}">		
	</form>
</div>

<div class="row">
	<div class="col-sm-12 col-md-12 " id="docs_table">
		<table class="table table-striped table-hover table-bordered">
		  <thead class="thead-dark">
		    <tr>
		      <th>#</th>
		      <th>Document Title</th>
		      <th>Note</th>
		      <th class="text-center">Actions</th>
		    </tr>
		  </thead>
		  <tbody id="docsTbody">
		  	<?php $count = 0; ?> 
		  	@foreach($tender->documents as $Data)
		  	<?php $tender = App\Models\Tenders\Tender::find($Data->tender_id);	?>
		  		<tr>
		  			<td>{{ ++$count }}</td>
		  			<td>{{ $Data->doc_title }}</td>
		  			<td>{{ $Data->note }}</td>
		  			<td class="text-center">
		  				<a style="color: #fff" href="{{Storage::url('public/'.$tender->tender_no.'/'.$Data->file)}}" runat="server" class="fa fa-download btn btn-primary" rel="tooltip" title="" data-original-title="Edit"></a>
		  				<a style="color: #fff" data-id="{{$Data->id}}" runat="server" class="fa fa-edit btn btn-success edit_meeting" rel="tooltip" title="" data-original-title="Edit"></a>
			            <a style="color: #fff" data-id="{{$Data->id}}" onclick="javascript:return confirm('Do You Really Want To Delete This?');" class="fa fa-times btn btn-danger doc_delete" rel="tooltip" title="" data-original-title="Delete"></a>
		  			</td>
		  		</tr>
		  	@endforeach	
		  </tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Tender Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form id="u_doc_form" enctype='multipart/form-data'>
        	<div class="row">
				<div class="col-md-4 col-sm-4">
					<label>Document Title</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<input id="m_doc_title" name="doc_title" class="form-control">
				</div>
			</div>
			<div class="row mt-3">	
				<div class="col-md-4 col-sm-4">
					<label>Attachment</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<input type="file" id="file" name="file" class="form-control datepicker">
				</div>
        	</div>
        	<div class="row mt-3">	
				<div class="col-md-4 col-sm-4">
					<label>Note</label>
				</div>
				<div class="col-md-8 col-sm-8">
					<textarea id="note_text" name="note" class="form-control"></textarea>
				</div>
		   	</div>
        	<input type="hidden" name="tender_id" id="tender_id" value="{{ $tender_id }}">
			<input type="hidden" name="u_id" id="u_id">
			<input type="hidden" name="type" value="update_doc">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="u_submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>  
</div>

<input type="hidden" id="message" value="<?php if(session('message') != ''){ echo session('message'); } ?>">

<script>

	$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#upload_form");

form.validate({   
    rules: {
		doc_title:{
			required: true,
      		
		},
		file:{
			required:true,
		},
		note:{
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
		event.preventDefault();
	     	var form = $('#upload_form')[0];
		    var data = new FormData(form);	    	     	

			$.ajax({
                url: "/tender_details",
                type: 'POST',
                processData: false,
				contentType: false,
				enctype: 'multipart/form-data',
				dataTyte: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:data,
                success: function (data) {
                	if(data != ''){
                		$('.notify-sect').notify($('#message').val(),'success');
                		$('#docs_table').html(data);        
                		$("input[name=doc_title]").val('');
                		$("#file").val('').clone(true);
                		$("textarea[name=note]").val('');   	
                	}
                }
	       })
	}
                      
});

	$(document).on('click','.edit_meeting',function(){
		var id        = $(this).attr('data-id');
		var tender_id = $('#tender_id').val();
		$.ajax({
			url:'/update_meeting',
			type:'POST',
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
			data:{id:id,tender_id:tender_id,type:'doc_model'},
			success:function(data){
				var parsed_result = JSON.parse(data);  //parsing here
				
           		for (var key in parsed_result){
				    $('#m_doc_title').val(parsed_result['doc_title'])
				    $('#note_text').val(parsed_result['note'])
				    $('#u_id').val(parsed_result['id'])
				    //$('#m_tender_id').val(parsed_result['tender_id']);
				}
				$('#exampleModal').modal('show')        		
			}
		})		
	})

	$(document).on('click','#u_submit',function(){
		var form = $('#u_doc_form')[0];
		var data = new FormData(form);	    	     	

		$.ajax({
            url: "/update_meeting",
            type: 'POST',
            processData: false,
			contentType: false,
			enctype: 'multipart/form-data',
			dataTyte: 'json',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:data,
            success: function (data) {
            	if(data != ''){
            		$('.notify-sect').notify($('#message').val(),'Data Successfully Updated');
            		$('#docs_table').html(data);    
            		$('#exampleModal').modal('hide')         	
            	}
            }
		})		
	})

	$(document).on('click','.doc_delete',function(){
		var tender_id  = $('#tender_id').val();
		var id         = $(this).attr('data-id');

		$.ajax({
			url:'/delete_reco',
			type:'POST',
			headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
			data:{id:id,tender_id:tender_id,type:'doc_delete'},
			success:function(data){
				$('#docs_table').html(data)			
			}
		})		
	})

</script>
