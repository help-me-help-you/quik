<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Contact model
 *
 * @property integer $id
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $about
 *

 */
class Contact extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['address', 'safe'],
            ['phone', 'safe'],
            ['email', 'safe'],
            ['about','safe'],

        ];
    }


}
