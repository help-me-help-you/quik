<?php
namespace backend\controllers;

use common\models\AdminLoginForm;
use common\models\Ads;
use common\models\Track;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = 'plain';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','user'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute('site/login'));
        }
        $this->layout = "main";
        $user = \common\models\User::find()->orderBy(['created_at'=>SORT_DESC])->limit('5')->all();
        $ads = Ads::find()->orderBy(['created_at'=>SORT_DESC])->limit('5')->all();;

        $statistics = Track::find()->limit('5')->all();
        $adsTotal = Ads::find()->count();
        $pending = Ads::find()->where(['active'=>'yes'])->count();
        $active = ($adsTotal - $pending);
        return $this->render('index',[
            'total'=>$adsTotal,
            'pending'=>$pending,
            'active'=>$active,
            'statistics'=>$statistics,
            'member'=>$user,
            'ads'=>$ads
        ]);
    }
    public function actionUser($id = false)
    {
        $this->layout = "main";
        if (\Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute('site/login'));
        };

        if($id)
        {

            $ads = \common\models\Ads::find()->where(['user_id'=>$id])->all();
            $adsPremium = \common\models\Ads::find()->where(['user_id'=>$id])->andWhere('premium != ""')->count();

            $user = \common\models\User::find()->where(['id'=>$id])->one();
            if ($user->load(Yii::$app->request->post())) {
                $user->save(false);
                Yii::$app->session->setFlash('success', 'save settings');
            }
            return $this->render('profile',[
                'member'=>$user,
                'premium'=>$adsPremium,
                'ads'=>$ads
            ]);
        }
        else
        {
            $user = \common\models\User::find()->orderBy(['created_at'=>SORT_DESC])->limit('5')->all();
            return $this->render('user',[
                'member'=>$user
            ]);
        }


    }




    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Url::toRoute('settings/dashboard'));
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }



    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
