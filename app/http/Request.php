<?php

namespace App\Http;

class Request {
  /**
   * The HTTP request method.
   *
   * @var string
   */
  protected $method;
  /**
   * The HTTP request URI.
   *
   * @var string
   */
  protected $uri;
  /**
   * Built-in $_POST.
   *
   * @var array
   */
  protected $post;
  /**
   * The matched parameters.
   *
   * @var array
   */
  protected $parameters;
  /**
   * The admin state.
   *
   * @var bool
   */
  protected $loggedIn;
  /**
   * Create a new Request instance.
   */
  public function __construct() {
    $this->method = $_SERVER['REQUEST_METHOD'];
    $this->uri = strtolower($_SERVER['REQUEST_URI']);
    $this->post = $_POST;
    $this->parameters = [];
    $this->loggedIn = isset($_SESSION['admin']) ? true : false;
  }
  /**
   * Get the HTTP request method.
   *
   * @param string
   */
  public function method(): string {
    return $this->method;
  }
  /**
   * Get the HTTP request URI.
   *
   * @return string
   */
  public function uri(): string {
    return $this->uri;
  }
  /**
   * Get built-in $_POST.
   *
   * @return array
   */
  public function post(): array {
    return $this->post;
  }
  /**
   * Get matched URI parameters.
   *
   * @return array
   */
  public function parameters(): array {
    return $this->parameters;
  }
  /**
   * Check whether an admin is logged in or not.
   *
   * @return bool
   */
  public function isLoggedIn(): bool {
    return $this->loggedIn;
  }
  /**
   * Filter matched parameters, and add them to the collection.
   *
   * @param array $matches
   * @return void
   */
  public function matches(array $matches = []): void {
    foreach ($matches as $key => $value) {
      if (is_string($key) && !empty($value)) {
        $this->parameters[$key] = $value;
      }
    }
  }
}
