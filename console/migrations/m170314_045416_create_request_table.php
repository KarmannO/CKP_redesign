<?php

use yii\db\Migration;

/**
 * Handles the creation of table `request`.
 */
class m170314_045416_create_request_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'user' => $this->integer()->notNull(),
            'service' => $this->integer()->notNull(),
            'title' => $this->string(300)->notNull(),
            'description' => $this->text()->notNull(),
            'static' => $this->text()->notNull(),
            'dynamic' => $this->text()->notNull()
        ]);
        $this->createIndex('request_user_index', '{{%request}}', 'user', false);
        $this->addForeignKey('request_user_fk', '{{%request}}', 'user', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('request_service_index', '{{%request}}', 'service', false);
        $this->addForeignKey('request_service_fk', '{{%request}}', 'service', '{{%service}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('request');
    }
}
