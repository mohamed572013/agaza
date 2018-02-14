$("#form_data").on('submit',(function(e) {
		$("#insert_btn").hide();
		jQuery( '.progess_div' ).html('<h4 class="text-light-blue"><img src="'+base_url+'images/loading.gif" style="width:20px;height:20px"> Saving</h4>');
			 	
		e.preventDefault();
		$.ajax({
        	url: base_url+"ajax/insert_date_img",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			dataType: "json",
			success: function(data)
		    {
			if(data.status == 'ok'){
			 setTimeout(
  function() 
  {	
		jQuery( '.progess_div' ).html('<h4 class="text-green">Data has been inserted</h4>').hide().show(500);
				 		setTimeout(
  function() 
  {	
  
  location.reload();
	}, 2000);
	}, 2000);
			}
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));//---------------------------
	$("#edit_date_img").on('submit',(function(e) {
		var table = jQuery( '#level' ).val();
		$("#edit_btn").hide();
			 jQuery( '.progess_div' ).html('<h4 class="text-light-blue"><img src="'+base_url+'images/loading.gif" style="width:20px;height:20px"> Updating</h4>');
			 		
		e.preventDefault();
		$.ajax({
        	url: base_url+"ajax/edit_date_img",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			dataType: "json",
			success: function(data)
		    {
			if(data.status == 'ok'){
			 setTimeout(
  function() 
  {	
		jQuery( '.progess_div' ).html('<h4 class="text-green">Data has been updated</h4>').hide().show(500);
				 		setTimeout(
  function() 
  {	
  if(table != 'trip'){
 window.location = base_url+'admin/'+table;
}else{
	window.location = base_url+'admin/'+table+'/'+jQuery('#cat_id').val();
}
	}, 2000);
	}, 2000);
			}
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));