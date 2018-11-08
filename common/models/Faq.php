<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Faq model
 *
 * @property integer $question
 * @property string $answer

 */
class Faq extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%faq}}';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['question', 'safe'],
            ['answer', 'safe'],

        ];
    }


}
