<?php
include_once 'dbconfig/connexion.php';
include_once './includes/header.php';
include_once './includes/functions/debug.php';
include_once './includes/functions/functions.php';

$pdo = connect();
if (!empty($_POST['register_btn'])) {
  $errors = [];
  if (empty($_POST['nom'])) {
    $errors['nom'] = "veuillez entrer votre nom";
  } else if (!preg_match('/^[a-zA-Z]+$/', $_POST['nom'])) {
    $errors['nom'] = "veuillez entrer un nom valide";
  }
  if (empty($_POST['prenom'])) {
    $errors['prenom'] = "veuillez entrer votre prénom";
  } else if (!preg_match('/^[a-zA-Z]+$/', $_POST['prenom'])) {
    $errors['prenom'] = "veuillez entrer un prénom valide";
  }
  if (empty($_POST['tel'])) {
    $errors['tel'] = "Vous devrez remplir le téléphone";
  } else if (!preg_match('/^[0-9]+$/', $_POST['tel'])) {
    $errors['tel'] = "Vous devrez remplir un téléphone valide";
  } else {
    $req = $pdo->prepare("SELECT id FROM users WHERE tel=?");
    $req->execute([$_POST['tel']]);
    $user = $req->fetch();
    if ($user) {
      $errors['tel'] = 'Ce téléphone existe déja';
    }
  }
  if (empty($_POST['courriel'])|| !filter_var($_POST['courriel'],FILTER_VALIDATE_EMAIL)) {
    $errors['courriel'] = "Vous devrez remplir le courriel ";
  } else {
    $req = $pdo->prepare("SELECT id FROM users WHERE courriel=?");
    $req->execute([$_POST['courriel']]);
    $user = $req->fetch();
    if ($user) {
      $errors['courriel'] = 'Ce courriel existe déja';
    }
  }
  if (empty($_POST['pswd'])) {
    $errors['pswd'] = "Vous devrez remplir le password correctement ";
  }
  if (empty($_POST['cpswd'])) {
    $errors['cpswd'] = "Vous devrez remplir la confirmation du password  ";
  } else if ($_POST['pswd'] != $_POST['cpswd']) {
    $errors['pswd'] = "Mots de passe non identiques ";
  }
  if (empty($errors)) {

    $req = $pdo->prepare("INSERT INTO users SET nom=?, prenom=?,tel=? ,courriel=?,pswd=?");
    $password = password_hash($_POST['pswd'], PASSWORD_BCRYPT);
    $req->execute([$_POST['nom'], $_POST['prenom'],$_POST['tel'] , $_POST['courriel'], $password]);
    $req2 = $pdo->prepare("SELECT * FROM users WHERE courriel=:courriel ");
    $req2->execute(['courriel' => $_POST['courriel']]);
    $user = $req2->fetch();
    set_user_session($user);
    header('Location: profil.php');
  
  }
}
// ----login ---------

if (!empty($_POST['login_btn'])) {
  $errors = [];
  if (!empty($_POST['courriel']) && !empty($_POST['pswd'])) {
    $req = $pdo->prepare("SELECT * FROM users WHERE courriel=:courriel ");
    $req->execute(['courriel' => $_POST['courriel']]);
    $user = $req->fetch();
    $user_exist = $req->rowcount();

    if ($user_exist == 1) {

      if (password_verify($_POST['pswd'], $user->pswd)) {

        set_user_session($user);
        header('Location:profil.php');
      } else {
        $errors['pswd'] = 'mot de passe incorrecte';
      }
    } else {

      $errors['courriel'] = 'compte inexistant!';
    }
  }
  if (empty($_POST['courriel'])) {
    $errors['courriel'] = 'remplir l email';
  }
  if (empty($_POST['pswd'])) {
    $errors['pswd'] = 'remplir pswd';
  }
}
?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text animate__animated animate__shakeY animate__delay-2s">Simsonne Cire présente</h1>
      <div class="row center" id="propos">
        <h5 class="header col s12 light">Sub-discombobulateur Atomique sert à nettoyer l'air
          ambiant autour d'un joueur suite à une détéléportation... Pour une sensation
          de propreté propre.</h5>
      </div>
      <div class="row center">
        <a href="#formulaire" id="download-button" class="btn-large waves-effect waves-light orange">Inscrivez vous</a>
      </div>
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">
   
      <!--   Icon Section   -->
      <div class="row">   
      <h2 class="header center orange-text">Découvrez nos produits</h2>  
          <div class="col s12 m4">
            <div class="card" id="produits">
              <div class="card-image">
                <img src="img/prod_base.jpg">
              </div>
              <div class="card-content">
                <span class="card-title">Version de base</span>
                <ul>
                  <li>Bonne pour 2 utilisations.</li>
                  <li>Attire 50% molécule atomique 15 pied.</li>
                  <li>Non modifiable.</li>
                  <li>Couleur blanche.</li>
                </ul>
              </div>
              <div class="card-action">
                <a href="#">1250,99$</a>
              </div>
            </div>
          </div>
          <div class="col s12 m4">
            <div class="card">
              <div class="card-image">
                <img src="img/pas_base.jpg">
              </div>
              <div class="card-content">
                <span class="card-title">Version pas base</span>
                <ul>
                  <li>Bonne pour 2 utilisations.</li>
                  <li>Attire 25% molécule atomique.</li>
                  <li>Monobloc et impénétrable.</li>
                  <li>Couleur pastel.</li>
                </ul>
              </div>
              <div class="card-action">
                <a href="#">3050.74$</a>
              </div>
            </div>
          </div>
          <div class="col s12 m4">
            <div class="card">
              <div class="card-image">
                <img src="img/gros_luxe.jpg">
                
              </div>
              <div class="card-content">
                <span class="card-title">Version de gros gros luxe</span>
                <ul>
                  <li>Bonne pour 2 utilisations.</li>
                  <li>N'attire aucune molécule nocive.</li>
                  <li>Monobloc et impénétrable.</li>
                  <li>Couleur rouge ou brun vif.</li>
                </ul>
              </div>
              <div class="card-action">
                <a href="#">10287.23$</a>
              </div>
            </div>
          </div>
      </div>
      
<!-- -------------------------form -->
<h2 class="header center orange-text">Commandez votre version</h2>
<div id="formulaire">
<?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
              <h5>Votre formulaire n'est pas remplis correctement</h5>
              <ul>
                <?php foreach ($errors as $error) : ?>
                  <li><?= $error; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>
<?php include_once './includes/forms.php';?>
 <!-- Blog---- -->
<h2 class="header center orange-text">Suivez toutes nos actualités</h2>
<?php include_once './includes/blog.php';
include_once './includes/footer.php';
?>

  