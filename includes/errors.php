<?php if(!empty($errors)):?>
<div class="alert alert-danger">
<p>Votre formulaire n'est pas remplis correctement</p>
    <ul>
    <?php foreach($errors as $error):?>
        <li><?=$error;?></li>
    <?php endforeach;?>
    </ul>
</div>
<?php endif;?>