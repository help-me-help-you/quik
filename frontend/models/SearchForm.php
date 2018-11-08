<?php
namespace frontend\models;

use common\models\Ads;
use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;


class SearchForm extends Model
{
    public $city;
    public $category;
    public $item;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['city', 'safe'],

            ['category', 'safe'],

            ['item', 'required'],

        ];
    }



}
