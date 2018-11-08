<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Countries model
 * @property string $sortname
 * @property string $name
 * @property string $phonecode
 * @property string $id
 */
class Countries extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['sortname', 'safe'],
            ['name', 'safe'],
            ['phonecode', 'safe'],
            ['city', 'safe'],

        ];
    }

    public static function GetNameById($id)
    {
        $country = static::find()->where(['id'=>$id])->one();
        return $country['name'];
    }

    /**
     * @inheritdoc
     */

}
