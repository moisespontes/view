<?php

namespace DevPontes\View;

/**
 * Class DevPontes Assets
 *
 * @author Moises Pontes <sesiom_assis@hotmail.com>
 * @package DevPontes\View
 */
class Assets
{
    /** @var string */
    private $styles;

    /** @var string */
    private $scripts;

    /** @var string */
    private $stylePath;

    /** @var string */
    private $scriptPath;

    /** @var string */
    private $source;

    /** @var bool */
    private $cache;

    /**
     * Assets constructor.
     *
     * @param string $src path to resources folder
     * @param boolean $cache [optional] cache on/off, defaults true
     * @example - new Assets('assets', false);
     */
    public function __construct(string $src, bool $cache = true)
    {
        $this->source = $src;
        $this->cache = $cache;
    }

    /**
     * @return string|null
     */
    public function getStyles(): ?string
    {
        return $this->styles;
    }

    /**
     * @return string|null
     */
    public function getScripts(): ?string
    {
        return $this->scripts;
    }

    /**
     * Set path for styles
     *
     * @param string $stylePath
     * @return Assets
     */
    public function setStylePath(string $stylePath): Assets
    {
        $this->stylePath = $stylePath;
        return $this;
    }

    /**
     * Set path for scripts
     *
     * @param string $scriptPath
     * @return Assets
     */
    public function setScriptPath(string $scriptPath): Assets
    {
        $this->scriptPath = $scriptPath;
        return $this;
    }

    /**
     * Make CSS styles
     *
     * @param array $css array of styles
     * @return Assets
     * @example - $a->makeStyle($css['global', ...]);
     */
    public function makeStyle(array $css): Assets
    {
        $version = $this->cache ? "" : "?v=" . time();
        $stylePath = empty($this->stylePath) ? "css" : $this->stylePath;

        if (!empty($css)) {
            foreach ($css as $style) {
                $this->styles .= "<link href='{$this->source}/{$stylePath}/{$style}.css{$version}' rel='stylesheet'>\n    ";
            }
        }

        return $this;
    }

    /**
     * Make JS scripts
     *
     * @param array $js array of scripts
     * @return Assets
     * @example - $a->makeScript($js['global', ...]);
     */
    public function makeScript(array $js): Assets
    {
        $version = $this->cache ? "" : "?v=" . time();
        $scriptPath = empty($this->scriptPath) ? "js" : $this->scriptPath;

        if (!empty($js)) {
            foreach ($js as $script) {
                $this->scripts .= "<script src='{$this->source}/{$scriptPath}/{$script}.js{$version}'></script>\n    ";
            }
        }

        return $this;
    }
}
