$( document ).ready(function() {
	
	var date_format = {
		dateFormat: "dd/mm/yy"
	};
	
	$( "#usr_datefrom" ).datepicker(date_format);
	$( "#usr_dateto" ).datepicker(date_format);
    //$("#export_csv").click(function(){
	
	// $.post( "test.php", { name: "John", time: "2pm" })
	  // .done(function( data ) {
		// alert( "Data Loaded: " + data );
	  // });
	// });
});