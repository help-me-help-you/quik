<?php
/* @var $this yii\web\View */
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' a Classified Responsive Website | Home';

$current_url = \yii\helpers\Url::toRoute('site/profile');
\yii\helpers\Url::remember($current_url,'currency_p');
$googleAds= \common\models\Analytic::find()->one();
$session2 = Yii::$app->cache;
$default_selected = $session2->get('default_currency');
$default = (isset($default_selected))?$default_selected:$currency_default;
?>
<!--slider corosal-->
<div>
    <?= $googleAds['script'] ?>
</div>
<div role="main" class="ui-content">
    <ul data-role="listview" data-inset="true">
        <li><a href="#">
                <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= $me['image']; ?>" class="img-responsive">
                <h2><?= $me['username']; ?></h2>
                <p><?= $me['city']; ?></p></a>
        </li>

    </ul>
    <div data-role="navbar">
        <ul>
            <li><a href="<?= \yii\helpers\Url::toRoute('mobile/edit-profile') ?>"><?=  Yii::t('app', 'Edit Profile');?></a></li>
            <li><a href="<?= \yii\helpers\Url::toRoute('mobile/message') ?>"><?=  Yii::t('app', 'Message');?></a></li>
            <li><a href="<?= \yii\helpers\Url::toRoute('mobile/post') ?>"><?=  Yii::t('app', 'Post Ad');?></a></li>
        </ul>
    </div>
    <a data-method="POST" data-ajax="false" href="<?= \yii\helpers\Url::toRoute('site/logout') ?>" class="ui-btn"><?=  Yii::t('app', 'Logout');?></a>
    <ul data-role="listview"   data-inset="true">
        <li data-role="list-divider" data-theme="b">
            <?=  Yii::t('app', 'Total Ads');?>
            <span class="ui-li-count" style="background-color: #eee;">
              <?= $myadsCount; ?>
            </span>
        </li>
        <?php
        if($myadsCount != 0) {
            foreach ($myAds as $product)
            {
                if ($product['category'] == 'Jobs' or $product['sub_category'] == 'Services') {
                    $view = "none";
                } else {
                    $view = "block";
                }
                $imagebase = $product['image'];
                $imageArray = explode(",",$imagebase);
                $count = count($imageArray);
                $img = reset($imageArray);

                ?>

                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('mobile/detail?ads='.$product['id']) ?>&title=<?= $product['ad_title']; ?>" data-ajax="false">
                        <h2><?= $product['ad_title'] ?></h2>
                        <p>
                            <strong>
                                <?= $product['ad_description'] ?>
                            </strong>
                        </p>
                        <p>
                            <?= $product['category'] ?>
                            <i class="fa fa-angle-right"></i>
                            <?= $product['sub_category'] ?>
                            <i class="fa fa-angle-right"></i>
                            <?= $product['type'] ?>
                        </p>
                        <p class="ui-li-aside">
                            <strong>
                                <?= \common\models\Analytic::time_elapsed_string($product['created_at']) ?>
                            </strong>
                        </p>
                    </a>
                </li>
                <div class="ads-list hidden">
                    <div class="col-lg-3 col-sm-12 col-xs-12 image">
                        <span class="label">
                            <?= $product['active'] ?>
                        </span>
                        <div class="img-wrapper">
                            <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                        </div>
                        <div class="ads-list_details">
                                    <span class="hidden-lg col-sm-8  col-xs-8">
                                            <?= $product['ad_title'] ?>
                                    </span>
                                    <span class="pic pull-right  col-sm-2  col-xs-2">
                                         <i class="fa fa-camera"></i>
                                        <?= $count ?>
                                    </span>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-xs-12 title">
                        <h2 class="hidden-xs hidden-sm">
                            <?= $product['ad_title'] ?>
                            <?php
                            $ad =  $product['active'];
                            if($ad = "urgent")
                            {
                                ?>
                                <label class="label-greens"><?=  Yii::t('app', 'Urgent');?></label>
                            <?php
                            }
                            elseif($ad = "featured")
                            {
                                ?>
                                <label class="label label-info"><?=  Yii::t('app', 'featured');?></label>
                            <?php
                            }
                            else
                            {
                                ?>
                                <label class="label label-warning blue"><?= $ad; ?></label>
                            <?php
                            }
                            ?>
                        </h2>
                        <h5>
                            <?= $product['ad_description'] ?>

                        </h5>
                        <p>
                            <i class="fa fa-map-marker"></i>
                            <?= \common\models\Ads::findDistance($product['lat'],$product['lng']) ?> <?=  Yii::t('app', 'Km away');?>
                        </p>
                        <br><br>
                        <p>
                            <a  href="<?= \yii\helpers\Url::toRoute('ads/edit-ads?id=' . $product['id']) ?>">
                                <?=  Yii::t('app', 'Edit');?>
                            </a>
                            |
                            <a  href="<?= \yii\helpers\Url::toRoute('ads/delete?id=' . $product['id']) ?>">
                                <?=  Yii::t('app', 'Delete');?>
                            </a>
                        </p>

                    </div>
                    <div class="col-lg-3 col-sm-16 col-xs-6 price" align="center">
                        <h3>
                            <i class="fa fa-usd"></i> <?= $product['price'] ?>
                        </h3>
                    </div>
                    <div class="col-lg-3 price col-sm-6 col-xs-6" align="center">

                        <a href="<?= \yii\helpers\Url::toRoute('ads/detail?ads='.$product['id']) ?>">
                            <?=  Yii::t('app', 'View Detail');?>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>


            <?php
            }
        }

        else
        {
            ?>
            <div class="col-lg-12">
                <br><br>
                <div  style="padding:10px 15px;border: 2px dashed #999;border-radius: 20px;;" align="center">
                    <h2  style="font-family: roboto-regular;font-size: 28px">
                        <?=  Yii::t('app','This is embarrassing. We didn’t find anyone');?> .
                    </h2>
                    <br>
                    <h6  style="font-family: roboto-bold;font-size: 12px">
                        <?=  Yii::t('app','Please post your product here, you still not post your product. please post your first product');?> .
                    </h6>
                    <a href="<?= \yii\helpers\Url::toRoute('ads/index') ?>" class="btn btn-warning"> <?=  Yii::t('app','Post Ad');?>   </a>


                </div>
            </div>
        <?php
        }
        ?>


    </ul>
</div>























