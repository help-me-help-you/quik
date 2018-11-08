<?php
namespace frontend\controllers;

use common\models\Ads;
use common\models\AdsMore;
use common\models\AdsPremium;
use common\models\Category;
use common\models\City;
use common\models\Currency;
use common\models\Message;
use common\models\QnewCustomFields;
use common\models\SubCategory;
use common\models\Type;
use common\models\Verify;
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
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * Ads controller
 */
define('SCREENSHOT', Yii::getAlias('@webroot') .'/images/products/');

class AdsController extends Controller
{

    public function beforeAction($action) {
        $actionToRun = $action;;
        //   var_dump($actionToRun->id) ;die;
        $unique = Verify::userVerify();
        if(!$unique)
        {
           // $this->redirect(Url::toRoute('site/verify'));
        };
        $session2 = Yii::$app->cache;

        $default_language_slctd = $session2->get('default_language');

        $default_language = (isset($default_language_slctd))?$default_language_slctd:"en-EN";
        Yii::$app->language = $default_language['value'];;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionPostAds($category,$kyind)
    {
        // echo $user_id = Yii::$app->user->id;die;
        if (\Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('info', 'you must be login/register before posting you Ads');
            return $this->goHome();
        }

        $currency = $currency_default = Currency::default_currency();

        $model = new AdsForm();
        $adCustom = new AdsMore();
        $form1 = $model->load(Yii::$app->request->post());
        $form2 = $adCustom->load(Yii::$app->request->post());
        if ($form1 and $form2)
        {

            // die('form 1');
            if ($model->premium == "regular")
            {
                if (UploadedFile::getInstances($model, 'image'))
                {
                    $model->image = UploadedFile::getInstances($model, 'image');
                    $screen = $model->ScreenShot();
                    $model->image = $screen;
                }
                else {
                    $model->image = false;
                }

                $adsId = $model->post($model->image);

                $array1 = $adCustom['more_title'];

                $array2 = $adCustom['more_value'];

                foreach($array1 as $key => $value)
                {

                    if(isset($array2[$value]))
                    {

                        $AdsNew = new AdsMore();
                        $AdsNew['ads_id'] = $adsId;
                        $AdsNew['more_title'] = $value;
                        $AdsNew['more_value'] = implode(',', $array2[$value]);
                        //   echo $value." = ".implode(',', $array2[$value])."<br>";
                        $AdsNew->save(false);

                    }

                };


            }

            else
            {
                if (UploadedFile::getInstances($model, 'image')) {
                    $model->image = UploadedFile::getInstances($model, 'image');
                    $screen = $model->ScreenShot();
                    $model->image = $screen;
                } else {
                    $model->image = false;
                }

                $adsId = $model->post($model->image);
                $array1 = $adCustom['more_title'];
                $array2 = $adCustom['more_value'];
                foreach($array1 as $key => $value)
                {
                    if(isset($array2[$value]))
                    {

                        $AdsNew = new AdsMore();
                        $AdsNew['ads_id'] = $adsId;
                        $AdsNew['more_title'] = $value;
                        $AdsNew['more_value'] = implode(',', $array2[$value]);
                        //   echo $value." = ".implode(',', $array2[$value])."<br>";
                        $AdsNew->save(false);

                    }

                }
                return $this->redirect(Url::toRoute('payment/index?type=' . $model->premium . '&pid=' . $adsId . '&price=' . AdsPremium::getPriceByName($model->premium)));

            }
            Yii::$app->session->setFlash('success', 'your ads is under review...');
            return $this->redirect(Url::toRoute('site/profile'));
        }
        elseif($form1)
        {

            if ($model->premium == "regular")
            {
                if (UploadedFile::getInstances($model, 'image'))
                {
                    $model->image = UploadedFile::getInstances($model, 'image');
                    $screen = $model->ScreenShot();
                    $model->image = $screen;
                }
                else {
                    $model->image = false;
                }

                $adsId = $model->post($model->image);



            }

            else
            {
                if (UploadedFile::getInstances($model, 'image')) {
                    $model->image = UploadedFile::getInstances($model, 'image');
                    $screen = $model->ScreenShot();
                    $model->image = $screen;
                } else {
                    $model->image = false;
                }

                $adsId = $model->post($model->image);

                return $this->redirect(Url::toRoute('payment/index?type=' . $model->premium . '&pid=' . $adsId . '&price=' . AdsPremium::getPriceByName($model->premium)));

            }
            Yii::$app->session->setFlash('success', 'your ads is under review...');
            return $this->redirect(Url::toRoute('site/profile'));
        }
        else
        {
            $SubId = SubCategory::find()->where(['name'=>$kyind])->one();
            $custom = QnewCustomFields::find()->where(['custom_subcatid'=>$SubId['id']])->all();;
         //   echo  "<br>".$SubId['id']." h";
//die;
            return $this->render('post', [
                'adCustom'=>$adCustom,
                'custom'=>$custom,
                'model' => $model,
                'currency' => $currency,
                'cat'=>$category,
                'sub'=>$kyind,

            ]);
        }



        //return $this->render('index');
    }


    public function actionIndex()
    {
        // echo $user_id = Yii::$app->user->id;die;
        if (\Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('info', 'you must be login/register before posting you Ads');
            return $this->goHome();
        }

        $category = \common\models\Category::find()->all();

        return $this->render('index', [
                'category'=>$category
            ]);

        //return $this->render('index');
    }

    //edit ads code start here

    public function actionEditAds($id)
    {
        // echo $user_id = Yii::$app->user->id;die;
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
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
            return $this->render('edit', [
                'model' => $model,
            ]);
            //return $this->goBack();
        } else {
            return $this->render('edit', [
                'model' => $model,
            ]);
        }

        //return $this->render('index');
    }
    //edit code end here

