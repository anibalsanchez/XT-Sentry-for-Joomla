# XT Sentry for Joomla

Open-source error tracking for Joomla. An implementation of the [Sentry Client](https://github.com/getsentry/sentry-php) library for Joomla.

## Installation and configuration of Sentry

To start with the configuration, first, create a new project in Sentry and find the DSN. The URI has this format: https://24...9d@sentry.io/...s.

- Download and install this library. You can find the latest release [here](https://github.com/anibalsanchez/XT-Sentry-for-Joomla/releases).
- Create a script (sentry.php) to initialize the client and copy it to the Joomla **/cli folder**. This is a sample client initialization:

```php
defined('JPATH_SENTRY_BASE') || (define('JPATH_SENTRY_BASE', '/var/www/..../web');

require_once JPATH_SENTRY_BASE . '/libraries/xtsentry/vendor/sentry/sentry/lib/Raven/Autoloader.php';

Raven_Autoloader::register();

$client = new Raven_Client('YOUR-DSN', array('environment' => 'development'));

$error_handler = new Raven_ErrorHandler($client);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();
```

TIP: [Integrating Sentry's error handler in Joomla template error page](https://blog.anibalhsanchez.com/en/10-blogging/lost-and-found/59-integrating-sentry-s-error-handler-in-joomla-template-error-page.html)

- Finally, add the **cli/sentry.php** script to the PHP initialization following one of these methods.

1. php auto_prepend, added as auto_prepare to PHP Selector -> Options: auto_prepend_file and set the full path
1. .user.ini php auto prepend add: auto_prepend_file="/home/.../public_html/cli/sentry.php"
1. .php ini using the same auto_prepend_file
1. .htaccess : php_value auto_prepend_file /home/.../public_html/cli/sentry.php
1. index.php - include it into the first line of the Joomla! Instance (index.php), this however only works for the frontend instance Joomla! no other scripts are covered.

## Copyright & License

- Copyright (c)2007-2018 Extly, CB All rights reserved.

- Distributed under the GNU General Public License version 3 or later; see LICENSE.txt
