<?php

namespace App\Models;

use Kernel\Model;

/**
 * Class Projects
 * @package App\Models
 */
class Projects extends Model
{

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return "projects";
    }

    /**
     * @return array
     */
    static function saveFields(): array
    {
        return [
            'name',
            'description',
            'budget_amount',
            'budget_currency',
            'budget_in_UAH',
            'link_web',
            'employer_id',
            'is_only_for_plus',
        ];
    }

    /**
     * @param $limit
     * @param $offset
     * @return array
     */
    public function getProjectWithEmployers($limit, $offset)
    {
        return $this->select("select
                                p.name, ROUND(p.budget_amount, 2) as budget_amount,
                                p.budget_currency, ROUND(p.budget_in_UAH, 2) as budget_in_UAH, 
                                p.link_web, e.first_name, e.last_name, e.login, p.id
                             FROM projects as p 
                             LEFT JOIN employer as e on p.employer_id = e.id
                             ORDER BY p.id DESC LIMIT {$offset}, {$limit} ");
    }

    /**
     * @return array
     */
    public function byPrices()
    {
        return $this->select('select
                                    (select count(id) from projects where budget_in_UAH < 500) as "от 500",
                                    (select count(id) from projects where budget_in_UAH BETWEEN 500 AND 1000) as "500-1000",
                                    (select count(id) from projects where budget_in_UAH BETWEEN 1001 AND 5000) as "1000-5000",
                                    (select count(id) from projects where budget_in_UAH BETWEEN 5001 AND 10000) as "5000-10000",
                                    (select count(id) from projects where budget_in_UAH > 10000) as "более 10000"');
    }

    /**
     * @return array
     */
    public function getNewProjects()
    {
        return $this->select("SELECT id, name, link_web FROM projects ORDER BY id DESC LIMIT 5");
    }


}