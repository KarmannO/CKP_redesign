<?php

use yii\db\Migration;

/**
 * Handles the creation of table `equipment`.
 */
class m170310_071158_create_equipment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%equipment}}', [
            'id' => $this->primaryKey(),
            'ckp_id' => $this->integer()->notNull(),
            'title' => $this->string(300)->notNull(),
            'description' => $this->text(),
            'production_company' => $this->string(300),
            'production_year' => $this->string(50),
            'price' => $this->decimal(),
            'mark' => $this->string(300)
        ]);
        $this->createIndex('ckp_equipment_index', '{{%equipment}}', 'ckp_id', false);
        $this->addForeignKey('ckp_equipment_fk', '{{%equipment}}', 'ckp_id', '{{%ckp}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('equipment');
    }
}
