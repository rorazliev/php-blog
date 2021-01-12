<?php

spl_autoload_register(function ($class) {
  $exploded = explode('\\', $class);
  $fileName = array_pop($exploded) . '.php';

  $exploded = array_map(function ($directory) {
    return strtolower($directory);
  }, $exploded);

  $imploded = implode('/', $exploded);

  if (file_exists($path = __DIR__ . '/../' . $imploded . '/' . $fileName)) {
    require_once $path;
  }
});
/**
 * OR use composer:
 *
 * require_once __DIR__ . '/../vendor/autoload.php';
 */
use App\Routing\Router;

$router = new Router;
