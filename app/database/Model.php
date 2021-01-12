<?php

namespace App\Database;

abstract class Model {
  /**
   * The database connection instance.
   *
   * @var App\Database\Connection
   */
  protected $connection;
  /**
   * Create a new model instance.
   */
  public function __construct() {
    $this->connection = Connection::getInstance();
  }
}
