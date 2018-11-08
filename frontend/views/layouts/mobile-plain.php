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
</head>
<body>
<?php $this->beginBody() ?>
<!--header section start-->
    <?= Alert::widget(); ?>
    <?= $content ?>

<!--header section end-->

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
