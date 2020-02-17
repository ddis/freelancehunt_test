<?php

namespace App\Models;

use Kernel\Model;

/**
 * Class ImportHistory
 * @package App\Models
 */
class ImportHistory extends Model
{
    const STATUS_PENDING = "pending";
    const STATUS_SUCCESS = "success";
    const STATUS_FAIL    = "fail";

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return "import_history";
    }

    /**
     * @return array
     */
    static function saveFields(): array
    {
        return [
            'name',
            'time_start',
            "time_finish",
            "status",
            "skills",
        ];
    }

    /**
     * @return array
     */
    public function getStarted()
    {
        return $this->findAll(['status' => self::STATUS_PENDING]);
    }
}