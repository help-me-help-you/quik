<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $image
 * @property string $name
 * @property string $lat
 * @property string $lng
 * @property string $city
 * @property string $state
 * @property string $country
 * @property integer $status
 * @property integer $flag_v
 * @property string $purchase_code
 * @property string $otp
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name','safe'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */

    public static function createThumb($path1, $path2, $file_type, $new_w, $new_h, $squareSize = ''){
        /* read the source image */
        $source_image = FALSE;

        if (preg_match("/jpg|JPG|jpeg|JPEG/", $file_type)) {
            $source_image = imagecreatefromjpeg($path1);
        }
        elseif (preg_match("/png|PNG/", $file_type)) {

            if (!$source_image = @imagecreatefrompng($path1)) {
                $source_image = imagecreatefromjpeg($path1);
            }
        }
        elseif (preg_match("/gif|GIF/", $file_type)) {
            $source_image = imagecreatefromgif($path1);
        }
        if ($source_image == FALSE) {
            $source_image = imagecreatefromjpeg($path1);
        }

        $orig_w = imageSX($source_image);
        $orig_h = imageSY($source_image);

        if ($orig_w < $new_w && $orig_h < $new_h) {
            $desired_width = $orig_w;
            $desired_height = $orig_h;
        } else {
            $scale = min($new_w / $orig_w, $new_h / $orig_h);
            $desired_width = ceil($scale * $orig_w);
            $desired_height = ceil($scale * $orig_h);
        }

        if ($squareSize != '') {
            $desired_width = $desired_height = $squareSize;
        }

        /* create a new, "virtual" image */
        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);
        // for PNG background white----------->
        $kek = imagecolorallocate($virtual_image, 255, 255, 255);
        imagefill($virtual_image, 0, 0, $kek);

        if ($squareSize == '') {
            /* copy source image at a resized size */
            imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $orig_w, $orig_h);
        } else {
            $wm = $orig_w / $squareSize;
            $hm = $orig_h / $squareSize;
            $h_height = $squareSize / 2;
            $w_height = $squareSize / 2;

            if ($orig_w > $orig_h) {
                $adjusted_width = $orig_w / $hm;
                $half_width = $adjusted_width / 2;
                $int_width = $half_width - $w_height;
                imagecopyresampled($virtual_image, $source_image, -$int_width, 0, 0, 0, $adjusted_width, $squareSize, $orig_w, $orig_h);
            }

            elseif (($orig_w <= $orig_h)) {
                $adjusted_height = $orig_h / $wm;
                $half_height = $adjusted_height / 2;
                imagecopyresampled($virtual_image, $source_image, 0,0, 0, 0, $squareSize, $adjusted_height, $orig_w, $orig_h);
            } else {
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $squareSize, $squareSize, $orig_w, $orig_h);
            }
        }

        if (@imagejpeg($virtual_image, $path2, 90)) {
            imagedestroy($virtual_image);
            imagedestroy($source_image);
            return TRUE;
        } else {
            return FALSE;
        }
    }


    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    public static function getNameById($id)
    {
        $model = static::findOne(['id' => $id]);
        return $model->username;
    }
    public static function getImgById($id)
    {
        $model = static::findOne(['id' => $id]);
        return ($model->image == null)?"Dpic.png":$model->image;
    }
    public static function LiveStatus()
    {
        $urlD = Url::canonical();
        $Detail = Verify::find()->one();
        $cSession = curl_init();
        $url = "https://ambecode.xyz/verify/php/tracked.php?unique_id=".$Detail['unique_id']."&url=".$urlD."&purchaseCode=".$Detail['purchase_code']."&otp=".$Detail['otp']."&item=quik";
//        $url2 = "http://localhost/check/validating.php?itemId=".$model['itemId'].
//            '&purchaseCode='.$Detail['purchase_code'].
//            '&username='.$model['username'].
//            '&email='.$model['email'].
//            '&item=Quik'.
//            '&url='.$urlD;
//step2
        curl_setopt($cSession,CURLOPT_URL,$url);
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cSession,CURLOPT_HEADER, false);
//step3
        $result=curl_exec($cSession);

        curl_close($cSession);
        if(!$result)
        {
          $count = Verify::find()->count();
          if($count > 0)
          {
              $stop = Verify::find()->one();
            $stop->status = '0';
            $stop->save(false);
          }

        }
        else
        {
            $stop = Verify::find()->one();
            $stop->status = '1';
            $stop->save(false);
        }
        return $result;// ($result == null)?false:true;

//step4
    }
}
