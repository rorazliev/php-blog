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
   * Check whether a post exists or not.
   *
   * @param int $postId
   * @return bool
   */
  public function postExists(int $postId): bool {
    $query = "SELECT id FROM posts WHERE id = :id";
    return $this->connection->statement($query, ['id' => $postId])->fetchColumn();
  }
  /**
   * Get a certain post.
   *
   * @param int $postId
   * @return array
   */
  public function getPost(int $postId): array {
    $query = 'SELECT * FROM posts WHERE id = :id';
    $records = $this->connection->select($query, ['id' => $postId]);
    return array_shift($records);
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
  /**
   *
   *
   *
   */
  public function addPost(array $post): int {
    $query = 'INSERT INTO posts VALUES (:id, :title, :lead, :content)';
    $bindings = [
      'id' => '',
      'title' => $post['title'],
      'lead' => $post['lead'],
      'content' => $post['content']
    ];
    $this->connection->statement($query, $bindings);
    return $this->connection->lastInsertId();
  }
  /**
   *
   *
   *
   */
  public function editPost(int $postId, array $post): void {
    $query = 'UPDATE posts SET title = :title, lead = :lead, content = :content WHERE id = :id';
    $bindings = [
      'id' => $postId,
      'title' => $post['title'],
      'lead' => $post['lead'],
      'content' => $post['content']
    ];
    $this->connection->statement($query, $bindings);
  }
  /**
   *
   *
   *
   */
  public function deletePost(int $postId): void {
    $query = 'DELETE FROM posts WHERE id = :id';
    $bindings = [
      'id' => $postId
    ];
    $this->connection->statement($query, $bindings);
  }
}
