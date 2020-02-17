<?php

use Phinx\Migration\AbstractMigration;

class ForeignKey extends AbstractMigration
{
    public function up()
    {
        $table  = $this->table("project_skills");

        $table->addForeignKey("skill_id", "skills", "id", [
            'delete' => 'RESTRICT',
        ])->save();

        $table->addForeignKey("project_id", "projects", "id", [
            'delete' => "CASCADE",
        ])->save();
    }

    public function down()
    {
        $table  = $this->table("project_skills");

        if ($table->hasForeignKey("skill_id")) {
            $table->dropForeignKey("skill_id")->save();
        }

        if ($table->hasForeignKey("project_id")) {
            $table->dropForeignKey("project_id")->save();
        }
    }
}
