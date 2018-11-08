<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * SubCategory model
 *
 * @property integer $id
 * @property string $name
 * @property string $parent
 */
class SubCategory extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sub_category';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['name', 'required'],
            ['name', 'string', 'max' => 255,'min'=>3],

            ['parent', 'required'],
            ['parent', 'string', 'max' => 255]


        ];
    }
    public static function findName($id)
    {
        $name =  static::find()->where(['id' => $id,])->one();
        return  $name['name'];
    }
    public static function findId($name)
    {
        $name =  static::find()->where(['name' => $name,])->one();
        return  $name['id'];
    }



}
