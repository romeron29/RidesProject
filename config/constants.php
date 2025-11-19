<?php

$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? 80) == 443;
$protocol = $isHttps ? 'https://' : 'http://';
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/\\');
$path = $scriptDir === '' || $scriptDir === '/' ? '' : $scriptDir;
define('BASE_URL', $protocol . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $path . '/');
define('APP_BASE_PATH', $path . '/');
?>