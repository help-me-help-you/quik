<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Adsense model
 * @property string $id
 * @property string $title
 * @property string $script
 * @property string $position
 * @property string $status
 *
 *
 */
class Adsense extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adsense';
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
            ['script', 'required'],
            ['position', 'required'],
            ['title', 'required'],

            ['status', 'safe']
        ];
    }


    /**
     * @inheritdoc
     */
    public static function show($position)
    {
      $model = Adsense::find()->where(['position'=>$position])->andWhere(['status'=>'active'])->all();
      foreach ($model as $list)
      {
         echo $list['script'];
      }
    }

}
