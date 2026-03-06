<?php

namespace DevPontes\View;

use DevPontes\View\Exception\ErrorRender;

/**
 * Class DevPontes View
 *
 * @author Moises Pontes
 * @package DevPontes\View
 */
class View
{
    private null | string $head   = null;
    private null | string $aside  = null;
    private null | string $header = null;
    private null | string $footer = null;

    /** @var array An array of data to be passed to the view */
    private array $data = [];

    public null | Assets $assets = null;

    /**
     * View constructor.
     *
     * @param string $viewPath ex: src/views
     * @param string $extension php or html or other
     */
    public function __construct(
        private string $viewPath,
        private string $extension
    ) {
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * View data
     *
     * @return object
     */
    public function data(): object
    {
        return (object) $this->data;
    }

    /**
     * Define head view
     *
     * @param string $head
     * @return View
     */
    public function setHead(string $head): View
    {
        $this->head = $head;
        return $this;
    }

    /**
     * Define header view
     *
     * @param string $header
     * @return View
     */
    public function setHeader(string $header): View
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Define aside view
     *
     * @param string $aside
     * @return View
     */
    public function setAside(string $aside): View
    {
        $this->aside = $aside;
        return $this;
    }

    /**
     * Define footer view
     *
     * @param string $footer
     * @return View
     */
    public function setFooter(string $footer): View
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * Render the View
     * Data array will be converted to stdClass object
     *
     * @param string $view
     * @param array $data
     * @return void
     * @example - $v->render('home', array('data' => [...]));
     */
    public function render(string $view, array $data = []): void
    {
        $this->data = $data;

        $sections = [
            $this->head,
            $this->header,
            $this->aside,
            $view,
            $this->footer
        ];

        foreach ($sections as $section) {
            if (!empty($section)) {
                $this->renderScope($section);
            }
        }
    }

    /**
     * Insert a view into the current scope
     *
     * @param string $view
     * @param string $extension
     * @return void
     */
    public function insert(string $view, string $extension = ''): void
    {
        $this->renderScope($view, $extension);
    }

    /**
     * Render the view in the current scope, allowing access to the data array as variables
     *
     * @param string $view
     * @return void
     */
    private function renderScope(string $view, string $extension = ''): void
    {
        $bar = DIRECTORY_SEPARATOR;

        $ext  = $extension ?: $this->extension;
        $view = str_replace('.', $bar, ltrim($view, '.'));

        $file = $this->resolvePath($this->viewPath . $bar . $view . '.' . $ext);

        extract($this->data, EXTR_SKIP);

        include $file;
    }

    /**
     * Resolve the path of the view file and check if it is readable
     *
     * @param string $view
     * @return string
     */
    private function resolvePath(string $view): string
    {
        if ($view === '') {
            throw new ErrorRender('View name cannot be empty');
        }

        $real = realpath($view);

        if ($real === false || !is_readable($real)) {
            throw new ErrorRender("Error loading view {$view}");
        }

        return $real;
    }

    /**
     * Injects the Assets instance into the view.
     *
     * @param Assets $assets
     * @return View
     */
    public function addAssets(Assets $assets): View
    {
        $this->assets = $assets;
        return $this;
    }
}
