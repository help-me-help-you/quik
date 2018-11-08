<?php
$this->title = $model->ad_title;
use  \common\models\Message;

\common\models\Ads::view($model->id);
$currency_default = common\models\Currency::default_currency();

$current_url = \yii\helpers\Url::current();
\yii\helpers\Url::remember($current_url,'currency_p');

$session2 = Yii::$app->cache;
$default_selected = $session2->get('default_currency');
$default = $currency_default;

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
                                <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/products/'.$img ?>" id="zoom_<?= $arr; ?>"  data-zoom-image="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/products/'.$img ?>">

                                <img src='<?= Yii::getAlias('@web') ?>/images/products/<?= $img ?>' alt='' />
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
                            <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/products/'.$img ?>" class="img-thumbnail">

                        </li>

                    <?php
                    }
                    ?>
                    <li data-target='#carousel-custom' data-slide-to='2' class='active'><img src='assets2/images/ads/nano3.jpg' alt='' /></li>


                </ol>
            </div>

        </div>


    </div>
    <div class="col-lg-7">

        <div class="detailsBox ">
            <h2>
                <?= $model->ad_title ?>

                <a title="Edit" style="font-size: 18px;padding: 12px;" href="<?= \yii\helpers\Url::toRoute('ads/edit') ?>?id=<?= $model->id; ?>">
                    <span class="fa fa-pencil"></span>
                </a>
            </h2>





            <div class="row">
                <div class="col-lg-4">
                    <h6>Price:</h6>
                    <h2>
                        <i class="<?= $default['symbol'] ?> currency"></i> <?= $model->price; ?>/-
                    </h2>
                    <br>
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
                                    Email  &nbsp;
                                </strong>
                                <i class="fa fa-angle-right"></i>
                                &nbsp;
                                <?= $model->email ?>
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
                                    View &nbsp; <i class="fa fa-angle-right"></i>
                                </strong>  &nbsp;<?= $model->view ?>
                            </h6>
                            <h6>
                                <strong>
                                    Ad posted &nbsp; <i class="fa fa-angle-right"></i>
                                </strong>  &nbsp;<?= \common\models\Analytic::time_elapsed_string($model->created_at) ?>
                            </h6>
                            <h6>
                                <strong>
                                    City &nbsp; <i class="fa fa-angle-right"></i>
                                </strong>  &nbsp;<?= $model->city ?>
                            </h6>
                            <hr>
                            <h6>
                                <strong>
                                    Description &nbsp; <i class="fa fa-angle-right"></i>
                                </strong>  &nbsp;<?= $model->ad_description ?>
                            </h6>
                            <hr>
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

            </div>
        </div>

    </div>


</div>


