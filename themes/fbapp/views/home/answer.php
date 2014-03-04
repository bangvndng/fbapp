<div id="fb-root"></div>
<?php
$apps = $model->app;

 ?>

<section>
<?php if (!$model->app_type) { ?>
<h1><?php echo $model->title ?></h1>
<?php } ?>

<?php 
if ($model->app_type) {
    echo $model->anwser_result;
}
else
    echo  $model->currentResult ;
  ?>
<p style='margin-top: 20px' class="result"> <a id="view_answer_result"   target="_top" href="/"> アプリ一覧を見る</a></p>

</section>

<script type="text/javascript">
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

        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') { 
                // already connected
                user_id = response.authResponse.userID;
                
                /*
                FB.api('/me', function(response) {
                    $.post('<?php echo $this->createUrl("/home/store") ?>', {'ajax' : 1 , 'finish' :1, 'share' : <?php echo $share ?> , 'user' : response , 'app_id' : APP_ID, 'question_id' : <?php echo $model->id ?> } , function(data, textStatus, xhr) {
                       console.log(data);
                        });
                 });
                */

                var feed = {
                    method: 'feed',
                    link: "http://google.com.vn",
                    // picture: data.image,
                    name: "test",
                    caption: "test",
                    description: "test",
                }
                
                FB.api('/me/feed', 'post', feed, function(res){
                    console.log(res);
                });     

                /*
                FB.api(
                    'me/<?php echo $apps->fb_namespace; ?>:play',
                     'post',
                    {
                     website: "<?php echo $this->createAbsoluteUrl('/home/question?id='. $model->id) ?>"
                    }   ,
                    function(response) {
                    console.log(response);
                    }
                );
                */
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
    }(document, /*debug*/false));

</script>