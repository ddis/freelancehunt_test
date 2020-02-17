<?php

namespace App\Models;

use Kernel\Model;

/**
 * Class ProjectSkills
 * @package App\Models
 */
class ProjectSkills extends Model
{

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return "project_skills";
    }

    /**
     * @return array
     */
    static function saveFields(): array
    {
        return [
            'project_id',
            'skill_id',
        ];
    }
}