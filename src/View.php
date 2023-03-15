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
    private $style;
    /** @var string */
    private $script;
    /** @var object */
    private $options;

    /**
     * View constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $default = [
            "head" => true,
            "aside" => true,
            "header" => true,
            "footer" => true,
        ];

        $this->options = (object) array_merge($default, $options);
    }

    /**
     * Renderiza a View
     *
     * @example - $v->render('home', array('dados' => [...]));
     * @param string $view
     * @param array $data
     * @return void
     */
    public function render(string $view, array $data = [])
    {
        $file = CONF_VIEWS_PATH . "/{$view}.php";

        if (!file_exists($file)) {
            throw new \Exception("Erro ao carregar View");
            return;
        }

        if (!empty($data)) {
            $this->data = (object) $data;
        }

        if ($this->options->head) {
            include CONF_VIEW_HEAD;
        }

        if ($this->options->header) {
            include CONF_VIEW_HEADER;
        }

        if ($this->options->aside) {
            include CONF_VIEW_ASIDE;
        }

        include CONF_VIEWS_PATH . "/{$view}.php";
    }

    /**
     * Adiciona os recursos de CSS e JS.
     * Passar como argumento o caminho dos recursos, um array de assets.
     * Não é necessário colocar extenção.
     * [opcional] $cache deslida passar fals.
     *
     * @example - array(['style'] => ['global',...],['script'] => ['global',...]);
     * @param string $source
     * @param array $assets
     * @param boolean $cache
     * @return View
     */
    public function addAssets(string $source, array $assets, bool $cache = true): View
    {
        $v = '';
        if (empty($cache)) {
            $v = "?v=" . time();
        }

        if (!empty($assets['script'])) {
            foreach ($assets['script'] as $script) {
                $this->script .= "<script src='{$source}/js/{$script}.js{$v}'></script>\n    ";
            }
        }

        if (!empty($assets['style'])) {
            foreach ($assets['style'] as $style) {
                $this->style .= "<link href='{$source}/css/{$style}.css{$v}' rel='stylesheet'>\n    ";
            }
        }

        return $this;
    }

    public function __destruct()
    {
        if ($this->options->footer) {
            include CONF_VIEW_FOOTER;
        }
    }
}
