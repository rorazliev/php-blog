<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>404 Not Found</title>
  <link rel="stylesheet" type="text/css" href="/assets/styles/style.css">
</head>
<body>
  <header class="header" role="banner">
    <div class="header-inner">
      <nav class="header-nav">
        <ul>
          <li>
            <a href="/">Home</a>
          </li>
          <li>
            <a href="/contact">Contact</a>
          </li>
          <li>
            <a href="/about">About</a>
          </li>
          <?php if (isset($_SESSION['admin'])): ?>
          <li>
            <a href="/add">Add</a>
          </li>
          <li>
            <a href="/logout">Log Out</a>
          </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>
  <main class="main" role="main">
    <div class="main-inner">
      <h2>Not Found</h2>
    </div>
  </main>
  <footer class="footer" role="contentinfo">
    <div class="footer-inner">
      <p class="copyright">2021 &copy; Ruslan Orazliev. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
