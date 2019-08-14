<?php

use Slim\App;

//phpinfo();

require __DIR__ . '/../vendor/autoload.php';

$settings = require __DIR__ . '/../app/settings.php';

$app = new App(['settings' => $settings]);

require __DIR__ . '/../app/services.php';

require __DIR__ . '/../app/routes.php';

require __DIR__ . '/../app/functions.php';

$app->run();

