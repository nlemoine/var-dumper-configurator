# Symfony Var Dumper Configurator

VarDumper component has some nice features when used with the complete Symfony stack. However, those features are lost or tedious to configure application wide when using in standalone mode.

This package aims to provide a simple way to configure these options such as `theme` and `fileLinkFormat` which puts links on dumped objects that directly open your favorite IDE.

## Usage

Install the package:

```bash
composer req hellonico/var-dumper-configurator
```

The component is automatically configured with environment variables:

If you're a `.env` file:
```env
VAR_DUMPER_THEME=light
VAR_DUMPER_IDE=vscode
```

Or in pure PHP:

```php
$_SERVER['VAR_DUMPER_THEME'] = 'light':
$_SERVER['VAR_DUMPER_IDE'] = 'vscode';
// OR
putenv('VAR_DUMPER_THEME=light'):
putenv('VAR_DUMPER_IDEvscode');
```

**⚠️ Put those lines BEFORE requiring your `vendor/autoload.php` file.**

You can also call the `VarDumperConfigurator::configure` method yourself.

```php
HelloNico\VarDumperConfigurator\VarDumperConfigurator::configure('vscode', 'light');
```

### IDE supported

Check the Symfony docs for a full list of supported IDE: https://symfony.com/doc/current/reference/configuration/framework.html#ide
