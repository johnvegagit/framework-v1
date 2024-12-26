<?php
# DON'T Remove this: Your general error will display in the: (app/log/php_err_gn.log).
ini_set("display_errors", 0);
ini_set("log_errors", 'On');
ini_set('error_log', '/opt/lampp/htdocs/public_html/framework-v1/app/log/php_err_gn.log');
# DON'T Remove this: Your general error will display in the: (app/log/php_err_gn.log).
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= $_ENV['BASEURL'] ?>public/assets/style/index.css">
    <script src="<?= $_ENV['BASEURL'] ?>public/assets/script/index.js" defer></script>
    <title><?= $data['title'] ?></title>
  </head>

  <body>
    <header>
      <a href="<?= $_ENV['BASEURL'] ?>">
        <h1>website-name.com</h1>
      </a>

      <?php if (isset($_SESSION['customerId'])): ?>
        <div class="collapse navbar-collapse navbar-collapse-me" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item"><?= ucfirst(htmlspecialchars($_SESSION["customerName"])) . ' ' . ucfirst(htmlspecialchars($_SESSION["customerSurname"])) ?></li>
            <form class="form-logout" action="<?= $_ENV['BASEURL'] ?>logout" method="post">
              <button title="logout" type="submit" class="nav-item pl-1">
                <i class="bi bi-box-arrow-left"></i>
              </button>
            </form>
          </ul>
        </div>
      <?php else: ?>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= $_ENV['BASEURL'] ?>login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= $_ENV['BASEURL'] ?>signup">Signup</a>
          </li>
        </ul>
      <?php endif; ?>
    </header>