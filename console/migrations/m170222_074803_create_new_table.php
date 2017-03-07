<?php

use yii\db\Migration;

/**
 * Handles the creation of table `new`.
 */
class m170222_074803_create_new_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%new}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'title' => $this->string(300),
            'full_text' => $this->text(),
            'attachments' => $this->string(300)
        ]);
        $this->createIndex('author', '{{%new}}', 'author_id', true);
        $this->addForeignKey('author_fk', '{{%new}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%new}}');
    }
}
