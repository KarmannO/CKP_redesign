<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ckp_comments`.
 */
class m170309_025318_create_ckp_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ckp_comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'ckp_id' => $this->integer()->notNull(),
            'message_text' => $this->text()->notNull(),
            'timestamp' => $this->integer()->notNull()
        ]);
        $this->createIndex('ckp_comment_user_id_index', '{{%ckp_comment}}', 'user_id');
        $this->createIndex('ckp_comment_ckp_id_index', '{{%ckp_comment}}', 'ckp_id');
        $this->addForeignKey('ckp_comment_ckp_fk', '{{%ckp_comment}}', 'ckp_id', '{{%ckp}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('ckp_comment_user_fk', '{{%ckp_comment}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ckp_comment}}');
    }
}
