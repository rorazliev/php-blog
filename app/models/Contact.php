<?php

namespace App\Models;

class Contact {
  /**
   * The error message.
   *
   * @var string
   */
  public $message;
  /**
   * The result of validation.
   *
   * @var bool
   */
  public $isValid;
  /**
   * The email to send a message to.
   *
   * @var string
   */
  protected $email = 'admin@localhost.com';
  /**
   * Validate post parameters.
   *
   * @param array $post
   * @return void
   */
  public function validate(array $post): void {
    $nameLen = iconv_strlen($post['name']);
    $textLen = iconv_strlen($post['text']);

    $this->isValid = true;

    if ($nameLen < 3 || $nameLen > 64) {
      $this->message = 'The name should be 3-64 characters long';
      $this->isValid = false;
    }
    if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
      $this->message = 'The email is not valid';
      $this->isValid = false;
    }
    if ($textLen < 8 || $textLen > 2000) {
      $this->message = 'The message should be 8-2000 characters long';
      $this->isValid = false;
    }
  }
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
