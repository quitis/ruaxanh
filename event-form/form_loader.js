var EventFormLoader = {

	init: function()
	{
		var me = this;
        // Anonymous "self-invoking" function
        var head = document.getElementsByTagName("head")[0];
        var body = document.getElementsByTagName("body")[0];
        var link  		= document.createElement('link')
        link.rel  			= 'stylesheet';
        link.type 		= 'text/css';
        link.href 		= '/event-form/custom_style_v2.css';
        link.media 	= 'all';
        head.appendChild(link);
        document.title = "Old Navy";

		var startingTime = new Date().getTime();
		// Load the script
		var script = document.createElement("SCRIPT");
		script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';
		script.type = 'text/javascript';
		document.getElementsByTagName("head")[0].appendChild(script);

		// Poll for jQuery to come into existance
		var checkReady = function(callback) {
			if (window.jQuery) {
				callback(jQuery);
			}
			else {
				window.setTimeout(function() { checkReady(callback); }, 20);
			}
		};
		// Start polling...
		checkReady(function($) {
			$(function() {
				let params = window[window.EventFormObject].forms[0];
                let user_id = params.user_id;
                let bLoadForm = false;
                if(user_id > 0) {
                    $.ajax({
                        url: 'http://ruaxanh.net/api/',
                        type: 'GET',
                        data: {id: user_id},
                        success: function (result) {
                            if (result.code === 1) {
                                let user_data = result.data;
                                document.title = "Detail " + user_data.NAME;
                                createPictureContent(user_data, false);
                                // shareOverrideOGMeta('http://dantri.vn','1231211231313','Descriptio Description','https://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg\nhttps://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg')
                                // document.title = "Old Navy";
                                // var link			= document.createElement('meta');
                                // link.name		= "og:url";
                                // link.content	=  "http://dantri.vn";
                                // head.appendChild(link);
                                //
                                // var link			= document.createElement('meta');
                                // link.name		= "og:title";
                                // link.content	=  "1231211231313";
                                // head.appendChild(link);
                                //
                                // var link			= document.createElement('meta');
                                // link.name		= "og:description";
                                // link.content	=  "Descriptio Description";
                                // head.appendChild(link);
                                //
                                // var link			= document.createElement('meta');
                                // link.name		= "og:image";
                                // link.content	=  "https://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg\nhttps://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg";
                                // head.appendChild(link);
                            } else {
                                bLoadForm = true;
                            }
                        }
                    });
                } else {
                    bLoadForm = true;
                }
                if(bLoadForm)
                    window[window.EventFormObject].forms.forEach(me.preLoad, me);
			});

		});


		// this.yaId = null;
		// this.forms = {};
		// this.eventHandlers = [];
		// this.frameHeight = '900';
		// this.defaultNodeId = 'bx24_form_';
		//
		// if(!window.EventFormObject || !window[window.EventFormObject])
		// 	return;
		// if(!window[window.EventFormObject].forms)
		// 	return;
		//

	},
	preLoad: function(params)
	{
		var _this = this;
        this.load(params);
	},
	isFormExisted: function(params)
	{
		return !!this.forms[this.getUniqueLoadId(params)];
	},
	load: function(params)
	{
		this.domain = params.ref.match(/((http|https):\/\/[^\/]+?)\//)[1];
		this.createContent(params);
	},
    createContent: function(params) {
		let me = this;
        var body = document.getElementsByTagName("body")[0];
        var od_div 	= document.createElement('div');
        od_div.className = "event_custom_body";
        od_div.id = "event_custom_body_od_div";

        var od_div2 	= document.createElement('div');
        od_div2.className = "event-custom-form";
        od_div2.className = "event-custom-form-od-div2";

        var od_form = document.createElement('form');
        od_form.className = "event-custom-form";
        od_form.id = "event-custom-form";
        od_form.setAttribute("id", "event-custom-form");

        //client name
        var div		= document.createElement('div');
        var client_name = document.createElement('input');
        client_name.type 	= "text";
        client_name.name = "client_name";
        client_name.setAttribute("id", "client_name");
        client_name.setAttribute("placeholder", "Your Name");
        client_name.setAttribute("autocomplete", "off");

        let client_name_error  = document.createElement('label');
        client_name_error.id = "client_name_error";
        client_name_error.setAttribute("class", "input-error");
        div.appendChild(client_name);
        div.appendChild(client_name_error);
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
        let client_email_error  = document.createElement('label');
        client_email_error.id = "client_email_error";
        client_email_error.setAttribute("class", "input-error");
        div.appendChild(client_email_error);
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
        let client_phone_error  = document.createElement('label');
        client_phone_error.id = "client_email_error";
        client_phone_error.setAttribute("class", "input-error");
        div.appendChild(client_phone_error);
        od_form.appendChild(div);

        //client photo
        var div		= document.createElement('div');
        div.className = "js";
        var div2		= document.createElement('div');
        div2.className = "input-file-container";
        var client_photo = document.createElement('input');
        client_photo.type 	= "file";
        client_photo.className 	= "input-file";
        client_photo.name 	= "client_photo";
        client_photo.id 	= "client_photo";
        div2.appendChild(client_photo);
        var client_photo_label = document.createElement('label');
        client_photo_label.className 	= "input-file-trigger";
        client_photo_label.id 	= "client_photo_label";
        client_photo_label.innerHTML  	= "Upload Image";
        div2.appendChild(client_photo_label);

        var client_file_error  = document.createElement('label');
        client_file_error.id = "client_email_error";
        client_file_error.setAttribute("class", "input-error");
        div2.appendChild(client_file_error);

        div.appendChild(div2);
        od_form.appendChild(div);

        od_div2.appendChild(od_form);
        od_div.appendChild(od_div2);
        body.appendChild(od_div);
        /*
        * Javascript handle Submit
        * */
        client_photo_label.addEventListener("click", function( event ) {
            client_photo.focus();
            return false;
        });

        client_photo.addEventListener("change", function( event ) {
            let error = false;

            let _inputNameValue =  client_name.value;
            let _inputNameError =  '';

            let _inputEmailValue =  client_email.value;
            let _inputEmailError =  '';

            let _inputPhoneValue =  client_phone.value;
            let _inputPhoneError =  '';

            let _inputFileValue =  client_photo.value;
            let _inputFileError =  '';

            client_name_error.innerHTML = '';
            client_email_error.innerHTML = '';
            client_phone_error.innerHTML = '';
            client_file_error.innerHTML = '';

            //Input CHeck
            if(typeof _inputNameValue === 'undefined' || _inputNameValue.length === 0) {
                _inputNameError = 'Please input your name';
                error = true;
            }
            if(typeof _inputEmailValue === 'undefined' || _inputEmailValue.length === 0) {
                _inputEmailError = 'Please input your email';
                error = true;
            } else if(!me.validateEmail(_inputEmailValue)) {
                _inputEmailError = 'Email Invalid';
                error = true;
            }
            if(typeof _inputPhoneValue === 'undefined' || _inputPhoneValue.length === 0) {
                _inputPhoneError = 'Please input your phone';
                error = true;
            }

            //File check
            let fileSize = this.files[0].size;
            let defaulSize = 595*601;
            if(typeof _inputFileValue === 'undefined' || _inputFileValue.length == 0) {
                _inputFileError = 'Please choose your image';
                error = true;
            } else {
                let extension = _inputFileValue.replace(/^.*\./, '');
                if (extension == _inputFileValue) {
                    extension = '';
                } else {
                    extension = extension.toLowerCase();
                }

                switch (extension) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                        // if(fileSize < defaulSize) {
                        //     _inputFileError = 'Vui lòng sử dụng hình ảnh có kích thước 596 x 601 trở lên';
                        //     error = true;
                        // }
                        break;
                    default:
                        _inputFileError = 'Image is one of types: jpg, png, jpeg';
                        error = true;
                }
            }
            if(error) {
                if(_inputNameError.length > 0) {
                    client_name_error.innerHTML = _inputNameError;
                    // _inputNameErrorElement.text(_inputNameError);
                }
                if(_inputEmailError.length > 0) {
                    client_email_error.innerHTML = _inputEmailError;
                    // _inputEmailErrorElement.text(_inputEmailError);

                }
                if(_inputPhoneError.length > 0) {
                    client_phone_error.innerHTML = _inputPhoneError;
                    // _inputPhoneErrorElement.text(_inputPhoneError);

                }
                if(_inputFileError.length > 0) {
                    client_file_error.innerHTML = _inputFileError;
                    // _inputFileErrorElement.text(_inputFileError);

                }
                client_photo.value = '';
            } else {
                var fileName = event.target.files[0].name;
                client_photo_label.innerHTML = fileName;
                // _inputFileErrorElement.text('');
                $('#event-custom-form').first().submit()
            }
        });
        $('#event-custom-form').submit(function(e) {
            var formData = new FormData(this);
            $.ajax({
                url: 'http://ruaxanh.net/api/',
                type: 'POST',
                data: formData,
                success: function (result) {
                    // result = JSON.parse(result);
                    let code = result.code;
                    let data = result.data;
                    if(code === 1) {
                        createPictureContent(data,true);
                    } else {

					}
                    e.preventDefault();
                },
                cache: false,
                contentType: false,
                processData: false
            });
            e.preventDefault();
        });
	},
	unload: function(params)
	{
		if(!this.isFormExisted(params))
			return;

		this.execEventHandler(params, 'unload', [params]);

		var uniqueLoadId = this.getUniqueLoadId(params);
		var iframe = this.forms[uniqueLoadId].iframe;
		if (iframe && null != iframe.parentNode)
			iframe.parentNode.removeChild(iframe);

		this.forms[uniqueLoadId] = null;
	},

	addEventListener: function(el, eventName, handler)
	{
		el = el || window;
		if (window.addEventListener)
		{
			el.addEventListener(eventName, handler, false);
		}
		else
		{
			el.attachEvent('on' + eventName, handler);
		}		
	},
	addEventHandler: function(target, eventName, handler)
	{
		if (!eventName || !handler)
		{
			return;
		}

		this.eventHandlers.push({
			'target': target,
			'eventName': eventName,
			'handler': handler
		});
	},
	execEventHandler: function(target, eventName, params)
	{
		params = params || [];
		if (!eventName)
		{
			return;
		}

		this.eventHandlers.forEach(function (eventHandler) {
			if (eventHandler.eventName != eventName)
			{
				return;
			}
			if (eventHandler.target != target)
			{
				return;
			}

			eventHandler.handler.apply(this, params);
		}, this);

		if(target == this)
		{
			// global events
		}
		else
		{
			if(target.handlers && target.handlers[eventName])
			{
				target.handlers[eventName].apply(this, params);
			}
		}
	},
    validateEmail:function(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
};
function feed_facebook_ui(link, name, description, picture) {
    FB.ui({
        method: 'feed',
        name: name,
        link: link,
        picture: picture,
        caption: description,
        description: description
    }, function (response) {
        if (response && response.post_id) {
            alert('Post was published.');
        } else {
            alert('Post was not published.');
        }
    });
};
function shareOverrideOGMeta(overrideLink, overrideTitle, overrideDescription, overrideImage)
{
    FB.ui({
            method: 'share_open_graph',
            action_type: 'og.shares',
            action_properties: JSON.stringify({
                object: {
                    'og:url': overrideLink,
                    'og:title': overrideTitle,
                    'og:description': overrideDescription,
                    'og:image': overrideImage
                }
            })
        },
        function (response) {
            // Action after response
        });
};
function createPictureContent(data,showBackBtn) {
    $('body').addClass('form-sutmited');
    let od_div = document.getElementById('event_custom_body_od_div');
    let od_div2 = document.getElementById('event-custom-form-od-div2');
    $(od_div).addClass('current-form-sutmited');
    /*If success change page*/
    if(typeof od_div2 !== "undefined" && od_div2 != null) {
        od_div2.style.display = 'none';
    }
    let __div = $('<div />', {
        class: 'event_custom_body_submitted',
        id: 'event_custom_body_submitted',
    });
    let img_div = $('<div />', {class: 'event-custom-client-div', id: 'event-custom-client-div',});
    let img = $('<img />', {class: 'event-custom-client-img', id: '', src: data.PHOTO});
    let buttonDiv = $('<div />', {class: 'button_group', id: 'button_group',});
    let backBtnDiv = $('<div />', {
        class: 'button-back',
    });
    let shareAdditionalClass = '';
    if(showBackBtn) {
        let backBtn = $('<span />', {
            class: 'button-back-span',
            text: "back"
        });
        backBtnDiv.append(backBtn);
        backBtn.click(function (e) {
            if (typeof od_div2 !== "undefined" && od_div2 != null) {
                od_div2.style.display = 'block';
            }
            $('body').removeClass('form-sutmited');
            $(od_div).removeClass('current-form-sutmited');
            __div.remove();
            client_photo.value = '';
            client_photo_label.innerHTML = 'Upload Image';
        });
    } else {
        shareAdditionalClass = ' button-fb-share-center'
    }
    let shareBtnDiv = $('<div />', {
        class: 'button-fb-share' + shareAdditionalClass,
    });
    let shareBtn = $('<span />', {
        class: 'button-fb-share-span',
        text: "Share now",
        onclick: "return shareOverrideOGMeta('"+window.location.origin + window.location.pathname+"?detail="+data.ID+"','Old Navy','KHOE KHOẢNH KHẮC WEFIE - NHẬN QUÀ VUI HẾT Ý. Tham gia ngay cùng bạn bè để nhân rộng niềm vui cùng Old Navy','"+data.PHOTO+"')",
    });
    shareBtnDiv.append(shareBtn);
    buttonDiv.append(backBtnDiv, shareBtnDiv);
    img_div.append(img);
    img_div.append(buttonDiv);
    __div.append(img_div);
    $('body').append(__div);
}

EventFormLoader.init();