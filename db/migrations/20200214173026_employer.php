<?php

use Phinx\Migration\AbstractMigration;

class Employer extends AbstractMigration
{
    const TABLE_NAME = "employer";

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, ['signed' => false]);

        $table->addColumn("login", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_STRING)
              ->addColumn("last_name", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_STRING)
              ->addColumn("first_name", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_STRING)
              ->save();
    }

    public function down()
    {
        $this->table(self::TABLE_NAME)->drop()->save();
    }
}
