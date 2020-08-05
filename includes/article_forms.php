<?php 
include_once'./includes/functions/functions.php';
?>

<form name="article" action="" method="POST">
 <fieldset>
    <label for="titre"><strong> Titre:</strong></label><br>
    <input class="input" type="text" name="titre" placeholder="Titre" value="<?php form_values("titre") ?>"><br>
    <label for="date"><strong>Date publication:</strong></label><br>
    <input class="input" type="date" id="date_pub" name="date_pub" placeholder="Date publication" value="<?php form_values("date_pub") ?>"><br> 
    <label for="contenu"><strong>Texte:</strong></label><br>
    <textarea class="input" type="text" id="texte" name="texte" placeholder="contenu texte" cols="30" rows="10" value="<?php form_values("texte") ?>"></textarea><br>
  </fieldset>
  <input name='ajout_btn' class="btn" type="submit" value="Creér"><br>
</form> 