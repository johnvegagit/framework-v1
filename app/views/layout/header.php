<?php
function output_username()
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
        <div class="collapse navbar-collapse navbar-collapse-me" id="navbarNav">
          <ul class="navbar-nav">
            <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="home">Home</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link" href="' . URLPATH . 'user">Users</a></li> -->
            <li class="nav-item"><a class="nav-link" href="' . URLPATH . 'login">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="' . URLPATH . 'signup">Signup</a></li>
          </ul>
        </div>
        ';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?= URLPATH ?>public/assets/style/index.css">
  <script src="<?= URLPATH ?>public/assets/script/index.js" defer></script>
  <title><?= $data['title'] ?></title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?= URLPATH ?>">Home</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?= output_username(); ?>
    </div>

  </nav>