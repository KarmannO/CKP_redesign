<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_binding`.
 */
class m170313_071938_create_service_binding_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%service_binding}}', [
            'id' => $this->primaryKey(),
            'service' => $this->integer()->notNull(),
            'equipment' => $this->integer()->notNull()
        ]);
        $this->createIndex('service_binding_service', '{{%service_binding}}', 'service');
        $this->createIndex('service_binding_equipment', '{{%service_binding}}', 'equipment');

        $this->addForeignKey('service_binding_service_fk', '{{%service_binding}}', 'service', '{{%service}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('service_binding_equipment_fk', '{{%service_binding}}', 'equipment', '{{%equipment}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%service_binding}}');
    }
}
