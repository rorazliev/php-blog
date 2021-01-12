<?php

namespace App\View;

class View {
  /**
   * The HTML string of content.
   *
   * @var string
   */
  protected $page;
  /**
   * Create a new View instance.
   *
   * @param string $view
   * @param array $data
   */
  public function __construct(string $view, array $meta = [], array $data = [], string $layout = 'default') {
    $layout = __DIR__ . "/../templates/layouts/{$layout}.php";
    $view = __DIR__ . "/../templates/{$view}.php";
    $content = $this->buffer($view, $data);
    $meta['content'] = $content;
    $this->page = $this->buffer($layout, $meta);
  }
  /**
   * Return a page content as string.
   *
   * @return string
   */
  public function __toString(): string {
    return $this->page;
  }
  /**
   * Buffer including files.
   *
   * @param string $path
   * @param array|string $data
   * @return string
   */
  protected function buffer(string $path, $data): string {
    extract($data, EXTR_SKIP);
    ob_start();
    require $path;
    return ob_get_clean();
  }
}
