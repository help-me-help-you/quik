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
use common\models\Track;
use common\models\Type;
use common\models\User;
use common\models\Verify;
use frontend\models\AdsForm;
use frontend\models\SelectCityForm;
use frontend\models\VerifyForm;
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
use yii\web\Cookie;
use yii\web\UploadedFile;

define('PROFILE_DIR', Yii::getAlias('@webroot') .'/images/user/');
define('THUMB_SIZE', 300);
define('SCREENSHOT', Yii::getAlias('@webroot') .'/images/products/');

/**
 * Site controller
 */
class MobileController extends Controller
{
    public $layout = "mobile";
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
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

    public function actionIndex()
    {


        $trendCount = Ads::find()->count();
        $urgent = Ads::find()->where(['premium'=>'urjent'])->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        $featured= Ads::find()->where(['premium'=>'featured'])->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        $all = Ads::find()->orderBy(['id'=>SORT_DESC])->limit(5)->all();

        $cat = Category::find()->all();
        $unique = Verify::userVerify();
        if(!$unique)
        {
           // $this->redirect(Url::toRoute('site/verify'));
        }
        else
        {
            $cheksds = User::LiveStatus();
            if(!$cheksds)
            {
                Yii::$app->getSession()->setFlash('danger', "you cannot use this script until you have full right to use this. please purchase this script from here");
               // $this->redirect(Url::toRoute('site/verify'));
            }


        };
        //$city = City::find()->all();
        return $this->render('index',['trendCount'=>$trendCount,'trend'=>$all,'urgent'=>$urgent,'featured'=>$featured,'category'=>$cat]);

    }


    public function actionNearby($radius = false)
    {
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


        return $this->render('nearby',[
            'model'=>$model,
            'radius'=>$radius
        ]);
    }

