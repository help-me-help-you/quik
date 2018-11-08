<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * City model
 * @property string $purchase_code
 * @property string $otp
 * @property string $status
 * @property string $unique_id
 *
 */
class Verify extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'verify';
    }

    public static function userVerify()
    {
        $user = static::find()->one();
        $status = $user['status'];
        $result = ($status == 1)?true:false;

        return $result;
    }
    public static function addUnique($purchase_code =false,$otp = false)
    {

        $user = new Verify();
        if($purchase_code)
        {
            $user->purchase_code = $purchase_code;
            $user->save(false);
        }
        else
        {
            $check = Verify::find()->count();
            if($check)
            {
                $user = Verify::find()->one();
                $user->otp = $otp;
                $user->unique_id = substr($otp,'5','10');
                $user->save(false);
            }
            else
            {
                $user = new Verify();
                $user->otp = $otp;
                $user->unique_id = substr($otp,'5','10');
                $user->status = 1;

                $user->save(false);
            }

          //  echo $otp;
        }
        return true;
    }
    public static function rightP()
    {
        $user = static::find()->one();
        $user['status'] = 1;
        $user->save(false);
        return true;
    }

}
