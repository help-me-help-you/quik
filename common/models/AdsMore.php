<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ads_more".
 *
 * @property integer $id
 * @property integer $ads_id
 * @property string $more_title
 * @property string $more_value
 */
class AdsMore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ads_more';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ads_id', 'more_title', 'more_value'], 'required'],
            [['ads_id'], 'integer'],
            [['more_value'], 'string'],
            [['more_title'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ads_id' => Yii::t('app', 'Ads ID'),
            'more_title' => Yii::t('app', 'More Title'),
            'more_value' => Yii::t('app', 'More Value'),
        ];
    }
}
