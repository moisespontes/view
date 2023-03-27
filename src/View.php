<?php

namespace DevPontes\View;

/**
 * Class DevPontes View
 *
 * @author Moises Pontes <sesiom_assis@hotmail.com>
 * @package DevPontes\View
 */
class View
{
    /** @var object */
    private $data;

    /** @var string */
    private $head;

    /** @var string */
    private $header;

    /** @var string */
    private $aside;

    /** @var string */
    private $footer;

    /** @var string */
    private $style;

    /** @var string */
    private $script;

    /** @var string */
    private $viewPath;

    /** @var string */
    private $stylePath;

    /** @var string */
    private $scriptPath;

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
        $this->extension = $extension;
        $this->viewPath  = $viewPath;
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
     * Set path for styles
     *
     * @param string $stylePath
     * @return View
     */
    public function setStylePath(string $stylePath): View
    {
        $this->stylePath = $stylePath;
        return $this;
    }

    /**
     * Set path for scripts
     *
     * @param string $scriptPath
     * @return View
     */
    public function setScriptPath(string $scriptPath): View
    {
        $this->scriptPath = $scriptPath;
        return $this;
    }

    /**
     * Adds CSS and JS features.
     *
     * @param string $source path to resources folder
     * @param array $assets array of assets
     * @param boolean $cache [optional] cache on/off, defaults true
     * @return View
     * @example - $v->addAssets('assets', array(['style'] => ['global',], ['script'] => ['global',]), false);
     */
    public function addAssets(string $source, array $assets, bool $cache = true): View
    {
        $v = '';
        if (empty($cache)) {
            $v = "?v=" . time();
        }

        $stylePath  = empty($this->stylePath) ? "css" : $this->stylePath;
        $scriptPath = empty($this->scriptPath) ? "js" : $this->scriptPath;

        if (!empty($assets['script'])) {
            foreach ($assets['script'] as $script) {
                $this->script .= "<script src='{$source}/{$scriptPath}/{$script}.js{$v}'></script>\n    ";
            }
        }

        if (!empty($assets['style'])) {
            foreach ($assets['style'] as $style) {
                $this->style .= "<link href='{$source}/{$stylePath}/{$style}.css{$v}' rel='stylesheet'>\n    ";
            }
        }

        return $this;
    }

    /**
     * Render the View
     * Data array will be converted to stdClass object
     *
     * @param string $view
     * @param array $data
     * @return void
     * @throws Exception
     * @example - $v->render('home', array('data' => [...]));
     */
    public function render(string $view, array $data = []): void
    {
        $file = "{$this->viewPath}/{$view}.{$this->extension}";
        $this->data = (object) $data;

        if (!file_exists($file)) {
            throw new \Exception("Error loading view");
            return;
        }

        if ($this->head) {
            include "{$this->head}.{$this->extension}";
        }

        if ($this->header) {
            include "{$this->header}.{$this->extension}";
        }

        if ($this->aside) {
            include "{$this->aside}.{$this->extension}";
        }

        include $file;

        if ($this->footer) {
            include "{$this->footer}.{$this->extension}";
        }
    }
}
