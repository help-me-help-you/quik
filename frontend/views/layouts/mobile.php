<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
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

    <link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/template/pe-icon-7-stroke/css/pe-icon-7-stroke.css">
    <!-- Optional - Adds useful class to manipulate icon font display -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/template/pe-icon-7-stroke/css/helper.css">

    <link href="<?= Yii::getAlias('@web')?>/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?= Yii::getAlias('@web')?>/template/css/common.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/mobile/quikMobile.css" />
    <link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/mobile/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/mobile/jquery.mobile.structure-1.4.5.css" />
    <script src="<?= Yii::getAlias('@web')?>/mobile/js/jquery.js"></script>
    <script src="<?= Yii::getAlias('@web')?>/mobile/js/jquery.mobile-1.4.5.js"></script>

    <script async="async" src="https://www.google.com/adsense/search/ads.js"></script>

    <!-- other head elements from your page -->

    <script type="text/javascript" charset="utf-8">
        (function(g,o){g[o]=g[o]||function(){(g[o]['q']=g[o]['q']||[]).push(
            arguments)},g[o]['t']=1*new Date})(window,'_googCsa');
    </script>
    <style>

        /*body {*/
            /*-ms-overflow-style: none;*/
        /*overflow: -moz-scrollbars-none;*/
        /*}*/
        /*body::-webkit-scrollbar {*/
            /*width: 3px;*/
            /*height: 10px;*/
        /*}*/
        body{
            scrollbar-face-color: #000000;
            scrollbar-shadow-color: #2D2C4D;
            scrollbar-highlight-color:#7D7E94;
            scrollbar-3dlight-color: #7D7E94;
            scrollbar-darkshadow-color: #2D2C4D;
            scrollbar-track-color: #7D7E94;
            scrollbar-arrow-color: #C1C1D1;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<!--main page section start-->
<div data-role="page" data-theme="a" id="MainPage">

    <div data-role="header"  align="left">
        <a href="#leftPage"  class="ui-input-btn ui-btn toggBtn">
            <i class="fa fa-bars"></i>
            <img width="70px" src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>">

        </a>
        <h1 id="citydefault">
           <span class="pe-7s-map-marker"></span> <?= $cityDefault; ?>
        </h1>

        <a href="<?= \yii\helpers\Url::toRoute('location/countrym') ?>" data-ajax="false" class=" ui-btn ">
            <img id="countryflag" src="<?= Yii::getAlias('@web') ?>/images/country-flag/IN.png" style="width: 15px;">
            <small id="citydefault"></small>
            <i class="fa fa-angle-down"></i>
        </a>
        <div class="ui-body-b" data-role="navbar" data-content-theme="a" data-theme="a" style="border-top:1px solid #005187">
            <ul>
                <li><a data-ajax="false" href="<?= Url::toRoute('mobile/index') ?>"><?=  Yii::t('app','All Ads');?></a></li>
                <li><a data-ajax="false" href="<?= Url::toRoute('mobile/nearby') ?>"><?=  Yii::t('app','NearBy');?></a></li>
                <li>
                    <a href="#more" data-position-to="window" data-rel="popup" data-transition="pop">
                        <?=  Yii::t('app','More');?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /header -->

    <?php
    $alert = Alert::widget();
    if(!empty($alert))
    {
        ?>
        <div role="main" class="ui-content">
            <?= Alert::widget(); ?>
        </div>
    <?php
    }
    ?>

    <?= $content ?>

    <div data-role="popup"  data-history="false" id="more" data-theme="none" data-overlay-theme="c">
        <div data-role="collapsibleset" data-theme="b" data-content-theme="a" data-collapsed-icon="arrow-r" data-expanded-icon="arrow-d" style="margin:0; width:250px;">
            <div data-role="collapsible" data-inset="false">
                <h2><?=  Yii::t('app','Language');?></h2>
                <ul data-role="listview">
                    <li>
                        <a data-ajax="false" href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=en-EN" >
                            <img class="ui-li-icon ui-corner-none" src="<?= Yii::getAlias('@web')?>/images/country-flags/US.png"> English
                        </a>
                    </li>
                    <li >
                        <a data-ajax="false" href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=ru-RU" >
                            <img class="ui-li-icon ui-corner-none"  src="<?= Yii::getAlias('@web')?>/images/country-flags/RU.png"> Russian
                        </a>
                    </li>
                    <li>
                        <a data-ajax="false" href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=hi-HI" >
                            <img class="ui-li-icon ui-corner-none" src="<?= Yii::getAlias('@web')?>/images/country-flags/IN.png">  Hindi
                        </a>
                    </li>
                    <li>
                        <a data-ajax="false" href="<?php echo \yii\helpers\Url::toRoute('site/default-language') ?>?lng=ar-AR" >
                            <img class="ui-li-icon ui-corner-none" src="<?= Yii::getAlias('@web')?>/images/country-flags/AR.png"> Arebian
                        </a>
                    </li>
                </ul>
            </div><!-- /collapsible -->
            <div data-role="collapsible" data-inset="false">
                <h2><?=  Yii::t('app','Currency');?></h2>
                <ul data-role="listview">
                    <?php
                    foreach($currency as $list)
                    {
                        ?>
                        <li >
                            <a  data-ajax="false" href="<?php echo \yii\helpers\Url::toRoute('site/default-currency') ?>?id=<?= $list['id']; ?>" >
                                <span class="<?= $list['currency_symbol'] ?>"></span>
                                &nbsp;
                                <?= $list['currency_initial'] ?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div><!-- /collapsible -->
            <div data-role="collapsible" data-inset="false">
                <h2><?=  Yii::t('app', 'Action');?></h2>
                <ul data-role="listview">
                    <?php
                    if (\Yii::$app->user->isGuest)
                    {
                        ?>
                        <li><a data-ajax="false"  href="<?= \yii\helpers\Url::toRoute('mobile/login') ?>" ><?=  Yii::t('app', 'Login');?></a></li>
                        <li><a data-ajax="false"  href="<?= \yii\helpers\Url::toRoute('mobile/signup') ?>" data-rel="dialog"><?=  Yii::t('app', 'Register');?></a></li>

                    <?php
                    }
                    else
                    {
                        ?>
                        <li>
                            <a data-ajax="false"  data-method="post" href="<?= \yii\helpers\Url::toRoute('mobile/logout') ?>" >
                                <?=  Yii::t('app', 'Logout');?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div><!-- /collapsible -->

        </div><!-- /collapsible set -->
    </div><!-- /popup -->

    <?php
    if (Yii::$app->user->isGuest)
    {
    ?>
    <div data-role="popup"  data-history="false" id="loginNow" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
        <a href="#" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-b ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a>
        <div data-role="header" data-theme="a">
            <h1>
                <strong>
                    <?=  Yii::t('app', 'Login Now');?>
                </strong>
            </h1>
        </div>
        <div role="main" class="ui-content">
            <h3 class="ui-title"><?=  Yii::t('app', 'Please Login/Signup for Access this Content');?></h3>
            <p>
                <?=  Yii::t('app', 'if you are new member please create a new account');?>

            </p>
            <div class="ui-grid-a ui-responsive">
                <div class="ui-block-a">
                    <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/login') ?>" class="ui-btn  ui-shadow  ui-btn-b" ><?=  Yii::t('app', 'Login');?></a>
                </div>
                <div class="ui-block-b">
                    <a  data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/signup') ?>" class="ui-btn  ui-shadow ui-btn-c" data-transition="flow"><?=  Yii::t('app','Singup');?></a>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div data-role="footer" data-position="fixed">
        <div data-role="navbar">
            <ul class="ui-body-b">
                <li><a data-ajax="false" href="<?= Url::toRoute('mobile/index') ?>" data-icon="home"><?=  Yii::t('app','Discover');?></a></li>
                <li>
                    <?php
                    if (Yii::$app->user->isGuest) {
                        ?>
                        <a href="#loginNow" data-rel="popup" data-position-to="window" data-icon="comment" data-transition="pop" >
                            <?= Yii::t('app', 'Chat'); ?>
                        </a>

                    <?php
                    }
                    else
                    {
                        ?>
                        <a data-ajax="false" href="<?= Url::toRoute('mobile/message') ?>" data-icon="comment">
                            <?= Yii::t('app', 'Chat'); ?>
                        </a>
                        <?php
                    }
                    ?>
                </li>
                <li>
                    <?php
                    if (Yii::$app->user->isGuest) {
                        ?>
                        <a href="#loginNow" data-rel="popup" data-icon="tag" data-position-to="window" data-transition="pop" >
                            <?=  Yii::t('app','Sale');?>
                        </a>

                    <?php
                    }
                    else
                    {
                        ?>
                        <a data-ajax="false" href="<?= Url::toRoute('mobile/post') ?>" data-icon="tag">
                            <?=  Yii::t('app','Sale');?>
                        </a>
                    <?php
                    }
                    ?>

                </li>
                <li>
                    <?php
                    if (Yii::$app->user->isGuest) {
                        ?>
                        <a href="#loginNow" data-rel="popup" data-position-to="window" data-icon="shop" data-transition="pop" >
                            <?=  Yii::t('app','My Ads');?>
                        </a>

                    <?php
                    }
                    else
                    {
                        ?>
                        <a data-ajax="false" href="<?= Url::toRoute('mobile/myads') ?>" data-icon="shop">
                            <?=  Yii::t('app','My Ads');?>
                        </a>
                    <?php
                    }
                    ?>


                </li>
                <li>
                    <?php
                    if (Yii::$app->user->isGuest) {
                        ?>
                        <a href="#loginNow" data-rel="popup" data-position-to="window"  data-icon="user" data-transition="pop" >
                            <?=  Yii::t('app','Profile');?>
                        </a>

                    <?php
                    }
                    else
                    {
                        ?>
                        <a data-ajax="false" href="<?= Url::toRoute('mobile/profile') ?>" data-icon="user">
                            <?=  Yii::t('app','Profile');?>
                        </a>
                    <?php
                    }
                    ?>

                </li>
            </ul>
        </div>
    </div>
    <!-- /footer -->
</div>
<!--main page section end-->

<div data-role="page" id="leftPage">

    <div data-role="header" align="left">
        <a href="#MainPage"  class="ui-input-btn ui-btn toggBtn">
            <i class="fa fa-angle-left"></i>
            <img width="70px" src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>">

        </a>
        <h1 id="citydefault">
            Search & Choose Category
        </h1>

        <a href="<?= \yii\helpers\Url::toRoute('location/countrym') ?>" data-ajax="false" class=" ui-btn ">
            <small id="citydefault"></small>
            <i class="fa fa-angle-down"></i>
        </a>
        <div class="ui-body-b" data-role="navbar" data-content-theme="a" data-theme="a" style="border-top:1px solid #005187">
            <?php $form = ActiveForm::begin(['action'=>['mobile/search']]) ?>
            <div class="homeSearch">
                <div class="homeSearchWrapper">

                    <select data-role="none" id="searchform-category"  name="SearchForm[category]">
                        <option value="">
                            <?=  Yii::t('app', 'Select category');?>
                        </option>
                        <?php
                        foreach($category as $option)
                        {
                            ?>
                            <option value="<?= $option['name'] ?>">
                                <?=  Yii::t('app', $option['name']);?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <span></span>
                    <input data-role="none" id="searchform-item" value="" name="SearchForm[item]" type="search"  placeholder="Search in Jodhpur">
                    <button data-role="none" type="submit" value="" name="search"><i class="fa fa-search"></i></button>
                    <div class="clearfix"></div>

                </div>

            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <!-- /header -->

    <div role="main" class="ui-content">

        <ul class="list-group menuList">
            <?php
            $cat = \common\models\Category::find()->all();

            foreach($cat as $catList)
            {  ?>
                <li class="list-group-item">
                    <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/category') ?>?cat=<?= $catList['name'] ?>">
                        <i class="<?= $catList['fa-icon'] ?> "></i>
                        <?=  Yii::t('app', $catList['name']);?>

                    </a>
                </li>
            <?php
            }
            ?>

        </ul>
    </div><!-- /content -->


</div><!-- /page -->
<?php

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
<!-- js -->
<!-- js -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
