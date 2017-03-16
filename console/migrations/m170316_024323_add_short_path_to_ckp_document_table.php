<?php

use yii\db\Migration;

class m170316_024323_add_short_path_to_ckp_document_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%ckp_document}}', 'short_path', $this->string(200)->notNull()->unique());
    }

    public function down()
    {
        $this->dropColumn('{{%ckp_document}}', 'short_path');
    }
}
