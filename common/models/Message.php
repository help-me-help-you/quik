<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Message model
 *
 * @property integer $id
 * @property integer $ad_id
 * @property integer $chat_id
 * @property string $sender
 * @property string $receiver
 * @property string $text
 * @property string $time
 */
class Message extends ActiveRecord
{




    public static function tableName()
    {
        return 'message';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender','receiver','time','ad_id','text','chat_id'], 'required'],

        ];
    }

    public static function sendMsg($user,$advertiser,$text,$ad,$isSeller)
    {
        $model  = new Message();
        $model->ad_id = $ad;
        if($isSeller == "yes")
        {
            $model->chat_id = $advertiser.$ad.$user;
        }
        else
        {
            $model->chat_id = $user.$ad.$advertiser;

        }
        $model->sender = $user;
        $model->receiver = $advertiser;
        $model->text = $text;
        $model->time = time();
        $model->save(false);

        $tpl = '';
        $tpl .= "<div class='msgLi sender'>";
        $tpl .= "<h5>";
        $tpl .= "<span>".\common\models\User::getNameById($user)."</span>"." ".$text;
        $tpl .= "</h5>";
        $tpl .= "<h6>";
        $tpl .= \common\models\Analytic::time_elapsed_string(time())." ago";
        $tpl .= "</h6>";
        $tpl .= "</div>";
        return $tpl;
    }

    public static function LoadMsg($sender,$ad)
    {
        $uId = Yii::$app->user->identity->getId();
        $chat1 = Message::find()->where(['receiver'=>$uId])->andWhere(['sender'=>$sender])->andWhere(['ad_id'=>$ad])->orderBy(['time'=>SORT_ASC])->all();
        $chat2 = Message::find()->where(['receiver'=>$sender])->andWhere(['sender'=>$uId])->andWhere(['ad_id'=>$ad])->orderBy(['time'=>SORT_ASC])->all();
        $chat = array_merge($chat1,$chat2);
        return $chat;
    }



}
