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
<body>
<div class="event_custom_body">
    <div class="event-custom-form">
        <!-- Your share button code -->
<!--        <div class="fb-share-button"-->
<!--             data-href="https://younetsi.com"-->
<!--             data-layout="button_count">-->
<!--        </div>-->
        <form class="event-custom-form" id="event-custom-form">
            <div>
                <input name = "client_name" type="text" placeholder="Your Name">
            </div>
            <div>
                <input name = "client_email" type="text" placeholder="Email">
            </div>
            <div>
                <input name = "client_phone" type="text" placeholder="Phone">
            </div>
            <div class="js">
                <div class="input-file-container">
                    <input class="input-file" id="my-file" name="client_photo" type="file">
                    <label tabindex="0" for="my-file" class="input-file-trigger">Select a file...</label>
                </div>
            </div>
            <button type="s ubmit"> Submit</button>
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

    buttonLabel.click(function( event ) {
        fileInput.focus();
        return false;
    });
    fileInput.change(function( event ) {
        var fileName = event.target.files[0].name;
        buttonLabel[0].innerHTML = fileName;
    });
    let myForm = $('#event-custom-form').first();
    myForm.submit(function(e) {
        var formData = new FormData(this);

        $.ajax({
            url: '/pub/nhatth2/ajax.php',
            type: 'POST',
            data: formData,
            success: function (result) {
                result = JSON.parse(result);
                /*If success change page*/
                $('.event-custom-form').remove();
                let img_div = $('<div />',{class:'event-custom-client-div',id:'event-custom-client-div',});
                let img = $('<img />',{class:'event-custom-client-img',id:'',src:result.url_image});
                let shareButton = $('<div />',{class:'fb-share-button-custom',onclick:"return feed_facebook_ui('http://www.cafedenam.com/chi-tiet-bai-viet/20','abacdabacaabab......','abacdabacaabab......','http://cafedenam-cms-production.s3-ap-southeast-1.amazonaws.com/iblock/913/913c0bdf2ff743d6677db3f6bbf1abc1.jpg')",text:"Chia sẻ lên facebook"});
                img_div.append(img);
                img_div.append(shareButton);
                eventContent.append(img_div);
                e.preventDefault();
            },
            cache: false,
            contentType: false,
            processData: false
        });

        e.preventDefault();
    })
</script>
</html>