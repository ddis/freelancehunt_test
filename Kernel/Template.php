<?php

namespace Kernel;

/**
 * Class Template
 *
 * @package kernel
 */
class Template
{
    private $dir_tmpl = CORE_PATH . "/App/Views/";
    public  $title    = '';

    protected $js = [];

    /**
     * @return string
     */
    public function getTmplDir()
    {
        return $this->dir_tmpl;
    }


    /**
     * @param      $template
     * @param      $data
     * @param null $templateDir
     * @return false|string
     */
    public function display($template, $data, $templateDir = null)
    {
        $templateDir = $templateDir ?? $this->dir_tmpl;

        $template = $templateDir . $template . ".php";
        ob_start();
        extract($data);
        include($template);

        $data = ob_get_contents();
        ob_get_clean();

        return $data;
    }

    /**
     * @param string $layoutName
     * @param array  $data
     * @return array|false|string
     */
    public function renderLayout(string $layoutName, array $data)
    {
        $template = "{$this->dir_tmpl}/layouts/{$layoutName}.php";
        ob_start();
        extract($data);
        include($template);

        $data = ob_get_contents();
        ob_get_clean();

        return $data;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function addJS(string $path)
    {
        $this->js[] = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function appendJS()
    {
        $res = "";
        foreach ($this->js as $j) {
            $res .= "<script src='{$j}'></script>\n";
        }

        return $res;
    }
}

