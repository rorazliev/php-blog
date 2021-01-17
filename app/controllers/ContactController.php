<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Models\Contact;
use App\Validation\ContactValidator;
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
    $validator = new ContactValidator;
    $model = new Contact;

    $validator->validate($request->post());

    if ($validator->isValid()) {
      $model->send($request->post());
      $response->json('success', 'The email has been sent');
    }
    else {
      $response->json('error', $validator->message());
    }
  }
}
