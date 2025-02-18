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
    private bool $cache;
    private string $styles;
    private string $source;
    private string $scripts;
    private string $stylePath;
    private string $scriptPath;

    /**
     * Assets constructor.
     *
     * @param string $src path to resources folder
     * @param boolean $cache [optional] cache on/off, defaults true
     * @example - new Assets('assets', false);
     */
    public function __construct(string $src, bool $cache = true)
    {
        $this->styles = '';
        $this->scripts = '';

        $this->source = $src;
        $this->cache = $cache;

        $this->stylePath = "{$this->source}/css";
        $this->scriptPath = "{$this->source}/js";
    }

    /**
     * @return string
     */
    public function getStyles(): string
    {
        return $this->styles;
    }

    /**
     * @return string
     */
    public function getScripts(): string
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
        $this->stylePath = $this->source . '/' . ltrim($stylePath, '/');
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
        $this->scriptPath = $this->source . '/' . ltrim($scriptPath, '/');
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
        $this->styles = $this->build('link', $css, $this->stylePath);
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
        $this->scripts = $this->build('script', $js, $this->scriptPath);
        return $this;
    }

    /**
     * Build styles and scripts
     *
     * @param string $tag
     * @param array $files
     * @param string $path
     * @return string
     */
    private function build(string $tag, array $files, string $path): string
    {
        $version = $this->cache ? "" : "?v=" . time();

        if (!$files) {
            return '';
        }

        $tags = array_map(fn($file) => match ($tag) {
            'script' => "<script src='{$path}/{$file}.js{$version}'></script>",
            'link' => "<link rel='stylesheet' href='{$path}/{$file}.css{$version}'>",
        }, $files);

        return implode("\n    ", $tags) . "\n    ";
    }
}
