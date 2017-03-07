<?php

use yii\db\Migration;

/**
 * Handles the creation of table `degree`.
 */
class m170306_051332_create_degree_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('degree', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->unique()->notNull()
        ]);
        $this->createIndex('ckp_degree_index', '{{%ckp}}', 'director_degree');
        $this->addForeignKey('ckp_degree_fk', '{{%ckp}}', 'director_degree', '{{%degree}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('degree');
    }
}
