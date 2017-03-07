<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ckp`.
 */
class m170302_040157_create_ckp_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%ckp}}', [
            'id' => $this->primaryKey(),
            'short_name' => $this->string(255)->notNull(),
            'full_name' => $this->string(300)->notNull(),
            'validation_status' => $this->integer()->notNull(),
            'address' => $this->string(200)->notNull(),
            'organization' => $this->integer()->notNull(),
            'director_full_name' => $this->string(255),
            'director_degree' => $this->integer(),
            'director_rank' => $this->integer(),
            'director_position' => $this->integer(),
            'director_phone' => $this->string(45),
            'director_fax' => $this->string(45),
        ]);
        $this->createIndex('organization_index', '{{%ckp}}', 'organization', false);
        $this->addForeignKey('organization_fk', '{{%ckp}}', 'organization', '{{%organization}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%ckp}}');
    }
}
