<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ckp_documents`.
 */
class m170314_061746_create_ckp_documents_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ckp_document}}', [
            'id' => $this->primaryKey(),
            'ckp' => $this->integer()->notNull(),
            'path' => $this->text()->notNull(),
            'user' => $this->integer()->notNull(),
            'time' => $this->integer()->notNull()
        ]);
        $this->createIndex('ckp_document_ckp_index', '{{%ckp_document}}', 'ckp', false);
        $this->addForeignKey('ckp_document_ckp_fk', '{{%ckp_document}}', 'ckp', '{{%ckp}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('ckp_document_user_index', '{{%ckp_document}}', 'user', false);
        $this->addForeignKey('ckp_document_user_fk', '{{%ckp_document}}', 'user', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ckp_document}}');
    }
}
