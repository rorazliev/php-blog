<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Contact;
use App\View\View;

class ContactController {
  /**
   * Render a 'contact' page.
   *
   * @param
   * @param
   * @return void
   */
  public function render(Request $request, Response $response): void {
    $content = new View('home/contact', ['title' => 'Contact Me']);

    $response->setStatusCode(200);
    $response->setContent($content);
    $response->send();
  }
  /**
   * Send an email.
   *
   * @param
   * @param
   * @return void
   */
  public function sendEmail(Request $request, Response $response): void {
    $model = new Contact;
    $model->validate($request->post());

    if ($model->isValid) {
      $model->send($request->post());
    }
    else {
      $response->json('error', $model->message);
    }
  }
}
