<?php

use yii\db\Migration;
use app\models\User;

/**
 * Class m180929_130343_add_user_admin
 */
class m180929_130343_add_user_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $model = User::find()->where(['username' => 'admin'])->one();
        if (empty($model)) {
            $user = new User();
            $user->username = 'admin';
            $user->email = 'emelyanov_a@list.ru';
            $user->setPassword('admin');
            $user->generateAuthKey();
            if ($user->save()) {
                echo 'The user was created successfully. Login admin password admin  ';
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180929_130343_add_user_admin cannot be reverted.\n";

        return false;
    }
}
