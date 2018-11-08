<?php
namespace frontend\models;

use common\models\Ads;
use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;


class SearchTypeForm extends Model
{
    public $type;
    public $category;
    public $city;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['type', 'safe'],
            ['category', 'safe'],
            ['city', 'safe'],


        ];
    }



}
