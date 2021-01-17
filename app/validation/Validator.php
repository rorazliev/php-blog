<?php

namespace App\Validation;

abstract class Validator {
  /**
   *
   *
   * @var string
   */
  protected $message;
  /**
   *
   *
   * @var bool
   */
  protected $isValid;
  /**
   *
   *
   * @param array $post
   * @return void
   */
  abstract public function validate(array $post);
  /**
   *
   *
   * @return string
   */
  public function message(): string {
    return $this->message;
  }
  /**
   *
   *
   * @return bool
   */
  public function isValid(): bool {
    return $this->isValid;
  }
}
