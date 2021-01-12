<?php

namespace App\Database;

use Exception;
use PDO;
use PDOStatement;

class Connection {
  /**
   * The PDO instance.
   *
   * @var PDO
   */
  protected $connection;
  /**
   * The connection instance.
   *
   * @var App\Database\Connection
   */
  protected static $instance;
  /**
   * Create a new connection instance.
   */
  protected function __construct() {
    $config = require_once __DIR__ . '/../config/database.php';
    $this->connect($config);
  }
  /**
   * Run a select query.
   *
   * @param string $query
   * @param array $bindings
   * @return array
   */
  public function select(string $query, array $bindings = []): array {
    $statement = $this->statement($query, $bindings);
    return $statement->fetchAll();
  }
  /**
   * Get the last insert ID.
   *
   * @return int
   */
  public function lastInsertId(): int {
    return $this->connection->lastInsertId();
  }
  /**
   * Create a PDO statement.
   *
   * @param string $query
   * @param array $bindings
   * @return PDOStatement
   */
  public function statement(string $query, array $bindings = []): PDOStatement {
    $statement = $this->connection->prepare($query);
    $this->bindValues($statement, $bindings);
    $statement->execute();
    return $statement;
  }
  /**
   * Create PDO connection.
   *
   * @param array $config
   * @return void
   */
  protected function connect(array $config): void {
    extract($config);
    $dsn = "mysql:host{$hostname};dbname={$database}";
    try {
      $this->connection = new PDO($dsn, $username, $password);
    }
    catch (Exception $e) {
      throw $e;
    }
  }
  /**
   * Bind values to a given query.
   *
   * @param PDOStatement $statement
   * @param array $bindings
   * @return void
   */
  protected function bindValues(PDOStatement $statement, array $bindings = []): void {
    foreach ($bindings as $key => $value) {
      $statement->bindValue(
        is_string($key) ? $key : $key + 1,
        $value,
        is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR
      );
    }
  }
  /**
   * Get the instance of connection class.
   *
   * @return App\Database\Connection
   */
  public static function getInstance(): Connection {
    if (!isset(Connection::$instance)) {
      Connection::$instance = new static;
    }
    return Connection::$instance;
  }
}
