<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ckp_binding`.
 */
class m170307_070055_create_ckp_binding_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ckp_binding}}', [
            'ckp_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'binding_type' => $this->integer()->notNull()
        ]);
        $this->addPrimaryKey('ckp_user_pk', '{{%ckp_binding}}', ['ckp_id', 'user_id']);
        $this->createIndex('ckp_id_index', '{{%ckp_binding}}', 'ckp_id');
        $this->addForeignKey('ckp_id_binding_fk', '{{%ckp_binding}}', 'ckp_id', '{{%ckp}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('user_id_index', '{{%ckp_binding}}', 'user_id');
        $this->addForeignKey('user_id_binding_fk', '{{%ckp_binding}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ckp_binding}}');
    }
}
