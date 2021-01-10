<?php

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;
use Exception;

class Router {
  /**
   * The array of registered routes.
   *
   * @var array
   */
  protected $routes = [];
  /**
   * Create a new Router instance.
   */
  public function __construct() {
    session_start();
  }
  /**
   * Start the application.
   *
   * @return void
   */
  public function dispatch(): void {
    // Catch HTTP request, and create HTTP response.
    $request = new Request;
    $response = new Response;
    // Trying to find whether the HTTP request matches to the register routes
    // or not
    foreach ($this->routes as $route) {
      if ($route['method'] == $request->method() && preg_match($route['uri'], $request->uri(), $matches)) {
        $request->matches($matches);
        $controller = new $route['controller'];
        $controller->{$route['action']}($request, $response);
        return;
      }
    }
    // Else we display erro 404
    $response->onError(404);
    return;
  }
  /**
   * Register the GET route.
   *
   * @param string $uri
   * @param string $action
   * @return self
   */
  public function get(string $uri, string $action): self {
    $this->register('GET', $uri, $action);
    return $this;
  }
  /**
   * Register the POST route.
   *
   * @param string $uri
   * @param string $action
   * @return self
   */
  public function post(string $uri, string $action): self {
    $this->register('POST', $uri, $action);
    return $this;
  }
  /**
   * Add a new route to the collection.
   *
   * @param string $method
   * @param string $uri
   * @param string $action
   * @return void
   *
   * @throws Exception
   */
  protected function register(string $method, string $uri, string $action): void {
    // Check validation of HTTP methods.
    if (!in_array($method, ['GET', 'POST'])) {
      throw new Exception("The {$method} HTTP method is not valid");
    }
    // Make regex mask.
    $uri = '#^' . preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $uri) . '$#';
    list($controller, $action) = explode('::', $action);
    $controller = 'App\Controllers\\' . $controller;
    // If action doesn't exist, it throws an error.
    if (!method_exists($controller, $action)) {
      throw new Exception("The {$controller}->{$action} action does not exist");
    }
    $route = [
      'method'     => $method,
      'uri'        => $uri,
      'controller' => $controller,
      'action'     => $action
    ];
    // Add the route to our collection.
    array_push($this->routes, $route);
  }
}