    public function actionMessage()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }
        $uId = Yii::$app->user->identity->getId();

        $model = Message::find()->where(['receiver'=>$uId])->groupBy('chat_id')->orderBy(['time'=>SORT_DESC])->all();

        //$city = City::find()->all();
        return $this->render('message',['msg'=>$model]);


    }

    public function actionChat($chat)
    {
        $this->layout = "mobile-plain";
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }
        $uId = Yii::$app->user->identity->getId();

        $model = Message::find()->where(['receiver'=>$uId])->groupBy('chat_id')->orderBy(['time'=>SORT_ASC])->all();

        $chat1 = Message::find()->where(['chat_id'=>$chat])->all();

        $chat = $chat1;
        return $this->render('chat',['msg'=>$model,'chat'=>$chat]);

    }
    public function actionChatU($chat_id,$AdId)
    {
        $this->layout = "mobile-plain";
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }
        $uId = Yii::$app->user->identity->getId();
        $ads = Ads::find()->where(['id'=>$AdId])->one();

        $chat1 =  Message::find()->where(['chat_id'=>$chat_id])->limit(10)->orderBy(['time'=>SORT_DESC])->all();

        return $this->render('chatU',['chat'=>$chat1,'ads'=>$ads]);

    }
    public function actionProfile()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }

        $id = Yii::$app->user->identity->id;
        $myadsCount = Ads::find()->where(['user_id'=>$id])->count();
        $myadspending = Ads::find()->where(['user_id'=>$id])->andWhere(['active'=>'pending'])->count();
        $msg = Message::find()->where(['receiver'=>$id])->orderBy(['time'=>SORT_ASC])->count();

        $myAds= Ads::find()->where(['user_id'=>$id])->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        $me = User::findOne(Yii::$app->user->id);
        //$city = City::find()->all();
        return $this->render('profile',['myadsCount'=>$myadsCount,'pending'=>$myadspending,'myAds'=>$myAds,'me'=>$me,'msg'=>$msg]);

    }

    public function actionMyads()
    {

        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }

        $id = Yii::$app->user->identity->id;
        $myadsCount = Ads::find()->where(['user_id'=>$id])->count();
        $pending = Ads::find()->where(['user_id'=>$id])->andWhere(['active'=>'pending'])->all();
        $pendingCount = Ads::find()->where(['user_id'=>$id])->andWhere(['active'=>'pending'])->count();
        $myAds= Ads::find()->where(['user_id'=>$id])->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        //$city = City::find()->all();
        return $this->render('myads',['myadsCount'=>$myadsCount,'pending'=>$pending,'myAds'=>$myAds,'pendingCount'=>$pendingCount]);

    }

    public function actionPost()
    {
// echo $user_id = Yii::$app->user->id;die;
        // echo $user_id = Yii::$app->user->id;die;
        if (\Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('info', 'you must be login/register before posting you Ads');
            return $this->goHome();
        }

        $category = \common\models\Category::find()->all();

        return $this->render('post', [
            'category'=>$category
        ]);
    }

    public function actionPostAds2($category,$kyind)
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

        if ($model->load(Yii::$app->request->post()) and $adCustom->load(Yii::$app->request->post()))
        {
            if ($model->premium == "regular") {
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
                    $AdsNew = new AdsMore();
                    $AdsNew['ads_id'] = $adsId;
                    $AdsNew['more_title'] = $value;
                    $AdsNew['more_value'] = $array2[$key];
                    $AdsNew->save(false);
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

                    if(isset($array2[$key]))
                    {
                        $AdsNew = new AdsMore();
                        $AdsNew['ads_id'] = $adsId;
                        $AdsNew['more_title'] = $value;
                        $AdsNew['more_value'] = $array2[$key];
                        $AdsNew->save(false);

                    }
                }
                return $this->redirect(Url::toRoute('payment/index?type=' . $model->premium . '&pid=' . $adsId . '&price=' . AdsPremium::getPriceByName($model->premium)));

            }
            Yii::$app->session->setFlash('success', 'your ads is under review...');
            return $this->redirect(Url::toRoute('mobile/profile'));
        }

        $SubId = SubCategory::find()->where(['name'=>$kyind])->one();
        $custom = QnewCustomFields::find()->where(['custom_subcatid'=>$SubId['id']])->all();;

        return $this->render('posts', [
            'adCustom'=>$adCustom,
            'custom'=>$custom,
            'model' => $model,
            'currency' => $currency,
            'cat'=>$category,
            'sub'=>$kyind,

        ]);

        //return $this->render('index');
    }

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
            die('form 1');

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
//die;
            return $this->render('posts', [
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

    public function actionEditAds($id)
    {
// echo $user_id = Yii::$app->user->id;die;
        if (\Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('info', 'you must be login/register before posting you Ads');
            return $this->goHome();
        }

        $currency = $currency_default = Currency::default_currency();

        $model = Ads::find()->where(['id'=>$id])->one();
        $saved = Ads::find()->where(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post())) {
            if($model->premium == "regular")
            {
                if(UploadedFile::getInstances($model, 'image'))
                {
                    $model->image = UploadedFile::getInstances($model, 'image');
                    $screen = $model->ScreenShot();
                    $model->image = $screen;
                }
                else
                {
                    $model->image =  $saved->image;
                }
                $model->save(false);
            }
            else
            {
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
                $adsId = $model->save(false);
                // echo $adsId;die;
                return  $this->redirect(Url::toRoute('payment/index?type='.$model->premium.'&pid='.$adsId.'&price='.AdsPremium::getPriceByName($model->premium)));

            }


            Yii::$app->session->setFlash('success', 'your ads is under review...');
            return $this->redirect(Url::toRoute('mobile/myads'));
        } else {
            return $this->render('edit', [
                'model' => $model,
                'currency'=>$currency
            ]);
        }


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


    public function actionDetail($ads,$title)
    {
        $similar = Ads::find()->orderBy(['id'=>SORT_DESC])->limit(4)->all();
        $model = Ads::findOne($ads);
        $more = AdsMore::find()->where(['ads_id'=>$model['id']])->all();

        $user = User::find()->where(['id'=>$model['user_id']])->one();
        return $this->render('detail', [
            'model' => $model,
            'user'=>$user,
            'more'=>$more
        ]);
    }

    public function actionEditProfile()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }
        $uid = Yii::$app->user->identity->getId();

        $model = User::find()->where(['id'=>$uid])->one();

        if ($model->load(Yii::$app->request->post())) {

            //dir("over");
            if(UploadedFile::getInstance($model,'image'))
            {
                $model->image = UploadedFile::getInstance($model,'image');
                $ext = substr(strrchr($model->image,'.'),1);
                $desiredExt='jpg';
                $fileNameNew = rand(137, 999) . time() . ".$desiredExt";
                $path[0] = $model->image->tempName;
                $path[1] = PROFILE_DIR . $fileNameNew;
                if(empty($path[0]))
                {
                    Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Image may be currepted or too big file size. try another image');
                    return $this->render('edit_profile', [
                        'model' => $model,
                    ]);
                }

                User::createThumb($path[0],$path[1], $ext, "","",THUMB_SIZE);
                $model->image = $fileNameNew;
                $model->save(false);
            }
            else
            {
                $model->save(false);
            }


            Yii::$app->getSession()->setFlash('success', '<b>Success</b> Account detail successfully updated');
            //return $this->redirect(Url::toRoute('edit/account'));
            return $this->render('edit_profile', [
                'model' => $model,
            ]);
        } else {
            return $this->render('edit_profile', [
                'model' => $model,
            ]);
        }
        //$city = City::find()->all();

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        };
        $unique = Verify::userVerify();
        if(!$unique)
        {
           // $this->redirect(Url::toRoute('site/verify'));
        };


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(Url::toRoute('mobile/index'));
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    public function actionSignup()
    {
        $unique = Verify::userVerify();
        if(!$unique)
        {
          //  $this->redirect(Url::toRoute('site/verify'));
        };

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(Url::toRoute('mobile/index'));
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionSearch()
    {
        $unique = Verify::userVerify();
        if(!$unique)
        {
            // $this->redirect(Url::toRoute('site/verify'));
        };
        $model = Ads::find()->orderBy(['id'=>SORT_DESC])->limit(15)->all();
        $session = Yii::$app->session;
        $city = $session->get('cityset');//die;;

        $cityDefault = ($city == null)?"jodhpur":$city;
        $searchForm = new \frontend\models\SearchForm();

        if ($searchForm->load(Yii::$app->request->post())) {
            $model = Ads::find()->where(['LIKE', 'ad_title',$searchForm->item ])->andWhere(['category'=>$searchForm->category])->andWhere(['city'=>$cityDefault])->all();

            return $this->render('list',[
                'myadsCount'=>count($model),
                'myAds'=>$model,

            ]);
        }
        else
        {
            return $this->render('list',[
                'myadsCount'=>count($model),
                'myAds'=>$model,

            ]);
        }
    }


    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::toRoute('mobile/index'));
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


}
