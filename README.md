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
"devpontes/view": "2.0.*"
```

or run

```bash
composer require devpontes/view
```

## Documentation

##### To use the View you need to define the path for the views folder and optionally the path for the head, header, aside and footer files to dynamically use the template

1. Para utilizar o View você precisa definir o caminho para a pasta de views e de forma opcional o caminho dos arquivos de head, header, aside e footer para usar dinamicamente o template.

```php
$viewPath   = dirname(__FILE__, 1) . '/views';
$viewHead   = "{$viewPath}/includes/head";
$viewAside  = "{$viewPath}/includes/aside";
$viewHeader = "{$viewPath}/includes/header";
$viewFooter = "{$viewPath}/includes/footer";
```

##### At initialization, we need to pass the path to the views folder and the extension to the template file type as an argument

2. Na inicialização precisamos passar como argumento o caminho para a pasta de views e a extensão para o tipo de arquivo de templates.

```php
$v = new \DevPontes\View\View($viewPath, 'php');
```

##### You can use modifier methods to dynamically include parts of the template, see

3. Você pode utilizar os métodos modificadores para incluir dinamicamente partes do template, veja:

```php
$v->setHead($viewHead);
$v->setAside($viewAside);
$v->setHeader($viewHeader);
$v->setFooter($viewFooter);
```

##### You can just use these two methods to do all the work. Call ***addAssets*** to define the JS and CSS assets, and ***render*** to render the selected view. You can omit the ***add Assets*** if the assets are inserted in the template itself, see

4. Você pode usar apenas estes dois métodos para fazer todo o trabalho. Chame ***addAssets*** para definir os ativos de JS e CSS, e ***render*** para renderizar a view selecionada. Você pode omitir o ***add Assets*** caso os ativos sejam inseridos no próprio template, veja:

#### Add assets

```php
/** assets array */
$assets['style']  = ['global', 'style'];
$assets['script'] = ['global', 'script'];

/** soucer path */
$source = 'assets';

/** define cache */
$cache = false;

$v->addAssets($source, $assets, $cache);
```

#### Render view

```php
/** set view data */
$user  = new \stdClass();
$user->name = "John Doe";
$user->age = 25;

$data['user'] = $user;

$v->render('home', $data);
```

or just

```php
$v = new \DevPontes\View\View($options);
$v->addAssets('assets', $assets);
$v->render('home', $data);
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
