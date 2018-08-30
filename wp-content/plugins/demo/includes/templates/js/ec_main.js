$( document ).ready(function() {
	
	var date_format = {
		dateFormat: "dd/mm/yy"
	};
	
	$( "#usr_datefrom" ).datepicker(date_format);
	$( "#usr_dateto" ).datepicker(date_format);
    
	$("#export_csv").click(function(){	
		$("#client_export").val(1);
		$("#form_client_list").submit();
	});
	
	$("#search_client").click(function(){	
		$("#client_export").val(0);
		$("#form_client_list").submit();
	});
});