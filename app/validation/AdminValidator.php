<?php

namespace App\Validation;

class AdminValidator {
  /**
   * Validate credentials.
   *
   * @param array $post
   * @return void
   */
  public function validate(array $post): void {
    $config = require_once __DIR__ . '/../config/admin.php';

    if ($config['username'] != $post['username'] || $config['password'] != $post['password']) {
      $this->message = 'Username or password is incorrect';
      $this->isValid = false;
    }
    else {
      $this->isValid = true;
    }
  }
}
