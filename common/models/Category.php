<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Category model
 *
 * @property integer $id
 * @property string $name
 * @property string $fa-icon

 */
class Category extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['fa-icon','safe']
        ];
    }

    public static function findId   ($name)
    {
        $model = static::find()->where(['name'=>$name])->one();
        return  $model['id'];
    }

}
