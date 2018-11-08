<?php
/* @var $this yii\web\View */
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' a Classified Responsive Website | Home';
$current_url = \yii\helpers\Url::toRoute('mobile/index');
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
    <div class="row">
        <div class="catScroller">
            <?php
            foreach($category as $catList)
            {  ?>
                <div class="catScrollerItem"  align="center">
                    <a data-ajax="false" class="mob_roundBtnCat red" href="<?= \yii\helpers\Url::toRoute('mobile/category') ?>?cat=<?= $catList['name'] ?>">
                        <i class="<?= $catList['fa-icon'] ?> "></i>
                    </a>
                    <div>
                        <?= Yii::t('app', $catList['name']); ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
    <hr>
    <div class="ui-block-solo ui-responsive">
        <?php
        foreach($trend as $rank=>$item)
        {


            $imagebase = $item['image'];
            $imageArray = explode(",",$imagebase);
            $img = reset($imageArray);
            $img = ($item['category'] == 'Jobs')?'QuikJobs.jpg':$img;;
            $controlHide = ($item['category'] == 'Jobs')?'hidden':'';
            $controlShow = ($item['category'] == 'Jobs')?'':'hidden';
            ?>
        <a href="<?= \yii\helpers\Url::toRoute('mobile/detail?ads='.$item['id']) ?>&title=<?= $item['ad_title']; ?>" data-ajax="false">

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
                        <span class="MobilePrice <?= $controlHide ?>">
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


<?php
$script2 = <<< JS
$('.carousel[data-type="multi"] .item').each(function(){
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));

        for (var i=0;i<1;i++) {
            next=next.next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
        }
    });
JS;
//$this->registerJs($script2);
?>





















