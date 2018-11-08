<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$uid = Yii::$app->user->id;
$usrInfo = \common\models\User::findOne($uid);
$siteSetting = \common\models\SiteSettings::find()->one();
$this->title = $siteSetting['site_name'].' Post an Ad free';

$current_url = \yii\helpers\Url::toRoute('site/profile');
\yii\helpers\Url::remember($current_url,'currency_p');
$googleAds= \common\models\Analytic::find()->one();
$session2 = Yii::$app->cache;
$default_selected = $session2->get('default_currency');
$default = (isset($default_selected))?$default_selected:$currency_default;
?>

<div role="main" class="ui-content">

    <?php
    foreach($category as $rank => $catList)
    {
        ?>
        <div data-role="collapsible" data-inset="false">
             <h3> <i class="<?= $catList['fa-icon'] ?> "></i>
                <?=  Yii::t('app', $catList['name']);?>
            </h3>
                <ul data-role="listview">
                <?php
                $sub = \common\models\SubCategory::find()
                    ->where(['parent' => $catList['id']])
                    ->All();
                foreach ($sub as $rank => $SubcatList)
                {
                    ?>
                    <li>
                        <a data-ajax="false" href="<?= \yii\helpers\Url::toRoute('mobile/post-ads') ?>?category=<?= $catList['name']; ?>&kyind=<?= $SubcatList['name']; ?>">
                            <?= Yii::t('app', $SubcatList['name']); ?>&nbsp;
                            <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>
                        </a>
                    </li>

                    <?php
                }
                ?>
                        
                    </ul>
        </div><!-- /collapsible -->

        <?php
    }
    ?>


</div>























