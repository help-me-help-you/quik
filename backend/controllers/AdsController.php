<?php
namespace backend\controllers;

use common\models\Ads;
use common\models\Category;
use common\models\SubCategory;
use common\models\Type;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Ads controller
 */
class AdsController extends Controller
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
        $all = Ads::find()->all();
        $pending = Ads::find()->where(['active'=>'pending'])->all();

        return $this->render('index',['all'=>$all,'pending'=>$pending]);

    }
    public function actionView($id)
    {
        $model = Ads::find()->where(['id'=>$id])->one();
        return $this->render('view',['model'=>$model]);

    }
    public function actionEdit($id)
    {
        $saved = Ads::find()->where(['id'=>$id])->one();
        $model = Ads::find()->where(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post())) {

            if(UploadedFile::getInstances($model, 'image'))
            {
                $model->image = UploadedFile::getInstances($model, 'image');
                $screen = $model->ScreenShot();
                $model->image = $screen;
            }
            else
            {
                $model->image = $saved->image;
            }
            $model->save(false);
            Yii::$app->session->setFlash('success', 'update successfully');

            return $this->render('edit', [
                'model' => $model,
            ]);
            //return $this->goBack();
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }

    }
    public function actionApproved($id)
    {

            $ads = Ads::find()->where(['id'=>$id])->one();
            $ads->active = 'yes';
            $ads->save(false);
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionReject($id)
    {

        $ads = Ads::find()->where(['id'=>$id])->one();
        $ads->active = 'no';
        $ads->save(false);
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionFormtype($name)
    {
        $p_id = SubCategory::find()->where(['name'=>$name])->one();
        $count = Type::find()
            ->where(['parent'=>$p_id['id']])
            ->All();
        $city = Type::find()
            ->where(['parent'=>$p_id['id']])
            ->All();
        if($count > 0) {
            echo "<option value='other'> Other</option>";
            foreach ($city as $name) {
                echo "<option value='" . $name->name . "'>" . $name->name . "</option>";
            }

        }
        else
        {
            echo "<option value='other'> other </option>";
        }
    }

    public function actionCat($name)
    {
        $p_id = Category::find()->where(['name'=>$name])->one();
        $count = Type::find()
            ->where(['parent'=>$p_id['id']])
            ->All();
        $city = SubCategory::find()
            ->where(['parent'=>$p_id['id']])
            ->All();
        if($count > 0) {
            echo "<option value='other'> Other</option>";
            foreach ($city as $name) {
                echo "<option value='" . $name->name . "'>" . $name->name . "</option>";
            }

        }
        else
        {
            echo "<option value='other'> other </option>";
        }
    }


}
