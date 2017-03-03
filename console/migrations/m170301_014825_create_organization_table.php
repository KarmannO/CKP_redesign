<?php

use yii\db\Migration;

/**
 * Handles the creation of table `organization`.
 */
class m170301_014825_create_organization_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%organization}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(300),
            'short_name' => $this->string(255),
            'fano_id' => $this->integer()->unique(),
            'post_code' => $this->string(10),
            'post_address' => $this->string(200)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%organization}}');
    }
}
