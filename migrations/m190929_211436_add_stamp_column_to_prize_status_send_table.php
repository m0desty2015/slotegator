<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%prize_status_send}}`.
 */
class m190929_211436_add_stamp_column_to_prize_status_send_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('prize_status_send', 'stamp', "integer DEFAULT 0");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
