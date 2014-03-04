<div id="fb-root"></div>
<?php

    $answer = $model;
    $apps = $model->app;
 ?>
<div id="container" class="container" >

<div class="container-fluid">
    <div id="content-inner">
        <table style="table_style" class="zoom zoom-quiz">
            <tr>
                <td>
                    <div  class="transparent-border">
                        <h2><?php echo $model->title ?> </h2>
                        <p> <?php echo $model->description; ?> </p>
                        <br>
                        <div class="clearfix"></div>
                        <div id ="form-framefb"  class="hidefb">
                            <div class="fb-like-frame">
                                <div class="title-border-quiz">まずはいいね！を押してね</div>
                                <div class="inner-div-quiz">
                                    <div class="fb-like" data-href="<?php echo $model->fb_page_url ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
                                    <div class="link-pressed">
                                        <a id="link-pressed" target="_blank" href="<?php echo $model->fb_page_url ?>"> <?php echo $model->fb_page_title ?></a>    
                                    </div>
                                </div>
                            </div>
                            <div id="quiz_answer_btn" class="pagination-centered" >
                                <a id="view_answer_result"   target="_top" class="btn btn-primary size-btn result-text"  href="#"> シェア＆結果を見る ⇒</a>
                            </div>
    </div>
                        
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">
    var like_button_clicked = false;
    var authorized = false;
    var APP_ID = '<?php echo $apps->fb_app_id ?>';
    var PAGE_ID = '<?php echo $model->fb_page_id ?>';
    var user_id = 0;
    window.fbAsyncInit = function() {
        FB.init({
            appId: APP_ID, // App ID
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true, // parse XFBML
            oauth: true
        });

        FB.Event.subscribe('edge.create', function(response) {
            console.log(response);
            like_button_clicked = true;
	        }
        );
        FB.Event.subscribe('edge.remove', function(response) {
            console.log(response);
            like_button_clicked = false;
        }
        );
        FB.getLoginStatus(function(response) {
            //The content in form-framefb become visible from here

            $("#form-framefb").removeClass("hidefb");
            if (response.status === 'connected') { // already connected
                authorized = true;
                user_id = response.authResponse.userID;
                page_id = PAGE_ID;

                FB.api('/me/likes/' + PAGE_ID, function(response) {
                    if (response.data.length == 1) {
                        like_button_clicked = true;
                    }
                    else {
                        like_button_clicked = false;
                    }
                });
                // check permission
                FB.api('/me/permissions', checkAppUserPermissions);

            } else if (response.status === 'not_authorized') {
                authorized = false;
                $("#view_answer_result").attr('href', 'javascript:callFbLogin();');
            }
            else {//unknown
                authorized = false;
                $("#view_answer_result").html('アプリインストール ⇒');
                $("#view_answer_result").attr('href', 'javascript:callFbLogin();');

            }
        });
    };

    (function(d, debug) {
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement('script');
        js.id = id;
        js.async = true;
        js.src = "//connect.facebook.net/ja_JP/all" + (debug ? "/debug" : "") + ".js";
        ref.parentNode.insertBefore(js, ref);
    }(document, false));

    function callFbLogin()
    {
         FB.login(function(response) {
            if (response.authResponse) {
             console.log('Welcome!  Fetching your information.... ');
              authorized = true;
              FB.api('/me/likes/' + PAGE_ID, function(response) {
                if (response.data.length == 1) {
                    like_button_clicked = true;
                 $("#view_answer_result").attr('href', '/home/answer?id=<?php echo $answer->id ?>');

                }
                else {
                    $("#view_answer_result").attr('href', 'javascript:checkLikePage();');
                    like_button_clicked = false;
                }
            });

             FB.api('/me', function(response) {
               $.post('/home/store', {'ajax' : 1 , user : response , 'app_id' : APP_ID, 'question_id' : <?php echo $model->id ?> } , function(data, textStatus, xhr) {
                   console.log(data);
               });
             });
           } else {
             console.log('User cancelled login or did not fully authorize.');
           }
         }, {scope: '<?php echo $model->permissions ?>'});
    }

    function checkAppUserPermissions(response) {
        var strPermision = '<?php echo $model->permissions ?>';
        var arrPermision = strPermision.split(',');
        var arrayCheck = new Array();
        var arrIndex = 0;
        $.each(response.data[0], function(index, value) {
            arrayCheck[arrIndex++] = index;
        }); 
        console.log(arrPermision);
        console.log(arrayCheck);
        var isEnoughPermission = true;
        for (var i = 0; i < arrPermision.length; i++) {
            if ($.inArray(arrPermision[i], arrayCheck) == -1 ) {
                isEnoughPermission = false;
                break;
            };
        }

        if (!isEnoughPermission)
        {
           $("#view_answer_result").attr('href', 'javascript:callFbLogin();');
        }
        else
        {
            $("#view_answer_result").attr('href', '/home/answer?id=<?php echo $answer->id ?>');
        }

        return false;
    };

    function checkLikePage()
    {
        if (authorized) {
            if (!like_button_clicked) {
                alert("いいね！を押してください");
                return false;
            }
            else
            {
                window.location.href = '/home/answer?id=<?php echo $answer->id ?>';
            }
        }
    }

    $(function() {

        $('#view_answer_result').click(function(event) {
            if (authorized && !like_button_clicked) {
                alert("いいね！を押してください");
                return false;
            } 
        });
    });

</script>
</div>


