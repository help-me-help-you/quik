<?php
namespace frontend\controllers;


use common\models\Ads;
use common\models\AdsPremium;
use common\models\Boost;
use common\models\Credit;
use common\models\Payment;
use common\models\Point;
use common\models\User;
use common\models\UserBoost;
use common\models\VipPlan;
use Yii;
use yii\helpers\Url;
use yii\rest\CreateAction;
use yii\web\Controller;
/**
 * payment controller
 */



class PaymentController extends Controller
{
    public $layout = 'blank';
    /**
     * @inheritdoc
     */
    public function actionIndex($type,$pid,$price)
    {
        $payment = Payment::find()->where(['status'=>'enable'])->one();
        $rerunUrl = Url::toRoute('payment/success',true)."?type=$type&pid=".$pid;
       // return $this->redirect(Url::toRoute('payment/success?type='.$type.'&pid='.$pid));

        return $this->render('index',[
            'type'=>$type,
            'paypalAddress'=>$payment['email'],
            'amount'=> $price,
            'rerunUrl'=>$rerunUrl,
            'item_name'=>"Boost Your profile"

        ]);

    }
    public function actionSuccess($type,$pid)
    {
       // $adstype = AdsPremium::find()->all();
        $ads = Ads::find()->where(['id'=>$pid])->one();
        $ads->premium = $type;;
        $ads->save(false);
        Yii::$app->session->setFlash('info', 'your premium as has been posted');
        $this->redirect(Url::toRoute('site/profile'));

        return $this->render('success');
    }
    
    

    
}