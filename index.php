<?php
require 'inc/Database.php';
require 'inc/routes.php';
require 'models/Stats.php';

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bienvenue dans mon site Web ! ">
    <title>BAH Mamadou</title>

    <link rel="stylesheet" href="assets/css/f1_style.css">

    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php require_once 'static/nav.php'; ?>;

<main>
  <?php
    $pageName = "Stats";
    $controller = $routes[$pageName]['controller'];
    $template = $routes[$pageName]['template'];

    require ('controllers/'.$controller.'.php');
    require ('templates/'.$template.'.php');
   ?>
</main>

<?php //require_once '../static/footer.php'; ?>

<script src="public/script.js"></script>
</body>

</html>
