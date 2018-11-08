<?php
namespace frontend\models;

use common\models\Track;
use common\models\User;
use yii\base\Model;
use Yii;

/**
 * ProfileEdit form
 */
class ProfileEditForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $image;
    public $name;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['image', 'safe'],
            ['image', 'string', 'min' => 1],

            ['name', 'safe'],
            ['name', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        ///var_dump($loc);die;
        if ($this->validate()) {
            $loc = Track::getLocationInfoByIp();

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->lat = $loc['lat'];
            $user->lng = $loc['lng'];
            $user->city = $loc['city'];
            $user->state = $loc['state'];
            $user->country = $loc['country'];

            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
