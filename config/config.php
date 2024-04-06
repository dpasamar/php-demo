<?php
declare(strict_types=1);

define("APP_PATH", getcwd() . '/');

const LOCAL_LOGGER_FILE_NAME = __DIR__ . '/../logs/app.log';
const LOG_FORMAT = "%datetime% > %level_name% > %message% %context% %extra%\n";
const LOG_PRINT_FORMAT = "%datetime% ; %message%\n";
const LOG_DATE_FORMAT = "%Y-%m-%d %H:%M:%S";

if (file_exists(__DIR__.'/environments/config.dev.php')) {
    require __DIR__.'/environments/config.dev.php';
}elseif (file_exists(__DIR__.'/environments/config.prod.php')) {
    require __DIR__.'/environments/config.prod.php';
}