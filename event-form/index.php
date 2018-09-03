<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="custom_style.css">
    <script src="jquery-3.3.1.min.js"></script>
    <meta property="og:url"           content="https://younetsi.com" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Your Website Title" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="https://codepedia.info/files/uploads/2015/08/getFileName_size.jpg" />
</head>
<body >
<div class="event_custom_body">
    <div class="event-custom-form">
        <!-- Your share button code -->
<!--        <div class="fb-share-button"-->
<!--             data-href="https://younetsi.com"-->
<!--             data-layout="button_count">-->
<!--        </div>-->
        <form class="event-custom-form" id="event-custom-form">
            <div>
                <input name = "client_name" id="client_name" type="text" placeholder="Your Name">
                <label class="input-error" id="client_name_error"></label>
            </div>
            <div>
                <input name = "client_email" id="client_email" type="text" placeholder="Email">
                <label class="input-error" id="client_email_error"></label>
            </div>
            <div>
                <input name = "client_phone" id="client_phone" type="text" placeholder="Phone number">
                <label class="input-error" id="client_phone_error"></label>
            </div>
            <div class="js">
                <div class="input-file-container">
                    <input class="input-file" id="client_photo" name="client_photo" type="file">
                    <label tabindex="0" for="my-file" class="input-file-trigger">Upload Image</label>
                    <label class="input-error" id="client_file_error"></label>
                </div>
            </div>
<!--            <button type="s ubmit"> Submit</button>-->
        </form>
    </div>
</div>
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1654283924700370',
            xfbml      : true,
            version    : 'v3.1'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function feed_facebook_ui(link, name, description, picture) {
        FB.ui({
            method: 'feed',
            name: name,
            link: link,
            picture: picture,
            caption: description,
            description: description
        }, function(response) {
            if (response && response.post_id) {
                alert('Post was published.');
            } else {
                alert('Post was not published.');
            }
        });
    }
</script>

    </body>
<script>
    let eventContent = $('.event_custom_body').first();
    let fileInput = $('.input-file');
    let buttonLabel = $('.input-file-trigger');
    let the_return = $('.file-return');


    let myForm = $('#event-custom-form').first();
    let _inputName =  $('#client_name').first();
    let _inputNameErrorElement =  $('#client_name_error').first();
    let _inputEmail =  $('#client_email').first();
    let _inputEmailErrorElement =  $('#client_email_error').first();
    let _inputPhone =  $('#client_phone').first();
    let _inputPhoneErrorElement =  $('#client_phone_error').first();
    let _inputFileErrorElement =  $('#client_file_error').first();
    let _inputFile =  $('#client_photo').first();
    let _inputPhotoError =  '';
    buttonLabel.click(function( event ) {
        fileInput.focus();
        return false;
    });
    _inputFile.change(function( event ) {
        let error = false;

        let _inputNameValue =  _inputName.val();
        let _inputNameError =  '';

        let _inputEmailValue =  _inputEmail.val();
        let _inputEmailError =  '';

        let _inputPhoneValue =  _inputPhone.val();
        let _inputPhoneError =  '';

        let _inputFileValue =  _inputFile.val();
        let _inputFileError =  '';

        _inputNameErrorElement.text('');
        _inputEmailErrorElement.text('');
        _inputPhoneErrorElement.text('');

        //Input CHeck
        if(typeof _inputNameValue === 'undefined' || _inputNameValue.length === 0) {
            _inputNameError = 'Please input your name';
            error = true;
        }
        if(typeof _inputEmailValue === 'undefined' || _inputEmailValue.length === 0) {
            _inputEmailError = 'Please input your email';
            error = true;
        } else if(!validateEmail(_inputEmailValue)) {
            _inputEmailError = 'Email Invalid';
            error = true;
        }
        if(typeof _inputPhoneValue === 'undefined' || _inputPhoneValue.length === 0) {
            _inputPhoneError = 'Please input your phone';
            error = true;
        }

        //File check
        debugger;
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
                    if(fileSize < defaulSize) {
                        _inputFileError = 'Vui lòng sử dụng hình ảnh có kích thước 596 x 601 trở lên';
                        error = true;
                    }
                    break;
                default:
                    _inputFileError = 'Image is one of types: jpg, png, jpeg';
                    error = true;
            }
        }
        if(error) {
            if(_inputNameError.length > 0) {
                _inputNameErrorElement.text(_inputNameError);
            }
            if(_inputEmailError.length > 0) {
                _inputEmailErrorElement.text(_inputEmailError);

            }
            if(_inputPhoneError.length > 0) {
                _inputPhoneErrorElement.text(_inputPhoneError);

            }
            if(_inputFileError.length > 0) {
                _inputFileErrorElement.text(_inputFileError);

            }
            _inputFile.val('');
        } else {
            var fileName = event.target.files[0].name;
            buttonLabel[0].innerHTML = fileName;
            _inputFileErrorElement.text('');
            myForm.submit();
        }


    });

    _inputName.keydown(function() {
        _inputNameErrorElement.text('');
    });
    _inputEmail.keydown(function() {
        _inputEmailErrorElement.text('');
    });
    _inputPhone.keydown(function() {
        _inputPhoneErrorElement.text('');
    });


    myForm.submit(function(e) {
            var formData = new FormData(this);
            $.ajax({
                url: 'http://ruaxanh.nhatth2.com/event-form/ajax.php',
                type: 'POST',
                data: formData,
                success: function (result) {
                    result = JSON.parse(result);
                    $('body').addClass('form-sutmited');
                    eventContent.addClass('current-form-sutmited');
                    /*If success change page*/
                    $('.event-custom-form').remove();
                    let __div = $('<div />', {class: 'event_custom_body_submitted', id: 'event_custom_body_submitted',});
                    let img_div = $('<div />', {class: 'event-custom-client-div', id: 'event-custom-client-div',});
                    let img = $('<img />', {class: 'event-custom-client-img', id: '', src: result.url_image});
                    let buttonDiv = $('<div />', {class: 'button_group', id: 'button_group',});
                    let backBtnDiv = $('<div />', {
                        class: 'button-back',
                        onclick: "console.log('back')",
                    });
                    let backBtn = $('<span />', {
                        class: 'button-back-span',
                        text:"back"
                    });
                    backBtnDiv.append(backBtn);
                    let shareBtnDiv = $('<div />', {
                        class: 'button-fb-share',
                        onclick: "console.log('Share')",
                    });
                    let shareBtn = $('<span />', {
                        class: 'button-fb-share-span',
                        text:"Share now"
                    });
                    shareBtnDiv.append(shareBtn);
                    buttonDiv.append(backBtnDiv,shareBtnDiv);
                    // let shareButton = $('<div />', {
                    //     class: 'fb-share-button-custom',
                    //     onclick: "return feed_facebook_ui('http://www.cafedenam.com/chi-tiet-bai-viet/20','abacdabaca......','abacdabaca......','http://cafedenam-cms-production.s3-ap-southeast-1.amazonaws.com/iblock/913/913c0bdf2ff743d6677db3f6bbf1abc1.jpg')",
                    //     text: "Chia sẻ lên facebook"
                    // });
                    img_div.append(img);
                    img_div.append(buttonDiv);
                    __div.append(img_div);
                    $('body').append(__div);
                    e.preventDefault();
                },
                cache: false,
                contentType: false,
                processData: false
            });
        e.preventDefault();
    });
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
</script>
</html>