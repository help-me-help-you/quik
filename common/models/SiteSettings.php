<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
/**
 * SiteSettings model
 *
 * @property integer $id
 * @property integer $site_name
 * @property string $site_title
 * @property string $logo
 * @property string $min_withdrawal_balance
 * @property string $meta_keyword
 * @property string $meta_description
 */
define('IMG_SITE_DIR', \yii::getAlias('@frontend').'/web/images/site/logo/');


class SiteSettings extends ActiveRecord
{

    /**
     * @var UploadedFile
     */

    public static function tableName()
    {
        return 'site_settings';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logo'], 'file','extensions' => ['jpg',' png'] ,'checkExtensionByMimeType'=>false],

            [['logo','site_title','meta_keyword','meta_description','site_name'], 'safe'],

        ];
    }

    public static function logo()
    {
        $pic = static::find()->one();
        $pic->logo;
        return $pic->logo;
    }



    public function uploadLogo()
    {
        $name = rand(137, 999) . time();
        $this->logo->saveAs(IMG_SITE_DIR . $name . '.' . $this->logo->extension);
        return $name.'.'.$this->logo->extension;
    }



}
