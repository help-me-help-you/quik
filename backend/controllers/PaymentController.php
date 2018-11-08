<?php
namespace backend\controllers;

use common\models\Ads;
use common\models\AdsPremium;
use common\models\Category;
use common\models\SubCategory;
use common\models\Track;
use common\models\Payment;
use common\models\Type;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * StaticsController
 */
class PaymentController extends Controller
{


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

    public function actionPaypal()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $count = Payment::find()->count();

        $ana =  Payment::find()->all();
        return $this->render('index', ['payment'=>$ana]);

    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $count = Payment::find()->count();

        $ana =  Payment::find()->all();
        return $this->render('index', ['payment'=>$ana]);


    }

    public function actionAdd()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new Payment();

        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                // echo $model->name;
                Payment::updateAll(array('status'=>'disable'));
                $model->save(false);///die;
                Yii::$app->getSession()->setFlash('success', 'Update successfully');
                return $this->redirect(Url::toRoute('payment/index'));

            }

        }
        return $this->render('edit', ['model'=>$model]);
    }
    public function actionEdit($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        // echo $id;die;
        $model = Payment::find()->where('id='.$id)->one();
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                // echo $model->name;
                Payment::updateAll(array('status'=>'disable'));
                $model->save();///die;
                Yii::$app->getSession()->setFlash('success', 'Update successfully');

                return $this->redirect(Url::toRoute('payment/index'));

            }
        }
        return $this->render('edit', ['model'=>$model]);
    }
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        // echo $id;die;
        $model = Payment::find()->where('id='.$id)->one();

        $model->delete();
        return $this->redirect(Url::toRoute('payment/index'));


    }



    //ads
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

    public function actionAdsEdit($ads)
    {
        $all = AdsPremium::findOne($ads);
        if ($all->load(Yii::$app->request->post())) {
            $all->save(false);
            Yii::$app->session->setFlash('success', 'save settings');
        }
        return $this->render('ads_payment_setting_edit',['all'=>$all,'new'=>$all]);
    }





}
