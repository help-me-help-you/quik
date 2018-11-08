<?php
/* @var $this yii\web\View */
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' a Classified Responsive Website | Home';

$current_url = \yii\helpers\Url::toRoute('mobile/myads');
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
                        <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" >
                        <h2><?= $product['ad_title'] ?></h2>
                        <p><?= $product['ad_description'] ?></p>
                    </a>

                </li>
            <?php
            }
        }

        else
        {
            ?>
            <div class="col-lg-12">
                <br><br>
                <div  style="padding:50px 25px;border: 2px dashed #999;border-radius: 20px;;" align="center">
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























