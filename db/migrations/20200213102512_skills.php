<?php

use Phinx\Migration\AbstractMigration;

class Skills extends AbstractMigration
{
    const TABLE_NAME = "skills";

    public function up()
    {
        $table = $this->table(self::TABLE_NAME, ['signed' => false]);

        $table->addColumn("name", \Phinx\Db\Adapter\MysqlAdapter::PHINX_TYPE_STRING)
              ->save();
    }

    public function down()
    {
        $this->table(self::TABLE_NAME)->drop()->save();
    }
}
