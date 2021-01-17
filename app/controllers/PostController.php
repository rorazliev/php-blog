<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Admin;
use App\Models\Posts;
use App\Validation\PostValidator;
use App\View\View;

class PostController {
  /**
   * Render a certain post.
   *
   * @param App\Http\Request
   * @param App\Http\Response
   * @return void
   */
  public function getPost(Request $request, Response $response): void {
    $postId = $request->parameters()['id'];
    $model = new Posts;
    if (!$model->postExists($postId)) {
      $response->onError(404);
      return;
    }
    $post = $model->getPost($postId);
    $meta = [
      'title' => $post['title']
    ];
    $content = new View('post/post', $meta, ['post' => $post]);

    $response->setStatusCode(200);
    $response->setContent($content);
    $response->send();
  }
  /**
   *
   *
   *
   */
  public function addPostPage(Request $request, Response $response): void {
    if (!$request->isLoggedIn()) {
      $response->onError(403);
      return;
    }
    $content = new View('post/add', ['title' => 'Add Post']);

    $response->setStatusCode(200);
    $response->setContent($content);
    $response->send();
  }
  /**
   *
   *
   *
   */
  public function addPost(Request $request, Response $response): void {
    if (!$request->isLoggedIn()) {
      $response->onError(403);
      return;
    }
    $model = new Posts;
    $validator = new PostValidator;
    $validator->validate($request->post());
    if (!$validator->isValid()) {
      $response->json('error', $validator->message);
      return;
    }
    $model->addPost($request->post());
    $response->json('success', 'Post has been added');
    return;
  }
  /**
   *
   *
   *
   */
  public function editPostPage(Request $request, Response $response): void {
    if (!$request->isLoggedIn()) {
      $response->onError(403);
      return;
    }
    $postId = $request->parameters()['id'];
    $model = new Posts;
    if (!$model->postExists($postId)) {
      $response->onError(404);
      return;
    }
    $post = $model->getPost($postId);
    $meta = [
      'title' => $post['title']
    ];
    $data = [
      'post' => $post
    ];
    $content = new View('post/edit', $meta, $data);
    $response->setStatusCode(200);
    $response->setContent($content);
    $response->send();
  }
  /**
   *
   *
   *
   *
   */
  public function editPost(Request $request, Response $response): void {
    $validator = new PostValidator;
    $validator->validate($request->post());

    $postId = $request->parameters()['id'];

    if (!$validator->isValid()) {
      $response->json('error', $validator->message());
      return;
    }
    $model = new Posts;
    $model->editPost($postId, $post);
    $response->json('success', 'Saved');
  }
  /**
   *
   *
   *
   */
  public function deletePost(Request $request, Response $response): void {
    if (!$request->isLoggedIn()) {
      $response->onError(403);
      return;
    }
    $model = new Posts;
    $postId = $request->parameters()['id'];
    if ($model->postExists($postId)) {
      $model->deletePost($postId);
    }
    $response->redirect('/');
  }
}
