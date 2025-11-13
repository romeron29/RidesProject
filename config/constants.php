<?php
/**
 * Calculate a sensible BASE_URL so views can reference /public paths correctly
 * Works on localhost, subfolders and tunnelling services (ngrok) because it
 * uses the current request host and script path.
 */
// detect protocol
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? 80) == 443;
$protocol = $isHttps ? 'https://' : 'http://';

// dirname of entry script (usually /first_project)
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? '/'), '/\\');

// if scriptDir is root, make it empty string so BASE_URL becomes protocol+host+'/'
$path = $scriptDir === '' || $scriptDir === '/' ? '' : $scriptDir;

define('BASE_URL', $protocol . ($_SERVER['HTTP_HOST'] ?? 'localhost') . $path . '/');
// Backwards-compatible constant used elsewhere
define('APP_BASE_PATH', $path . '/');
?>