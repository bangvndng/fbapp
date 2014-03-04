<div id="fb-root"></div>
<?php
$apps = $model->app;

 ?>
                <div id="container" class="container" >

            
            <div class="container-fluid">
    <div id="content-inner" >
        <table style="table_style"  class="zoom zoom-quiz">
            <tr>
                <td >
                    <div class="transparent-border">
                        <div id="quiz_answer_html">
                            <?php 
                            if ($model->app_type) {
                                echo $model->anwser_result;
                            }
                            else
                                echo  $model->currentResult ;
                              ?>
                        </div>
                        <!--Comment form-->
                        <form class="form-horizontal" id="comment_form"  method="post">
                            <input type="hidden" value="409" name="quiz_id" />
                            <input type="hidden" id="title" name="title" value="【完全版】あなたは男性脳？女性脳？"/>
                            <div id="quiz_answer_btn" class="pagination-centered" >
                                <a id="view_answer_result"  target="_top" class="btn btn-primary size-btn"  href="/"><span class="result-text">クイズ一覧を見る</span> </a>
                            </div>
                        </form>

                         <?php $this->widget('bootstrap.widgets.TbGridView', array(
                            'type'=>'striped bordered condensed',
                            'dataProvider'=>$recommended,
                            'template'=>"{items}",
                            'columns'=>array(
                                array( 'type'=>'raw', 'header'=>'▼今人気！', 'value' => 'CHtml::link(CHtml::encode($data->title),array("question","id"=>$data->id))' ),
                            ),
                        )); ?>
                   </div>
                </td>
            </tr>

      </table>
    </div>
  </div>


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
                FB.api('/me', function(response) {
                    $.post('/home/store', {'ajax' : 1 , user : response , 'app_id' : APP_ID, 'question_id' : <?php echo $model->id ?> } , function(data, textStatus, xhr) {
                       console.log(data);
                        });
                 });

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
        </div>
