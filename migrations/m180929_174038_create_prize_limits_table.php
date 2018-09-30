<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prize_limits`.
 */
class m180929_174038_create_prize_limits_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('prize_limits', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->defaultValue(0),
            'user_id' => $this->integer()->defaultValue(0),
            'limit' => $this->integer()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk-prize_limits-type',
            'prize_limits',
            'type',
            'prize_limit_types',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-prize_limits-user_id',
            'prize_limits',
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
        echo "m180929_174038_create_prize_limits_table cannot be reverted.\n";
    }
}
