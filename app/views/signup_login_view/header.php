<?php
# DON'T Remove this: Your general error will display in the: (app/log/gn_err.log).
ini_set("display_errors", 0);
ini_set("log_errors", 'On');
ini_set('error_log', '/opt/lampp/htdocs/public_html/framework-v1/app/log/php_err_gn.log');
# DON'T Remove this: Your general error will display in the: (app/log/gn_err.log).
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= URLPATH ?>public/assets/style/signup.css">
        <link rel="stylesheet" href="<?= URLPATH ?>public/assets/style/index.css">
        <script src="<?= URLPATH ?>public/assets/script/index.js" defer></script>
        <title><?= $data['title'] ?></title>
    </head>

    <body></body>

</html>
