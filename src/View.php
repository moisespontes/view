<?php

namespace DevPontes\View;

use DevPontes\View\Exception\ErrorRender;

/**
 * Class DevPontes View
 *
 * @author Moises Pontes <sesiom_assis@hotmail.com>
 * @package DevPontes\View
 */
class View
{
    private null | string $head   = null;
    private null | string $aside  = null;
    private null | string $header = null;
    private null | string $footer = null;

    private array $data    = [];
    public ?Assets $assets = null;

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

        extract($this->data);

        if ($this->head) {
            include $this->resolvePath($this->head);
        }

        if ($this->header) {
            include $this->resolvePath($this->header);
        }

        if ($this->aside) {
            include $this->resolvePath($this->aside);
        }

        include $this->resolvePath($view);

        if ($this->footer) {
            include $this->resolvePath($this->footer);
        }
    }

    /**
     * Insert View
     *
     * @param string $view
     * @param string $extension
     * @return void
     */
    public function insert(string $view, string $extension = ''): void
    {
        extract($this->data);

        $this->extension = $extension ?: $this->extension;

        include $this->resolvePath($view);
    }

    /**
     * @param string $view
     * @return string
     */
    private function resolvePath(string $view): string
    {
        if (empty($view)) {
            throw new ErrorRender('View name cannot be empty');
        }

        $bar  = DIRECTORY_SEPARATOR;
        $view = $view[0] == '.' ? ltrim($view, '.') : $view;
        $file = $this->viewPath . $bar . str_replace('.', $bar, $view) . '.' . $this->extension;

        if (!is_readable($file)) {
            throw new ErrorRender("Error loading view {$file}");
        }

        return $file;
    }

    /**
     * Assets class injection
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
