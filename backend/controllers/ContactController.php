<?php
namespace backend\controllers;

use common\models\Contact;
use common\models\SiteSettings;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

/**
 * Settings controller
 */



class ContactController extends Controller
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
        // echo IMG_SITE_DIR;die;
        $count = Contact::find()->count();//die;

        if($count == "0")
        {
            $model = new Contact();

            if ($model->load(Yii::$app->request->post()))
            {
                $model->save(false);

                Yii::$app->getSession()->setFlash('success', 'Update successfully');
            }
            return $this->render('index', ['model'=>$model]);
        }
        else
        {
            $model = Contact::find()->one();
            $save = Contact::find()->one();
            if ($model->load(Yii::$app->request->post()))
            {
                //$model->image = UploadedFile::getInstance($model, 'image');
                $model->save();
                Yii::$app->getSession()->setFlash('success', 'Update successfully');
            }
            return $this->render('index', ['model'=>$model]);
        }


    }




}
