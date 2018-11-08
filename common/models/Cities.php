<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * City model
 * @property string $name
 * @property string $state_id
 *
 */
class Cities extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
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
            ['state_id', 'safe'],
        ];
    }


    /**
     * @inheritdoc
     */

}
