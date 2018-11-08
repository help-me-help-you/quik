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

$site = \common\models\SiteSettings::find()->one();
$pending = \common\models\Ads::find()->where(['active'=>'pending'])->all();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php //$this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="<?= \yii\helpers\Url::toRoute('site/index') ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">
                <?= $site['site_name'] ?>
            </span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>
                    <?= $site['site_name'] ?>
                </b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">
                                <?= count($pending); ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have <?= count($pending); ?> Pending ads for approval   </li>

                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <?php
                                    foreach($pending as $list)
                                    {
                                        ?>
                                        <li>
                                            <a href="<?= \yii\helpers\Url::toRoute('ads/index') ?>">
                                                <i class="fa fa-shopping-cart text-aqua"></i>
                                                <?= $list['ad_title'] ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li class="footer"><a href="<?= \yii\helpers\Url::toRoute('ads/index') ?>">View all</a></li>
                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                            <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/site/logo/'.$site->logo ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs">
                                Admin
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">

                                <img src="<?= Yii::$app->urlManagerFrontend->baseUrl.'/images/site/logo/'.$site->logo ?>" class="" alt="User Image">
                                <p>
                                   <?= $site->site_name; ?>
                                    <small>
                                        <?= $site->site_title; ?>
                                    </small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-6 text-center">
                                    <a href="<?= \yii\helpers\Url::toRoute('settings/dashboard') ?>">Dashboard</a>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <a href="<?= \yii\helpers\Url::toRoute('settings/admin') ?>">
                                        Admin Setting
                                    </a>
                                </div>

                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= \yii\helpers\Url::toRoute('settings/site') ?>" class="btn btn-default btn-flat">
                                        Site Setting
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <a data-method="POST" href="<?= \yii\helpers\Url::toRoute('site/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->


            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active treeview">
                    <a href="<?= \yii\helpers\Url::toRoute('site/index') ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('category/index') ?>">
                        <i class="fa fa-th"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('category/subcategory') ?>">
                        <i class="fa fa-bars"></i>
                        <span>Sub Category</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('category/type') ?>">
                        <i class="fa fa-plug"></i>
                        <span>Type</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('settings/banner') ?>">
                        <i class="fa fa-image"></i>
                        <span>Banner</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('site/user') ?>">
                        <i class="fa fa-user"></i>
                        <span>User Management</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('ads/index') ?>">
                        <i class="fa fa-gear"></i>
                        <span>Ads Management</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('settings/adsense') ?>">
                        <i class="fa fa-google-wallet"></i>
                        <span>Adsense Management</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('pages/index') ?>">
                        <i class="fa fa-book"></i>
                        <span>Page Management</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-map-marker"></i>
                        <span>Location</span>
                    </a>
                    <ul class="treeview-menu">

                        <li>
                            <a href="<?= \yii\helpers\Url::toRoute('location/city') ?>">
                                <i class="fa fa-plus-square-o"></i>
                                Listed Cities
                            </a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::toRoute('location/state') ?>">
                                <i class="fa fa-plus-square-o"></i>
                                Listed States
                            </a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::toRoute('location/country') ?>">
                                <i class="fa fa-plus-square-o"></i>
                                Listed Country
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-usd"></i>
                        <span>Currency</span>
                    </a>
                    <ul class="treeview-menu">

                        <li>
                            <a href="<?= \yii\helpers\Url::toRoute('currency/index') ?>">
                                <i class="fa fa-bar-chart-o"></i>

                                Currency List
                            </a>
                        </li>
                        <li>
                            <a href="<?= \yii\helpers\Url::toRoute('currency/add') ?>">
                                <i class="fa fa-plus-square-o"></i>
                                Add new Currency
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('statics/index') ?>">
                        <i class="fa fa-line-chart"></i>
                        <span>Statics</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('settings/site') ?>">
                        <i class="fa fa-gears"></i>
                        <span>Site Setting</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('payment/index') ?>">
                        <i class="fa fa-paypal"></i>
                        <span>Paypal Setting</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('payment/ads') ?>">
                        <i class="fa fa-money"></i>
                        <span>Ads Payment Setting</span>
                    </a>
                </li>
                <li>
                    <a href="<?= \yii\helpers\Url::toRoute('analytic/index') ?>">
                        <i class="fa fa-google"></i>
                        <span>Analytic Code</span>
                    </a>
                </li>

                <li>
                    <a data-method="POST" href="<?= \yii\helpers\Url::toRoute('site/logout') ?>">
                        <i class="fa fa-power-off"></i>
                        <span>Logout</span>
                    </a>

                </li>

                <li class="header">LABELS</li>
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <?= $this->title; ?>
                <small>Version 1.0</small>
            </h1>
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <br>
        </section>

        <!-- Main content -->
        <section class="content" >

            <?= Alert::widget() ?>
            <?= $content ?>
        </section>
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy;  <?= date("Y",time()); ?> <a href="http://ambecode.com">AmbeCode</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane" id="control-sidebar-home-tab">
               <!-- /.control-sidebar-menu -->
                <p>
                    You Can add Custom field here
                </p>
            </div><!-- /.tab-pane -->

            <!-- Settings tab content -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div><!-- ./wrapper -->
<?php $this->endBody() ?>
<!-- jQuery 2.1.4 -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?= Yii::getAlias('@web') ?>/template/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/fastclick/fastclick.min.js"></script>
<!-- Myadmin App -->
<script src="<?= Yii::getAlias('@web') ?>/template/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= Yii::getAlias('@web') ?>/template/plugins/chartjs/Chart.min.js"></script>
<!-- Myadmin dashboard demo (This is only for demo purposes) -->
<script src="<?= Yii::getAlias('@web') ?>/template/dist/js/pages/dashboard2.js"></script>
<!-- Myadmin for demo purposes -->
<script src="<?= Yii::getAlias('@web') ?>/template/dist/js/demo.js"></script>


</body>

</html>
<?php $this->endPage() ?>
