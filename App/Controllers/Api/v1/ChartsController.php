<?php

namespace App\Controllers\Api\v1;

use App\Models\Projects;
use App\Models\Skills;
use Kernel\Controller;

/**
 * Class ChartsController
 * @package App\Controllers\Api\v1
 */
class ChartsController extends Controller
{
    /**
     * @return bool
     */
    public function byPrice()
    {
        $data = (new Projects())->byPrices();

        $response = [
            "status" => "fail",
        ];

        if ($data) {
            $response = [
                'status' => 'success',
                'data'   => [
                    'labels' => array_keys($data[0]),
                    'values' => array_values($data[0]),
                ],
            ];
        }

        return $this->renderJson($response);
    }

    /**
     * @return bool
     */
    public function topSkills()
    {
        $data = (new Skills())->topSkills();

        $response = [
            "status" => "fail",
        ];

        return $this->renderJson([
            'status' => 'success',
            'data'   => [
                'labels' => array_map(function ($item) {
                    return $item['name'];
                }, $data),
                'values' => array_map(function ($item) {
                    return $item['total'];
                }, $data),
            ],
        ]);
    }
}