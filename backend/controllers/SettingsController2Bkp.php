<?php
namespace backend\controllers;

use common\models\Admin;
use common\models\Ads;
use common\models\Contact;
use common\models\Faq;
use common\models\SiteBanner;
use common\models\SiteSettings;
use common\models\MainMenu;
use common\models\Product;
use common\models\Track;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\User;

/**
 * Settings controller
 */


define('LOGO_W', 223);
define('LOGO_H',50);
define('FAV_ICON_SIZE', 10);
define('IMG_BANNER_DIR2', \yii::getAlias('@frontend').'/web/images/site/');

class SettingsController extends Controller
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

    public function actionSite()
    {
       // echo IMG_SITE_DIR;die;
        $count = SiteSettings::find()->count();//die;

        if($count == "0")
        {
            $model = new SiteSettings();

            if ($model->load(Yii::$app->request->post()))
            {
                $model->logo = UploadedFile::getInstance($model,'logo');
                $logo = $model->uploadLogo();
                $model->logo = $logo;
                $model->save(false);

                Yii::$app->getSession()->setFlash('success', 'Update successfully');
            }
            return $this->render('site', ['model'=>$model]);
        }
        else
        {
            $model = SiteSettings::find()->one();
            $save = SiteSettings::find()->one();
            if ($model->load(Yii::$app->request->post()))
            {
                //$model->image = UploadedFile::getInstance($model, 'image');

                if(UploadedFile::getInstance($model,'logo') != null)
                {
                    $model->logo = UploadedFile::getInstance($model,'logo');
                    $logo = $model->uploadLogo();
                    $model->logo = $logo;
                }
                else
                {
                    $model->logo = $save->logo;
                }

                $model->save();
                Yii::$app->getSession()->setFlash('success', 'Update successfully');
            }
            return $this->render('site', ['model'=>$model]);
        }


    }

       //dashboard Action

    public function actionDashboard()
    {
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

    //dashboard Action

    public function actionCountry()
    {
        $country = \common\models\Countries::find()->orderBy(['id'=>SORT_DESC])->all();

        return $this->render('country',[
            'model'=>$country
        ]);
    }
    public function actionBanner()
    {
        $model = new \common\models\SiteBanner();
        if ($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model,'name');

            $Imgname = rand(137, 999999) . time();


            $file->name = $Imgname . '.' . $file->extension; // override the file name

            $model->name = $file;

            if($model->validate() && $model->save()) {
                $file->saveAs(IMG_BANNER_DIR2 . $model->name);
                Yii::$app->getSession()->setFlash('success', 'Upload successfully');

            }


        }
        $banner =SiteBanner::find()->all();

        return $this->render('banner', ['model'=>$model,'banner'=>$banner]);

    }

    public function actionFaqdelete($id)
    {
        $list = Faq::find()->all();
        $model = new Faq();
        $delete = Faq::find()->where(['id'=>$id])->one();
        $delete->delete();
        return $this->redirect(Url::toRoute('settings/faq'));

        //return $this->render('faq', ['model'=>$model,'list'=>$list]);
    }
    public function actionFaqedit($id)
    {
        $model = Faq::find()->where(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()))
        {
            //$model->image = UploadedFile::getInstance($model, 'image');
            $model->save();
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
            return $this->redirect(Url::toRoute('settings/faq'));
        }
        $list = Faq::find()->all();
        return $this->render('faq', ['model'=>$model,'list'=>$list]);

        //return $this->render('faq', ['model'=>$model,'list'=>$list]);
    }
    public function actionFaq()
    {
        // echo IMG_SITE_DIR;die;
        $count = Faq::find()->count();//die;

        if($count == "0")
        {
            $model = new Faq();

            if ($model->load(Yii::$app->request->post()))
            {
                $model->save(false);

                Yii::$app->getSession()->setFlash('success', 'Update successfully');
            }
            return $this->render('faq', ['model'=>$model,'list'=>false]);
        }
        else
        {

            $model = new Faq();
            if ($model->load(Yii::$app->request->post()))
            {
                //$model->image = UploadedFile::getInstance($model, 'image');
                $model->save();
                Yii::$app->getSession()->setFlash('success', 'Update successfully');
            }
            $list = Faq::find()->all();
            return $this->render('faq', ['model'=>$model,'list'=>$list]);
        }


    }
    public function actionAdmin()
    {
        $model = Admin::find()->one();
        if ($model->load(Yii::$app->request->post()))
        {
           $model->change();
            Yii::$app->getSession()->setFlash('success', 'Update successfully');
        }
        return $this->render('admin', ['model'=>$model]);



    }


}
