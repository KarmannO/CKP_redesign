<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rank`.
 */
class m170306_052221_create_rank_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('rank', [
            'id' => $this->primaryKey(),
            'title' => $this->string(200)->unique()->notNull()
        ]);
        $this->createIndex('ckp_rank_index', '{{%ckp}}', 'director_rank');
        $this->addForeignKey('ckp_rank_fk', '{{%ckp}}', 'director_rank', '{{%rank}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('rank');
    }
}
