$(document).ready(function() {
	delete_action();
	switch_action();
});

function delete_action(){
		$( '.delete-btn').each( function(){
			
		var btn = this ;
		jQuery(btn).off('click');
		 jQuery(btn).click(function(){	
		 	$.confirm({
					title: '<span style="color:#333">هل انت متاكد من انك تريد مسح هذا العنصر</span>',
					content: '<span style="color:#333">لديك 6 ثوانى للاختيار</span>',
					autoClose: 'cancel|6000',
					rtl: true,
					confirmButton: 'نعم متاكد',
					confirmButtonClass: 'btn-danger',
					cancelButton: 'الغاء',
					confirm: function () {
						delete_item( btn.id );
					}
				});
			});	
		}); 

		}
		function delete_item( id ){
			var table = $( '#level').val();
			var relate_table = $( '#relate_table').val();
			var field_name = $( '#field_name').val();
				jQuery.post(base_url+"admin/ajax/delete_item" ,{ id:id,table:table,field_name:field_name,relate_table: relate_table}, function(data){
		if(data.status == 'ok'){
			$('#data-table').DataTable().row('#tr_'+id).remove().draw();
				$.amaran({
            content:{
                message:'<b>تم الحذف</b>',
                size: 'العنصر رقم #'+id,
                file: '<b>تم حذف جميع البيانات المتعلقة بالعنصر</b>',
                icon:'glyphicon glyphicon-ok'
            },
            theme:'default green',
            position:'top right',
            inEffect:'slideLeft',
            outEffect:'slideTop',
            closeButton:true,
            delay:7000
        });
			}else{
					$.amaran({
            content:{
                message:'<b>فشل فى الحذف</b>',
                size: 'العنصر رقم #'+id,
                file: '<b>لا يمكن حذف هذا العنصر لوجود عناصر متعلقة به</b>',
                icon:'fa fa-times'
            },
            theme:'default error',
            position:'top right',
            inEffect:'slideLeft',
            outEffect:'slideTop',
            closeButton:true,
            delay:7000
        });
			}
			},"json");	
					
			}
		

		function switch_action(){
		$( '.switchCheckBox').each( function(){		
		var btn = this ;
		jQuery(btn).off('click');
		 $(btn).on('switchChange.bootstrapSwitch', function(event, state) {
		 	var table = $( '#level').val();
		 	var sw_item_id = btn.id.substring(3);
		 	var num_state = 1;
		 	if(state == false){
		 	num_state = 0;
		 	}else{
		 	num_state = 1;
		 	}	

		 	jQuery.post(base_url+"admin/ajax/update_item" ,{ id: sw_item_id, table: table, state:num_state}, function(data){
				
				var ar_name = 'عنصر';
				if(table == 'company'){
					ar_name = 'شركة';
				}else if(table == 'branches'){
					ar_name = 'فرع';
				}else{
					ar_name = 'عنصر';
				}

				if(num_state == 1){
				$.amaran({
            content:{
                message:'<b>تم التفعيل</b>',
                size: 'ال'+ar_name+' رقم #'+sw_item_id,
                file: '<b>تم تفعيل صلاحيات ال'+ar_name+'</b>',
                icon:'glyphicon glyphicon-ok'
            },
            theme:'default green',
            position:'top right',
            inEffect:'slideLeft',
            outEffect:'slideTop',
            closeButton:true,
            delay:7000
        });
			}else{
					$.amaran({
            content:{
                message:'<b>تم التوقف</b>',
                size: 'ال'+ar_name+' رقم #'+sw_item_id,
                file: '<b>تم توقف صلاحيات ال'+ar_name+'</b>',
                icon:'fa fa-times'
            },
            theme:'default error',
            position:'top right',
            inEffect:'slideLeft',
            outEffect:'slideTop',
            closeButton:true,
            delay:7000
        });
			}

			},"json");
});
		}); 

		}


