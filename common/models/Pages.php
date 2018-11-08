<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Pages model
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $status
 */
class Pages extends ActiveRecord
{




    public static function tableName()
    {
        return 'pages';
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','content','status'], 'required'],

        ];
    }

    public static function pageslist()
    {
        $model = Pages::find()->all();
        foreach($model as $list)
        {?>
            <li>
                <a href="<?= \yii\helpers\Url::toRoute('title/'.$list['id']) ?>"><?= $list['title'] ?></a>
            </li>
        <?php
        }

    }

}
