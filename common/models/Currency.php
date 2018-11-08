<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Currency model
 * @property integer $id
 * @property string $currency_name
 * @property string $currency_initial
 * @property string $currency_symbol
 * @property string $currency_value
 * @property string $currency_status
 *
 */
class Currency extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['currency_name', 'required'],

            ['currency_value', 'required'],

            ['currency_status', 'required'],

            ['currency_symbol', 'required'],

            ['currency_initial', 'required'],
            ['currency_initial', 'string', 'min' => 2, 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function default_currency()
    {
        $currency = static::find();
        $currency_default = $currency->where(['currency_status'=>'default'])->one();
       return array("initial"=>$currency_default['currency_initial'],'value'=>$currency_default['currency_value'],'symbol'=>$currency_default['currency_symbol']);

    }
    public static function selected_currency()
    {
        $currency = Static::find();
        $currency_default = $currency->where(['currency_status'=>'default'])->one();
        array("initial"=>$currency_default['currency_initial'],'value'=>$currency_default['currency_value'],'symbol'=>$currency_default['currency_symbol']);
    }



}
