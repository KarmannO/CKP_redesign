<?php

use yii\db\Migration;

/**
 * Handles the creation of table `position`.
 */
class m170306_052343_create_position_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('position', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->unique()->notNull()
        ]);
        $this->createIndex('ckp_position_index', '{{%ckp}}', 'director_position');
        $this->addForeignKey('ckp_position_fk', '{{%ckp}}', 'director_position', '{{%position}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('position');
    }
}
