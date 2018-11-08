<?php
namespace backend\controllers;

use backend\models\CityForm;
use common\models\Ads;
use common\models\AdsPremium;
use common\models\Category;
use common\models\Cities;
use common\models\City;
use common\models\Countries;
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

/**
 * Edit Controller
 */
class EditController extends Controller
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
        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }
        return $this->render('category',['cat'=>$cat]);
    }

    public function actionSubCategory($id)
    {
        $cat = SubCategory::find()->where(['id'=>$id])->one();
        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }

        return $this->render('sub-category',['cat'=>$cat]);
    }

    public function actionType($id)
    {
        $cat = Type::find()->where(['id'=>$id])->one();
        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }

        return $this->render('type',['cat'=>$cat]);
    }

    public function actionCountry($id)
    {
        //Countries
        $cat = Countries::find()->where(['id'=>$id])->one();
        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }
        $country = \common\models\Countries::find()->orderBy(['id'=>SORT_DESC])->all();

        return $this->render('country',[
            'model'=>$country,
            'cat'=>$cat
        ]);
    }

    public function actionState($id)
    {
        //Countries
        $cat = States::find()->where(['id'=>$id])->one();
        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }
        $State = \common\models\State::find()->orderBy(['id'=>SORT_DESC])->all();

        return $this->render('state',[
            'model'=>$State,
            'cat'=>$cat
        ]);
    }

    public function actionCity($id)
    {
        //Countries
        $cat = Cities::find()->where(['id'=>$id])->one();
        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }
        $city = \common\models\City::find()->orderBy(['id'=>SORT_DESC])->all();

        return $this->render('city',[
            'model'=>$city,
            'cat'=>$cat
        ]);
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







}
