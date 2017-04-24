<?php

namespace yuncms\note\migrations;

use yii\db\Migration;

class M170424100255Add_backend_menu extends Migration
{
    public function up()
    {
        $this->insert('{{%admin_menu}}', [
            'name' => '笔记管理',
            'parent' => 8,
            'route' => '/note/note/index',
            'icon' => 'fa-file-archive-o',
            'sort' => NULL,
            'data' => NULL
        ]);

        $id = (new \yii\db\Query())->select(['id'])->from('{{%admin_menu}}')->where(['name' => '笔记管理', 'parent' => 8])->scalar($this->getDb());
        $this->batchInsert('{{%admin_menu}}', ['name', 'parent', 'route', 'visible', 'sort'], [
            ['笔记查看', $id, '/note/note/view', 0, NULL],
            ['创建笔记', $id, '/note/note/create', 0, NULL],
            ['更新笔记', $id, '/note/note/update', 0, NULL],
        ]);
    }

    public function down()
    {
        $id = (new \yii\db\Query())->select(['id'])->from('{{%admin_menu}}')->where(['name' => '笔记管理', 'parent' => 8])->scalar($this->getDb());
        $this->delete('{{%admin_menu}}', ['parent' => $id]);
        $this->delete('{{%admin_menu}}', ['id' => $id]);
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
