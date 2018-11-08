<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * City form
 */
class CitySearchForm extends Model
{
    public $country_id;
    public $state_id;
    public $city;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['country_id', 'safe'],
            ['state_id', 'safe'],
            ['city', 'safe'],
        ];
    }


}
