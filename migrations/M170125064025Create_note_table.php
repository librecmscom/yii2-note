<?php

namespace yuncms\note\migrations;

use yii\db\Migration;

class M170125064025Create_note_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%note}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'folder_id' => $this->integer(),
            'uuid' => $this->string(),
            'type' => $this->smallInteger(1)->defaultValue(0)->comment('0私有1公共'),
            'title' => $this->string()->defaultValue('Untitled')->comment('标题[可选]'),
            'format' => $this->string()->comment('内容语法格式'),
            'content' => $this->text()->notNull()->comment('原始内容'),
            'ip' => $this->string()->notNull()->comment('用户IP'),
            'size' => $this->integer()->defaultValue(0)->comment('大小[b]'),
            'views' => $this->integer()->defaultValue(0)->comment('点击数'),
            'expired_at' => $this->integer()->comment('过期时间'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('note_key', '{{%note}}', 'uuid', true);
    }

    public function down()
    {
        $this->dropTable('{{%note}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
