<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
define('IMG_BANNER_DIR', \yii::getAlias('@frontend').'/web/images/site/');
/**
 * This is the model class for table "site_banner".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 */
class SiteBanner extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_banner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['title', 'required'],
            ['title', 'string', 'max' => 225],

            [['name'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif',
                'minWidth' => 938, 'maxWidth' => 938,
                'minHeight' => 276, 'maxHeight' =>276,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Image'),
            'title' => Yii::t('app', 'alt Title'),
        ];
    }

}
