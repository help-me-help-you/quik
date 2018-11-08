<?php
$this->title = "user profile";
?>

<div class="row " style="margin-top: 20px;">
    <div style="padding: 20px;" class="white">
        <div class="col-lg-2 col-sm-6 col-xs-12">
            <img src="<?= Yii::getAlias('@web') ?>/images/user/<?= $me['image']; ?>" class="img-responsive img-circle">
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <p style="padding: 5px 0px;font-size: 45px;margin-left: -5px;margin-top: -15px;text-transform: capitalize;">
                <?= $me['username']; ?>
            </p>
            <p style="padding: 5px 0px;font-size:15px;margin-left: -5px;margin-top: -15px;">
                <?= $me['city']; ?>
                <a href="<?= \yii\helpers\Url::toRoute('site/profile-edit') ?>">
                    <?=  Yii::t('app','Edit');?>
                </a>
            </p>
        </div>
        <div class="col-lg-6" align="right">
            <p style="padding: 5px 0px;font-size:15px;">
                <?=  Yii::t('app','Total Ads');?> - <span style="color: #6972e5;font-size:25px;"> <?= $myadsCount ?></span>
            </p>
            <p style="padding: 5px 0px;font-size:15px;">
                <?=  Yii::t('app','Pending Ads');?> - <span style="color: #6972e5;font-size:25px;">  <?= $pending ?></span>
            </p>

            <a href="<?= \yii\helpers\Url::toRoute('message/index') ?>" style="padding: 5px 0px;font-size:15px;">
                <?=  Yii::t('app','Message');?>  - <span style="color: #6972e5;font-size:25px;">  <?= $msg ?></span>
            </a>
        </div>
        <div class="clearfix"></div>
    </div>

    <h2 class="title">
        <?=  Yii::t('app','Your Ads');?>
    </h2>
    <hr>
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

            $imgs = reset($imageArray);
            $img = ($product['category'] == 'Jobs')?'QuikJobs.jpg':$imgs;;
            ?>
            <div class="ads-list">
                <div class="col-lg-3 col-sm-12 col-xs-12 image">

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
                        $ad =  $product['premium'];
                        if($ad == "urgent")
                        {
                            ?>
                            <label class="label-greens"><?=  Yii::t('app','Urgent');?> </label>
                        <?php
                        }
                        elseif($ad == "featured")
                        {
                            ?>
                            <label class="label label-info"><?=  Yii::t('app','featured');?></label>
                        <?php
                        }
                        else
                        {
                            ?>
                            <label class="label label-default">Regular</label>
                        <?php
                        }
                        ?>
                    </h2>
                    <h5>
                        <?= $product['ad_description'] ?>

                    </h5>
                    <p>
                        <i class="fa fa-map-marker"></i>
                        <?= \common\models\Ads::findDistance($product['lat'],$product['lng']) ?><?=  Yii::t('app','Km away');?>
                    </p>
                    <br><br>
                    <p>
                        <a  href="<?= \yii\helpers\Url::toRoute('ads/edit-ads?id=' . $product['id']) ?>">
                            <?=  Yii::t('app','Edit');?>
                        </a>
                        |
                        <a  href="<?= \yii\helpers\Url::toRoute('ads/delete?id=' . $product['id']) ?>">
                            <?=  Yii::t('app','Delete');?>
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
                        <?=  Yii::t('app','View detail');?>
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

</div>
