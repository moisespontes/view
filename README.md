# View by @Devpontes

[![Maintainer](https://img.shields.io/badge/maintainer-@moisespontes-blue.svg?style=flat-square)](https://github.com/moisespontes)
[![Source Code](https://img.shields.io/badge/source-moisespontes/view-blue.svg?style=flat-square)](https://github.com/moisespontes/view)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/devpontes/view.svg?style=flat-square)](https://packagist.org/packages/devpontes/view)
[![Latest Version](https://img.shields.io/github/release/moisespontes/view.svg?style=flat-square)](https://github.com/moisespontes/view/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/moisespontes/view.svg?style=flat-square)](https://scrutinizer-ci.com/g/moisespontes/view)
[![Quality Score](https://img.shields.io/scrutinizer/g/moisespontes/view.svg?style=flat-square)](https://scrutinizer-ci.com/g/moisespontes/view)
[![Total Downloads](https://img.shields.io/packagist/dt/devpontes/view.svg?style=flat-square)](https://packagist.org/packages/devpontes/view)

## About View componet

##### View is a simple component for rendering templates with native PHP.

View é um componente simples para renderização de templates com PHP nativo.

### Highlights

- Renderização simples de templates. (simple rendering of templates)
- Controle dinâmico de ativos de JS e CSS. (dynamic Control of JS and CSS Assets)
- Controle dinâmico do template HTML. (dynamic control of the HTML template)

## Installation

View is available via Composer:

```bash
"devpontes/view": "4.0.*"
```

or run

```bash
composer require devpontes/view
```

## Documentation

##### To use View you need to define the path to the views folder.

1. Para utilizar o View você precisa definir o caminho para a pasta de views.

```php
$viewPath = 'views';
```

##### At initialization, we need to pass the path to the views folder and the extension to the template file type as an argument.

2. Na inicialização precisamos passar como argumento o caminho para a pasta de views e a extensão para o tipo de arquivo de templates.

```php
$v = new \DevPontes\View\View($viewPath, 'php');
```

##### Use modifier methods to dynamically include parts of the template. Then, use the render method passing an array of data and the selected view. You can use either the slash (/) or the period (.) as a directory separator. For more details, see the example folder in the component directory.

3. Use os métodos modificadores para incluir dinamicamente partes do template. Em seguida, utilize o método **_render_** passando um array de dados e a view selecionada. Você pode usar tanto a barra (/), quanto o ponto(.), como separador de diretórios. Para mais detalhes, veja a pasta de exemplo no diretório do componente.

#### Basic usage

```php
/** set view data */
$user  = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$v = new \DevPontes\View\View($viewPath, 'php');

$v->setHead('includes.head');
$v->setAside('includes.aside');
$v->setHeader('includes.header');
$v->setFooter('includes.footer');

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

#### The default path for styles and scripts folders (css and js). Use modifier methods to change the pattern

- O caminho padrão para pastas de estilos e scripts (css e js). Use métodos modificadores para alterar o padrão.

```php
$v->setStylePath('style');
$v->setScriptPath('script');
```

#### Add CSS in &lt;head&gt;

```html
<head>
  <title>View</title>
  <!-- add CSS -->
  <?= $this->assets->getStyles() ?>
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
