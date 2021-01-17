<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Validation\AdminValidator;
use App\View\View;

class AdminController {
  /**
   *
   *
   *
   */
  public function loginPage(Request $request, Response $response): void {
    if ($request->isLoggedIn()) {
      $response->redirect('/');
      return;
    }
    $content = new View('admin/login', ['title' => 'Login']);
    $response->setStatusCode(200);
    $response->setContent($content);
    $response->send();
  }
  /**
   *
   *
   *
   */
  public function login(Request $request, Response $response): void {
    if ($request->isLoggedIn()) {
      $response->redirect('/');
      return;
    }
    $validator = new AdminValidator;
    $validator->validate($request->post());
    if (!$validator->isValid()) {
      $response->json('error', $validator->message());
    }
    else {
      $_SESSION['admin'] = true;
      $response->redirect('/');
    }
  }
  /**
   *
   *
   *
   */
  public function logout(Request $request, Response $response): void {
    unset($_SESSION['admin']);
    $response->redirect('/');
  }
}
