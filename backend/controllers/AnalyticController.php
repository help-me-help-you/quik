<?php
namespace backend\controllers;

use backend\models\CategoryForm;
use common\models\Analytic;
use common\models\Category;
use common\models\MainMenu;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Analytic controller
 */
class AnalyticController extends Controller
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
        $count = Analytic::find()->count();

        $ana =  Analytic::find()->all();
            return $this->render('index', ['analytic'=>$ana]);


    }

    public function actionAdd()
    {
        $model = new Analytic();

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
        $model = Analytic::find()->where('id='.$id)->one();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->save(false);
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
        }
        return $this->render('edit', ['model'=>$model]);
    }
    public function actionDelete($id)
    {
        // echo $id;die;
        $model = Analytic::find()->where('id='.$id)->one();

        $model->delete();

        $count = Analytic::find()->count();
        $new = Analytic::find()->all();

        return $this->render('index', ['analytic'=>$new,'count'=>$count]);
    }


}
