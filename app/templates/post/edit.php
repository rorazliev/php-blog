<main class="main" role="main">
  <div class="main-inner">
    <form class="add-form" method="post" action="/edit/<?php echo $post['id']; ?>">
      <div class="form-item">
        <label class="form-label" for="title">Title</label>
        <input class="form-input" name="title" type="text" value="<?php echo htmlspecialchars($post['title'], ENT_QUOTES); ?>">
      </div>
      <div class="form-item">
        <label class="form-label" for="lead">Lead</label>
        <input class="form-input" name="lead" type="text" value="<?php echo htmlspecialchars($post['lead'], ENT_QUOTES); ?>">
      </div>
      <div class="form-item">
        <label class="form-label" for="content">Content</label>
        <textarea class="form-textarea" rows="3" name="content"><?php echo htmlspecialchars($post['content'], ENT_QUOTES); ?></textarea>
      </div>
      <div class="form-item">
        <button type="submit" class="form-button">Submit</button>
      </div>
    </form>
  </div>
</main>
