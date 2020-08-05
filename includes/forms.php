<form id="Registration" action="" method="POST">
  <fieldset>
   <?php if (isset($_POST['register_btn'])) : ?> 
    <label for="nom">Nom</label> <input class="text" id="nom" type="text" name="nom" value="<?php form_values("nom") ?>" />
    <label for="prenom">Prénom</label> <input class="text" id="prenom" type="text" name="prenom" value="<?php form_values("prenom") ?>" />
    <label for="tel">Téléphone</label> <input class="text" id="tel" type="tel" name="tel" value="<?php form_values("tel") ?>" />
    <?php endif; ?>
    <label for="email">Email</label> <input class="text" id="courriel" type="email" name="courriel" value="<?php form_values("courriel") ?>" />
    <label for="password">Mot de passe</label> <input class="text" id="pswd" type="password" name="pswd" />
    <?php if (isset($_POST['register_btn'])) : ?>
    <label for="cpassword">Confirmer mot de passe</label> <input class="text" id="cpswd" type="password" name="cpswd" />
    <input id="acceptTerms" type="checkbox" name="acceptTerms" />
    <label for="acceptTerms"> I agree to the <a>Terms and Conditions</a> and <a>Privacy Policy</a> </label>
    <?php endif; ?>
    <input name='register_btn' class="btn" type="submit" value="Register">
    <input name='login_btn' class="btn" type="submit" value="Login">

  </fieldset>
</form>
</div>
    <br><br>
  </div>
</div>