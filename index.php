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

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<?php require_once 'static/header.php'; ?>

<main>
  <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'Home' ;

    if(isset($routes[$page])) {
      $controller = $routes[$page]['controller'];
      $template = $routes[$page]['template'];

      require ('controllers/'.$controller.'.php');
      require ('templates/'.$template.'.php');
      require 'templates/popup.php';
    }

   ?>
</main>

<?php require_once 'static/footer.php'; ?>
</body>

    <!-- scroll reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- typed js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <!-- custom js -->

<script src="public/script.js"></script>


</html>
