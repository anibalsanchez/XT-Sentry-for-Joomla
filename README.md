# XT Sentry for Joomla

Open-source error tracking for Joomla. An implementation of the [Sentry Client](https://github.com/getsentry/sentry-php) library for Joomla.

What is Sentry? [Sentry](https://sentry.io) is a Application Monitoring and Error Tracking Software.

## Installation and configuration of Sentry

To start with the configuration, first, create a new project in [Sentry's Dashboard](https://sentry.io/settings/) and find the DSN.

- Download and install this library. You can find the latest release [here](https://github.com/anibalsanchez/XT-Sentry-for-Joomla/releases).
- Create a script (sentry.php) to initialize the client and copy it to the Joomla **/cli folder**. This is a sample client initialization:

```php
<?php

# Sample: cli/sentry.php
require_once dirname(__DIR__).'/libraries/xtsentry/vendor/autoload.php';

Sentry\init(['dsn' => 'https://....@......ingest.sentry.io/....']);

```

Secondly, add the **cli/sentry.php** script to the PHP initialization following one of these methods.

- **php auto_prepend**, added as auto_prepare to PHP Selector -> Options: auto_prepend_file and set the full path
- **.user.ini** php auto prepend add:

```ini
auto_prepend_file = "/home/.../public_html/cli/sentry.php"
```

- **.php ini** using the same auto_prepend_file .htaccess:

```htaccess
php_value auto_prepend_file /home/.../public_html/cli/sentry.php
```

- **index.php** - include it into the first line of the Joomla! Instance (index.php). However only works for the frontend instance Joomla! no other scripts are covered.

```
require_once '/home/.../public_html/cli/sentry.php';
```

Finally, integrate Sentry's error handler in Joomla template error page:

TIP: [Integrating Sentry's error handler in Joomla template error page](https://blog.anibalhsanchez.com/en/10-blogging/lost-and-found/59-integrating-sentry-s-error-handler-in-joomla-template-error-page.html)

```php
// To integrate "XT Sentry for Joomla" - https://github.com/anibalsanchez/XT-Sentry-for-Joomla
if (file_exists(JPATH_SITE.'/cli/sentry.php')) {
    require_once JPATH_SITE.'/cli/sentry.php';

    if ($this->error instanceof \Throwable) {
        \Sentry\captureException($this->error);
    }
}
```

## Copyright & License

- Copyright (c) 2012-2020 Extly, CB All rights reserved.

- Distributed under the The 3-Clause BSD License; see LICENSE.txt
