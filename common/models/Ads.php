<?php
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * ads model
 *
 * @property integer $id
 * @property string $user_id
 * @property string $category
 * @property string $sub_category
 * @property string $type
 * @property string $ad_title
 * @property string $price
 * @property string $ad_description
 * @property string $image
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $active
 * @property string $premium
 * @property string $lat
 * @property string $lng
 * @property string $country
 * @property string $states
 * @property string $city
 * @property string $view
 * @property string $created_at
 * @property string $updated_at
 *
 */
class Ads extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ads}}';
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

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['category', 'required'],
            ['category', 'string', 'max' => 255],

            ['sub_category', 'safe'],
            ['price', 'safe'],
            ['type', 'safe'],
            ['ad_title', 'required'],
            ['ad_title', 'string', 'max' => 255],

            ['ad_description', 'required'],
            ['ad_description', 'string', 'max' => 500],

//            [['image'], 'image','extensions' => 'png, jpg, gif','minWidth' => 300, 'maxWidth' => 300,
//                'minHeight' => 800, 'maxHeight' =>800,'message'=>'min image size 300x300 pixel'],
//

            [['image'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 5],
            ['name', 'required'],

            ['mobile', 'required'],
            ['lat', 'safe'],
            ['lng', 'safe'],
            ['country', 'safe'],
            ['states', 'required'],
            ['city', 'required'],
            ['created_at','safe']
        ];
    }
    /**
     * @inheritdoc
     */
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

    public static function view($id)
    {
        $view =  static::find()->where(['id' => $id,])->one();
        $viewCount = $view->view;
        $view->view = $viewCount+1;
        $view->save(false);


    }


    public static function getTitle($id)
    {
        $view =  static::find()->where(['id' => $id,])->one();
        return $view['ad_title'];
    }

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
    public static function findDistance($lat2, $lon2)
    {
        $lat1 =  26.9124 ;
        $lon1 = 78.7873 ;

        $unit = "K";
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K")
        {
            $result =  ($miles * 1.609344);
            $return = substr($result,0,5);
            return $return;
        }
        else if ($unit == "N")
        {
            return ($miles * 0.8684);
        }
        else
        {
            return substr($miles,0,4);
        }
    }

}

