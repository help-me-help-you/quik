<?php
namespace frontend\controllers;

use common\models\Ads;
use common\models\Category;
use common\models\City;
use common\models\Pages;
use common\models\SubCategory;
use common\models\Type;
use frontend\models\AdsForm;
use frontend\models\SearchForm;
use frontend\models\SearchTypeForm;
use frontend\models\SortByForm;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Ads controller
 */
class PagesController extends Controller
{


    public function actionIndex($title)
    {
        $model = Pages::find()->where(['title'=>$title])->one();
        return $this->render('index', [
            'model' => $model,
        ]);
    }
    public function actionHowItWorks()
    {
        return $this->render('how_it_works');
    }

}
