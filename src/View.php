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
    /** @var array */
    private $data;

    /** @var Assets */
    public $assets;

    /** @var string */
    private $head;

    /** @var string */
    private $header;

    /** @var string */
    private $aside;

    /** @var string */
    private $footer;

    /** @var string */
    private $viewPath;

    /** @var string */
    private $extension;

    /**
     * View constructor.
     *
     * @param string $viewPath ex: src/views
     * @param string $extension php or html or other
     */
    public function __construct(string $viewPath, string $extension)
    {
        $this->viewPath = $viewPath;
        $this->extension = $extension;
    }

    public function __get($name)
    {
        return $this->data[$name];
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
     * @param string|null $head
     * @return View
     */
    public function setHead(?string $head): View
    {
        $this->head = $head;
        return $this;
    }

    /**
     * Define header view
     *
     * @param string|null $header
     * @return View
     */
    public function setHeader(?string $header): View
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Define aside view
     *
     * @param string|null $aside
     * @return View
     */
    public function setAside(?string $aside): View
    {
        $this->aside = $aside;
        return $this;
    }

    /**
     * Define footer view
     *
     * @param string|null $footer
     * @return View
     */
    public function setFooter(?string $footer): View
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
            include $this->head . "." . $this->extension;
        }

        if ($this->header) {
            include $this->header . "." . $this->extension;
        }

        if ($this->aside) {
            include $this->aside . "." . $this->extension;
        }

        include $this->resolvePath($view);

        if ($this->footer) {
            include $this->footer . "." . $this->extension;
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

        $this->extension = $extension ? $extension : $this->extension;

        include $this->resolvePath($view);
    }

    /**
     * @param string $view
     * @return string
     */
    private function resolvePath(string $view): string
    {
        $file = $this->viewPath . '/' . $view . '.' . $this->extension;

        if (!file_exists($file)) {
            throw new ErrorRender("Error loading view...");
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
