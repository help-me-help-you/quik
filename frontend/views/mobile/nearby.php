<?php
/* @var $this yii\web\View */
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' a Classified Responsive Website | Home';
$current_url = \yii\helpers\Url::toRoute('mobile/nearby');
\yii\helpers\Url::remember($current_url,'currency_p');
$current_url = \yii\helpers\Url::toRoute('site/index');
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
    <div class="ui-body, ui-body-a ui-corner-all" align="center">
        <span style="padding: 5px;line-height: 3">
            <?=  Yii::t('app', 'Ads Within');?> <?= $radius ?><?=  Yii::t('app', 'Km range');?>
        </span>
        <a href="#radius<?= $radius ?>" data-role="button" data-rel="popup" data-position-to="window" transition="pop" data-shadow="false" class="pull-right ui-btn ui-mini  ui-shadow ui-btn-inline ui-icon-location ui-btn-icon-left ui-btn-b">
            <?=  Yii::t('app', 'Distance');?>
        </a>

        <div class="clearfix"></div>

    </div>
    <hr>
    <div class="ui-block-solo ui-responsive">
        <?php
        foreach($model as $rank=>$item)
        {
            $imagebase = $item['image'];
            $imageArray = explode(",",$imagebase);
            $img = reset($imageArray);
            ?>
        <a href="<?= \yii\helpers\Url::toRoute('ads/detail?ads='.$item['id']) ?>" data-ajax="false">
        <div class="ui-block-solo">
                <div class="adsBlock ">

                    <div class="img-wrapper">
                        <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                    </div>
                    <div class="details">
                        <div class="name">
                            <div class="label label-info">
                                <?=  Yii::t('app', 'Urgent');?>
                            </div>
                        </div>
                    </div>
                    <div class="foot">
                        <h4 style="font-family: roboto-regular;color:#555">
                            <?= substr($item['ad_title'],0,28) ?>...
                        </h4>
                        <span class="MobilePrice">
                           <i class="<?= $default['symbol'] ?> currency"></i> <?= $item['price']*$default['value']; ?>/-
                        </span>
                        <span style="font-size: 16px;">

                        in <a href=""><?= $item['sub_category']; ?></a>
                        <i class="fa fa-angle-right"></i>
                        <i class="fa fa-map-marker"></i>
                            <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?><?=  Yii::t('app', 'Km away');?>

                        </span>
                    </div>
                </div>
            </div>
        </a>
        <?php
        }
        ?>

    </div>
</div>

<div data-role="popup" data-history="false" id="radius<?= $radius ?>" data-theme="a" data-overlay-theme="a" >
    <ul data-role="listview" data-inset="false" style="min-width:210px;">
        <li data-role="list-divider">Select Distance</li>
        <li><a href="<?= \yii\helpers\Url::toRoute('mobile/nearby?radius=5') ?>"><?=  Yii::t('app', 'Within');?> 5 Km</a></li>
        <li><a href="<?= \yii\helpers\Url::toRoute('mobile/nearby?radius=10') ?>"><?=  Yii::t('app', 'Within');?> 10 Km</a></li>
        <li><a href="<?= \yii\helpers\Url::toRoute('mobile/nearby?radius=25') ?>"><?=  Yii::t('app', 'Within');?> 25 Km</a></li>
        <li><a href="<?= \yii\helpers\Url::toRoute('mobile/nearby?radius=50') ?>"><?=  Yii::t('app', 'Within');?> 50 Km</a></li>
        <li><a href="<?= \yii\helpers\Url::toRoute('mobile/nearby?radius=100') ?>"><?=  Yii::t('app', 'Within');?> 100 Km</a></li>
        <li><a href="<?= \yii\helpers\Url::toRoute('mobile/nearby?radius=500') ?>"><?=  Yii::t('app', 'Within');?> 500 Km</a></li>
        <li><a href="<?= \yii\helpers\Url::toRoute('mobile/nearby?radius=1000') ?>"><?=  Yii::t('app', 'Within');?> 1000 Km</a></li>

    </ul>
</div>
<?php
$script2 = <<< JS
    $('#&ui-state=dialog').popup('close');
    try {
          $.mobile.popup.active = null;
          delete $.mobile.popup.active;
    } catch (e) { }
JS;
$this->registerJs($script2);
?>





















