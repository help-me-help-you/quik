<?php
$this->title = $model->ad_title;
use  \common\models\Message;

\common\models\Ads::view($model->id);
$currency_default = common\models\Currency::default_currency();

$current_url = \yii\helpers\Url::current();
\yii\helpers\Url::remember($current_url,'currency_p');

$session2 = Yii::$app->cache;
$default_selected = $session2->get('default_currency');
$default = (isset($default_selected))?$default_selected:$currency_default;

?>
<?php
if($model->category== 'Jobs' or $model->sub_category == 'Services')
{
    $view = "none";
}
else
{
    $view = "block";
}

?>
<!--single-page-->

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xs-12 col-sm-12">
            <div class="row">
                <div class="col-lg-12 AduListBreg" style="margin-top: 30px;">

                    <a href="<?= \yii\helpers\Url::toRoute('site/index') ?>">
                        <i class="fa fa-home"></i>
                    </a>
                    <span class="span"><i class="fa fa-angle-right"></i> </span>
                    <a href="<?= \yii\helpers\Url::toRoute('ads/category?cat='.$model->category) ?>"><?= $model->category ?></a>

                    <span class="span"><i class="fa fa-angle-right"></i> </span>
                    <a href="<?= \yii\helpers\Url::toRoute('ads/category') ?>#parentVerticalTab">
                        <?= $model->sub_category ?>
                    </a>

                    <span class="span"><i class="fa fa-angle-right"></i> </span>
                    <a href="<?= \yii\helpers\Url::toRoute('ads/category') ?>#parentVerticalTab">
                        <?= $model->type ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-lg-5">


        <div class="itemDetail">
            <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
                <div class='carousel-outer'>
                    <!-- me art lab slider -->
                    <div class='carousel-inner '>

                        <?php
                        $image = $model->image;
                        $imgChunck = explode(",",$image);

                        foreach($imgChunck as $arr => $img)
                        {
                            ?>
                            <div class='item <?= ($arr == 0)?"active":""; ?>'>
                                <img src='<?= Yii::getAlias('@web') ?>/images/products/<?= $img ?>' alt='' id="zoom_<?= $arr; ?>"  data-zoom-image="<?= Yii::getAlias('@web') ?>/images/products/<?= $img ?>"/>
                            </div>

                        <?php
                        }
                        ?>


                        <script>
                            $("#zoom_07").elevateZoom({ zoomType    : "inner", cursor: "crosshair" });
                        </script>
                    </div>

                    <!-- sag sol -->
                    <a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
                        <span class='glyphicon glyphicon-chevron-left'></span>
                    </a>
                    <a class='right carousel-control' href='#carousel-custom' data-slide='next'>
                        <span class='glyphicon glyphicon-chevron-right'></span>
                    </a>
                </div>
                <!-- thumb -->
                <ol class='carousel-indicators mCustomScrollbar meartlab'>
                    <?php
                    $image = $model->image;
                    $imgChunck = explode(",",$image);

                    foreach($imgChunck as $arr=> $img)
                    {
                        ?>

                        <li data-target='#carousel-custom' data-slide-to='<?= $arr; ?>' class='active'>
                            <img src='<?= Yii::getAlias('@web') ?>/images/products/<?= $img ?>' alt='' />
                        </li>

                    <?php
                    }
                    ?>
                    <li data-target='#carousel-custom' data-slide-to='2' class='active'><img src='assets2/images/ads/nano3.jpg' alt='' /></li>


                </ol>
            </div>

        </div>

        <div class="detaildescription">
            <h3>
                <?=  Yii::t('app', 'Description');?>
            </h3>
            <p>
                <?= $model->ad_description ?>
            </p>
            <div></div>
        </div>
    </div>
    <div class="col-lg-7">

        <div class="detailsBox ">
            <h2>
                <?= $model->ad_title ?>
            </h2>

            <div class="dealer">
                <div class="col-lg-2" align="center">
                   <h3>
                       <?=  Yii::t('app', 'View');?>
                   </h3>
                    <h4>
                       <?= $model->view ?>
                    </h4>
                </div>
                <div class="col-lg-3">
                    <h4>
                        <?= $model->city ?>
                    </h4>
                    <h3><?=  Yii::t('app', 'Location');?>  </h3>
                </div>
                <div class="col-lg-3">
                    <h3> <?= $model->name ?></h3>
                    <h4>
                      <i class="fa fa-mobile"></i>
                        <?php
                        if (Yii::$app->user->isGuest)
                        {
                            echo "XXXXXXXXX";
                        }
                        else
                        {
                            echo  $model->mobile ;
                        }
                        ?>
                    </h4>
                </div>
                <div class="col-lg-3">
                    <h4><?=  Yii::t('app', 'AD Posted');?>  </h4>
                    <h3>
                        <?= \common\models\Analytic::time_elapsed_string($model->created_at) ?><?=  Yii::t('app', 'Ago');?>
                    </h3>
                </div>
                <div class="clearfix"></div>
            </div>
            <span class="priceDetail">
                <span>
                     <?= \common\models\Ads::findDistance($model['lat'],$model['lng']) ?>Km away
                    <?=  Yii::t('app', 'from your location');?>
                </span>
                 <i class="<?= $default['symbol'] ?> currency"></i> <?= $model->price*$default['value']; ?>/-
                <br>
            </span>
            <div class="detailLoc">
                <i class="fa fa-map-marker"></i>
                <?=  Yii::t('app', 'Less then');?>
                  <?= \common\models\Ads::findDistance($model['lat'],$model['lng']) ?>km
            </div>
            <div class="detaiLBtn">
                <?php
                if (Yii::$app->user->isGuest)
                {
                    ?>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#doLogin" >
                        <i class="fa fa-comment-o"></i> <?=  Yii::t('app', 'Chat');?>
                    </a>
                    <?php
                }
                else
                {
                    ?>
                    <a href="javascript:void(0)" onclick="<?= (Yii::$app->user->isGuest == $model->user_id) ? "sorry()" : "openChat()"; ?>" >
                        <i class="fa fa-comment-o"></i> <?=  Yii::t('app', 'Chat');?>
                    </a>
                    <?php
                }
                ?>


                <?php
                if (Yii::$app->user->isGuest)
                {
                    ?>
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#doLogin" >
                        <i class="fa fa-eye"></i><?=  Yii::t('app', 'View Number');?>
                    </a>
                <?php
                }
                else
                {
                    ?>
                    <a href="javascript:void(0)"  style="font-family: roboto-regular">
                        <i class="fa fa-phone"></i>   <?= $model->mobile ?>
                    </a>
                <?php
                }
                ?>

            </div>

            <div>
                <br>


            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>
                                <?=  Yii::t('app', 'Item Detail');?>
                            </b>
                        </div>
                        <div class="panel-body">
                            <h6>
                                <strong>
                                    <?=  Yii::t('app', 'Category');?>
                                     &nbsp; <i class="fa fa-angle-right"></i>
                                </strong>  &nbsp;<?= $model->category ?>
                            </h6>
                            <h6>
                                <strong>
                                    <?=  Yii::t('app', 'Sub Category');?>  &nbsp; <i class="fa fa-angle-right"></i>
                                </strong>  &nbsp;<?= $model->sub_category  ?>
                            </h6>
                            <h6>
                                <strong>
                                    <?=  Yii::t('app', 'Brand / Type');?> &nbsp; <i class="fa fa-angle-right"></i>
                                </strong>  &nbsp;<?= $model->type ?>
                            </h6>
                        </div>

                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                       <div class="panel-heading">
                           <b>
                               <?=  Yii::t('app', 'Advertiser Detail');?>

                           </b>
                       </div>
                       <div class="panel-body">
                           <h6>
                               <strong>
                                   <?=  Yii::t('app', 'Advertiser');?>  &nbsp; <i class="fa fa-angle-right"></i>
                               </strong>  &nbsp; <?= $model->name ?>
                           </h6>
                           <h6>
                               <strong>
                                   <?=  Yii::t('app', 'Contact');?>   &nbsp;
                               </strong>
                               <i class="fa fa-angle-right"></i>
                               &nbsp;
                               <?= $model->mobile ?>
                           </h6>
                           <h6>
                               <strong>
                                   <?=  Yii::t('app', 'City');?> &nbsp; <i class="fa fa-angle-right"></i>
                               </strong>  &nbsp;
                               <?= $model->city ?>
                           </h6>
                       </div>

                   </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-12 row" style="margin-top: 10px;">
        <h2 class="page-header">
            <?=  Yii::t('app', 'Similar ads');?>
        </h2>
        <?php
        foreach($similar as $item)
        {
            $imagebase = $item['image'];
            $imageArray = explode(",",$imagebase);
            $img = reset($imageArray);
            ?>


            <div class="col-lg-3">
                <div class="adsBlock">
                    <div class="label">
                        <?=  Yii::t('app', 'Featured');?>
                    </div>
                    <div class="img-wrapper">
                        <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>"  class="img-responsive">
                    </div>
                    <div class="details">
                        <div class="name">
                            <a href="<?= \yii\helpers\Url::toRoute('ads/detail?ads='.$item['id']) ?>">
                                <?= $item['ad_title'] ?>
                            </a>
                        </div>
                    </div>
                    <div class="foot">
                        in <a href="">Bikes</a>
                        <i class="fa fa-angle-right"></i>
                        <i class="fa fa-map-marker"></i> <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?><?=  Yii::t('app', 'Km away');?>
                        <span class="price">&#36; <?= $item['price'] ?></span>
                    </div>
                </div>
            </div>


        <?php
        }
        ?>
    </div>

