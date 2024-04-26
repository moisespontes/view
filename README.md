# View by @Devpontes

[![Maintainer](https://img.shields.io/badge/maintainer-@moi.pontes-blue.svg?style=flat-square)](https://instagram.com/moi.pontes)
[![Source Code](https://img.shields.io/badge/source-moisespontes/view-blue.svg?style=flat-square)](https://github.com/moisespontes/view)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/devpontes/view.svg?style=flat-square)](https://packagist.org/packages/devpontes/view)
[![Latest Version](https://img.shields.io/github/release/moisespontes/view.svg?style=flat-square)](https://github.com/moisespontes/view/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/moisespontes/view.svg?style=flat-square)](https://scrutinizer-ci.com/g/moisespontes/view)
[![Quality Score](https://img.shields.io/scrutinizer/g/moisespontes/view.svg?style=flat-square)](https://scrutinizer-ci.com/g/moisespontes/view)
[![Total Downloads](https://img.shields.io/packagist/dt/devpontes/view.svg?style=flat-square)](https://packagist.org/packages/devpontes/view)

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
"devpontes/view": "3.0.*"
```

or run

```bash
composer require devpontes/view
```

## Documentation

##### To use the View you need to define the path for the views folder and optionally the path for the head, header, aside and footer files to dynamically use the template

1. Para utilizar o View você precisa definir o caminho para a pasta de views e de forma opcional o caminho dos arquivos de head, header, aside e footer para usar dinamicamente um template.

```php
$viewPath   = dirname(__FILE__, 1) . '/views';
$viewHead   = "/includes/head";
$viewAside  = "/includes/aside";
$viewHeader = "/includes/header";
$viewFooter = "/includes/footer";
```

##### At initialization, we need to pass the path to the views folder and the extension to the template file type as an argument

2. Na inicialização precisamos passar como argumento o caminho para a pasta de views e a extensão para o tipo de arquivo de templates.

```php
$v = new \DevPontes\View\View($viewPath, 'php');
```

##### Use modifier methods to dynamically include parts of the template. Then, use the render method passing an array of data and the selected view. For more details, see the example folder in the component directory.

3. Use os métodos modificadores para incluir dinamicamente partes do template. Em seguida, utilize o método **_render_** passando um array de dados e a view selecionada. Para mais detalhes, veja a pasta de exemplo no diretório do componente.

#### Basic usage

```php
/** set view data */
$user  = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$v = new \DevPontes\View\View($viewPath, 'php');

$v->setHead($viewHead);
$v->setAside($viewAside);
$v->setHeader($viewHeader);
$v->setFooter($viewFooter);

$v->render('home', $data);
```

#### In the template

```html
<main>
  <h5><?= "My name is {$user->name}, i am {$user->age} years" ?></h5>
</main>
```

#### Use the **_insert_** method to insert a component directly into the template

```php
<?php $this->insert('components/article') ?>
```

##### Call addAssets by injecting an Assets object to manipulate JS and CSS assets through the makeScript and makeStyle methods. You can omit addAssets if the assets are inserted in the template itself, see

4. Chame **_addAssets_** injetando um objeto de **_Assets_** para manipular os ativos de JS e CSS através dos métodos **_makeScript_** e **_makeStyle_**. Você pode omitir o **_addAssets_** caso os ativos sejam inseridos no próprio template, veja:

#### Add assets

```php
/** assets array */
$css = ['style'];
$js = ['script'];

/** soucer path */
$source = 'assets';

/** define cache */
$cache = false;

$a = new \DevPontes\View\Assets('assets', false);

$v->addAssets($a);
$v->assets->makeScript($js);
$v->assets->makeStyle($css);
```

#### Default path for styles and scripts folders (css and js). Use modifier methods to change the pattern

```php
$v->setStylePath('assets/style');
$v->setScriptPath('assets/script');
```

#### Add CSS in &lt;head&gt;

```html
<head>
  <title>View</title>
  <!-- add CSS -->
  <?= $this->
  assets->getStyles() ?>
</head>
```

#### Add JS in &lt;body&gt;

```html
<body>
  ...
  <!-- add JS -->
  <?= $this->assets->getScripts() ?>
</body>
```

## Credits

- [Moises Pontes](https://github.com/moisespontes) (Developer)

## License

The MIT License (MIT).
