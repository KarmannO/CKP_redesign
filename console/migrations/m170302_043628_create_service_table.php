<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service`.
 */
class m170302_043628_create_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'ckp' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text()->notNull(),
            'json_template' => $this->text()->notNull(),
            'validation_status' => $this->integer()->notNull()
        ]);
        $this->createIndex('service_index', '{{%service}}', 'ckp', false);
        $this->addForeignKey('service_fk', '{{%service}}', 'ckp', '{{%ckp}}', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%service}}');
    }
}
