<?php

use yii\db\Migration;

class m170316_030026_add_hash_to_ckp_document_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%ckp_document}}', 'hash', $this->string(16)->notNull()->unique());
    }

    public function down()
    {
        $this->dropColumn('{{%ckp_document}}', 'hash');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
