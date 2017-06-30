<?php

namespace yuncms\note\migrations;

use yii\db\Migration;

class M170630103327Create_note_of_collections_field extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%note}}', 'collections', $this->integer()->unsigned()->defaultValue(0)->comment('收藏次数'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%note}}', 'collections');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M170630103327Create_note_of_collections_field cannot be reverted.\n";

        return false;
    }
    */
}
