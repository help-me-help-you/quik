<?php
namespace frontend\models;

use common\models\Ads;
use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;


class SelectCityForm extends Model
{
    public $city;
    public $state;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['state', 'safe'],
            ['city', 'safe'],


        ];
    }



}
