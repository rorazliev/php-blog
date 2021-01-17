<?php

namespace App\Validation;

class ContactValidator extends Validator {
  /**
   * Validate a given content.
   *
   * @param array
   * @return void
   */
  public function validate(array $post): void {
    $nameLen = strlen($post['name']);
    $textLen = strlen($post['text']);

    $this->isValid = true;

    if ($nameLen < 3 || $nameLen > 20) {
      $this->message = '';
      $this->isValid = false;
    }
    if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
      $this->message = '';
      $this->isValid = false;
    }
    if ($textLen < 10 || $textLen > 500) {
      $this->message = '';
      $this->isValid = false;
    }
  }
}
