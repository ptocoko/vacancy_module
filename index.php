<?php

declare(strict_types=1);

use App\Core\Routes;
use Symfony\Component\Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Core/settings.php';

$dotEnv = new Dotenv();
$dotEnv->load(__DIR__ . '/.env');


Routes::init();
