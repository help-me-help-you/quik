<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Analytic model
 *
 * @property integer $id
 * @property string $name
 * @property string $script
 * @property string $flag
 */
class Analytic extends ActiveRecord
{




    public static function tableName()
    {
        return 'analytic';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','script','flag'], 'required'],

        ];
    }

    public static function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return 'just now';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'min',
            1  =>  'sec'
        );
        $a_plural = array( 'year'   => 'years',
            'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'min' => 'min',
            'sec' => 'sec'
        );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ';
            }
        }
    }


}
