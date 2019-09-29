<?php

use yii\db\Migration;

/**
 * Handles adding balance to table `user`.
 */
class m180929_134457_add_balance_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'balance', "float DEFAULT 0");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'balance');
    }
}
