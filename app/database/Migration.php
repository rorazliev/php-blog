<?php

namespace App\Database;

abstract class Migration {
  /**
   * The connection instance.
   *
   * @var App\Database\Connection
   */
  protected $connection;
  /**
   * Create a new migration instance.
   *
   * @return void
   */
  public function __construct() {
    $this->connection = Connection::getInstance();
  }
  /**
   * Start the migration.
   *
   * @return void
   */
  abstract function migrate(): void;
  /**
   * Create a new table.
   *
   * @param string $name
   * @return void
   */
  public function createTable(string $name): void {
    $query = "CREATE TABLE IF NOT EXISTS {$name} (id INT AUTO_INCREMENT PRIMARY KEY) ENGINE=InnoDB";
    $this->connection->statement($query);
    return;
  }
  /**
   * Drop the table.
   *
   * @param string $name
   * @return void
   */
  public function dropTable(string $name): void {
    $query = "DROP TABLE IF EXISTS {$name}";
    $this->connection->statement($query);
    return;
  }
  /**
   * Add the column.
   *
   * @param string $table
   * @param string $name
   * @param string $type
   * @return void
   */
  public function addColumn(string $table, string $name, string $type): void {
    $query = "ALTER TABLE {$table} ADD COLUMN {$name} {$type}";
    $this->connection->statement($query);
    return;
  }
  /**
   * Drop the column.
   *
   * @param string $table
   * @param string $name
   * @return void
   */
  public function dropColumn(string $table, string $name): void {
    $query = "ALTER TABLE {$table} DROP {$name}";
    $this->connection->statement($query);
    return;
  }
  /**
   * Add the index.
   *
   * @param string $table
   * @param string $name
   * @param bool $columns
   * @return void
   */
  public function addIndex(string $table, string $name, bool $columns = false): void {
    $query = "ALTER TABLE {$table} ADD INDEX {$name} ({$columns})";
    $this->connection->statement($query);
    return;
  }
  /**
   * Drop the index.
   *
   * @param string $table
   * @param string $name
   * @return void
   */
  public function dropIndex(string $table, string $name): void {
    $query = "DROP INDEX {$name} ON {$table}";
    $this->connection->statement($query);
    return;
  }
  /**
   * Add the time stamps.
   *
   * @param string $table
   * @return void
   */
  public function addTimeStamps(string $table): void {
    $this->connection->addColumn($table, 'created_at', 'DATETIME');
    $this->connection->addColumn($table, 'updated_at', 'DATETIME');
    return;
  }
}
