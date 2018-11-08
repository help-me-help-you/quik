<?php
namespace frontend\models;

use common\models\Ads;
use common\models\User;
use yii\base\Model;
use Yii;
use yii\web\UploadedFile;


class SortByForm extends Model
{
    public $sort;
    public $category;
    public $city;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['sort', 'safe'],
            ['category', 'safe'],
            ['city', 'safe'],
        ];
    }



}
