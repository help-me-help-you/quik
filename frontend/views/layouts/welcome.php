<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\web\View;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
AppAsset::register($this);
//\common\models\Track::track($_SERVER['HTTP_USER_AGENT'],$_SERVER['REMOTE_ADDR'],isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'No referal Link');
$siteSetting = \common\models\SiteSettings::find()->one();
//$this->title = $siteSetting['site_title'];
$citySet = "<script>document.write(localStorage.getItem('setcity'))</script>";

$contact = \common\models\Contact::find()->one();

$session = Yii::$app->session;
$cityDefault = $session->get('cityset');

$category = \common\models\Category::find()->all();
$searchForm = new \frontend\models\SearchForm();
$session2 = Yii::$app->cache;
$currency = common\models\Currency::find()->all();
$currency_default = common\models\Currency::default_currency();
$default_selected = $session2->get('default_currency');
$default = $currency_default;//(isset($default_selected))?$default_selected:$currency_default;

$default_language_slctd = $session2->get('default_language');
$default_language = (isset($default_language_slctd))?$default_language_slctd:"en-EN";

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
<!--    theme css and js-->
    <link rel="icon" href="<?= Yii::getAlias('@web')?>/images/fav.jpg" />




    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?= $siteSetting['meta_keyword'] ?>" />
    <meta name="description" content="<?= $siteSetting['meta_description'] ?>" />

    <link href="<?= Yii::getAlias('@web')?>/template/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web')?>/template/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web')?>/template/css/common.css" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web')?>/template/css/detail2.css" rel="stylesheet">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>




</head>
<body>

