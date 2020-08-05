<?php
include_once 'dbconfig/connexion.php';
include_once './includes/header.php';
include_once './includes/functions/debug.php';
include_once './includes/functions/functions.php';
only_user_logged();
$pdo = connect();
$user = get_user_session();

if (!empty($_POST['confirm_btn'])) {
  $errors = [];
  $date=$_POST['date_livraison'];
  $date_cmde=strtotime($date);
  $date_courrante= time();
  if (empty($_POST['date_livraison'])) {
    $errors['date_livraison'] = "veuillez saisir une date de livraison";
  } 
  else if($date_cmde<= $date_courrante){
      $errors['date_livraison'] = "veuillez entrer une date de commande valide";
   }

  if (empty($errors)) {
    $req = $pdo->prepare("INSERT INTO commandes SET id_user=?,date_livraison=?,produit=?");
    $req->execute([$user->id, $_POST['date_livraison'], $_POST['produit']]);
  }

}
// ------ blog manipulation
if (!empty($_POST['ajout_btn'])) {
  $errors = [];
  if (empty($_POST['titre'])){
    $errors['titre'] = "veuillez entrer un titre";
  }
  if (empty($_POST['texte'])){
    $errors['texte'] = "veuillez saisir un texte";
  }
  if (empty($_POST['date_pub'])) {
    $errors['date'] = "Vous devrez remplir la date de publication ";
  } 
}
if (!empty($_POST['ajout_btn'])) {
  $errors = [];
  if (empty($_POST['titre'])){
    $errors['titre'] = "veuillez entrer un titre";
  }
  if (empty($_POST['texte'])){
    $errors['texte'] = "veuillez saisir un texte";
  }
  if (empty($_POST['date_pub'])) {
    $errors['date'] = "Vous devrez remplir la date de publication ";
  } 
 if (empty($errors)){
    $req = $pdo->prepare("INSERT INTO articles SET titre=?, date_pub=?,texte=?,auteur=?");
    $req->execute([$_POST['titre'], $_POST['date_pub'], $_POST['texte'],$user->nom]);
     header('Location: profil.php');
  }  
}
  $articles=get_article();
  $liste_articles=$articles->fetchAll();

?>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Bienvenue </h1>
      <div class="row center">
      <h2><?php echo $user->nom.' '.$user->prenom; ?></h2>
      </div>
      <br><br>

    </div>
  </div>
  
 <div class="container">
  <div class="section">

   <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
          <p>Votre formulaire n'est pas remplis correctement:</p><br>
            <ul>
              <?php foreach ($errors as $error) : ?>
              <li><?= $error; ?></li>
              <?php endforeach; ?>
            </ul>
        </div>
   <?php endif; ?>

      <p>Veuillez remplir les détails de votre commande ici:</p>
      <form id="commander" action="" method="POST">
        <fieldset>
          <label for="date_livraison">Date livraison souhaitée</label> <input class="input" id="date_livraison" type="date" name="date_livraison" value="" />
          <label for="produit">Selectionner votre produit:</label>
                <select class="form-control" name="produit" id="produit">
                  <option value="base">Version de base</option>
                  <option value="pas base">Version pas base</option>
                  <option value="luxe">Version de gros gros luxe</option>
                </select>
          <br>     
          <input name='confirm_btn' class="btn" type="submit" value="Commander">
        </fieldset>
      </form>  
  </div>
     <!-- Blog section-->
     <h2 class="header center orange-text">Blog</h2>
    
     <section id="section-accordion">
            <div class="accordion">
              <div class="acc-item">
                <h2 class="acc-head">Créer un article</h2>
                <div class="acc-content">
                <?php include_once'./includes/article_forms.php';?>
              </div>
            </div>
            
            <div class="acc-item">
                <h2 class="acc-head">Modifier Article</h2>
                <div class="acc-content">
                    <?php foreach($liste_articles as $article){ ?>
                       <ul>
                         <a href="update_article.php?id=<?php echo $article->id;?>">
                         <li><?php echo $article->titre;?></li></a>
                       </ul>
                    <?php } ?>
                </div>
              </div>
              <div class="acc-item">
                <h2 class="acc-head">Supprimer Article</h2>
                 <div class="acc-content">
                  <?php foreach($liste_articles as $article){ ?>
                   <ul>
                     <a href="delete_article.php?id=<?php echo $article->id;?>">
                     <li><?php echo $article->titre;?></li></a>
                    </ul>
                  <?php } ?>
                </div>
              </div>
          </section>        
 </div>
  <?php include_once './includes/footer.php';?>