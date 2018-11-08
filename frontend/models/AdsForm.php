<?php
namespace frontend\models;

use common\models\Ads;
use common\models\State;
use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;


class AdsForm extends Model
{
    public $category;
    public $sub_category;
    public $type;
    public $ad_title;
    public $ad_description;
    public $image;
    public $name;
    public $states;
    public $premium;
    public $city;
    public $mobile;
    public $email;
    public $price;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [


            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['category', 'required'],
            ['category', 'string', 'max' => 255],

            ['sub_category', 'safe'],

            ['sub_category', 'string', 'max' => 255],

            ['price', 'safe'],
            ['type', 'safe'],
            ['states', 'required'],
            ['city', 'required'],
            ['ad_title', 'required'],
            ['ad_title', 'string', 'max' => 255],

            ['ad_description', 'required'],
            ['ad_description', 'string', 'max' => 500],

//            [['image'], 'image','extensions' => 'png, jpg, gif','minWidth' => 300, 'maxWidth' => 300,
//                'minHeight' => 800, 'maxHeight' =>800,'message'=>'min image size 300x300 pixel'],
//
            [['image'], 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],


            ['name', 'required'],
            ['name', 'string', 'max' => 55],

            ['mobile', 'required'],
            ['mobile', 'string', 'max' => 255],
            ['premium', 'required'],
            ['premium', 'string', 'max' => 255],



        ];
    }
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email'),
            'category' => Yii::t('app', 'Category'),
            'sub_category' => Yii::t('app', 'Sub Category'),
            'price' => Yii::t('app', 'Price'),
            'type' => Yii::t('app', 'Type'),
            'ad_title' => Yii::t('app', 'Ad Title'),
            'ad_description' => Yii::t('app', 'Ad Description'),
            'image' => Yii::t('app', 'Image'),
            'name' => Yii::t('app', 'Name'),
            'mobile' => Yii::t('app', 'Mobile Number'),


        ];
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function post($image)
    {
        $uid = Yii::$app->user->id;
        $usrInfo = User::find()->where(['id'=>$uid])->one();
        $ads = new Ads();
        $ads->user_id = $uid;
        $ads->category = $this->category;
        $ads->sub_category = $this->sub_category;
        $ads->ad_title = $this->ad_title;
        $ads->ad_description = $this->ad_description;

        //screenshot upload
        $ads->image = $image;

        $ads->name =$this->name;
        $ads->mobile = $this->mobile;
        $ads->name = $this->name;
        $ads->email = $this->email;
        $ads->lat = $usrInfo['lat'];
        $ads->lng = $usrInfo['lng'];
        $ads->country = $usrInfo['country'];
        $ads->states = $usrInfo['state'];
        $ads->city = $usrInfo['city'];
        if(empty($this->price))
        {
            $ads->price = "0";
        }
        else
        {
            $ads->price = $this->price;
        };
        $ads->type = $this->type;
        if ($ads->save(false))
        {

            return $ads->id;
        }

    }

    //screenshot upload funtion
    public function ScreenShot()
    {
        foreach ($this->image as $file)
        {
            $name = rand(137, 999) . time();
            $screen[] = $name . '.'.$file->extension;
            $file->saveAs(SCREENSHOT . $name. '.' . $file->extension);
        }
        return $ScreenChunk = implode(",", $screen);

    }
}
