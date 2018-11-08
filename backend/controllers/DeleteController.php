<?php
namespace backend\controllers;

use common\models\Ads;
use common\models\AdsPremium;
use common\models\Category;
use common\models\Cities;
use common\models\City;
use common\models\Countries;
use common\models\SiteBanner;
use common\models\State;
use common\models\States;
use common\models\SubCategory;
use common\models\Track;
use common\models\Type;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
define('IMG_BANNER_DIR2', \yii::getAlias('@frontend').'/web/images/site/');

/**
 * Delete Controller
 */
class DeleteController extends Controller
{


    public $layout = "main";
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        Yii::$app->session->setFlash('error', 'You are wrong way. Please go back');

        return $this->redirect(Url::toRoute('site/error'));

    }

    public function actionCategory($id)
    {
        $cat = Category::find()->where(['id'=>$id])->one();
        $cat->delete();
        Yii::$app->session->setFlash('success', 'Entry Deleted');

        return $this->redirect(Url::toRoute('category/index'));
    }

    public function actionSubCategory($id)
    {
        $cat = SubCategory::find()->where(['id'=>$id])->one();
        $cat->delete();
        Yii::$app->session->setFlash('success', 'Entry Deleted');

        return $this->redirect(Url::toRoute('category/subcategory'));
    }

    public function actionType($id)
    {
        $cat = Type::find()->where(['id'=>$id])->one();
        $cat->delete();
        Yii::$app->session->setFlash('success', 'Entry Deleted');

        return $this->redirect(Url::toRoute('category/type'));
    }


    public function actionCountry($id)
    {
        $cat = Countries::find()->where(['id'=>$id])->one();
        $cat->delete();
        Yii::$app->session->setFlash('success', 'Entry Deleted');

        return $this->redirect(Url::toRoute('location/country'));
    }

    public function actionState($id)
    {
        $cat = States::find()->where(['id'=>$id])->one();
        $cat->delete();
        Yii::$app->session->setFlash('success', 'Entry Deleted');

        return $this->redirect(Url::toRoute('location/state'));
    }

    public function actionCity($id)
    {
        $cat = Cities::find()->where(['id'=>$id])->one();
        $cat->delete();
        Yii::$app->session->setFlash('success', 'Entry Deleted');

        return $this->redirect(Url::toRoute('location/city'));
    }

    public function actionAds()
    {
        $all = AdsPremium::find()->all();
        $new = new AdsPremium();
        if ($new->load(Yii::$app->request->post())) {
            $new->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }
        return $this->render('ads_payment_setting',['all'=>$all,'new'=>$new]);
    }

    public function actionBanner($id)
    {
        $banner  = SiteBanner::find()->where(['id'=>$id])->one();
        $banner->delete();
        $bannerName = $banner['name'];
        unlink(IMG_BANNER_DIR.$bannerName);
        Yii::$app->session->setFlash('success', 'Banner Deleted');

        return $this->redirect(Url::toRoute('settings/banner'));
    }



}
