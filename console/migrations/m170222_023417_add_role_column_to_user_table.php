<?php

use yii\db\Migration;
use yii\db\Schema;
/**
 * Handles adding role to table `user`.
 */
class m170222_023417_add_role_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%user}}', 'role', Schema::TYPE_INTEGER.'(11) DEFAULT 1');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}
