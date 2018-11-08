<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * States model


 * @property string $name
 * @property string $country_id
 *
 */
class States extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
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
            ['name', 'safe'],
            ['country_id', 'safe'],

        ];
    }

    public static function namebyid($id)
    {
        $state = static::findOne($id);
        $state->name;
        return $state->name;
    }


    /**
     * @inheritdoc
     */

}
