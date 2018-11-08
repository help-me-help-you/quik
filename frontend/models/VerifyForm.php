<?php
namespace frontend\models;

use common\models\Ads;
use common\models\State;
use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;


class VerifyForm extends Model
{
    public $username;
    public $email;
    public $purchaseCode;
    public $itemId;
    public $otp;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [


            ['username', 'required'],
            ['username', 'string', 'max' => 255],

            ['otp', 'required'],
            ['otp', 'string', 'max' => 255],

            ['email', 'required'],
            ['email', 'email'],

            ['itemId', 'safe'],

            ['purchaseCode', 'string', 'max' => 255],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public static function verifyPurchase($userName, $apiKey , $purchaseCode, $itemId = false)
    {

        // Open cURL channel
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, "http://marketplace.envato.com/api/edge/$userName/$apiKey/verify-purchase:$purchaseCode.json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'ENVATO-PURCHASE-VERIFY'); //api requires any user agent to be set

        // Decode returned JSON
        $result = json_decode( curl_exec($ch) , true );

        //check if purchase code is correct
        if ( !empty($result['verify-purchase']['item_id']) && $result['verify-purchase']['item_id'] ) {
            //if no item name is given - any valid purchase code will work
            if ( !$itemId ) return true;
            //else - also check if purchased item is given item to check
            return $result['verify-purchase']['item_id'] == $itemId;
        }

        //invalid purchase code
        return false;

    }
}
