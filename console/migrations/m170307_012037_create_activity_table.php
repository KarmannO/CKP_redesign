<?php

use yii\db\Migration;

/**
 * Handles the creation of table `activity`.
 */
class m170307_012037_create_activity_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%activity}}', [
            'id' => $this->primaryKey(),
            'type' => $this->integer()->notNull(),
            'json_description' => $this->text()->notNull(),
            'timestamp' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%activity}}');
    }
}
