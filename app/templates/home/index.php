<main class="main" role="main">
  <div class="main-inner">
    <?php if (empty($posts)): ?>
      <p>No Post Found</p>
    <?php else: ?>
      <?php foreach ($posts as $post): ?>
        <article class="post">
          <h2>
            <?php echo $post['title']; ?>
          </h2>
          <p>
            <?php echo $post['lead']; ?>
          </p>
          <nav class="post-nav">
            <ul>
              <?php if(isset($_SESSION['admin'])): ?>
              <li>
                <a class="post-edit" href="/edit/<?php echo $post['id']; ?>">Edit</a>
              </li>
              <li>
                <a class="post-delete" href="/delete/<?php echo $post['id']; ?>">Delete</a>
              </li>
              <?php endif; ?>
              <li>
                <a href="/post/<?php echo $post['id']; ?>">Read</a>
              </li>
            </ul>
          </nav>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
    <div class="pagination-container">
      <?php echo $pagination; ?>
    </div>
  </div>
</main>
