<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * City model
 * @property string $city
 * @property string $state_id
 * @property string $country_id
 *
 */
class City extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
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
            ['city', 'safe'],
            ['state_id', 'safe'],
            ['country_id', 'safe']
        ];
    }


    /**
     * @inheritdoc
     */

}