    //delete code here
    public function actionDelete($id)
    {
        $model = Ads::find()->where(['id'=>$id])->one();
        $model->delete();
        Yii::$app->session->setFlash('info', 'Ads deleted successfully');
        return $this->redirect(Url::toRoute('site/profile'));
    }
    //delete code end
    public function actionDetail($ads,$title = false)
    {
        $similar = Ads::find()->orderBy(['id'=>SORT_DESC])->limit(4)->all();
        $model = Ads::findOne($ads);

        if(!$model)
        {
            return $this->render('access');
        }
        $more = AdsMore::find()->where(['ads_id'=>$model['id']])->all();
        return $this->render('detail', [
            'model' => $model,
            'similar'=>$similar,
            'more'=>$more
        ]);
    }

    public function actionSendMsg($msg,$receiver,$ad)
    {
        $uId = Yii::$app->user->identity->getId();
        $model = Message::sendMsg($uId,$receiver,$msg,$ad);
        return $model;
    }

    public function actionAll()
    {
        $all = Category::find()->all();
        $unique = Verify::userVerify();
        $session = Yii::$app->session;
        $city = $session->get('cityset');//die;;

        $cityDefault = ($city == null)?"jodhpur":$city;
        if(!$unique)
        {
           // $this->redirect(Url::toRoute('site/verify'));
        };
        $model = Ads::find()->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->limit(15)->all();
        $session = Yii::$app->session;
        $city = $session->get('cityset');//die;;

        $cityDefault = ($city == null)?"jodhpur":$city;
        $searchForm = new \frontend\models\SearchForm();

        if ($searchForm->load(Yii::$app->request->post())) {
            $model = Ads::find()->where(['LIKE', 'ad_title',$searchForm->item ])->andWhere(['category'=>$searchForm->category])->andWhere(['city'=>$cityDefault])->all();

            return $this->render('all',[
                'category'=>$all,
                'model'=>$model,
                'cat'=>false,
                'sub_cat'=>false,
                'subList'=>false,
                'typeList'=>false,
                'type'=>false
            ]);
        }
        return $this->render('all',[
            'category'=>$all,
            'model'=>$model,
            'cat'=>false,
            'sub_cat'=>false,
            'subList'=>false,
            'typeList'=>false,
            'type'=>false
        ]);
    }
    public function actionCategory($cat = false, $sub_cat = false, $type = false, $sort = false, $near = false)
    {

        $session = Yii::$app->session;
        $city = $session->get('cityset');//die;;

        $cityDefault = ($city == null)?"jodhpur":$city;

        $category = Category::find()->all();

        if($cat == true and $sub_cat == false)
        {

            if($sort)
            {
                switch($sort)
                {
                    case "new":
                        $model = Ads::find()->where(['category'=>$cat])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->all();
                    break;
                    case "htl":
                        $model = Ads::find()->where(['category'=>$cat])->andWhere(['city'=>$cityDefault])->orderBy(['price'=>SORT_DESC])->all();
                        break;
                    case "lth":
                        $model = Ads::find()->where(['category'=>$cat])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_ASC])->all();
                        break;
                }

            }
            elseif($near)
            {
                $lat1 =  26.9124 ;
                $lon1 = 78.7873 ;

                $center_lat =26.9124;
                $center_lng = 78.7873;
                $radius = $near;//25;
                //78.7873
                $query = sprintf("SELECT * ,( 3959 * acos( cos( radians('%s') ) * cos( radians(lat) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) )  AS distance FROM ads  where `category` = '".$cat."' HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
                    //\Yii::$app->db->quoteValue($value); ,
                    $center_lat,
                    $center_lng,
                    $center_lat,
                    $radius);

                $connection = \Yii::$app->db;
                $command = $connection->createCommand($query);
                $model = $command->queryAll();

            }
            else
            {
                $model = Ads::find()->where(['category'=>$cat])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->all();



            }
            $sub = SubCategory::find()->where(['parent'=>Category::findId($cat)])->all();
            $typeList = Type::find()->where(['parent'=>SubCategory::findId($sub_cat)])->all();

