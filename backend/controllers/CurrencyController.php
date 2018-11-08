<?php
namespace backend\controllers;

use common\models\Currency;
use common\models\Rout;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Currency controller
 */
class CurrencyController extends Controller
{
    /**
     * @inheritdoc
     */

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

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex()
    {
        $model = Currency::find()->all();
        return $this->render('index',['model'=>$model]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */


    public function actionAdd()
    {

        $model = new Currency();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::toRoute('currency/index'));
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionEdit($id)
    {

        $model = Currency::find()->where(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()))
        {
            Currency::updateAll(array('currency_status'=>'disable'));
            $model->save(false);
            return $this->redirect(Url::toRoute('currency/index'));
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }
    }

}
