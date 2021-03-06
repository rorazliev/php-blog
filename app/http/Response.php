<?php

namespace App\Http;

class Response {
  /**
   * The status code.
   *
   * @var int
   */
  protected $statusCode;
  /**
   * The array of headers.
   *
   * @var array
   */
  protected $headers = [];
  /**
   * The array of cookies.
   *
   * @var array
   */
  protected $cookies = [];
  /**
   * The page content.
   *
   * @var string
   */
  protected $content;
  /**
   * Create a new Response code.
   *
   * @param int $statusCode
   */
  public function __construct(int $statusCode = 200) {
    $this->statusCode = $statusCode;
  }
  /**
   * Send the HTTP response.
   *
   * @return void
   */
  public function send(): void {
    $this->sendHeaders();
    $this->sendContent();
  }
  /**
   * Send the HTTP response headers.
   *
   * @return void
   */
  protected function sendHeaders(): void {
    if (headers_sent()) {
      return;
    }
    http_response_code($this->statusCode);
    foreach ($this->headers as $name => $value) {
      header("{$name}: {$value}");
    }
    foreach ($this->cookies as $cookie) {
      extract($cookie, EXTR_OVERWRITE);
      setcookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
    }
    return;
  }
  /**
   * Send the HTTP response content.
   *
   * @return void
   */
  public function sendContent(): void {
    echo $this->content;
  }
  /**
   * Set a status code.
   *
   * @param int $statusCode
   * @return void
   */
  public function setStatusCode(int $statusCode = 200): void {
    $this->statusCode = $statusCode;
  }
  /**
   * Set a header.
   *
   * @param string $name
   * @param string $value
   * @return void
   */
  public function setHeader(string $name, string $value): void {
    $this->headers[$name] = $value;
  }
  /**
   * Set a cookie file.
   *
   * @param string $name
   * @param string $value
   * @param int $expires
   * @param string $path
   * @param string $domain
   * @param bool $secure
   * @param bool $httpOnly
   * @return void
   */
  public function setCookie(string $name, string $value = '', int $expires = 0, string $path = '', string $domain = '', bool $secure = false, bool $httpOnly = false): void {
    $cookie = [
      'name'     => $name,
      'value'    => $value,
      'expires'  => $expires,
      'path'     => $path,
      'domain'   => $domain,
      'secure'   => $secure,
      'httpOnly' => $httpOnly
    ];
    array_push($this->cookies, $cookie);
  }
  /**
   * Set a content.
   *
   * @param string $content
   * @return void
   */
  public function setContent(string $content): void {
    $this->content = $content;
  }
  /**
   * Send an error response.
   *
   * @return void
   */
  public function onError(int $code): void {
    $this->setStatusCode($code);
    ob_start();
    require_once __DIR__ . "/../templates/errors/{$code}.php";
    $this->setContent(ob_get_clean());
    $this->send();
  }
  /**
   * Redirect.
   *
   * @param string $uri
   * @return void
   */
  public function redirect(string $uri): void {
    header("Location: /{$url}");
    exit;
  }
  /**
   * Send JSON response.
   *
   * @param string $status
   * @param string $message
   * @return void
   */
  public function json(string $status, string $message): void {
    json_encode(['status' => $status, 'message' => $message]);
    exit;
  }
}
