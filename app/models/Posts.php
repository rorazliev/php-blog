<?php

namespace App\Models;

use App\Database\Model;

class Posts extends Model {
  /**
   * Count posts.
   *
   * @return int
   */
  public function count(): int {
    $query = 'SELECT COUNT(id) FROM posts';
    return $this->connection->statement($query)->fetchColumn();
  }
  /**
   * Get a certain post.
   *
   * @param int $postId
   * @return array
   */
  public function getPost(int $postId): array {
    $query = 'SELECT * FROM posts WHERE id = :id';
    return $this->connection->select($query, ['id' => $postId]);
  }
  /**
   * Get posts for a certain page.
   *
   * @param int $pageId
   * @return array
   */
  public function getPosts(int $pageId = 1): array {
    $query = 'SELECT * FROM posts ORDER BY id DESC LIMIT :start, :limit';
    $bindings = [
      'start' => ($pageId - 1) * 10,
      'limit' => 10
    ];
    return $this->connection->select($query, $bindings);
  }
}
