# ApisCP MediaWiki application

This is a sort of web app framework for building web application sfor [ApisCP](https://apiscp.com).

## Installation

```bash
cd /usr/local/apnscp
mkdir -p config/custom/webapps
git clone https://github.com/LithiumHosting/apiscp-webapp-starter config/custom/webapps/starter
./composer dump-autoload -o
```
Edit config/custom/boot.php, create if not exists:

```php
<?php
	\a23r::registerModule('starter', \LithiumHosting\WebApps\Starter\Starter_Module::class);
	\Module\Support\Webapps::registerApplication('starter', \LithiumHosting\WebApps\Starter\Handler::class);
```

Then refresh the web apps
```bash
cpcmd webapp:refresh-apps
```

Voila!

## Learning more
All third-party documentation is available via [docs.apiscp.com](https://docs.apiscp.com/admin/webapps/Custom/).
