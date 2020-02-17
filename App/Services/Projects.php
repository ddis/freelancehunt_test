<?php

namespace App\Services;

use App\Models\Employer;
use App\Models\ProjectSkills;
use App\Services\PrivatAPI\PrivatAPI;

/**
 * Class Projects
 * @package App\Services
 */
class Projects
{
    protected $projectModel       = null;
    protected $projectSkillsModel = null;
    protected $employerModel      = null;

    /**
     * Projects constructor.
     */
    public function __construct()
    {
        $this->projectModel       = new \App\Models\Projects();
        $this->projectSkillsModel = new ProjectSkills();
        $this->employerModel      = new Employer();
    }

    /**
     * @param $data
     * @return bool
     * @throws \ErrorException
     */
    public function insertProjectFromImport($data)
    {
        $data = $this->prepareForInsert($data);

        $res = $this->projectModel->insert($data['projects'], true);

        if ($res) {
            $res &= $this->projectSkillsModel->batchInsert($data['skills'], ['project_id', 'skill_id']);
        }

        return $res;
    }

    /**
     * Clear data method
     */
    public function clearData()
    {
        $this->projectModel->clearData();
        $this->employerModel->clearData();
        $this->projectSkillsModel->clearData();
    }

    /**
     * @param $data
     * @return array
     * @throws \ErrorException
     */
    protected function prepareForInsert($data)
    {
        return [
            'projects' => $this->prepareProjects($data),
            'skills'   => $this->prepareSkills($data),
        ];
    }

    /**
     * @param $data
     * @return array
     * @throws \ErrorException
     */
    protected function prepareProjects($data)
    {
        $res = [
            'id'              => $data['id'],
            'name'            => $data['name'],
            'description'     => $data['description'],
            'budget_amount'   => $data['budget_amount'],
            'budget_currency' => $data['budget_currency'],
            'link_web'        => $data['link_web'],
        ];

        if ($data['employer']) {
            $res['employer_id'] = $this->employerModel->findOrCreate($data['employer']);
        }

        if ($data['budget_amount']) {
            $res["budget_in_UAH"] = PrivatAPI::getInstance()->convert($data['budget_amount'], $data['budget_currency']);
        }

        return $res;
    }

    /**
     * @param $data
     * @return array
     */
    protected function prepareSkills($data)
    {
        $res = [];

        foreach ($data['skills'] as $skill) {
            $res[] = [
                $data['id'],
                $skill,
            ];
        }

        return $res;
    }
}