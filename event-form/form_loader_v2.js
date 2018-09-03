var EventFormLoader = {

	init: function()
	{
		var head = document.getElementsByTagName("head")[0];
		var body = document.getElementsByTagName("body")[0];
		
		var link  		= document.createElement('link')
		link.rel  			= 'stylesheet';
		link.type 		= 'text/css';
		link.href 		= '/wordpress/ruaxanh_form/custom_style_v2.css';
		link.media 	= 'all';
		head.appendChild(link);
		
		document.title = "Old Navy";
		
		var link			= document.createElement('meta');
		link.name		= "og:url";
		link.content	=  "http://ruaxanh.net";
		head.appendChild(link);
		
		var link			= document.createElement('meta');
		link.name		= "og:title";
		link.content	=  "Old Navy";
		head.appendChild(link);
		
		var link			= document.createElement('meta');
		link.name		= "og:description";
		link.content	=  "Old Navy Description";
		head.appendChild(link);
		
		var od_div 	= document.createElement('div');
		od_div.className = "event_custom_body";
		
		var od_div2 	= document.createElement('div');
		od_div2.className = "event-custom-form";
		
		var od_form = document.createElement('form');
		od_form.className = "event-custom-form";
		od_form.className = "event-custom-form";
		od_form.setAttribute("id", "event-custom-form");
		
		//client name
		var div		= document.createElement('div');
		var client_name = document.createElement('input');
		client_name.type 	= "text";
		client_name.name = "client_name";
		client_name.setAttribute("id", "client_name");
		client_name.setAttribute("placeholder", "Your Name");
		client_name.setAttribute("autocomplete", "off");
		div.appendChild(client_name);
		od_form.appendChild(div);
		
		//client email
		var div		= document.createElement('div');
		var client_email = document.createElement('input');
		client_email.type 	= "text";
		client_email.name = "client_email";
		client_email.setAttribute("id", "client_email");
		client_email.setAttribute("placeholder", "Your Email");
		client_email.setAttribute("autocomplete", "off");
		div.appendChild(client_email);
		od_form.appendChild(div);
		
		//client phone
		var div		= document.createElement('div');
		var client_phone = document.createElement('input');
		client_phone.type 	= "text";
		client_phone.name = "client_phone";
		client_phone.setAttribute("id", "client_phone");
		client_phone.setAttribute("placeholder", "Phone");
		client_phone.setAttribute("autocomplete", "off");
		div.appendChild(client_phone);
		od_form.appendChild(div);
		
		//client photo
		var div		= document.createElement('div');
		div.className = "js";
		var div2		= document.createElement('div');
		div2.className = "input-file-container";
		var client_photo = document.createElement('input');
		var client_photo = document.createElement('input');
		client_photo.type 	= "file";
		client_photo.className 	= "input-file";
		client_photo.name 	= "iclient_photo";
		client_photo.id 	= "my-file";
		div2.appendChild(client_photo);
		var label = document.createElement('label');
		label.className 	= "input-file-trigger";
		label.innerHTML  	= "Select a file...";
		div2.appendChild(label);
		div.appendChild(div2);
		od_form.appendChild(div);
		
		od_div2.appendChild(od_form);
		od_div.appendChild(od_div2);		
		body.appendChild(od_div);		
	},
	
};

EventFormLoader.init();