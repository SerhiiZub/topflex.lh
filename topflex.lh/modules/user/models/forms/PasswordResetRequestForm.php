<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 23.05.17
 * Time: 17:00
 */

namespace app\modules\user\models\forms;


use Yii;
use yii\base\Model;
use app\modules\user\models\User;
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;
    private $_user = false;
    private $_timeout;

    public function __construct($timeout, $config = [])
    {
        $this->_timeout = $timeout;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }
    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
        if (!$user) {
            return false;
        }

        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }
        return Yii::$app
            ->mailer
            ->compose(
                '@app/modules/user/mails/passwordReset', ['user' => $user]
/*                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]*/
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

    public function validateIsSent($attribute, $params)
    {
        if (!$this->hasErrors() && $user = $this->getUser()) {
            if (User::isPasswordResetTokenValid($user->$attribute, $this->_timeout)) {
                $this->addError($attribute, Module::t('module', 'ERROR_TOKEN_IS_SENT'));
            }
        }
    }
}