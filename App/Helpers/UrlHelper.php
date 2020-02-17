<?php

namespace App\Helpers;

/**
 * Class UrlHelper
 * @package App\Helpers
 */
class UrlHelper
{
    /**
     * @param array $newQuery
     * @return string
     */
    public static function changeQuery(array $newQuery = [])
    {
        $pathInfo = parse_url($_SERVER['REQUEST_URI']);

        $path = $pathInfo['path'];

        if (isset($pathInfo["query"])) {
            foreach (explode("&", $pathInfo["query"]) as $item) {
                $r = explode("=", $item);

                $query[$r[0]] = $r[1];
            }
        }

        foreach (array_merge(($query ?? []), $newQuery) as $key => $value) {
            $qPart[] = "{$key}={$value}";
        }

        $query = implode("&", ($qPart ?? []));


        return "{$path}?{$query}";
    }
}