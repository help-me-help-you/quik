<?php
namespace backend\controllers;

use backend\models\CategoryForm;
use common\models\Analytic;
use common\models\Category;
use common\models\MainMenu;
use common\models\Pages;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Analytic controller
 */
class PagesController extends Controller
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

    public function actionIndex()
    {

        $count = Pages::find()->count();

        $page =  Pages::find()->all();
        return $this->render('index', ['pages'=>$page]);
    }

    public function actionAdd()
    {
        $model = new Pages();

        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                // echo $model->name;
                 $model->save(false);///die;
            }
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
        }
        return $this->render('edit', ['model'=>$model]);
    }
    public function actionEdit($id)
    {
      // echo $id;die;
        $model = Pages::find()->where('id='.$id)->one();
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                // echo $model->name;
                 $model->save();///die;
            }
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
            return $this->redirect(Url::toRoute('pages/index'));

        }
        return $this->render('edit', ['model'=>$model]);
    }
    public function actionDelete($id)
    {
        // echo $id;die;
        $model = Pages::find()->where('id='.$id)->one();

        $model->delete();

        $count = Pages::find()->count();
        $new = Pages::find()->all();

        return $this->redirect(Url::toRoute('pages/index'));
    }


}
