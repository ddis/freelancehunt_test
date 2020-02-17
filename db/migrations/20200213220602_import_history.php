<?php

use Phinx\Migration\AbstractMigration;

class ImportHistory extends AbstractMigration
{
    const TABLE_NAME = "import_history";

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, ['signed' => false]);

        $table->addColumn("name", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_STRING)
              ->addColumn("time_start", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_TIMESTAMP, [
                  'default' => "CURRENT_TIMESTAMP",
              ])
              ->addColumn("time_finish", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_TIMESTAMP, [
                  "null"    => true,
                  'default' => "CURRENT_TIMESTAMP",
                  'update'  => "CURRENT_TIMESTAMP",
              ])
              ->addColumn("status", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_STRING)
              ->addColumn("skills", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_STRING)
              ->addIndex(['status'])
              ->save();
    }

    public function down()
    {
        $this->table(self::TABLE_NAME)->drop()->save();
    }
}
