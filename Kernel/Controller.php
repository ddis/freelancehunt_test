<?php


namespace Kernel;

use Kernel\Services\ConfigManager;

/**
 * Class Controller
 *
 * @package kernel
 */
abstract class Controller
{
    protected $view   = null;
    public    $layout = 'main';

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new Template();
    }

    /**
     * @param string $name
     * @param array  $data
     * @return bool
     */
    public function render(string $name, array $data = [])
    {
        $content = $this->renderFile($name, $data);

        header("Content-Type: text/html");

        echo $this->view->renderLayout($this->layout, ["content" => $content]);

        return true;
    }

    /**
     * @param string $name
     * @param array  $data
     *
     * @return false|string
     */
    public function renderFile(string $name, array $data = [])
    {
        return $this->view->display($name, $data);
    }

    /**
     * @param array           $data
     * @param \Exception|null $exception
     * @return bool
     */
    public function renderJson(array $data, \Exception $exception = null)
    {
        if ($exception) {
            http_response_code($exception->getCode());
        }

        header('Content-Type: application/json');

        echo json_encode($data);

        return true;
    }

    /**
     * @return ConfigManager
     */
    protected function getConfigManager(): ConfigManager
    {
        return App::getInstance()->get("configManager");
    }
}
