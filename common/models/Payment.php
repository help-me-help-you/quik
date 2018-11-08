<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Payment model
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $brokerage
 * @property string $status
 */
class Payment extends ActiveRecord
{




    public static function tableName()
    {
        return 'payment';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['brokerage','safe'],
            [['name','email','status'], 'required'],

        ];
    }

    public static function getBrokerCharge()
    {
         $model=  static::findOne(['status' => 'enable']);
        return $model->brokerage;
    }



}