            return $this->render('category',[
                'category'=>$category,
                'model'=>$model,
                'cat'=>$cat,
                'sub_cat'=>false,
                'subList'=>$sub,
                'typeList'=>$typeList,
                'type'=>false,
                'sort'=>$sort,
                'near'=>$near
            ]);

        }
        elseif($sub_cat  == true and $type == false)
        {
            if($sort)
            {
                switch($sort)
                {
                    case "new":
                        $model = Ads::find()->where(['sub_category'=>$sub_cat])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->all();
                        break;
                    case "htl":
                        $model = Ads::find()->where(['sub_category'=>$sub_cat])->andWhere(['city'=>$cityDefault])->orderBy(['price'=>SORT_DESC])->all();
                        break;
                    case "lth":
                        $model = Ads::find()->where(['sub_category'=>$sub_cat])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_ASC])->all();
                        break;

                }

            }
            elseif($near)
            {
                $lat1 =  26.9124 ;
                $lon1 = 78.7873 ;

                $center_lat =26.9124;
                $center_lng = 78.7873;
                $radius = $near;//25;
                //78.7873
                $query = sprintf("SELECT * ,( 3959 * acos( cos( radians('%s') ) * cos( radians(lat) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) )  AS distance FROM ads  where `sub_category` = '".$sub_cat."' HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
                    //\Yii::$app->db->quoteValue($value); ,
                    $center_lat,
                    $center_lng,
                    $center_lat,
                    $radius);

                $connection = \Yii::$app->db;
                $command = $connection->createCommand($query);
                $model = $command->queryAll();
            }
            else
            {
                $model = Ads::find()->where(['sub_category'=>$sub_cat])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->all();

            }

            $sub = SubCategory::find()->where(['parent'=>Category::findId($cat)])->all();
            $typeList = Type::find()->where(['parent'=>SubCategory::findId($sub_cat)])->all();

            return $this->render('category',[
                'category'=>$category,
                'model'=>$model,
                'cat'=>$cat,
                'sub_cat'=>$sub_cat,
                'subList'=>$sub,
                'typeList'=>$typeList,
                'type'=>false,
                'sort'=>$sort,
                'near'=>$near
            ]);

        }
        elseif($type)
        {
            if($sort)
            {
                switch($sort)
                {
                    case "new":
                        $model = Ads::find()->where(['type'=>$type])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->all();
                        break;
                    case "htl":
                        $model = Ads::find()->where(['type'=>$type])->andWhere(['city'=>$cityDefault])->orderBy(['price'=>SORT_DESC])->all();
                        break;
                    case "lth":
                        $model = Ads::find()->where(['type'=>$type])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_ASC])->all();
                        break;

                }

            }
            elseif($near)
            {
                $lat1 =  26.9124 ;
                $lon1 = 78.7873 ;

                $center_lat =26.9124;
                $center_lng = 78.7873;
                $radius = $near;//25;
                //78.7873
                $query = sprintf("SELECT * ,( 3959 * acos( cos( radians('%s') ) * cos( radians(lat) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) )  AS distance FROM ads  where `type` = '".$type."' HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
                    //\Yii::$app->db->quoteValue($value); ,
                    $center_lat,
                    $center_lng,
                    $center_lat,
                    $radius);

                $connection = \Yii::$app->db;
                $command = $connection->createCommand($query);
                $model = $command->queryAll();
            }
            else
            {
                $model = Ads::find()->where(['type'=>$type])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->all();

            }
            $sub = SubCategory::find()->where(['parent'=>Category::findId($cat)])->all();
            $typeList = Type::find()->where(['parent'=>SubCategory::findId($sub_cat)])->all();

            return $this->render('category',[
                'category'=>$category,
                'model'=>$model,
                'cat'=>$cat,
                'sub_cat'=>$sub_cat,
                'subList'=>$sub,
                'typeList'=>$typeList,
                'type'=>$type,
                'sort'=>$sort,
                'near'=>$near
            ]);
        }
        else
        {
            $model = Ads::find()->orderBy(['id'=>SORT_DESC])->andWhere(['city'=>$cityDefault])->limit(20)->all();
            return $this->render('category',[
                'category'=>$category,
                'model'=>$model,
                'cat'=>false,
                'sub_cat'=>false,
                'subList'=>false,
                'typeList'=>false,
                'type'=>false,
                'sort'=>$sort,
                'near'=>$near
            ]);

        }
    }

    public function actionNearby($radius)
    {
        $this->layout = "main";
        $session = Yii::$app->session;
        $cityDefault = $session->get('cityset');//die;

        $lat1 =  26.9124 ;
        $lon1 = 78.7873 ;

        $center_lat =26.9124;
        $center_lng = 78.7873;
        $radius = $radius;//25;
        //78.7873
        $query = sprintf("SELECT * ,( 3959 * acos( cos( radians('%s') ) * cos( radians(lat) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) )  AS distance FROM ads  HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
            //\Yii::$app->db->quoteValue($value); ,
            $center_lat,
            $center_lng,
            $center_lat,
            $radius);

        $connection = \Yii::$app->db;
        $command = $connection->createCommand($query);
        $model = $command->queryAll();


        return $this->render('near',[
            'model'=>$model
        ]);
    }

    public function actionList($near)
    {


        $session = Yii::$app->session;
        $cityDefault = $session->get('cityset');//die;

        $lat1 =  26.9124 ;
        $lon1 = 78.7873 ;

        $center_lat =26.9124;
        $center_lng = 78.7873;
        $radius = $near;//25;
        //78.7873
        $query = sprintf(" SELECT * ,( 3959 * acos( cos( radians('%s') ) * cos( radians(lat) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) )  AS distance FROM ads  HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
            //\Yii::$app->db->quoteValue($value); ,
            $center_lat,
            $center_lng,
            $center_lat,
            $radius);

        $connection = \Yii::$app->db;
        $command = $connection->createCommand($query);
        $model = $command->queryAll();


            return $this->render('list',[
                'model'=>$model
            ]);


        //return $this->render('list');
    }

    public function actionSearch()
    {
        $category = "";
        $session = Yii::$app->session;
        $cityDefault = $session->get('cityset');//die;
        $search = new SearchForm();
        $searchType = new SearchTypeForm();
        if ($search->load(Yii::$app->request->post())) {
            $search->city;
            $model = Ads::find()->where(['LIKE', 'ad_title',$search->item ])->andWhere(['category'=>$search->category])->andWhere(['city'=>$search->city])->all();
            $parent = SubCategory::findId($category);
            $type = Type::find()->where(['parent'=>$parent])->all();
            return $this->render('list', [
                'model' => $model,
                'search'=>$search,
                'type'=>$type,
                'searchType'=>$searchType,
            ]);
        }

        //search type end
        $searchType = new SearchTypeForm();
        if ($searchType->load(Yii::$app->request->post())) {
            $searchType->type;
            $model = Ads::find()->where(['type'=>$searchType->type ])->andWhere(['city'=>$searchType->city])->all();
            $parent = SubCategory::findId($category);
            $type = Type::find()->where(['parent'=>$parent])->all();
            return $this->render('list', [
                'model' => $model,
                'search'=>$search,
                'type'=>$type,
                'searchType'=>$searchType,

            ]);
        }

        //sortby start
        $Sortby = new SortByForm();
        if ($Sortby->load(Yii::$app->request->post())) {
            // echo  $Sortby->sort;die;
            if($Sortby->sort == "low")
            {
                $model = Ads::find()->where(['sub_category'=>$category])->andWhere(['city'=>$cityDefault])->orderBy(['price'=>SORT_DESC])
                    ->all();
            }
            elseif($Sortby->sort == "high")
            {
                $model = Ads::find()->where(['sub_category'=>$category])->andWhere(['city'=>$cityDefault])->orderBy(['price'=>SORT_ASC])
                    ->all();
            }
            else
            {
                $model = Ads::find()->where(['sub_category'=>$category])->andWhere(['city'=>$cityDefault])->orderBy(['created_at'=>SORT_DESC])
                    ->all();
            }

//            $model = Ads::find()
//                ->where(['sub_category'=>$category])
//                ->andWhere(['city'=>$cityDefault])
//                ->orderBy([
//                    'price'=>$Sortby->sort
//                ])->limit(10)
//                ->all();
            $parent = SubCategory::findId($category);
            $type = Type::find()->where(['parent'=>$parent])->all();
            return $this->render('list', [
                'model' => $model,
                'search'=>$search,
                'type'=>$type,
                'searchType'=>$searchType,

            ]);
        }
        //sortby end

        $model = Ads::find()->where(['sub_category'=>$category])->andWhere(['city'=>$cityDefault])->all();

        $parent = SubCategory::findId($category);
        $type = Type::find()->where(['parent'=>$parent])->all();
        return $this->render('list', [
            'model' => $model,
            'search'=>$search,
            'type'=>$type,
            'searchType'=>$searchType,

        ]);
    }

    public function actionScity($param)
    {
        $session = Yii::$app->session;
        $session->set('cityset', isset($param)?$param:'Jodhpur');
         Url::previous('currency_p');
      return $this->redirect(Url::previous('currency_p'));
       // return " you choose ".$param." as deault";

    }
    public function actionSearchtype($search,$category)
    {
        ///die;
        //SearchTypeForm
        $searchType = new SearchTypeForm();
        if ($searchType->load(Yii::$app->request->post())) {
            $searchType->type;
            $model = Ads::find()->where(['type'=>$search->type ])->andWhere(['city'=>$searchType->city])->all();
            $parent = SubCategory::findId($category);
            $type = Type::find()->where(['parent'=>$parent])->all();
            return $this->render('list', [
                'model' => $model,
                'search'=>$search,
                'type'=>$type,
            ]);
        }
    }

    // ###############################  ajax function is start here ################################################
    public function actionCat($id)
    {
        $p_id = Category::find()->where(['name'=>$id])->one();
        $count = SubCategory::find()
            ->where(['parent'=>$p_id->id])
            ->All();
        $subCat = SubCategory::find()
            ->where(['parent'=>$p_id->id])
            ->All();
        if($count >= 1)
        {
            echo "<option value='other'> Other</option>";
            foreach ($subCat as $name) {
                echo "<option value='" . $name->name . "'>" . $name->name . "</option>";
            }

        }
        else
        {
            echo "<option value='other'> Other</option>";
        }
    }

    public function actionFormtype($name)
    {
        $p_id = SubCategory::find()->where(['name'=>$name])->one();
        $count = Type::find()
            ->where(['parent'=>$p_id->id])
            ->All();
        $city = Type::find()
            ->where(['parent'=>$p_id->id])
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

    public function actionCustom($name)
    {
        $SubId = SubCategory::find()->where(['name'=>$name])->one();
        $custom = QnewCustomFields::find()->where(['custom_subcatid'=>$SubId['id']])->all();;
        $adCustom = new AdsMore();
        return $this->render('custom', [
            'adCustom'=>$adCustom,
            'custom'=>$custom,

        ]);
    }


    public function actionState($id)
    {
        $count = City::find()
            ->where(['state_id'=>$id])
            ->All();
        $city = City::find()
            ->where(['state_id'=>$id])
            ->All();
        if($count > 0) {
            foreach ($city as $name) {
                echo "<option value='" . $name->city . "'>" . $name->city . "</option>";
            }
        }
        else
        {
            echo "<option></option>";
        }
    }

}
