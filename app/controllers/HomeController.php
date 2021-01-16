<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Posts;
use App\Pagination\Paginator;
use App\View\View;

class HomeController {
  /**
   * Render an 'index' page.
   *
   * @param App\Http\Request
   * @param App\Htto\Response
   * @return void
   */
  public function index(Request $request, Response $response): void {
    $pageId = $request->parameters()['id'] ?? 1;
    $model = new Posts;
    $paginator = new Paginator($model->count(), $pageId);
    $data = [
      'pagination' => $paginator->render(),
      'posts' => $model->getPosts($pageId)
    ];
    $meta = [
      'title' => 'Homepage'
    ];
    $content = new View('home/index', $meta, $data);

    $response->setStatusCode(200);
    $response->setContent($content);
    $response->send();
  }
  /**
   * Render an 'about' page.
   *
   * @param App\Http\Request
   * @param App\Htto\Response
   * @return void
   */
  public function about(Request $request, Response $response): void {
    $content = new View('home/about', ['title' => 'About']);

    $response->setStatusCode(200);
    $response->setContent($content);
    $response->send();
  }
}
