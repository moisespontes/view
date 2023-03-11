# View by @Devpontes

## About View componet

##### View is a simple component for rendering templates with native PHP

View é um componente simples para renderização de templates com PHP nativo.

### Highlights

- Renderização simples de templates. (simple rendering of templates)
- Controle dinâmico de ativos de JS e CSS. (dynamic Control of JS and CSS Assets)
- Controle dinâmico te partes do template HTML. (dynamic control of parts of the HTML template).

## Installation

View is available via Composer:

```bash
"devpontes/view": "1.0.*"
```

or run

```bash
composer require devpontes/view
```

## Documentation

##### To use the View we need to define the following CONSTANTS in the execution file or in a separate file

1. Para utilizar o View precisamos definir as seguintes CONSTANTES no arquivo de execução ou em um arquivo separado.

```php
define('CONF_ROOT_PATH', dirname(__FILE__, 1));
define('CONF_VIEWS_PATH', CONF_ROOT_PATH . "/views");
define('CONF_VIEW_HEAD', CONF_VIEWS_PATH . "/includes/head.php");
define('CONF_VIEW_ASIDE', CONF_VIEWS_PATH . "/includes/aside.php");
define('CONF_VIEW_HEADER', CONF_VIEWS_PATH . "/includes/header.php");
define('CONF_VIEW_FOOTER', CONF_VIEWS_PATH . "/includes/footer.php");
```

##### On initialization, pass the template option array

2. Na inicialização, passe o array de opção do template.

```php
/** Dynamic template control */
$options = [
    "head" => true,
    "aside" => false,
    "header" => true,
    "footer" => true,
];

$render = new \DevPontes\View\View($options);
```

##### It's just two methods to do all the work. You just need to call ***addAssets*** to define the JS and CSS assets, and/or ***render*** to render the selected view. You can omit the ***add Assets*** if the assets are inserted in the template itself, see

3. São apenas dois métodos para fazer todo o trabalho. Você só precisa chamar o ***addAssets*** para definir os ativos de JS e CSS, e/ou o ***render*** para renderizar a view selecionada. Você pode omitir o ***add Assets*** caso os ativos sejam inseridos no proprio template, veja:

#### Add assets

```php
/** assets array */
$assets['style']  = ['global', 'style'];
$assets['script'] = ['global', 'script'];

/** soucer path */
$source = 'assets';

/** define cache */
$cache = false;

$render->addAssets($source, $assets, $cache);
```

#### Render view

```php
/** set view data */
$user  = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$render->render('home', $data);
```

or just

```php
$render = new \DevPontes\View\View($options);
$render->addAssets('assets', $assets);
$render->render('home', $data);
```

#### Add CSS in &lt;head&gt;

```html
<head>
    <title>View</title>
    <!-- add CSS -->
    <?= $this->style; ?> 
</head>
```

#### Add JS in &lt;body&gt;

```html
<body>
    ...
   <!-- add JS -->
   <?= $this->script; ?>
</body>
```

## Credits

- [Moises Pontes](https://github.com/moisespontes) (Developer)

## License

The MIT License (MIT).
