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
if(!Yii::$app->user->isGuest)
{
    $uid = Yii::$app->user->identity->getId();

}

?>
<?php
if($model->category== 'Jobs' or $model->sub_category == 'Services')
{
    $view = "none";
    $hideInJob = "hidden";
}
else
{
    $view = "block";
    $hideInJob = "";
}

?>

<link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/mobile/swiper.min.css" />
<script src="<?= Yii::getAlias('@web')?>/mobile/js/swiper.min.js"></script>
<style>

    .swiper-container {
        width: 100%;
        padding-top: 0px;
        padding-bottom: 20px;
    }
    .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 300px;
        height: 300px;

    }
</style>
<div role="main" class="ui-content">
    <h2 style="text-transform: capitalize;">
        <?= $model->ad_title; ?>
    </h2>
    <strong class="<?= $hideInJob; ?>">
        <i class="<?= $default['symbol'] ?> currency"></i> <?= $model->price*$default['value']; ?>/-
    </strong>
    <h6>
        <?=  Yii::t('app', 'View');?> <i class="fa fa-angle-right"></i> <?= $model->view ?>,
        <?=  Yii::t('app', 'Location');?> <i class="fa fa-angle-right"></i> <?= $model->city ?>,
        <?= \common\models\Analytic::time_elapsed_string($model->created_at) ?><?=  Yii::t('app', 'Ago');?>
    </h6>


    <hr>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php
            $image = $model->image;
            $imgChunck = explode(",",$image);
            foreach($imgChunck as $arr => $img)
            {
                $img = ($model['category'] == 'Jobs')?'QuikJobs.jpg':$img;;

                ?>
                <div class="swiper-slide" style="background-image:url(<?= Yii::getAlias('@web') ?>/images/products/<?= $img ?>)"></div>

            <?php
            }
            ?>

        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <h4 class="ui-bar ui-bar-a">
        <?= \common\models\Ads::findDistance($model['lat'],$model['lng']) ?> <?=  Yii::t('app', 'Km away');?>
        <?=  Yii::t('app', 'Within');?>
    </h4>
    <div class="ui-body ui-body-a ui-corner-all">
        <b>
            <?=  Yii::t('app', 'Item Detail');?>
        </b>
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
        <hr>
        <b>
            <?=  Yii::t('app', 'More');?>

        </b>
        <?php
        $ads = count($more);
        if( $ads > '1')
        {
            foreach($more as $detail)
            {
                ?>
                <h6>
                    <strong>
                        <?=  $detail['more_title'];?>
                        &nbsp; <i class="fa fa-angle-right"></i>
                    </strong>  &nbsp; <?=  $detail['more_value'];?>
                </h6>
            <?php
            }
        }

        ?>
        <hr>
        <b>
            <?=  Yii::t('app', 'Advertiser Detail');?>

        </b>
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
    <ul data-role="listview" data-inset="true">

        <li>
            <a href="#">
                <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= $user['image']; ?>" class="img-responsive">
                <h2><?= $user['username']; ?></h2>
                <p><?= $user['city']; ?></p>
            </a>
        </li>

    </ul>
    <?php
    if (Yii::$app->user->isGuest)
    {
        ?>
        <a href="#loginNow" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn  ui-shadow  ui-btn-b">
          <i class="pe-7s-comment"></i>  Chat With Advertiser
        </a>
        <div data-role="popup" id="loginNow" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
            <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
            <div data-role="header" data-theme="a">
                <h1>
                    <strong>
                        <?=  Yii::t('app', 'Want to contact ???');?>
                    </strong>
                </h1>
            </div>
            <div role="main" class="ui-content">
                <h3 class="ui-title"><?=  Yii::t('app', 'Please Login/Signup for further conversation');?></h3>
                <p>
                    <?=  Yii::t('app', 'this user is registered and trusted user, for prevent span you should login first befor sending a message. if you
                    are new member please create a new account');?>

                </p>
                <div class="ui-grid-a ui-responsive">
                    <div class="ui-block-a">
                        <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/login') ?>" class="ui-btn  ui-shadow  ui-btn-b" >Login</a>
                    </div>
                    <div class="ui-block-b">
                        <a  data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/signup') ?>" class="ui-btn  ui-shadow ui-btn-c" data-transition="flow">Signup</a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    else
    {
        $chatId = $uid.$model->id.$model->user_id;
        ?>
        <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/chat-u') ?>?chat_id=<?= $chatId;  ?>&AdId=<?= $model->id;  ?>" class="ui-btn <?= ($uid == $model->user_id)?"hidden":""; ?>">
            <i class="pe-7s-comment"></i>  Chat With Advertiser
        </a>
    <?php
    }
    ?>
</div>



<script>
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflow: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows : true
        }
    });
</script>





















