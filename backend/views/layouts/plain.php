<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/bootstrap/css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/dist/css/Myadmin.css">

    <!-- quikr Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= Yii::getAlias('@web') ?>/template/dist/css/skins/_all-skins.min.css">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?= Yii::getAlias('@web') ?>/theme/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <?php //$this->head() ?>
</head>
<body style="background-color: #000">
<?php $this->beginBody() ?>
<div class="wrapper">
    <div class="container">
        <div class="content">
            <div class="container-fluid">

                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>

<!--   Core JS Files   -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="<?= Yii::getAlias('@web') ?>/theme/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Charts Plugin -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<!-- Fine Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="<?= Yii::getAlias('@web') ?>/theme/js/fine-bootstrap-dashboard.js"></script>

<!-- Fine Bootstrap Table DEMO methods, don't include it in your project! -->

<script type="text/javascript">
//    $(document).ready(function(){
//
//        demo.initChartist();
//
//        $.notify({
//            icon: 'pe-7s-gift',
//            message: "Welcome to <b>Fine Admin Bootstrap Dashboard</b> - Easy And User Friendly."
//
//        },{
//            type: 'info',
//            timer: 4000
//        });
//
//    });
</script>
</html>
<?php $this->endPage() ?>