</div>


<!--Login model-->
<div id="doLogin" class="modal fade  white-text" style="margin-top: 90px;">
    <div class="modal-dialog modal-lg ">
        <div class="row white white-text">
            <div class="col-lg-6 blue white-text" style="padding: 50px 30px" align="center">
                <img src="<?= Yii::getAlias('@web') ?>/images/site/big-icon.png" width="150px">
                <br><br><br>
                <h2 style="color: #fff;font-family: roboto-thin;letter-spacing: 1px;" class="white-text"><?=  Yii::t('app', 'Login Now');?></h2>
                <br>
                <p class="white-text" style="color: #fff;font-family: roboto-thin;letter-spacing: 1px;line-height: 20px;font-size: 16px;">
                    <?=  Yii::t('app', 'Want to contact ???');?> <br>
                    <?=  Yii::t('app', 'Please Login/Signup for further conversation');?>
                </p>
            </div>
            <div class="col-lg-6 white " align="center">
                <p style="text-align: left;color: #999;word-spacing: 5px;font-size: 18px;padding: 60px 30px;line-height: 2;font-family: raleway-Light">
                    <?=  Yii::t('app', 'this user is registered and trusted user, for prevent span you should login first befor sending a message. if you
                    are new member please create a new account');?>

                </p>
                <a style="font-family: roboto-light;letter-spacing: 1px; font-size: 25px;"  class="btn postAds" href="<?= \yii\helpers\Url::toRoute('site/login') ?>"/>
                <i class="fa fa-bolt"></i><?=  Yii::t('app', 'Login');?>
                </a>
            </div>
        </div>
    </div>
</div>

<!--login model end-->


<?php
$uid = '';
if (!Yii::$app->user->isGuest)
{
    $uid = Yii::$app->user->identity->getId();
?>
    <div style="height:500px;display: none" id="ChatMsg" >
        <div class="col-sm-12">
            <div id="chatbox_female" class="chatbox" style="bottom: 0px; right: 20px; display: block;">
                <div class="chatboxhead">
                    <div class="chatboxtitle">
                        <?= $model->ad_title ?>

                    </div>
                    <div class="chatboxoptions">


                        <a onclick="closeChat()" href="javascript:void(0)"><i
                                class="fa fa-close"></i></a>
                    </div>
                    <br clear="all">
                </div>
                <div class="chatboxcontent" id="displayMsg">


                    <br>
                    <input type="hidden" name="check" id="check" value="<?= count(Message::LoadMsg($model->user_id,$model->id)) ?>">
                    <?php
                    foreach (Message::LoadMsg($model->user_id,$model->id) as $chat) {
                        ?>

                        <div class="msgLi <?= ($chat['sender'] == Yii::$app->user->identity->getId()) ? "sender" : ""; ?>">
                            <h5>
                                <span> <?=  \common\models\User::getNameById($chat['sender']) ?>: </span>
                                <?= $chat['text'] ?>
                            </h5>
                            <h6 >
                                <?= \common\models\Analytic::time_elapsed_string($chat['time']) ?> ago
                            </h6>
                        </div>
                    <?php

                    }

                    ?>

                </div>
                <div class="chatboxinput">
                    <textarea id="msgboxtext" class="chatboxtextarea form-control"></textarea>
                    <button onclick="sendmsg(<?= $model->user_id ?>,<?= $model->id ?>)" class="btn btn-primary chatboxend">Send</button>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<script >
    function sorry()
    {
        alert('You cannot send message yourself')
    }
    $('#DoLogin').modal('open');

    function openChat()
    {
        $('#ChatMsg').show();
        setInterval(function(){ CheckUpdate(); }, 3000);

    }
    function closeChat()
    {
        $('#ChatMsg').hide();

    }
    function sendmsg(id,ads)
    {
        var receiver = id;
        var url = "<?= \yii\helpers\Url::toRoute('message/send-msg'); ?>?msg="+$('#msgboxtext').val()+"&receiver="+receiver+"&ad="+ads;
        $.post(url,function(data){
           // $('#displayMsg').append("Sent");
        }).fail( function(){ $('#display-msg').append("<p>Connection Error...</p>"); } );

    }

    function CheckUpdate()
    {

        var chat = "<?= $uid ?>"+"<?= $model->user_id ?>";
        var receiver = "<?= $model->user_id ?>";
        var current = $('#check').val();


        var url = "<?= \yii\helpers\Url::toRoute('message/load-msg-tpl')?>?chat_id="+chat+"&current="+current;
        $.post(url,function(data){
            $('#displayMsg').append(data);

        }).done(function(){$('#displayMsg').append(data);}).fail( function(){ $('#display-msg').append("<p>Connection Error...</p>"); } );


        var check = "<?= \yii\helpers\Url::toRoute('message/check'); ?>?chatId="+chat;
        $.post(check,function(data){
            if(data > current)
            {
                document.getElementById("check").value = data;

            }
        }).fail( function(){  alert(data +" urrent:"+current); } );
    }



</script>

<!--//single-page-->