<?php

namespace App\Migrations;

use App\Database\Migration;

class PostMigration extends Migration {
  /**
   * Migrate.
   *
   * @return void
   */
  public function migrate(): void {
    $this->addTable('posts');
    $this->addColumn('posts', 'title', 'VARCHAR(64)');
    $this->addColumn('posts', 'lead', 'VARCHAR(256)');
    $this->addColumn('posts', 'content', 'TEXT(5000)');
    return;
  }
}
