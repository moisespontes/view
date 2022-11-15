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

const CONF_VIEWS_PATH  = "views";
const CONF_VIEW_HEAD   = CONF_VIEWS_PATH . "/includes/head.php";
const CONF_VIEW_ASIDE  = CONF_VIEWS_PATH . "/includes/aside.php";
const CONF_VIEW_HEADER = CONF_VIEWS_PATH . "/includes/header.php";
const CONF_VIEW_FOOTER = CONF_VIEWS_PATH . "/includes/footer.php";
```

##### At initialization, enter the assets path and an array of template options

2. Na inicialização, informe o caminho dos ativos e um array de opção do template.

```php

/** Dynamic template control */
$options = array(
    "head" => true,
    "aside" => false,
    "header" => true,
    "footer" => true,
);

$render = new \DevPontes\View\View('assets', $options);
```

##### There are just two methods to do all the work. You just need to call ***addAssets*** to set the JS and CSS assets, or just ***render*** to render the selected View. You can omit the ***add Assets*** if the assets are inserted in the template itself, see

3. São apenas dois métodos para fazer todo o trabalho. Você só precisa chamar o ***addAssets*** para definir os ativos de JS e CSS, ou o somente o ***render*** para renderizar a view selecionada. Você pode omitir o ***add Assets*** caso os ativos sejam inseridos no proprio template, veja:

#### Add assets

```php
<?php

/** assets array */
$assets['style']  = ['global', 'style'];
$assets['script'] = ['global', 'script'];

$render->addAssets($assets);
```

#### Render view

```php
<?php

/** set view data */
$user  = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$render->render('home', $data);
```

or just

```php
<?php

$render = new \DevPontes\View\View('assets', $options);
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

## Author

| [<img src="https://avatars.githubusercontent.com/u/52866537?v=4" width=120><br><sub>@moisespontes</sub>](https://github.com/moisespontes) |
| :---: |

## License

The MIT License (MIT).
