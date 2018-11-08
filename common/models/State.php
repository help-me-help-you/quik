<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * State model


 * @property string $state
 * @property string $parent_id
 *
 */
class State extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'state';
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
            ['state', 'safe'],
            ['parent_id', 'safe'],

        ];
    }

    public static function namebyid($id)
    {
        $state = static::findOne($id);
        $state['state'];
        return $state->state;
    }


    /**
     * @inheritdoc
     */

}
