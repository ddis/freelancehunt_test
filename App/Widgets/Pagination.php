<?php

namespace App\Widgets;

use Kernel\Widget;

/**
 * Class Pagination
 * @package App\Widgets
 */
class Pagination extends Widget
{
    /**
     * @return false|string|null
     */
    public function run()
    {
        $onPage     = $this->getConfigManager()->get("pagination.onPage");
        $totalCount = $this->data['total'] ?? null;
        $page       = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalPages = ceil($totalCount / $onPage);

        if ($onPage >= $totalCount) {
            return null;
        }

        return $this->render("pagination", compact("onPage", "totalCount", "page", "totalPages"));
    }
}