<?php 
if(session_status()==PHP_SESSION_NONE){
  session_start();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Simsonne Cire - Sub-discombobulateur Atomique</title>

  <!-- CSS  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"> LOGO

    
    </a>
      <ul class="right hide-on-med-and-down">
        <li class="home"><a href="index.php">A propos-nous</a></li>
        <li><a href="#produits">Nos Produits</a></li>
        <li><a href="#blog">Blog</a></li>
        <?php if(isset($_SESSION['auth'])): ?>
          <li><a href="profil.php">Mon Compte</a></li>
          <li><a class="btn" href="logout.php">Logout</a></li>
          <?php else:?>
          <li><a href="#formulaire" class="active">Login</a></li>
          <?php endif;?>

      </ul>

      <ul id="nav-mobile" class="sidenav">
      <li class="home"><a href="#propos">A propos</a></li>
        <li><a href="#produits">Nos Produits</a></li>
        <li><a href="#blog">Blog</a></li>
        <?php if(isset($_SESSION['auth'])): ?>
          <li><a href="profil.php">Mon Compte</a></li>
          <li><a class="btn" href="logout.php">Logout</a></li>
          <?php else:?>
        <li><a href="#formulaire" class="active">Login</a></li>
          <?php endif;?>
      </ul>
      <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
  </nav>