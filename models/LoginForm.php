<?php

namespace app\models;

use app\controllers\AuthController;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $name;
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username are both required
            [['name'], 'required'],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->getUser()['name']) {
            return Yii::$app->user->login($this->getUser());
        } else {
            $this->signup();
            return true;
        }
    }

    public function signup()
    {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->create();
            Yii::$app->user->login($user);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByName($this->name);
        }

        return $this->_user;
    }
}
