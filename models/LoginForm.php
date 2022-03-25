<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            echo '<h1>' . var_dump($user) . '</h1>'; //teste para ver se o getUser encontrou o usuário; conclusão: ENCONTROU

            if (!$user || !$user->validatePassword($this->password)) {
                echo '<h1>' . var_dump($user->validatePassword($this->password)) . '</h1>'; //teste para ver se o validatePassword considerou as duas passwords iguais; conclusão: NÃO
                echo '<h1>' . var_dump(($this->password)) . '</h1>'; //teste para ver o valor que transporta a variável "(this)password"

                echo '<h1>' . password_hash($this->password, PASSWORD_ARGON2I); // teste para ver o valor para o qual o "(this)password é convertido"

                echo '<h1>' . password_hash($user->password, PASSWORD_ARGON2I) . '</h1>'; //teste para ver o valor que transporta a propriedade 'password' do $user
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
