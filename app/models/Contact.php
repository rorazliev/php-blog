<?php

namespace App\Models;

use App\Database\Model;

class Contact extends Model {
  /**
   * The email to send a message to.
   *
   * @var string
   */
  protected $email = 'admin@localhost.com';
  /**
   * Send an email.
   *
   * @param array
   * @return void
   */
  public function send(array $post): void {
    mail($this->email, "{$post['name']} | {$post['email']}", $post['text']);
  }
}
