<?php

use yii\db\Migration;

/**
 * Handles the creation of table `prize_limit_types`.
 */
class m180929_172651_create_prize_limit_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('prize_limit_types', [
            'id' => $this->primaryKey(),
            'type' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->insert('prize_limit_types', [
            'type' => 'money',
        ]);

        $this->insert('prize_limit_types', [
            'type' => 'obj',
        ]);

        $this->insert('prize_limit_types', [
            'type' => 'bonus',
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180929_172651_create_prize_limit_types_table cannot be reverted.\n";
    }
}
