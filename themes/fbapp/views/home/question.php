<div id="fb-root"></div>
<?php

    $answer = $model;
    $apps = $model->app;
 ?>

<section <?php if ($model->app_type) echo 'class="image"'; ?>>

<?php echo $model->intro; ?> 


<div class="sns_wrap">
    <p>まずはいいね！を押してね</p>
        <div style='overflow:hidden' class="fb-like" data-href="<?php echo $model->fb_page_url ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
    <div class="link-pressed" style='margin-top: 10px;'>
        <a id="link-pressed" target="_blank" href="<?php echo $model->fb_page_url ?>"> <?php echo $model->fb_page_title ?></a>    
    </div>

</div>
<p class="result"> <a id="view_answer_result"   target="_top" href="#"> <?php if ($model->app_type) echo 'シェアをして次へ進む⇒'; else echo 'シェアをして次へ進む⇒';?></a></p>

</section>

<script type="text/javascript">
    var like_button_clicked     = false;
    var is_share                = true;
    var authorized              = false;
    var APP_ID                  = '<?php echo $apps->fb_app_id ?>';
    var PAGE_ID                 = '<?php echo $model->fb_page_id ?>';
    var user_id                 = 0;

    window.fbAsyncInit = function() {
        console.log('/question fbAsyncInit');
        FB.init({
            appId: APP_ID, // App ID
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true, // parse XFBML
            oauth: true
        });

        FB.Event.subscribe('edge.create', function(response) {
            console.log("edge.create");
            console.log(response);
            like_button_clicked = true;
        });
        
        FB.Event.subscribe('edge.remove', function(response) {
            console.log("edge.create");
            console.log(response);
            like_button_clicked = false;
        });
        
        FB.getLoginStatus(function(response) {
            //The content in form-framefb become visible from here
            console.log("FB.getLoginStatus response");
            console.log(response);

            if (response.status === 'connected') { // already connected

                console.log("FB.getLoginStatus connected");
                authorized = true;
                user_id = response.authResponse.userID;
                page_id = PAGE_ID;

                FB.api('/me/likes/' + PAGE_ID, function(response) {
                    console.log("Check if like or not");
                    console.log(response);
                    if (response.data.length == 1) {
                        like_button_clicked = true;
                        $('.sns_wrap').hide();
                    }
                    else {
                        like_button_clicked = false;
                    }
                });
                // check permission
                FB.api('/me/permissions', checkAppUserPermissions);

            } else if (response.status === 'not_authorized') {
                console.log("FB.getLoginStatus not_authorized");
                authorized = false;
                $("#view_answer_result").attr('href', 'javascript:callFbLogin();');
            }
            else {//unknown
                console.log("FB.getLoginStatus unknown");
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
        console.log("insertBefore facebook-jssdk");

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
                    if (!is_share) {
                        $("#view_answer_result").attr('href', '<?php echo $this->createUrl("/home/answer?id=" . $answer->id . "&share=0") ?>');
                    }
                    else
                    {
                        $("#view_answer_result").attr('href', '<?php echo $this->createUrl("/home/answer?id=" . $answer->id ) ?>');
                    }

                }
                else {
                    $("#view_answer_result").attr('href', 'javascript:checkLikePage();');
                    like_button_clicked = false;
                }
            });

            /*
            FB.api('/me', function(response) {
                $.post('<?php echo $this->createUrl("/home/store") ?>', {'ajax' : 1 , user : response , 'app_id' : APP_ID, 'question_id' : <?php echo $model->id ?> } , function(data, textStatus, xhr) {
                   console.log(data);
                });
            });
            */
           } else {
             console.log('User cancelled login or did not fully authorize.');
           }
         }, {scope: '<?php echo $model->permissions ?>'});
    }

    function checkAppUserPermissions(response) {
        console.log("/question checkAppUserPermissions");

        var strPermision = '<?php echo $model->permissions ?>';
        var arrPermision = strPermision.split(',');
        var arrayCheck = new Array();
        var arrIndex = 0;

        $.each(response.data[0], function(index, value) {
            arrayCheck[arrIndex++] = index;
        }); 
        

        console.log("/question checkAppUserPermissions arrPermision");
        console.log(arrPermision);
        console.log("/question checkAppUserPermissions arrayCheck");
        console.log(arrayCheck);
        
        var isEnoughPermission = true;
        for (var i = 0; i < arrPermision.length; i++) {
            if ($.inArray(arrPermision[i], arrayCheck) == -1 ) {
                isEnoughPermission = false;
                break;
            };
        }

        if (!isEnoughPermission){
           $("#view_answer_result").attr('href', 'javascript:callFbLogin();');
        }
        else{
            if (!is_share){
                $("#view_answer_result").attr('href', '<?php echo $this->createUrl("/home/answer?id=" . $answer->id . "&share=0") ?>');
            }else{
                $("#view_answer_result").attr('href', '<?php echo $this->createUrl("/home/answer?id=" . $answer->id ) ?>');
            }
        }

        return false;
    };

    function checkLikePage()
    {
        if (authorized) {
            if (!like_button_clicked) {
                alert("いいね！を押してください");
                return false;
            }else{
                if (!is_share) {
                     window.location.href = '<?php echo $this->createUrl("/home/answer?id=" . $answer->id . "&share=0") ?>';
                }else{
                     window.location.href = '<?php echo $this->createUrl("/home/answer?id=" . $answer->id ) ?>';
                }
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