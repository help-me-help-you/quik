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

$mobileUrl = \yii\helpers\Url::toRoute('mobile/index');
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
    Yii::$app->getResponse()->redirect($mobileUrl);
   // header('Location: '.$mobileUrl);
}
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
$default = (isset($default_selected))?$default_selected:$currency_default;

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
    <link href="<?= Yii::getAlias('@web')?>/template/ionicons/css/ionicons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/template/pe-icon-7-stroke/css/pe-icon-7-stroke.css">

    <!-- Optional - Adds useful class to manipulate icon font display -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web')?>/template/pe-icon-7-stroke/css/helper.css">
    <link href="<?= Yii::getAlias('@web')?>/template/css/common.css" rel="stylesheet">
    <link href="<?= Yii::getAlias('@web')?>/template/css/detail2.css" rel="stylesheet">
    <link rel="alternate" media="handheld" href="<?= \yii\helpers\Url::toRoute('mobile/index') ?>">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="<?= Yii::getAlias('@web')?>/template/css/homes.css" rel="stylesheet">


    <script async="async" src="https://www.google.com/adsense/search/ads.js"></script>

    <!-- other head elements from your page -->

    <script type="text/javascript" charset="utf-8">
        var url = "<?= \yii\helpers\Url::toRoute('mobile/index');?>";
        if (screen.width <= 699) {
           // alert("hello");
            document.location = url;
        }
        (function(g,o){g[o]=g[o]||function(){(g[o]['q']=g[o]['q']||[]).push(
            arguments)},g[o]['t']=1*new Date})(window,'_googCsa');
    </script>





</head>
<body>
<?php $this->beginBody() ?>
<!--header section start-->

<div  class="mainHeader ">
    <div class="row topsHeadThinWrap" >
        <div class="container">
            <div class="col-lg-6 " align="left">
                <small class="topsHeadThin" style="">
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
            <?php $form = ActiveForm::begin(['action'=>['ads/all']]) ?>
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
                    <input id="searchform-item" value="" name="SearchForm[item]" type="search"  placeholder="Search in <?= $cityDefault; ?>">
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
                    <a style="font-size: 12px;"   href="<?= \yii\helpers\Url::toRoute('site/login') ?>">
                        <?=  Yii::t('app', 'Login');?>
                    </a>
                    <span>/</span>
                    <a style="font-size: 12px;"  href="<?= \yii\helpers\Url::toRoute('site/signup') ?>">
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
<div class="container" >

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
    ?>
        <?php
        $alert = Alert::widget();
        if(!empty($alert))
        {
            ?>
            <div class="row">
                <div class="col-lg-12" style="margin-top: 20px;!important;">

                    <?= $alert; ?>
                </div>
            </div>
        <?php
        }
        ?>
    <?= $content ?>
</div>

<!--container section end-->

<div class="col-lg-12" align="center" style="padding: 40px;">
    <?= \common\models\Adsense::show('bottom') ?>
</div>
<div class="clearfix"></div>
<div class="clearfix"></div>
<!--footer section start-->
<footer class="footer footBg">
    <div class="container">
        <div class="footer-logo" align="center">
            <a href="<?= \yii\helpers\Url::home(); ?>">
                <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" style="width: 150px;z-index: 1">
            </a>
            <br>
            <img src="<?= Yii::getAlias('@web') ?>/images/site/banner2.png" width="60%">
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="<?= \yii\helpers\Url::home(); ?>">
                    <img src="<?= Yii::getAlias('@web/images/site/logo/'.$siteSetting['logo'])?>" style="width: 150px;z-index: 1">
                </a>
            </div>
            <div class="col-lg-4 footerTxt">

                <h5>
                    <?= $siteSetting['site_title']; ?>
                </h5>
                <p>
                    <b><span class="fa fa-map-marker"></span> Address: </b><?= $contact->address ?><br>
                    <b><span class="fa fa-phone"></span> Contact Number: </b><?= $contact->phone ?><br>
                    <b><span class="fa fa-envelope"></span> Email Id: </b><?= $contact->email ?>
                </p>
            </div>
            <div class="col-lg-4 footerTxt">

                <h5>
                    <?=  Yii::t('app', 'Who are we');?>:
                </h5>
                <p>
                    <?= $contact->about ?>
                </p>
            </div>
            <div class="col-lg-2 footerTxt">
                <h5>
                    Information
                </h5>
                <ul class="list-group footerTxtList">
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
            <div class="col-lg-2 footerTxt">
                <h5>
                    Help
                </h5>
                <ul class="list-group footerTxtList">
                    <li><a href="<?= \yii\helpers\Url::toRoute('pages/how-it-works') ?>"><?=  Yii::t('app', 'How it Works');?></a></li>
                    <li><a href="<?= \yii\helpers\Url::toRoute('faq/index') ?>"><?=  Yii::t('app', 'FAQ');?></a></li>
                    <li><a href="<?= \yii\helpers\Url::toRoute('site/contact') ?>"><?=  Yii::t('app', 'Contact');?></a></li>

                </ul>
            </div>

        </div>
    </div>
    <div class="col-lg-12 footerbtnBar">
        © <?= date("Y",time()) ?>
        <?= $siteSetting->site_name; ?>.
        <?=  Yii::t('app', 'All Rights Reserved | Design by ') ?>
        <a href="http://ambecode.com/"> Ambecode</a>

    </div>
</footer>
<!--footer section end-->

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
<script src="<?= Yii::getAlias('@web')?>/template/bootstrap/js/jquery.min.js"></script>
<script src="<?= Yii::getAlias('@web')?>/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= Yii::getAlias('@web')?>/template/bootstrap/js/scripts.js"></script>
<script src="<?= Yii::getAlias('@web')?>/template/js/detail2.js"></script>
<!-- js -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
