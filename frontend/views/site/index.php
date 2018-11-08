<?php
/* @var $this yii\web\View */
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' a Classified Responsive Website | Home';

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
<!-- Start Here -->

<!-- Start Here -->



<!-- End Here -->

<!-- End Here -->
<!--common ads-->
<div class="row">
    <div class="col-lg-3">
        <ul class="list-group menuList">
            <?php
            foreach($category as $catList)
            {  ?>
                <li class="list-group-item">
                    <a  href="<?= \yii\helpers\Url::toRoute('ads/category') ?>/<?= $catList['name'] ?>">
                        <i class="<?= $catList['fa-icon'] ?> "></i>
                        <?=  Yii::t('app', $catList['name']);?>

                    </a>
                </li>
            <?php
            }
            ?>

        </ul>
       <br>


        <!-- End Here -->
    </div>
    <div class="col-lg-9">
        <div class="row">
            <!--slider corosal-->
            <div  style="margin-top: 10px;">
                <div id="banner" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php
                        foreach($banner as $arr => $bannerImg)
                        {
                            ?>
                            <li data-target="#banner" data-slide-to="<?= $arr; ?>" class="<?= ($arr == 0)?"active":""; ?>"></li>
                        <?php
                        }
                        ?>

                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" >
                        <?php
                        foreach($banner as $arr => $bannerImg)
                        {
                        ?>
                        <div class="item <?= ($arr == 0)?"active":""; ?>" >
                            <img src="<?= Yii::getAlias('@web')?>/images/site/<?= $bannerImg['name'] ?>" alt="<?= $bannerImg['title'] ?>">
                        </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <?php
            $show = ($trend == null)?'hidden':'';
            if($trend == null)
            {
                ?>
                <blockquote class="col-lg-12" style="color: #555;border-color: #0d6aad;background-color: rgba(41,30,6,0.13)">
                    Choose Country: India,State: Rajsthan, City: Jodhpur for demo,
                    <footer>
                        Thanks,
                    </footer>
                </blockquote>
                <div class="clearfix"></div>
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
            <div class="col-lg-12 sweet-box <?= $show ?>" style="margin-top: -10px;">

                <div class="title">
                     <?=  Yii::t('app', 'Featured Advertisements');?>
                </div>
                <div class="carousel slide <?= $show ?>" data-ride="carousel" data-type="multi" data-interval="8000" id="featured">
                    <div class="carousel-inner" style="min-height: 205px">
                        <?php
                        foreach($featured as $rank=>$item)
                        {
                            $imagebase = $item['image'];
                            $imageArray = explode(",",$imagebase);
                            $imgs = reset($imageArray);
                            $img = ($item['category'] == 'Jobs')?'QuikJobs.jpg':$imgs;;
                            $controlHide = ($item['category'] == 'Jobs')?'hidden':'';
                            $controlShow = ($item['category'] == 'Jobs')?'':'hidden';
                            ?>
                            <div class=" item <?= ($rank == '0'? 'active':'') ?>">

                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="adsBlock" style="border-radius: 7px;overflow: hidden">
                                        <div class="label-blue">
                                            <?=  Yii::t('app', 'Featured');?>
                                        </div>
                                        <div class="img-wrapper">
                                            <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                                        </div>
                                        <div class="details">
                                            <div class="name">
                                                <a href="<?= \yii\helpers\Url::toRoute('ads/detail/'.$item['id']."/".str_replace(' ','-',$item['ad_title'])) ?>">
                                                    <?= substr($item['ad_title'],0,28) ?>...
                                                </a>
                                            </div>
                                        </div>
                                        <p class="foot">
                                            <span class="price <?= $controlHide; ?>">
                                                         <i class="<?= $default['symbol'].$controlHide; ?> currency"></i>
                                                <span class="price <?= $controlHide; ?>"> <?= $item['price']*$default['value']; ?>/-
                                                </span>
                                            </span>
                                            <span>
                                                in <a href=""><?= $item['sub_category']; ?></a>
                                                <i class="fa fa-angle-right"></i>
                                                <i class="fa fa-map-marker"></i>
                                                <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?> <?=  Yii::t('app', 'Km away');?>
                                            </span>
                                        </p>

                                    </div>

                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <a class="left carousel-control" href="#featured" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                    <a class="right carousel-control" href="#featured" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                </div>
            </div>

        </div>

    </div>
    <div class="col-lg-12 work-section-grids text-center">
        <div class="col-md-3 work-section-grid">
            <i style="font-size: 50px;" class="pe-7s-pen"></i>
            <h4 style="font-family: proxima-semiBold;color: #555;text-align: center">Post an Ad</h4>
            <p style="font-family: proxima-regular;color: #777;text-align: center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
            <span class="arrow1"><img src="<?= Yii::getAlias('@web') ?>/theme/images/arrow1.png" alt="" /></span>
        </div>
        <div class="col-md-3 work-section-grid">
            <i style="font-size: 50px;" class="pe-7s-search"></i>
            <h4 style="font-family: proxima-semiBold;color: #555;text-align: center">Find an item</h4>
            <p style="font-family: proxima-regular;color: #777;text-align: center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
            <span class="arrow2"><img src="<?= Yii::getAlias('@web') ?>/theme/images/arrow2.png" alt="" /></span>
        </div>
        <div class="col-md-3 work-section-grid">
            <i style="font-size: 50px;" class="pe-7s-phone"></i>
            <h4 style="font-family: proxima-semiBold;color: #555;text-align: center">contact the seller</h4>
            <p style="font-family: proxima-regular;color: #777;text-align: center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
            <span class="arrow1"><img src="<?= Yii::getAlias('@web') ?>/theme/images/arrow1.png" alt="" /></span>
        </div>
        <div class="col-md-3 work-section-grid">
            <i style="font-size: 50px;" class="pe-7s-wallet"></i>
            <h4 style="font-family: proxima-semiBold;color: #555;text-align: center">make transactions</h4>
            <p style="font-family: proxima-regular;color: #777;text-align: center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been</p>
        </div>
        <br><br>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-3">
        <?= \common\models\Adsense::show('left') ?>

    </div>
    <div class="col-lg-9">
       <div class="row">
           <div class="col-lg-12 sweet-box <?= $show ?>" style="margin-top: 10px;">
               <div class="title">
                   <?=  Yii::t('app', 'Urgent Sale grab all this item');?>
               </div>
               <hr>
               <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="3000" id="urgent">
                   <div class="carousel-inner" style="min-height: 235px">
                       <?php
                       foreach($urgent as $rank=>$item)
                       {
                           $imagebase = $item['image'];
                           $imageArray = explode(",",$imagebase);
                           $imgs = reset($imageArray);
                           $img = ($item['category'] == 'Jobs')?'QuikJobs.jpg':$imgs;;
                           $controlHide = ($item['category'] == 'Jobs')?'hidden':'';
                           $controlShow = ($item['category'] == 'Jobs')?'':'hidden';
                           ?>
                           <div class=" item <?= ($rank == '0'? 'active':'') ?>">

                               <div class="col-md-4 col-sm-6 col-xs-12">
                                    <span class="adsBlock">
                                        <div class="label-green">
                                             <?=  Yii::t('app', 'Urgent');?>
                                        </div>
                                        <div class="img-wrapper">
                                            <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                                        </div>
                                        <div class="details">
                                            <div class="name">
                                                <a href="<?= \yii\helpers\Url::toRoute('ads/detail/'.$item['id']."/".str_replace(' ','-',$item['ad_title'])) ?>">
                                                    <?= substr($item['ad_title'],0,28) ?>...
                                                </a>
                                            </div>
                                        </div>
                                        <p class="foot">
                                            <span class="price <?= $controlHide; ?>">
                                                         <i class="<?= $default['symbol'].$controlHide; ?> currency"></i>
                                                <span class="price <?= $controlHide; ?>"> <?= $item['price']*$default['value']; ?>/-
                                                </span>
                                            </span>
                                            <span>
                                                in <a href=""><?= $item['sub_category']; ?></a>
                                                <i class="fa fa-angle-right"></i>
                                                <i class="fa fa-map-marker"></i>
                                                <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?> <?=  Yii::t('app', 'Km away');?>
                                            </span>
                                        </p>

                               </div>

                           </div>

                           <?php
                       }
                       ?>
                   </div>
                   <a class="left carousel-control" href="#urgent" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                   <a class="right carousel-control" href="#urgent" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
               </div>
           </div>

           <div class="col-lg-12 sweet-box <?= $show ?>" style="margin-top: 10px;">
               <div class="title">
                   <?=  Yii::t('app', 'Popular ads near you within 100 km Range');?>

                   <a style="font-size: 11px;color: #555" class="pull-right" href="<?= \yii\helpers\Url::toRoute('ads/nearby?radius=5') ?>">
                       <?=  Yii::t('app', 'View All NearBy');?>
                   </a>
               </div>
               <hr>
               <div class="carousel slide" data-ride="carousel" data-type="multi" data-interval="9000" id="nearby">
                   <div class="carousel-inner" style="min-height: 235px">
                       <?php
                       foreach($trend as $rank=>$item)
                       {
                           $imagebase = $item['image'];
                           $imageArray = explode(",",$imagebase);

                           $imgs = reset($imageArray);
                           $img = ($item['category'] == 'Jobs')?'QuikJobs.jpg':$imgs;;
                           $controlHide = ($item['category'] == 'Jobs')?'hidden':'';
                           $controlShow = ($item['category'] == 'Jobs')?'':'hidden';
                           ?>
                           <div class=" item <?= ($rank == '0'? 'active':'') ?>">

                               <div class="col-md-4 col-sm-6 col-xs-12">
                                   <div class="adsBlock">
                                       <div class="label-green <?=  ($item['premium'] == ''?'hidden':'');?>">
                                           <?=  $item['premium'];?>
                                       </div>
                                       <div class="img-wrapper">
                                           <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                                       </div>
                                       <div class="details">
                                           <div class="name">
                                               <a href="<?= \yii\helpers\Url::toRoute('ads/detail/'.$item['id']."/".str_replace(' ','-',$item['ad_title'])) ?>">
                                                   <?= substr($item['ad_title'],0,28) ?>...
                                               </a>
                                           </div>
                                       </div>
                                       <p class="foot">
                                            <span class="price <?= $controlHide; ?>">
                                                         <i class="<?= $default['symbol'].$controlHide; ?> currency"></i>
                                                <span class="price <?= $controlHide; ?>"> <?= $item['price']*$default['value']; ?>/-
                                                </span>
                                            </span>
                                           <span>
                                                in <a href=""><?= $item['sub_category']; ?></a>
                                                <i class="fa fa-angle-right"></i>
                                                <i class="fa fa-map-marker"></i>
                                               <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?> <?=  Yii::t('app', 'Km away');?>
                                            </span>
                                       </p>
                                   </div>

                               </div>
                           </div>
                           <?php
                       }
                       ?>
                   </div>
                   <a class="left carousel-control" href="#nearby" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                   <a class="right carousel-control" href="#nearby" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
               </div>
           </div>
       </div>
    </div>
    <div class="row">
        <div class="col-lg-9 sweet-box <?= $show ?>" style="margin-top: 10px;">
            <div class="title">
                <?=  Yii::t('app', 'Trending Ads');?>
            </div>
            <hr>
            <?php
            foreach($trend  as $item)
            {
                $imagebase = $item['image'];
                $imageArray = explode(",",$imagebase);
                $imgs = reset($imageArray);
                $img = ($item['category'] == 'Jobs')?'QuikJobs.jpg':$imgs;;
                $controlHide = ($item['category'] == 'Jobs')?'hidden':'';
                $controlShow = ($item['category'] == 'Jobs')?'':'hidden';

                ?>
                <div class="ads-list">
                    <div class="col-lg-3 col-sm-12 col-xs-12 image">
                        <?php
                        if($item['premium'] != '')
                        {
                            echo "<span class='label'> ".$item['premium']."</span>";
                        }
                        ?>
                        <div class="img-wrapper">
                            <img src="<?= Yii::getAlias('@web').'/images/products/'.$img; ?>" class="img-responsive">
                        </div>
                        <div class="ads-list_details <?= $controlHide ?>">
                                    <span class="hidden-lg col-sm-8  col-xs-8">
                                            <?= $item['ad_title'] ?>
                                    </span>
                            <div class="pic pull-right  col-sm-2  col-xs-2" align="center" >
                                <i class="fa fa-camera"></i>
                                <?= count($imageArray); ?>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-xs-12 title">
                        <h2 class="hidden-xs hidden-sm">
                            <?= $item['ad_title'] ?>
                        </h2>
                        <h5>
                            <?= $item['ad_title'] ?>
                        </h5>
                        <br>
                        <p>
                            <i class="fa fa-map-marker"></i>
                            <?= \common\models\Ads::findDistance($item['lat'],$item['lng']) ?>Km away
                        </p>

                    </div>

                    <div class="col-lg-3 col-sm-16 col-xs-6 price " align="center">
                        <h3>
                            &nbsp; <i class="<?= $default['symbol'].$controlHide; ?> currency"></i> <span class="price <?= $controlHide; ?>"> <?= $item['price']*$default['value']; ?>/- </span>
                        </h3>
                    </div>
                    <div class="col-lg-3 price col-sm-6 col-xs-6" align="center">

                        <a class="btn btn-lg btn-primary" href="<?= \yii\helpers\Url::toRoute('ads/detail/'.$item['id'].'/'.str_replace(' ','-',$item['ad_title'])) ?>">
                            view detail
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <?php
            }
            ?>

            <div class="title" align="center">
                <a href="<?= \yii\helpers\Url::toRoute('ads/all') ?>" class="dottedBtn" >
                    <small>
                        <?=  Yii::t('app', 'View All');?>
                    </small>
                </a>
            </div>
        </div>
        <div class="col-lg-3" align="center">
            <?= \common\models\Adsense::show('right') ?>

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">

    var pageOptions = {
        "pubId": "pub-9616389000213823", // Make sure this the correct client ID!
        "query": "classified",
        "adPage": 1
    };

    var adblock1 = {
        "container": "afscontainer1",
        "width": "700",
        "number": 2
    };

    _googCsa('ads', pageOptions, adblock1);

</script>

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
$this->registerJs($script2);
?>





