<div  class="mainHeader">
    <div class="row" style="background-color: #0d81c2;padding: 1px;">
        <div class="container">
            <div class="col-lg-6 " align="left">
                <small style="color: #d9e4e5;font-size: 11px;">
                    <span class="fa fa-map-marker"></span>
                    <?= $contact->address ?>

                    <span style="margin-left: 0px;margin-right:20px;"> | </span>

                    <span class="fa fa-phone"></span>
                    <?= $contact->phone ?>

                    <span style="margin-left:20px;margin-right:20px;"> | </span>

                    <span class="fa fa-envelope"></span>
                    <a href="mailto:info@example.com" style="color: #b2d4d5"><?= $contact->email ?></a>
                </small>
            </div>
            <div class="col-lg-6 " align="right">
                <span class="dropdown">
                    <button class="btn btn-link btn-xs dropdown-toggle" type="button" style="color: #fff" data-toggle="dropdown">
                        <span class="<?= $default['symbol']; ?>"></span>
                        <small >
                            <strong>
                                <?= $default['initial']; ?>
                            </strong>
                        </small>
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 100px;background-color: transparent;border: none">
                        <ul class="list-group DropsList">
                            <?php
                            foreach($currency as $list)
                            {
                                ?>
                                <li class="list-group-item">
                                    <a href="<?php echo \yii\helpers\Url::toRoute('site/default-currency') ?>?id=<?= $list['id']; ?>" style="display: block;width: 100%;">
                                        <span class="<?= $list['currency_symbol'] ?>"></span>
                                        &nbsp;
                                        <?= $list['currency_initial'] ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>

                        </ul>
                    </div>

                </span>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row headerAdu">

            <div class="col-lg-3 logo">
                <i class="fa fa-bars"></i>
                <a   href="<?= \yii\helpers\Url::toRoute('site/index') ?>">
                    <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>">
                </a>

                <a href="<?= \yii\helpers\Url::toRoute('location/country') ?>" class="pull-right" >
                    <img id="countryflag" src="<?= Yii::getAlias('@web') ?>/images/country-flag/IN.png" style="width: 15px;">
                    <small id="citydefault"></small>
                    <i class="fa fa-angle-down"></i>
                </a>
            </div>
            <?php $form = \yii\bootstrap\ActiveForm::begin(['action'=>['ads/all']]) ?>
            <div class="col-lg-5 homeSearch">
                <div class="homeSearchWrapper">

                    <select id="searchform-category"  name="SearchForm[category]">
                        <option value="">
                            <?=  Yii::t('app', 'Select category');?>
                        </option>
                        <?php
                        foreach($category as $option)
                        {
                            ?>
                            <option value="<?= $option['name'] ?>">
                                <?= $option['name'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <span></span>
                    <input id="searchform-item" value="" name="SearchForm[item]" type="search"  placeholder="Search in Jodhpur">
                    <button type="submit" value="" name="search"><i class="fa fa-search"></i></button>
                    <div class="clearfix"></div>

                </div>

            </div>
            <?php ActiveForm::end(); ?>

            <div class="col-lg-4 HomeMenu" align="right">

                <?php
                if (\Yii::$app->user->isGuest)
                {
                    ?>
                    <a style="font-size: 14px;"   href="<?= \yii\helpers\Url::toRoute('site/login') ?>">
                        <?=  Yii::t('app', 'Login');?>
                    </a>
                    <span>/</span>
                    <a style="font-size: 14px;" href="<?= \yii\helpers\Url::toRoute('site/signup') ?>">
                        <?=  Yii::t('app', 'Register');?>
                    </a>
                <?php
                }
                else
                {
                    ?>
                    <span class="dropdown">
                    <button class="btn btn-sm  btn-link dropdown-toggle" type="button" data-toggle="dropdown">
                        <img width="30" src="<?= Yii::getAlias('@web') ?>/images/user/<?= Yii::$app->user->identity->image; ?>" class="img-responsive img-circle">
                    </button>
                       <div class="dropdown-menu dropdown-menu-right" style="width: 200px;margin-right: 50px;">
                           <ul class="list-group DropsList">
                               <li class="list-group-item">
                                   <a href="<?php echo \yii\helpers\Url::toRoute('site/profile') ?>" style="display: block;width: 100%;">
                                       <i class="pe-7s-user"></i> <?=  Yii::t('app','Profile');?>
                                   </a>
                               </li>
                               <li class="list-group-item">
                                   <a href="<?php echo \yii\helpers\Url::toRoute('message/index') ?>" style="display: block;width: 100%;">
                                       <i class="pe-7s-comment"></i> <?=  Yii::t('app','Message');?>
                                   </a>
                               </li>
                               <li class="list-group-item">
                                   <a  data-method="post" href="<?= \yii\helpers\Url::toRoute('site/logout') ?>">
                                       <i class="pe-7s-back"></i>
                                       <?=  Yii::t('app','Logout');?>
                                   </a>

                               </li>
                           </ul>
                       </div>



                    </span>

                <?php
                }
                ?>

                <a href="<?= \yii\helpers\Url::toRoute('ads/index') ?>" class="postAds">
                    <?=  Yii::t('app', 'Post Ad');?>
                </a>


                <span class="dropdown">
                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                        <small>
                            <strong>
                                <?= (isset($default_language['name']))?$default_language['name']:"English"; ?>
                            </strong>
                        </small>
                        <span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 200px;margin-right: 50px;">
                        <ul class="list-group DropsList">
                            <li class="list-group-item">
                                <a href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=en-EN" style="display: block;width: 100%;">
                                    <img src="<?= Yii::getAlias('@web')?>/images/country-flags/US.png"> English
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=ru-RU" style="display: block;width: 100%;">
                                    <img src="<?= Yii::getAlias('@web')?>/images/country-flags/RU.png"> Russian
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=hi-HI" style="display: block;width: 100%;">
                                    <img src="<?= Yii::getAlias('@web')?>/images/country-flags/IN.png">  Hindi
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=ar-AR" style="display: block;width: 100%;">
                                    <img src="<?= Yii::getAlias('@web')?>/images/country-flags/AR.png"> Arebian
                                </a>
                            </li>

                        </ul>
                    </div>

                </span>
            </div>

        </div>
    </div>
</div>
<div class="mainHeadergap"></div>
<!--header section end-->


<!--container section start-->

<div class="container-fluid">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= Alert::widget() ?>

    <?= $content ?>
</div>
<?php $this->beginBody() ?>
<!--header section start-->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1834024752369538"
     data-ad-slot="4563984809"
     data-ad-format="auto"></ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<!--container section end-->


<div class="clearfix"></div>
<!--footer section start-->
<footer class="footer white">
    <div class="footer-bottom text-center">
        <div class="container">
            <div class="footer-logo">
                <a href="<?= \yii\helpers\Url::home(); ?>">
                    <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" style="width: 150px;z-index: 1">
                </a>
                <br>
                <img src="<?= Yii::getAlias('@web') ?>/images/site/banner2.png" width="60%">
            </div>
            <div class="footer-social-icons" >
                <ul>
                    <li><a class="facebook" href="#"><span>Facebook</span></a></li>
                    <li><a class="twitter" href="#"><span>Twitter</span></a></li>
                    <li><a class="flickr" href="#"><span>Flickr</span></a></li>
                    <li><a class="googleplus" href="#"><span>Google+</span></a></li>
                    <li><a class="dribbble" href="#"><span>Dribbble</span></a></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <strong> <?=  Yii::t('app', 'Who are we');?>:</strong>
                    <br>
                    <small>
                        <?= $contact->about ?>
                    </small>
                </div>
                <div class="col-lg-4">
                    <strong><?=  Yii::t('app', 'Help');?>:</strong>
                    <ul class="list-inline">
                        <li><a href="<?= \yii\helpers\Url::toRoute('pages/how-it-works') ?>"><?=  Yii::t('app', 'How it Works');?></a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('faq/index') ?>"><?=  Yii::t('app', 'FAQ');?></a></li>
                        <li><a href="<?= \yii\helpers\Url::toRoute('site/contact') ?>"><?=  Yii::t('app', 'Contact');?></a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <strong><?=  Yii::t('app', 'Information') ?>:</strong>
                    <ul class="list-inline">
                        <?php
                        $pages = \common\models\Pages::find()->all();
                        foreach($pages as $pagelist)
                        {?>
                            <li><a href="<?= \yii\helpers\Url::toRoute('pages/index?title='.$pagelist['title']) ?>"><?= $pagelist['title']; ?></a></li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
            <div class="copyrights">
                <p style="font-size: 10px;padding: 30px;">
                    <span class="fa fa-map-marker"></span>
                    <?= $contact->address ?>

                    <span style="margin-left: 50px;margin-right:50px;"> | </span>

                    <span class="fa fa-phone"></span>
                    <?= $contact->phone ?>

                    <span style="margin-left: 50px;margin-right:50px;"> | </span>

                    <span class="fa fa-envelope"></span>
                    <a href="mailto:info@example.com"><?= $contact->email ?></a>
                </p>
                <p> © <?= date("Y",time()) ?> <?= $siteSetting->site_name; ?>.<?=  Yii::t('app', 'All Rights Reserved | Design by ') ?> <a href="http://ambecode.com/"> Ambecode</a></p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</footer>
<!--footer section end-->


<!--  ########### MODEL START HERE #############-->
<div class="modal fade" id="selectCity" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Please Choose Your Location
                </h4>



                <div class="panel-group" id="accordion">
                    <?php
                    $state = \common\models\State::find()->all();

                    foreach($state as $stateList)
                    {
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $stateList['id'] ?>">
                                        <?= $stateList['state'] ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?= $stateList['id'] ?>" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <script>
                                        document.getElementById("citydefault").innerHTML = localStorage.getItem("setcity");
                                        var url = "<?= \yii\helpers\Url::toRoute('ads/scity?param=') ?>";
                                        function setcity(city)
                                        {
                                            // alert(city);
                                            // Check browser support
                                            if (typeof(Storage) !== "undefined") {
                                                // Store
                                                localStorage.setItem("setcity", city);
                                                // Retrieve
                                                document.getElementById("citydefault").innerHTML = localStorage.getItem("setcity");
                                            } else {
                                                alert("Sorry, your browser does not support Web Storage...");
                                            }

                                            $.post(url+city, function(data, status){
                                                alert(data + "\nStatus: " + status);
                                            });

                                        }
                                    </script>
                                    <div class="list-group">
                                        <?php
                                        $city = \common\models\City::find()->where(['state_id'=>$stateList['id']])->all();
                                        foreach($city as $cityList)
                                        {
                                            ?>
                                            <a data-method="post"  onclick="setcity('<?= $cityList['city']; ?>')" href="<?= \yii\helpers\Url::toRoute('ads/scity') ?>?param=<?= $cityList['city']; ?>" class="list-group-item"><?= $cityList['city']; ?></a>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php

                    }

                    ?>
                </div>


            </div>
        </div>
    </div>
</div>

<!--  ########### MODEL End HERE #############-->

<?php

$script = <<< JS
 $(document).ready(function () {
            var mySelect = $('#first-disabled2');

            $('#special').on('click', function () {
                mySelect.find('option:selected').prop('disabled', true);
                mySelect.selectpicker('refresh');
            });

            $('#special2').on('click', function () {
                mySelect.find('option:disabled').prop('disabled', false);
                mySelect.selectpicker('refresh');
            });

            $('#basic2').selectpicker({
                liveSearch: true,
                maxOptions: 1
            });
        });
JS;
$this->registerJs($script);


$script2 = <<< JS
 $( document ).ready( function() {
            $( '.uls-trigger' ).uls( {
                onSelect : function( language ) {
                    var languageName = $.uls.data.getAutonym( language );
                    $( '.uls-trigger' ).text( languageName );
                },
                quickList: ['en', 'hi', 'he', 'ml', 'ta', 'fr']
            } );
        } );
JS;
$this->registerJs($script2);
?>

<!-- js -->
<script src="<?= Yii::getAlias('@web')?>/template/bootstrap/js/jquery.min.js"></script>
<script src="<?= Yii::getAlias('@web')?>/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= Yii::getAlias('@web')?>/template/bootstrap/js/scripts.js"></script>
<script src="<?= Yii::getAlias('@web')?>/template/js/detail2.js"></script>
<!-- js -->
<?php $this->endBody() ?>
</body>
<script type="application/javascript">

    if(localStorage.getItem("setcity") == null)
    {
        document.getElementById("citydefault").innerHTML = "Jodhpur";
        document.getElementById("countryflag").src = "<?= Yii::getAlias('@web') ?>/images/country-flags/IN.png";
    }
    else
    {
        document.getElementById("citydefault").innerHTML = localStorage.getItem("setcity");
        document.getElementById("countryflag").src = localStorage.getItem("countryFlag");
    }

    // $('#countryflag').attr('src',"hello");


</script>
</html>
<?php $this->endPage() ?>
