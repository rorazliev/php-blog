<?php

namespace App\Validation;

class PostValidator extends Validator {
  /**
   *
   *
   *
   */
  public function validate(array $post): void {
    $titleLen = strlen($post['title']);
    $leadLen = strlen($post['lead']);
    $contentLen = strlen($post['content']);

    $this->isValid = true;

    if ($titleLen < 3 || $titleLen > 196) {
      $this->message = '';
      $this->isValid = false;
    }
    if ($leadLen < 20 || $leadLen > 256) {
      $this->message = '';
      $this->isValid = false;
    }
    if ($contentLen < 300 || $contentLen > 5000) {
      $this->message = '';
      $this->isValid = false;
    }
  }
}
