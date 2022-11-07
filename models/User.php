<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\swiftmailer\Mailer;
use yii\swiftmailer\Message;
use yii\helpers\Inflector;
use ReflectionClass;

/**
 * This is the model class for table "tbl_user".
 *
 * @property string $id
 * @property string $role_id
 * @property integer $status
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $logged_in_ip
 * @property string $logged_in_at
 * @property string $created_ip
 * @property string $created_at
 * @property string $updated_at
 * @property string $banned_at
 * @property string $banned_reason
 *
 * @property Profile $profile
 * @property Role $role
 * @property UserToken[] $userTokens
 * @property UserAuth[] $userAuths
 * @property UserForm $userForm
 */
class User extends \amnah\yii2\user\models\User implements IdentityInterface
{
    /**
     * @var int Inactive status
     */
    const STATUS_INACTIVE = 0;

    /**
     * @var int Active status
     */
    const STATUS_ACTIVE = 1;

    /**
     * @var int Unconfirmed email status
     */
    const STATUS_UNCONFIRMED_EMAIL = 2;

    /**
     * @var string Current password - for account page updates
     */
    public $currentPassword;

    /**
     * @var string New password - for registration and changing password
     */
    public $newPassword;

    /**
     * @var string New password confirmation - for reset
     */
    public $newPasswordConfirm;

    /**
     * @var array Permission cache array
     */
    protected $permissionCache = [];

    /**
     * @var \amnah\yii2\user\Module
     */
    public $module;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!$this->module) {
            $this->module = Yii::$app->getModule("user");
        }
    }


    //funções criadas para facilitar a criação de uma nova página de definições de conta
    public function validateCurrentPasswordReturn($currentPassword)
    {
        if (!$this->validatePasswordIdentity($currentPassword)) {
            $this->addError("currentPassword", "Current password incorrect");
            return false;
        }

        return true;
    }

    public function validatePasswordIdentity($password)
    {
        return Yii::$app->security->validatePassword($password, Yii::$app->user->identity->password);
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'role_id' => Yii::t('user', 'Role ID'),
            'status' => Yii::t('user', 'Status'),
            'email' => Yii::t('user', 'Email'),
            'username' => Yii::t('user', 'Username'),
            'password' => Yii::t('user', 'Password'),
            'auth_key' => Yii::t('user', 'Auth Key'),
            'access_token' => Yii::t('user', 'Access Token'),
            'logged_in_ip' => Yii::t('user', 'Logged In Ip'),
            'logged_in_at' => Yii::t('user', 'Logged In At'),
            'created_ip' => Yii::t('user', 'Created Ip'),
            'created_at' => Yii::t('user', 'Created At'),
            'updated_at' => Yii::t('user', 'Updated At'),
            'banned_at' => Yii::t('user', 'Banned At'),
            'banned_reason' => Yii::t('user', 'Banned Reason'),

            // virtual attributes set above
            'currentPassword' => Yii::t('user', 'Current Password'),
            'newPassword' => $this->isNewRecord ? Yii::t('user', 'Password') : Yii::t('user', 'New Password'),
            'newPasswordConfirm' => Yii::t('user', 'New Password Confirm'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => function ($event) {
                    return gmdate("Y-m-d H:i:s");
                },
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        $profile = $this->module->model("Profile");
        return $this->hasOne($profile::className(), ['user_id' => 'id']);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        $role = $this->module->model("Role");
        return $this->hasOne($role::className(), ['id' => 'role_id']);
    }

    public function getProfile0()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    public function getRole0()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }


    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * Validate password
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    /**
     * Update login info (ip and time)
     * @return bool
     */
    public function updateLoginMeta()
    {
        $this->logged_in_ip = Yii::$app->request->userIP;
        $this->logged_in_at = gmdate("Y-m-d H:i:s");
        return $this->save(false, ["logged_in_ip", "logged_in_at"]);
    }

    /**
     * Send email confirmation to user
     * @param UserToken $userToken
     * @return int
     */
    public function sendEmailConfirmation($userToken)
    {
        /** @var Mailer $mailer */
        /** @var Message $message */

        // modify view path to module views
        $mailer = Yii::$app->mailer;
        $oldViewPath = $mailer->viewPath;
        $mailer->viewPath = $this->module->emailViewPath;

        // send email
        $user = $this;
        $profile = $user->profile;
        $email = $userToken->data ?: $user->email;
        $subject = Yii::$app->id . " - " . Yii::t("user", "Email Confirmation");
        $result = $mailer->compose('confirmEmail', compact("subject", "user", "profile", "userToken"))
            ->setFrom(Yii::$app->params['email']['from'])
            ->setTo($email)
            ->setSubject($subject)
            ->send();

        // restore view path and return result
        $mailer->viewPath = $oldViewPath;
        return $result;
    }

}