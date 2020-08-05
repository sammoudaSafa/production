<?php
include_once'./includes/header.php';
include_once'./includes/functions/functions.php';
include_once'dbconfig/connexion.php';
$pdo = connect();
$articles=get_article();
$liste_articles=$articles->fetchAll();
?>
<div id="blog" class="container">
    <?php foreach($liste_articles as $article){ ?>
    <section>
        <div class="banner-content">
          <h4><?php echo $article->titre;?></h4>
                <div><?php echo 'Posté le '.$article->date_pub. ' BY '.$article->auteur;?></div><br>
                      <p><?php echo $article->texte;?></p>
                      
                    <a href="#" class="btn">Laisser un commentaire</a>
                </div>
                <br><br>
    </section>
    <?php } ?>
</div>

