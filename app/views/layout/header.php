<?php
function output_header_menu()
{
  if (isset($_SESSION['user_id'])) {
    echo '
        <div class="collapse navbar-collapse navbar-collapse-me" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">' . $_SESSION["user_name"] . ' ' . $_SESSION["user_surname"] . '</li>
            <form class="form-logout" action="' . URLPATH . 'logout" method="post">
              <button type="submit" class="nav-item pl-1"><i class="bi bi-box-arrow-in-right"></i></button>
            </form>
          </ul>
        </div>
        ';
  } else {
    echo '
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="' . URLPATH . 'login">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="' . URLPATH . 'signup">Signup</a></li>
        </ul>
        ';
  }
}

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
  <link rel="stylesheet" href="<?= URLPATH ?>public/assets/style/var_set.css">
  <link rel="stylesheet" href="<?= URLPATH ?>public/assets/style/signup.css">
  <link rel="stylesheet" href="<?= URLPATH ?>public/assets/style/index.css">
  <script src="<?= URLPATH ?>public/assets/script/index.js" defer></script>
  <title><?= $data['title'] ?></title>
</head>

<body>
  <header>
    <a href="">
      <h1>website-name.com</h1>
    </a>

    <?= output_header_menu(); ?>
  </header>