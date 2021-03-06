<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 23.05.17
 * Time: 17:07
 */

namespace app\modules\user\models\forms;


use yii\base\Model;
use yii\base\InvalidParamException;
use app\modules\user\models\User;

/**
 * Password reset form
 */
class PasswordResetForm extends Model
{
    public $password;
    /**
     * @var \app\modules\user\models\User
     */
    private $_user;
    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    public function __construct($token, $timeout, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token, $timeout);
        if (!$this->_user) {
            throw new InvalidParamException('Wrong password reset token.');
        }
        parent::__construct($config);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();
        return $user->save(false);
    }
}