<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class Projects extends AbstractMigration
{
    const TABLE_NAME = "projects";

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, ['signed' => false]);

        $table->addColumn("name", MysqlAdapter::PHINX_TYPE_STRING)
              ->addColumn("description", MysqlAdapter::PHINX_TYPE_TEXT)
              ->addColumn("budget_amount", MysqlAdapter::PHINX_TYPE_DECIMAL, [
                  'null'      => true,
                  "precision" => 13,
                  "scale"     => 4,
              ])
              ->addColumn("budget_currency", MysqlAdapter::PHINX_TYPE_STRING, [
                  'null' => true,
              ])
              ->addColumn("budget_in_UAH", MysqlAdapter::PHINX_TYPE_DECIMAL, [
                  'null'      => true,
                  "precision" => 13,
                  "scale"     => 4,
              ])
              ->addColumn("link_web", MysqlAdapter::PHINX_TYPE_STRING)
              ->addColumn("employer_id", MysqlAdapter::PHINX_TYPE_INTEGER, ['signed' => false])
              ->addIndex(["employer_id"])
              ->save();
    }

    public function down()
    {
        $this->table(self::TABLE_NAME)->drop()->save();
    }
}
