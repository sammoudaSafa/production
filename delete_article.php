<?php
include_once'./includes/header.php';
include_once'./includes/functions/functions.php';
include_once 'dbconfig/connexion.php';

only_user_logged();
$article = get_article_by_id($_GET['id']);
if (!empty($_POST['delete_btn'])) {
    $pdo = connect();
    delete_article($_GET['id']);
}
?>

<main>
<div class="container"> 
  <div class="jumbotron">
      <h2>Supprimer un Article</h2>       
          <section id="section-accordion">
          <?php include_once'./includes/errors.php';?>
            <form name="article_update" action="" method="POST">
              <fieldset>
                  <label for="titre"><strong> Titre:</strong></label><br>
                  <input class="input" type="text" name="titre" value="<?php echo $article->titre ?>"><br>
                  <label for="date"><strong>Date publication:</strong></label><br>
                  <input class="input" type="date" id="date_pub" name="date_pub" " value="<?php echo $article->date_pub ?>"><br> 
                  <label for="contenu"><strong>Texte:</strong></label><br>
                  <textarea class="input" type="text" id="texte" name="texte"  cols="30" rows="10" value=""><?php echo $article->texte ?></textarea><br>
              </fieldset>
              <input name='delete_btn' class="btn" type="submit" value="Supprimer"><br>
            </form>
          </section>        
      
        
      </div>
  </div>
</div>
</main>
  <?php include_once'./includes/footer.php';?>
