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
 * @property string $home_page
 */
class AdsPremium extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ads_premium}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['price', 'required'],
            ['home_page', 'required'],
        ];
    }
    public static function getPriceByName($name)
    {
        $name = static::find()->where(['name'=>$name])->one();
        return $name['price'];
    }


}
