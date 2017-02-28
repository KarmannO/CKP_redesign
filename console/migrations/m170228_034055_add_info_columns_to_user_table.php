<?php

use yii\db\Migration;

/**
 * Handles adding info to table `user`.
 */
class m170228_034055_add_info_columns_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%user}}', 'name', $this->string(256)->notNull());
        $this->addColumn('{{%user}}', 'middle_name', $this->string(256)->notNull());
        $this->addColumn('{{%user}}', 'surname', $this->string(256)->notNull());
        $this->addColumn('{{%user}}', 'phone', $this->string(15)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%user}}', 'name');
        $this->dropColumn('{{%user}}', 'middle_name');
        $this->dropColumn('{{%user}}', 'surname');
        $this->dropColumn('{{%user}}', 'phone');
    }
}
