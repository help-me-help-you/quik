<?php
namespace frontend\controllers;

use common\models\Ads;
use common\models\Category;
use common\models\City;
use common\models\Currency;
use common\models\Message;
use common\models\SiteBanner;
use common\models\Track;
use common\models\User;
use common\models\Verify;
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
/**
 * Site controller
 */
class SiteController extends Controller
{
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
                    'logout' => ['POST'],
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

    public function actionDefaultLanguage($lng)
    {

        $url =  Url::previous('currency_p');

        $language = $lng;
        Yii::$app->language = $language;;


        if($lng == "en-EN")
        {
            $ini = "EN";
            $value = $language;
            $name = "English";
        }
        elseif($lng == "ar-AR")
        {
            $ini = "AR";
            $value = $language;
            $name = "العربية";


        }
        elseif($lng == "hi-HI")
        {
            $ini = "HI";
            $value = $language;
            $name = "हिंदी";
        }
        else
        {
            $ini = "RU";
            $value = $language;
            $name = "русский";
        }
        $session2 = Yii::$app->cache;
        $lang = array("ini"=>$ini,'value'=>$value,'name'=>$name);

        $session2->set('default_language',$lang);

        return $this->redirect($url);
        // $currency = $session->set('','');
    }
    public function actionIndex()
    {
        $unique = Verify::userVerify();
        if(!$unique)
        {
             //$this->redirect(Url::toRoute('site/verify'));
        };
        $session = Yii::$app->session;
        $city = $session->get('cityset');//die;;

        $cityDefault = ($city == null)?"jodhpur":$city;
        $this->layout = "main";
        $trendCount = Ads::find()->where(['city'=>$cityDefault])->count();
        $urgent = Ads::find()->where(['premium'=>'urjent'])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        $featured= Ads::find()->where(['premium'=>'featured'])->andWhere(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        $all = Ads::find()->where(['city'=>$cityDefault])->orderBy(['id'=>SORT_DESC])->limit(5)->all();
        $banner = SiteBanner::find()->all();
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
        return $this->render('index',['trendCount'=>$trendCount,'banner'=>$banner,'trend'=>$all,'urgent'=>$urgent,'featured'=>$featured,'category'=>$cat]);

    }
    public function actionVerify()
    {

        $this->layout = "main";
        $cheksds = User::LiveStatus();
        $msg = "$cheksds";
        $urlD = Url::home();
        if(!$cheksds)
        {

            $msg = "you cannot use this script until you have full right to use this. please purchase this script from <a href='https://codecanyon.net/ambecode'>Here</a>";
        }


        $model = new VerifyForm();
        if ($model->load(Yii::$app->request->post()) ) {
            //step1
            $cSession = curl_init();
            $url = "https://ambecode.xyz/verify/validating.php?itemId=".$model['itemId'].
                '&purchaseCode='.$model['purchaseCode'].
                '&username='.$model['username'].
                '&email='.$model['email'].
                '&item=Quik'.
                '&url='.$urlD;

           // $url = "http://ambecode.xyz/verify/request.php?itemId=".$model['itemId'].'&purchaseCode='.$model['purchaseCode'].'&username='.$model['username'].'&email='.$model['email'];
//step2
            curl_setopt($cSession,CURLOPT_URL,$url);
            curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($cSession,CURLOPT_HEADER, false);
//step3
            $result = curl_exec($cSession);
//step4
           // die($result);
            curl_close($cSession);
//step5
            Verify::addUnique($model['purchaseCode'],false);


            Yii::$app->getSession()->setFlash('success', $result);
            return $this->render('verify', [
                'model' => $model,
                'msg'=> $result
            ]);
            // return $this->redirect(Url::toRoute('settings/dashboard'));
        } else {
            return $this->render('verify', [
                'model' => $model,
                'msg'=> $msg
            ]);
        }
    }
    public function actionVerifyMe()
    {
        $unique = Verify::userVerify();
        if($unique)
        {
            $this->redirect(Url::toRoute('site/index'));
        };

        $model = new VerifyForm();
        if ($model->load(Yii::$app->request->post()) ) {
            $cSession = curl_init();
           // $url = "http://ambecode.com/verify/otp.php?otp=".$model['otp'];
            $url = "https://ambecode.xyz/verify/otp.php?otp=".$model['otp'];
//step2
            curl_setopt($cSession,CURLOPT_URL,$url);
            curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($cSession,CURLOPT_HEADER, false);
//step3
            $result=curl_exec($cSession);
//step4
            curl_close($cSession);
//step5
            //var_dump($result);die;
            if($result)
            {
                Verify::addUnique(false,$model['otp']);
                Verify::rightP();
                $msg= "Your successfully identify your identity ";
                 Yii::$app->getSession()->setFlash('danger', $msg);
                $this->redirect(Url::toRoute('site/index'));

            }
            else
            {
                $msg = "OTP already claim, Please purchase your script from codecanyon";
                Verify::addUnique(false,$model['otp']);
                Yii::$app->getSession()->setFlash('danger', $msg);

            }


            return $this->render('verify_me', [
                'model' => $model,
            ]);
        } else {
            return $this->render('verify_me', [
                'model' => $model,
            ]);
        }
    }

    public function actionDefaultCurrency($id)
    {
        $url =  Url::previous('currency_p');
            $currency = Currency::find();
            $currency_default = $currency->where(['id'=>$id])->one();
            $catch = array("initial"=>$currency_default->currency_initial,'value'=>$currency_default->currency_value,'symbol'=>$currency_default->currency_symbol);


            $session2 = Yii::$app->cache;
            $session2->set('default_currency',$catch);
            return $this->redirect($url);

    }


    public function actionProfile()
    {

        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        };
        $unique = Verify::userVerify();
        if(!$unique)
        {
           // $this->redirect(Url::toRoute('site/verify'));
        };

        $this->layout = "right_bar";
        $id = Yii::$app->user->identity->id;
        $myadsCount = Ads::find()->where(['user_id'=>$id])->count();
        $myadspending = Ads::find()->where(['user_id'=>$id])->andWhere(['active'=>'pending'])->count();
        $msg = Message::find()->where(['receiver'=>$id])->orderBy(['time'=>SORT_ASC])->count();

        $myAds= Ads::find()->where(['user_id'=>$id])->orderBy(['id'=>SORT_DESC])->limit(10)->all();
        $me = User::findOne(Yii::$app->user->id);
        //$city = City::find()->all();
        return $this->render('user',['myadsCount'=>$myadsCount,'pending'=>$myadspending,'myAds'=>$myAds,'me'=>$me,'msg'=>$msg]);

    }
    public function actionProfileEdit()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }
        $this->layout = "right_bar";
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
                    return $this->render('user_edit', [
                        'model' => $model,
                    ]);
                }

                User::createThumb($path[0],$path[1], $ext, "150","150",THUMB_SIZE);
                $model->image = $fileNameNew;
                $model->save(false);
            }
            else
            {
                $model->save(false);
            }


            Yii::$app->getSession()->setFlash('success', '<b>Success</b> Account detail successfully updated');
            //return $this->redirect(Url::toRoute('edit/account'));
            return $this->render('user_edit', [
                'model' => $model,
            ]);
        } else {
            return $this->render('user_edit', [
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
        $this->layout = "welcome";
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
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $unique = Verify::userVerify();
        if(!$unique)
        {
           // $this->redirect(Url::toRoute('site/verify'));
        };
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $unique = Verify::userVerify();
        if(!$unique)
        {
          //  $this->redirect(Url::toRoute('site/verify'));
        };
        $this->layout = "welcome";

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = "welcome";

        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
