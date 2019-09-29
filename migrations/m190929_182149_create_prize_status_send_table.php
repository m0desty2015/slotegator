<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prize_status_send`.
 */
class m190929_182149_create_prize_status_send_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('prize_status_send', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->defaultValue(0),
            'sum' => $this->float()->defaultValue(0),
            'status' => $this->boolean()->defaultValue(false),
        ]);

        $this->addForeignKey(
            'fk-prize_status_send-user_id',
            'prize_status_send',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('prize_status_send');
    }
}
