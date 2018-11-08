<?php
namespace backend\controllers;

use common\models\Category;
use common\models\SubCategory;
use common\models\Type;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Category controller
 */
class CategoryController extends Controller
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
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $cat = new Category();



        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            $model = Category::find()->all();
            //Yii::$app->getSession()->setFlash('success', 'Update successfully');
            return $this->render('index',['model'=>$model,'cat'=>$cat,'save'=>true]);
        }
        else{
            $model = Category::find()->all();
            return $this->render('index',['model'=>$model,'cat'=>$cat,'save'=>false]);

        }
    }

    public function actionSubcategory()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $cat = new SubCategory();



        if ($cat->load(Yii::$app->request->post()))
        {
           // die();
           $cat->save(false);
            $model = SubCategory::find()->all();
            //Yii::$app->getSession()->setFlash('success', 'Update successfully');
            return $this->render('subcategory',['model'=>$model,'cat'=>$cat,'save'=>true]);
        }
        else{
            $model = SubCategory::find()->all();
            return $this->render('subcategory',['model'=>$model,'cat'=>$cat,'save'=>false]);

        }
    }


    public function actionType()
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $cat = new Type();



        if ($cat->load(Yii::$app->request->post())) {
            $cat->save(false);
            //$model = Type::find()->orderBy(['id' => SORT_DESC,])->limit('3')->all();
            //Yii::$app->getSession()->setFlash('success', 'Update successfully');
            //return $this->render('Type',['model'=>$model,'cat'=>$cat,'save'=>true]);

            $trends_count = Type::find()->count();
            $pages = new Pagination(['totalCount' => $trends_count,'pageSize'=>20]);
            $model = Type::find()->offset($pages->offset)
                ->limit($pages->limit)->all();

            //$model = Type::find()->orderBy(['id' => SORT_DESC,])->limit('3')->all();
            return $this->render('Type',['model'=>$model,'cat'=>$cat,'pages'=>$pages,'save'=>true]);
        }
        else{
            $trends_count = Type::find()->count();
            $pages = new Pagination(['totalCount' => $trends_count,'pageSize'=>20]);
            $model = Type::find()->offset($pages->offset)
                ->limit($pages->limit)->all();

            //$model = Type::find()->orderBy(['id' => SORT_DESC,])->limit('3')->all();
            return $this->render('Type',['model'=>$model,'cat'=>$cat,'pages'=>$pages,'save'=>false]);

        }
    }


}
