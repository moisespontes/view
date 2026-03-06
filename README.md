# View by @Devpontes

[![Maintainer](https://img.shields.io/badge/maintainer-@moisespontes-blue.svg?style=flat-square)](https://github.com/moisespontes)
[![Source Code](https://img.shields.io/badge/source-moisespontes/view-blue.svg?style=flat-square)](https://github.com/moisespontes/view)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/devpontes/view.svg?style=flat-square)](https://packagist.org/packages/devpontes/view)
[![Latest Version](https://img.shields.io/github/release/moisespontes/view.svg?style=flat-square)](https://github.com/moisespontes/view/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build](https://img.shields.io/scrutinizer/build/g/moisespontes/view.svg?style=flat-square)](https://scrutinizer-ci.com/g/moisespontes/view)
[![Quality Score](https://img.shields.io/scrutinizer/g/moisespontes/view.svg?style=flat-square)](https://scrutinizer-ci.com/g/moisespontes/view)
[![Total Downloads](https://img.shields.io/packagist/dt/devpontes/view.svg?style=flat-square)](https://packagist.org/packages/devpontes/view)

## 📖 Sobre o Componente

**View** é um componente leve e simples para renderização de templates com **PHP nativo**, ideal para projetos que buscam uma solução minimalista sem dependências pesadas.

| EN                                                                  | PT                                                                          |
| ------------------------------------------------------------------- | --------------------------------------------------------------------------- |
| View is a simple component for rendering templates with native PHP. | View é um componente simples para renderização de templates com PHP nativo. |

## ✨ Principais Características

- 🎨 **Renderização simples de templates** - Use PHP puro sem sintaxe especial
- 🎯 **Controle dinâmico de ativos (JS e CSS)** - Gerencie seus assets facilmente e com versionamento automático
- 🏗️ **Controle dinâmico do layout HTML** - Use componentes modulares para head, header, aside e footer
- 📦 **PHP 8.0+** - Escrito com as últimas features do PHP
- 🚀 **Zero dependencies** - Nenhuma dependência externa
- 🔄 **Fluent Interface** - API intuitiva e encadeável

## 📋 Sumário

- [Instalação](#-instalação)
- [Uso Rápido](#-uso-rápido)
- [Documentação Completa](#-documentação-completa)
  - [Classe View](#classe-view)
  - [Classe Assets](#classe-assets)
- [Estrutura de Pastas](#-estrutura-de-pastas-recomendada)
- [Exemplos Práticos](#-exemplos-práticos)
- [Tratamento de Erros](#-tratamento-de-erros)
- [Dicas e Boas Práticas](#-dicas-e-boas-práticas)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🚀 Instalação

### Via Composer

```bash
composer require devpontes/view
```

Ou adicione manualmente ao seu `composer.json`:

```json
{
  "require": {
    "devpontes/view": "4.0.*"
  }
}
```

Depois execute:

```bash
composer install
```

---

## ⚡ Uso Rápido

### 1. Defina o caminho das views

```php
$viewPath = 'views';
```

### 2. Inicialize o View

```php
$v = new \DevPontes\View\View($viewPath, 'php');
```

### 3. Defina os componentes do layout

```php
$v->setHead('includes.head');
$v->setHeader('includes.header');
$v->setAside('includes.aside');
$v->setFooter('includes.footer');
```

### 4. Prepare seus dados e renderize

```php
$data = ['user' => $user, 'posts' => $posts];
$v->render('home', $data);
```

---

## 📚 Documentação Completa

### Classe View

A classe `View` é responsável por renderizar os templates e gerenciar o layout da aplicação.

#### Construtor

```php
$v = new \DevPontes\View\View(string $viewPath, string $extension)
```

| Parâmetro    | Tipo   | Descrição                                         |
| ------------ | ------ | ------------------------------------------------- |
| `$viewPath`  | string | Caminho para a pasta contendo os arquivos de view |
| `$extension` | string | Extensão dos arquivos de template (padrão: `php`) |

**Exemplo:**

```php
$v = new \DevPontes\View\View('src/views', 'php');
```

---

#### Métodos de Configuração do Layout

##### `setHead(string $head): View`

Define o arquivo a ser incluído no início do template (dentro da tag `<head>`).

```php
$v->setHead('includes.head');
// Carregará: views/includes/head.php
```

##### `setHeader(string $header): View`

Define o arquivo de cabeçalho da página.

```php
$v->setHeader('includes.header');
// Carregará: views/includes/header.php
```

##### `setAside(string $aside): View`

Define o arquivo da barra lateral/menu.

```php
$v->setAside('includes.aside');
// Carregará: views/includes/aside.php
```

##### `setFooter(string $footer): View`

Define o arquivo de rodapé da página.

```php
$v->setFooter('includes.footer');
// Carregará: views/includes/footer.php
```

**Todos os métodos retornam `View`, permitindo encadeamento:**

```php
$v->setHead('includes.head')
  ->setHeader('includes.header')
  ->setAside('includes.aside')
  ->setFooter('includes.footer');
```

---

#### Método de Renderização

##### `render(string $view, array $data = []): void`

Renderiza um template com os dados fornecidos. O layout é aplicado conforme definido nos métodos anteriores.

```php
$v->render('home', [
    'user' => $user,
    'posts' => $posts,
    'settings' => $config
]);
```

**Ordem de renderização:**

1. Head
2. Header
3. Aside
4. View principal
5. Footer

---

#### Métodos Utilitários

##### `insert(string $view): void`

Insere um componente diretamente dentro de uma view. Útil para componentes reutilizáveis.

```php
<?php $this->insert('components.article') ?>
```

Esta linha carregará o arquivo `views/components/article.php`.

##### `data(): object`

Retorna os dados passados para o template convertidos para `stdClass`.

```php
$data = $this->data();
echo $data->user->name;
```

##### `__get($name)` e `__isset($name)`

Permite acessar dados como propriedades da view.

```php
// Em vez de fazer isso:
$this->data()['user']

// Você pode fazer isto:
$this->user
```

---

### Classe Assets

A classe `Assets` gerencia o carregamento dinâmico de arquivos CSS e JavaScript com suporte a versionamento automático para controle de cache.

#### Construtor

```php
$a = new \DevPontes\View\Assets(string $src, bool $cache = true)
```

| Parâmetro | Tipo   | Padrão | Descrição                                      |
| --------- | ------ | ------ | ---------------------------------------------- |
| `$src`    | string | —      | Caminho raiz para a pasta de assets            |
| `$cache`  | bool   | `true` | Ativar caching (true) ou versionamento (false) |

**Exemplos:**

```php
// COM caching (produção)
$a = new \DevPontes\View\Assets('assets', true);
// Gera: <link rel="stylesheet" href="assets/css/style.css">

// SEM caching (desenvolvimento)
$a = new \DevPontes\View\Assets('assets', false);
// Gera: <link rel="stylesheet" href="assets/css/style.css?v=1709632527">
```

---

#### Métodos de CSS

##### `makeStyle(array $css): Assets`

Define quais arquivos CSS devem ser carregados.

```php
$css = ['bootstrap', 'style', 'responsive'];
$a->makeStyle($css);
```

**Estrutura esperada:**

```
assets/
├── css/
│   ├── bootstrap.css
│   ├── style.css
│   └── responsive.css
```

**HTML gerado:**

```html
<link rel="stylesheet" href="assets/css/bootstrap.css" />
<link rel="stylesheet" href="assets/css/style.css" />
<link rel="stylesheet" href="assets/css/responsive.css" />
```

##### `getStyles(): string`

Retorna o HTML com as tags `<link>` de CSS.

```html
<head>
  <title>Meu Site</title>
  <?= $this->assets->getStyles() ?>
</head>
```

##### `setStylePath(string $stylePath): Assets`

Customiza o caminho padrão para arquivos CSS (padrão: `assets/css`).

```php
$a->setStylePath('vendor/styles');
// Muda para: assets/vendor/styles/
```

---

#### Métodos de JavaScript

##### `makeScript(array $js): Assets`

Define quais arquivos JavaScript devem ser carregados.

```php
$js = ['jquery', 'popper', 'bootstrap', 'app'];
$a->makeScript($js);
```

**Estrutura esperada:**

```
assets/
├── js/
│   ├── jquery.js
│   ├── popper.js
│   ├── bootstrap.js
│   └── app.js
```

**HTML gerado:**

```html
<script src="assets/js/jquery.js"></script>
<script src="assets/js/popper.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/app.js"></script>
```

##### `getScripts(): string`

Retorna o HTML com as tags `<script>`.

```html
<body>
  <!-- conteúdo -->
  <?= $this->assets->getScripts() ?>
</body>
```

##### `setScriptPath(string $scriptPath): Assets`

Customiza o caminho padrão para arquivos JavaScript (padrão: `assets/js`).

```php
$a->setScriptPath('vendor/scripts');
// Muda para: assets/vendor/scripts/
```

---

#### Integração com View

```php
$a = new \DevPontes\View\Assets('assets', false);
$v = new \DevPontes\View\View('views', 'php');

// Adicionar assets ao view
$v->addAssets($a);

// Configurar assets
$v->assets->makeStyle(['bootstrap', 'style']);
$v->assets->makeScript(['jquery', 'app']);

// Agora você pode usar $this->assets nos templates
```

---

## 📁 Estrutura de Pastas Recomendada

```
project/
├── vendor/                    # Dependências do Composer
├── assets/                    # Arquivos estáticos
│   ├── css/
│   │   ├── bootstrap.css
│   │   └── style.css
│   ├── js/
│   │   ├── bootstrap.js
│   │   └── app.js
│   └── images/
├── views/                     # Templates
│   ├── includes/              # Componentes do layout
│   │   ├── head.php
│   │   ├── header.php
│   │   ├── aside.php
│   │   └── footer.php
│   ├── components/            # Componentes reutilizáveis
│   │   ├── article.php
│   │   ├── card.php
│   │   └── modal.php
│   ├── home.php               # Página principal
│   ├── about.php              # Página about
│   └── contact.php            # Página de contato
├── public/
│   └── index.php              # Ponto de entrada da aplicação
└── composer.json
```

---

## 💡 Exemplos Práticos

### Exemplo 1: Setup Básico Completo

```php
<?php
require "vendor/autoload.php";

// Dados da aplicação
$user = new \stdClass();
$user->name = "John Doe";
$user->email = "john@example.com";

$data = [
    'user' => $user,
    'title' => 'Welcome to My Site'
];

// Inicializar View
$v = new \DevPontes\View\View('views', 'php');

// Configurar layout
$v->setHead('includes.head')
  ->setHeader('includes.header')
  ->setAside('includes.aside')
  ->setFooter('includes.footer');

// Renderizar
$v->render('home', $data);
?>
```

### Exemplo 2: Com Controle de Assets

```php
<?php
require "vendor/autoload.php";

// Dados
$data = ['products' => $products];

// Assets
$a = new \DevPontes\View\Assets('assets', false); // false = versionamento para dev
$a->makeStyle(['bootstrap', 'style', 'theme']);
$a->makeScript(['jquery', 'bootstrap', 'app']);

// View
$v = new \DevPontes\View\View('views', 'php');
$v->addAssets($a);
$v->setHead('includes.head')
  ->setHeader('includes.header')
  ->setFooter('includes.footer');

// Renderizar
$v->render('products.list', $data);
?>
```

### Exemplo 3: Layout sem alguns componentes

```php
<?php
$v = new \DevPontes\View\View('views', 'php');

// Renderizar apenas com header e footer
$v->setHeader('includes.header')
  ->setFooter('includes.footer');

// Aside não é definido, então não aparecerá
$v->render('page.login', $data);
?>
```

### Exemplo 4: Templates com Componentes

**views/products.php:**

```php
<main class="products">
    <h1><?= $title ?></h1>

    <div class="products-grid">
        <?php foreach ($products as $product): ?>
            <?php $this->insert('components.product-card'); ?>
        <?php endforeach; ?>
    </div>
</main>
```

**views/components/product-card.php:**

```php
<div class="card">
    <img src="<?= $product->image ?>" alt="<?= $product->name ?>">
    <h3><?= $product->name ?></h3>
    <p>R$ <?= number_format($product->price, 2, ',', '.') ?></p>
    <a href="/product/<?= $product->id ?>">View Details</a>
</div>
```

### Exemplo 5: Renderização Condicional

**index.php:**

```php
<?php
$v = new \DevPontes\View\View('views', 'php');

if (is_admin()) {
    // Layout para admin
    $v->setHeader('includes.admin-header')
      ->setAside('includes.admin-sidebar');
} else {
    // Layout para usuário comum
    $v->setHeader('includes.header')
      ->setAside('includes.sidebar');
}

$v->setHead('includes.head')
  ->setFooter('includes.footer');

$v->render('dashboard', $data);
?>
```

---

## ⚠️ Tratamento de Erros

O componente inclui uma classe customizada para tratamento de erros: `ErrorRender`.

```php
<?php

namespace DevPontes\View\Exception;

use Exception;

class ErrorRender extends Exception
{
    public function __construct(string $message, int $code = 1, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
```

---

## 🎯 Dicas e Boas Práticas

### ✅ Faça:

1. **Use nomes descritivos para views:**

   ```php
   $v->render('users.profile', $data);      // ✓ Bom
   $v->render('page', $data);               // ✗ Vago
   ```

2. **Organize componentes em pastas:**

   ```
   views/
   ├── components/
   │   ├── forms/
   │   │   ├── login.php
   │   │   └── register.php
   │   ├── modals/
   │   │   └── confirm.php
   │   └── cards/
   │       └── user.php
   ```

3. **Use versionamento em desenvolvimento:**

   ```php
   $cache = (getenv('APP_ENV') === 'production');
   $a = new \DevPontes\View\Assets('assets', $cache);
   ```

4. **Valide dados antes de renderizar:**

   ```php
   if (!isset($data['user'])) {
       throw new Exception('User data is required');
   }
   $v->render('profile', $data);
   ```

5. **Reutilize componentes:**
   ```php
   // Em vez de duplicar código, use insert()
   <?php $this->insert('components.alert'); ?>
   ```

### ❌ Evite:

1. **Lógica pesada nos templates:**

   ```php
   // ✗ Evite
   <?php
       $users = $db->query("SELECT * FROM users")->fetch();
       foreach ($users as $user) { ... }
   ?>

   // ✓ Faça isso no controller
   $users = User::all();
   $v->render('users', ['users' => $users]);
   ```

2. **Acessar variáveis globais diretamente:**

   ```php
   // ✗ Evite
   <?= $_GET['id'] ?>

   // ✓ Passe pelo array data
   $v->render('view', ['id' => $_GET['id'] ?? null]);
   ```

3. **Misturar múltiplas extensões:**
   ```php
   // Escolha uma e mantenha consistente
   new \DevPontes\View\View('views', 'php');
   ```

---

## 🧪 Testando o Exemplo

O repositório inclui um exemplo funcional em `example/`:

```bash
cd example
php -S localhost:8000
# Acesse http://localhost:8000
```

**Arquivos do exemplo:**

- `example/index.php` - Ponto de entrada
- `example/views/home.php` - Template principal
- `example/views/includes/` - Componentes do layout
- `example/views/components/` - Componentes reutilizáveis
- `example/assets/` - Assets (CSS e JS)

---

## 🤝 Contributing

Contribuições são bem-vindas! Por favor:

1. Faça um fork do repositório
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

---

## 📄 License

The MIT License (MIT). See the [LICENSE](LICENSE) file for more information.

---

## 👨‍💻 Autor

**Moises Pontes** - [@moisespontes](https://github.com/moisespontes)

---

## 📞 Suporte

Para reportar bugs ou sugerir melhorias, abra uma [issue](https://github.com/moisespontes/view/issues) no GitHub.

---

**⭐ Se achou útil, deixe uma star!** 🌟
