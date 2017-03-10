<?php

use yii\db\Migration;

/**
 * Handles adding html to table `service`.
 */
class m170310_041757_add_html_column_to_service_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%service}}', 'html', $this->text()->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%service}}', 'html');
    }
}
