<?php
namespace frontend\controllers;


use common\models\Ads;
use common\models\AdsPremium;
use common\models\Payment;
use common\models\User;
use common\models\Message;
use common\models\Verify;
use Yii;
use yii\helpers\Url;
use yii\rest\CreateAction;
use yii\web\Controller;
/**
 * Message controller
 */



class MessageController extends Controller
{
    /**
     * @inheritdoc
     */

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
    public function actionIndex()
    {
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }
        $uId = Yii::$app->user->identity->getId();

        $model = Message::find()->where(['receiver'=>$uId])->groupBy('chat_id')->orderBy(['time'=>SORT_DESC])->all();

        //$city = City::find()->all();
        return $this->render('index',['msg'=>$model]);


    }

    public function actionView($chat)
    {
        $this->layout = "welcome";
        if (\Yii::$app->user->isGuest) {
            Yii::$app->getSession()->setFlash('error', '<b>Error: </b> Login for access this page');

            return $this->redirect(Url::toRoute('site/login'));
        }
        $uId = Yii::$app->user->identity->getId();

        $model = Message::find()->where(['receiver'=>$uId])->groupBy('chat_id')->orderBy(['time'=>SORT_DESC])->all();

        if(count($model) == 0)
        {
            Yii::$app->getSession()->setFlash('error', '<b>Wrong Way: </b> access not allow');
            return $this->redirect(Url::toRoute('site/index'));
        }
        $chat1 = Message::find()->where(['chat_id'=>$chat])->all();

        $chat = $chat1;
        return $this->render('view',['msg'=>$model,'chat'=>$chat]);

    }
    public function actionSendMsg($msg,$receiver,$ad,$advertiser = false)
    {
        $uId = Yii::$app->user->identity->getId();
        $model = Message::sendMsg($uId,$receiver,$msg,$ad,$advertiser);
        return $model;
    }
    public function actionLoadMsg($sender,$ad)
    {
        $uId = Yii::$app->user->identity->getId();
        $chat1 = Message::find()->where(['receiver'=>$uId])->andWhere(['sender'=>$sender])->andWhere(['ad_id'=>$ad])->orderBy(['time'=>SORT_ASC])->all();
        $chat2 = Message::find()->where(['receiver'=>$sender])->andWhere(['sender'=>$uId])->andWhere(['ad_id'=>$ad])->orderBy(['time'=>SORT_ASC])->all();
        $chat = array_merge($chat1,$chat2);
        return $chat;
    }

    public function actionCheck($chatId)
    {
        $chat1 = Message::find()->where(['chat_id'=>$chatId])->count();
        return $chat1;
    }

    public function actionLoadMsgTpl($chat_id,$current)
    {
        $runtime = Message::find()->where(['chat_id'=>$chat_id])->count();
        $uId = Yii::$app->user->identity->getId();

        if($runtime > $current)
        {
            $offset = $runtime - $current;

            $chat1 =  Message::find()->where(['chat_id'=>$chat_id])->limit($offset)->orderBy(['time'=>SORT_DESC])->all();
            $tpl = '';
            foreach ($chat1 as $chat)
            {

                $class =  ($uId == $chat['sender'])?"sender":"";
                $tpl .= "<div class='msgLi $class'>";
                $tpl .= "<h5>";
                $tpl .= "<span>".\common\models\User::getNameById($chat['sender'])."</span>"." ".$chat['text'];
                $tpl .= "</h5>";
                $tpl .= "<h6>";
                $tpl .= \common\models\Analytic::time_elapsed_string($chat['time'])." ago";
                $tpl .= "</h6>";
                $tpl .= "</div>";

            }
            echo $tpl;

        };
    }

    public function actionLoadMsgTplm($chat_id,$current)
    {
        $runtime = Message::find()->where(['chat_id'=>$chat_id])->count();
        $uId = Yii::$app->user->identity->getId();

        if($runtime > $current)
        {
            $offset = $runtime - $current;

            $chat1 =  Message::find()->where(['chat_id'=>$chat_id])->limit($offset)->orderBy(['time'=>SORT_DESC])->all();
            $tpl = '';
            foreach ($chat1 as $chat)
            {
                $ltr = ($chat['sender'] == Yii::$app->user->identity->getId())?"":"ltr";


                $class =  ($uId == $chat['sender'])?"sender":"";
                $tpl .= "<div class='chatboxmessage $ltr'  >";
                $tpl .=     "<span class='chatboxmessagefrom'>";
                $tpl .=         "<img src='".Yii::getAlias('@web').'/images/user/'.User::getImgById($chat['sender'])."' width='35px' class='img-circle'><br>";
                $tpl .=             User::getNameById($chat['sender']);
                $tpl .=     "</span>";
                $tpl .=     "<div class='chatboxmessagecontent' style='padding: 15px;'>";
                $tpl .=          $chat['text'];
                $tpl .=             "<time datetime='".\common\models\Analytic::time_elapsed_string($chat['time'])."'>";
                $tpl .=             \common\models\Analytic::time_elapsed_string($chat['time']);
                $tpl .=             " ago";
                $tpl .=             "</time>";
                $tpl .=     "</div>";
                $tpl .= "</div>";


            }
            echo $tpl;

        }
        else
        {
          //  echo $runtime ."<pre>". $current;
        };
    }
    
}
?>
