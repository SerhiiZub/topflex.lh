<?php
/**
 * Created by PhpStorm.
 * User: Serhii Zub
 * Date: 02.06.17
 * Time: 17:27
 */

namespace app\modules\user\models\query;


use app\modules\user\models\User;
use yii\db\ActiveQuery;
use Yii;

class UserQuery extends ActiveQuery
{
    public function overdue($timeout)
    {
        return $this
            ->andWhere(['status' => User::STATUS_WAIT])
            ->andWhere(['<', 'created_at', time() - $timeout]);
    }
}