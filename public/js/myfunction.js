//Function for imp_date page in tender section

function toggle_btn(check,item){
	if($(check).is(':checked')){
		$(item).show();
	}
	else{
		$(item).hide();	
	}
}