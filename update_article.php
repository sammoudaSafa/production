<?php
include_once'./includes/header.php';
include_once'./includes/functions/functions.php';
include_once 'dbconfig/connexion.php';

only_user_logged();
$article = get_article_by_id($_GET['id']);
$pdo = connect();
// verification des champs
if (!empty($_POST['update_btn'])) {
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
  else if (empty($errors)){
    update_article($_GET['id']);
  }
}
?>

<main>
<div class="container">  
  <div class="jumbotron">
                <h2>Modifier un Article</h2>       
          <section id="section-accordion">
          <?php include_once'./includes/errors.php';?>
            <form name="article_update" action="" method="POST">
              <fieldset>
                  <label for="titre"><strong> Titre:</strong></label><br>
                  <input class="input" type="text" name="titre" value="<?php echo $article->titre ?>"><br>
                  <label for="date"><strong>Date publication:</strong></label><br>
                  <input class="input" type="date" id="date_pub" name="date_pub" " value="<?php echo $article->date_pub ?>"><br> 
                  <label for="contenu"><strong>Texte:</strong></label><br>
                  <textarea class="input" type="text" id="texte" name="texte"  cols="30" rows="10" ><?php echo $article->texte ?></textarea><br>
                </fieldset>
              <input name='update_btn' class="btn" type="submit" value="Mettre à jour"><br>
            </form>
          </section>           
      </div>
  </div>
</div>
</main>
  <?php include_once'./includes/footer.php';?>
