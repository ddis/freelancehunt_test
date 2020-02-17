<?php

namespace App\Models;

use Kernel\App;
use Kernel\Model;

/**
 * Class Skills
 * @package App\Models
 */
class Skills extends Model
{

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return "skills";
    }

    /**
     * @return array
     */
    static function saveFields(): array
    {
        return [
            "name",
        ];
    }

    /**
     * @return array
     */
    public function getActiveSkills()
    {
        $skills = App::getInstance()->get("configManager")->get("skills_category");

        $res = $this->select("SELECT name FROM " . self::tableName() . " WHERE id IN ('" . implode("','", $skills) . "')");

        return array_map(function ($item) {
            return $item['name'];
        }, $res);
    }

    /**
     * @param $limit
     * @param $offset
     * @return array
     */
    public function getSkillsWithProjectCount($limit, $offset)
    {
        return $this->select("SELECT 
                                        s.id, s.name, COUNT(p.id) as project_count
                                    FROM skills as s 
                                    INNER JOIN project_skills as ps on s.id = ps.skill_id 
                                    INNER JOIN projects as p on p.id = ps.project_id 
                                    GROUP BY s.id
                                    ORDER BY project_count DESC LIMIT {$offset}, {$limit}");
    }

    /**
     * @return int
     */
    public function getTotalSkillsWithProjects()
    {
        $res = $this->select("SELECT COUNT(s.id) FROM skills as s INNER JOIN project_skills as ps ON s.id = ps.skill_id GROUP BY s.id");

        return count($res);
    }

    /**
     * @return array
     */
    public function topSkills()
    {
        return $this->select('SELECT count(p.id) as total, s.name FROM projects as p
                                    INNER JOIN project_skills as ps ON p.id = ps.project_id
                                    INNER JOIN skills as s ON s.id = ps.skill_id
                                    GROUP BY s.id ORDER BY total DESC LIMIT 5');
    }
}