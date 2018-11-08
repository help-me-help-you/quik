<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qnew_custom_fields".
 *
 * @property string $custom_id
 * @property string $custom_page
 * @property integer $custom_catid
 * @property integer $custom_subcatid
 * @property string $custom_name
 * @property string $custom_title
 * @property string $custom_type
 * @property string $custom_content
 * @property string $custom_min
 * @property string $custom_max
 * @property integer $custom_required
 * @property string $custom_options
 * @property string $custom_default
 */
class QnewCustomFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qnew_custom_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['custom_catid', 'custom_subcatid', 'custom_options'], 'required'],
            [['custom_catid', 'custom_subcatid', 'custom_min', 'custom_max', 'custom_required'], 'integer'],
            [['custom_options'], 'string'],
            [['custom_page'], 'string', 'max' => 60],
            [['custom_name', 'custom_type'], 'string', 'max' => 40],
            [['custom_title'], 'string', 'max' => 100],
            [['custom_content'], 'string', 'max' => 20],
            [['custom_default'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'custom_id' => Yii::t('app', 'Custom ID'),
            'custom_page' => Yii::t('app', 'Custom Page'),
            'custom_catid' => Yii::t('app', 'Choose Category'),
            'custom_subcatid' => Yii::t('app', 'Choose Sub Category'),
            'custom_name' => Yii::t('app', 'Filed Field Name'),
            'custom_title' => Yii::t('app', 'Filed Title'),
            'custom_type' => Yii::t('app', 'Input Type'),
            'custom_content' => Yii::t('app', 'Filed Content'),
            'custom_min' => Yii::t('app', 'Filed Min'),
            'custom_max' => Yii::t('app', 'Filed Max'),
            'custom_required' => Yii::t('app', 'Filed Required'),
            'custom_options' => Yii::t('app', 'Filed Options'),
            'custom_default' => Yii::t('app', 'Filed Default Value'),
        ];
    }
}
