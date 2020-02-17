<?php

use Phinx\Migration\AbstractMigration;

class ProjectSkills extends AbstractMigration
{
    const TABLE_NAME = "project_skills";

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => ['project_id', 'skill_id']]);

        $table
            ->addColumn("project_id", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_INTEGER, [
                'signed' => false,
            ])
            ->addColumn("skill_id", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_INTEGER, [
                'signed' => false,
            ])
            ->save();


    }

    public function down()
    {
        $this->table(self::TABLE_NAME)->drop()->save();
    }
}
