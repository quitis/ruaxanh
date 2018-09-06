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
        link.href 		= 'http://ruaxanh.net/event-form/custom_style_v2.css?v=06090935';
        link.media 	= 'all';
        head.appendChild(link);

        /*
        * Crop
        * */
        var linkCropCss  		= document.createElement('link')
        linkCropCss.rel  			= 'stylesheet';
        linkCropCss.type 		= 'text/css';
        linkCropCss.href 		= 'http://ruaxanh.net/event-form/css/jquery.Jcrop.css?v=06090935';
        linkCropCss.media 	= 'all';
        head.appendChild(linkCropCss);

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
            var scriptcrop = document.createElement("SCRIPT");
            scriptcrop.src = 'http://ruaxanh.net/event-form/js/jquery.Jcrop.js?v=06090935';
            scriptcrop.type = 'text/javascript';
            document.getElementsByTagName("head")[0].appendChild(scriptcrop);
			$(function() {
				var params = window[window.EventFormObject].forms[0];
                var user_id = params.user_id;
                var bLoadForm = false;
                if(user_id > 0) {
                    $.ajax({
                        url: 'http://ruaxanh.net/api/',
                        type: 'GET',
                        data: {id: user_id},
                        success: function (result) {
                            if (result.code === 1) {
                                var user_data = result.data;
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
		var me = this;
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
        //Crop Parameter
        var _x = document.createElement('input');
        _x.type 	= "hidden";
        _x.name = "photo_x";
        _x.setAttribute("id", "photo_x");
        var _y = document.createElement('input');
        _y.type 	= "hidden";
        _y.name = "photo_y";
        _y.setAttribute("id", "photo_y");
        var _w = document.createElement('input');
        _w.type 	= "hidden";
        _w.name = "photo_w";
        _w.setAttribute("id", "photo_w");
        var _h = document.createElement('input');
        _h.type 	= "hidden";
        _h.name = "photo_h";
        _h.setAttribute("id", "photo_h");

        od_form.append(_x);
        od_form.append(_y);
        od_form.append(_w);
        od_form.append(_h);

        //client name
        var div		= document.createElement('div');
        var client_name = document.createElement('input');
        client_name.type 	= "text";
        client_name.name = "client_name";
        client_name.setAttribute("id", "client_name");
        client_name.setAttribute("placeholder", "Your Name");
        client_name.setAttribute("autocomplete", "off");

        var client_name_error  = document.createElement('label');
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
        var client_email_error  = document.createElement('label');
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
        var client_phone_error  = document.createElement('label');
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

        var client_photo_img = document.createElement('img');
        div2.appendChild(client_photo_img);

        var client_file_notify  = document.createElement('label');
        client_file_notify.id = "client_file_notify";
        client_file_notify.setAttribute("class", "client_file_notify");
        client_file_notify.innerHTML = "* Lưu ý:<br/>- Nên sử dụng hình ảnh kích cỡ vuông.<br/>"+
        "- Nếu iPhone/iPad của bạn chưa load được hình, vui lòng làm theo hướng dẫn sau:<br>"+
        "Vào <b>Setting</b> > <b>Photo</b> > Chọn <b>Automatic</b> trong trường <b>TRANFER TO MAC OR PC</b> để chuyển đổi hình sang định dạng .jpg";

        var client_file_error  = document.createElement('label');
        client_file_error.id = "client_file_error";
        client_file_error.setAttribute("class", "input-error");
        div2.appendChild(client_file_error);

        div.appendChild(div2);
        div.appendChild(client_file_notify);
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
            var error = false;

            var _inputNameValue =  client_name.value;
            var _inputNameError =  '';

            var _inputEmailValue =  client_email.value;
            var _inputEmailError =  '';

            var _inputPhoneValue =  client_phone.value;
            var _inputPhoneError =  '';

            var _inputFileValue =  client_photo.value;
            var _inputFileError =  '';

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
            var fileSize = this.files[0].size;
            var file = this.files && this.files[0];;
            var defaulSize = 595*601;
            if(typeof _inputFileValue === 'undefined' || _inputFileValue.length == 0) {
                _inputFileError = 'Please choose your image';
                error = true;
            } else {
                var extension = _inputFileValue.replace(/^.*\./, '');
                if (extension == _inputFileValue) {
                    extension = '';
                } else {
                    extension = extension.toLowerCase();
                }

                switch (extension) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
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
                /*Check image size*/
                if( file ) {
                    var img = new Image();
                    img.src = window.URL.createObjectURL(file);
                    img.id="img-after-upload";
                    img.onload = function() {
                        createModalCrop(img);
                        //     var tile = parseInt(width/height * 100);
                    //     if( width >= 596 && height >= 601 && tile < 105 && tile > 95) {
                    //         var fileName = event.target.files[0].name;
                    //         // client_photo_label.innerHTML = fileName;
                    //     } else {
                    //         client_file_error.innerHTML = 'Hình ảnh bạn vừa đăng tải chưa phù hợp về kích thước.\n' +
                    //             'Vui lòng sử dụng hình ảnh kích thước 596 x 601 pixel trở lên';
                    //
                    //     }
                    };
                }


            }
        });
        $('#event-custom-form').submit(function(e) {
            var waitModal = createModal("Đang xử lý. Vui lòng đợi",false);
            var formData = new FormData(this);
            $.ajax({
                url: 'http://ruaxanh.net/api/',
                type: 'POST',
                data: formData,
                success: function (result) {
                    waitModal.remove();
                    // result = JSON.parse(result);
                    var code = result.code;
                    var data = result.data;
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
function shareOverrideOGMeta(overrideLink, overrideTitle, overrideDescription, overrideImage,client_id)
{
    var waitModal = createModal("Đang xử lý. Vui lòng đợi",false);
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
            waitModal.remove();
            if (response && !response.error_message) {
                var emailModal = createModal("Đang  gửi voucher về địa chỉ email bạn đã đăng kí.<br\> Vui lòng đợi.",false);
                $.ajax({
                    url: 'http://ruaxanh.net/api/',
                    type: 'POST',
                    data: {
                        action:'sent_email',
                        client_id:client_id
                    },
                    success: function (result) {
                        emailModal.remove;
                        if(result.code == 1) {
                            createModal('Cảm ơn bạn đã tham gia chương trình.<br\>Mã voucher trị giá 200.000 VND sẽ được gửi về địa chỉ email bạn đã đăng kí.<br>Vui lòng kiểm tra kĩ trong hộp thư để không bỏ lỡ quà tặng từ Old Navy nhé!');
                        } else if(result.code == -3){
                            createModal(result.message)
                        } else {
                            console.log("Error: " + result.message);
                        }
                    },
                    dataType:'json'
                });
            } else {
                createModal('Xảy ra lỗi, vui lòng thực hiện lại. Cảm ơn!');
            }
            // Action after response
        });
};
function createModal(message,candelete = true ) {
    var modal = $('<div />', {class: 'modal', id: 'modal'});
    var modalConent = $('<div />', {class: 'modal-content', id: 'modal-content'});
    var modalBody = $('<div />', {class: 'modal-body', id: 'modal-body'});
    var modalBodyText = $('<p />', {class: 'modal-body-text', html: message});
    if(candelete) {
        var closebtn = $('<span />', {class: 'close', id: '', text: '×'});
        modalBody.append(closebtn);
    }
    modalBody.append(modalBodyText);
    modalConent.append(modalBody);
    modal.append(modalConent);
    $('body').append(modal);
    if(candelete) {
        closebtn.click(function () {
            modal.css("display", "none");
            modal.remove();
        });
        window.onclick = function (event) {
            if (event.target == modal[0]) {
                modal.css("display", "none");
                modal.remove();
            }
        }
    }
    modal.css("display", "block");
    return modal;

};
function createModalCrop(img) {
    window_height = $(window).height();
    // $(document).height();
    window_width = $(window).width();
    // $(document).width();
    var width = img.naturalWidth,
        height = img.naturalHeight;
    var paddingtop_modal = (window_height - height)/2 > 0?(window_height - height)/2 :0;

        var modal = $('<div />', {class: 'modal', id: 'modal'}).css('padding-top', paddingtop_modal + "px");
    var modalConent = $('<div />', {class: 'modal-content', id: 'modal-content',width: width}).css('max-height',window_height+40+'px');;
    var closebtn = $('<span />', {class: 'close', id: '', text: '×'});
    var modalBody = $('<div />', {class: 'modal-body  modal-content-img', id: 'modal-body',height:height,width: width}).css('max-height',window_height+'px');
    var modalBodyImg = $('<img />', {id:'img-after-upload',class: 'modal-body-img', src: img.src, height:'300px'});
    var modalFooter = $('<div />', {id:'modal-footer',class: 'modal-footer'});
    var modalButon = $('<button />', {id:'submit-form',class: 'submit-form-btn',value:'Finish', text:'Finish'});

    modalButon.click(function(){
        modal.css("display", "none");
        window.URL.revokeObjectURL(img.src);
        modal.remove();
        $('#event-custom-form').first().submit();
        return;
    });
    modalConent.append(closebtn);
    modalBody.append(modalBodyImg);
    modalFooter.append(modalButon);
    modalConent.append(modalBody);
    modalConent.append(modalFooter);
    modal.append(modalConent);
    $('body').append(modal);
    $('#img-after-upload').Jcrop({
        aspectRatio: 1,
        maxSize:[595,605],
        min:[595,605],
        onSelect: updateCoords,
        onChange: updateCoords
    },function(){
        jcrop_api = this;
        jcrop_api.animateTo([1,1,595,605]);
    });



    closebtn.click(function () {
        modal.css("display", "none");
        client_photo.value = '';
        window.URL.revokeObjectURL( img.src );
        resetCoords();
        modal.remove();
    });
    modal.css("display", "block");
    // window.onclick = function (event) {
    //     if (event.target == modal[0]) {
    //         modal.css("display", "none");
    //         client_photo.value = '';
    //         resetCoords();
    //         window.URL.revokeObjectURL( img.src );
    //         modal.remove();
    //
    //     }
    // }
}
function createPictureContent(data,showBackBtn) {
    $('body').addClass('form-sutmited');
    var od_div = document.getElementById('event_custom_body_od_div');
    var od_div2 = document.getElementById('event-custom-form-od-div2');
    $(od_div).addClass('current-form-sutmited');
    /*If success change page*/
    if(typeof od_div2 !== "undefined" && od_div2 != null) {
        od_div2.style.display = 'none';
    }
    var __div = $('<div />', {
        class: 'event_custom_body_submitted',
        id: 'event_custom_body_submitted',
    });
    var img_div = $('<div />', {class: 'event-custom-client-div', id: 'event-custom-client-div',});
    var img = $('<img />', {class: 'event-custom-client-img', id: '', src: data.PHOTO});
    var buttonDiv = $('<div />', {class: 'button_group', id: 'button_group',});
    var backBtnDiv = $('<div />', {
        class: 'button-back',
    });
    var shareAdditionalClass = '';
    if(showBackBtn) {
        var backBtn = $('<span />', {
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
    var shareBtnDiv = $('<div />', {
        class: 'button-fb-share' + shareAdditionalClass,
    });
    var shareBtn = $('<span />', {
        class: 'button-fb-share-span',
        text: "Share now",
        onclick: "return shareOverrideOGMeta('"+window.location.origin + window.location.pathname+"?detail="+data.ID+"','KHOE KHOẢNH KHẮC WEFIE - NHẬN QUÀ VUI HẾT Ý','Tham gia ngay cùng bạn bè để nhân rộng niềm vui cùng Old Navy','"+data.PHOTO+"',"+data.ID+")",
    });
    shareBtnDiv.append(shareBtn);
    buttonDiv.append(backBtnDiv, shareBtnDiv);
    img_div.append(img);
    img_div.append(buttonDiv);
    __div.append(img_div);
    $('body').append(__div);
}
function updateCoords(c)
{
    $('#photo_x').val(c.x);
    $('#photo_y').val(c.y);
    $('#photo_w').val(c.w);
    $('#photo_h').val(c.h);
};
function resetCoords() {
    $('#photo_x').val(0);
    $('#photo_y').val(0);
    $('#photo_w').val(0);
    $('#photo_h').val(0);
}

function checkCoords()
{
    if (parseInt($('#photo_w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
};

EventFormLoader.init();