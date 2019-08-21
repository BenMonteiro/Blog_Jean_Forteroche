<?php
ob_start();
?>
<form class="offset-3 col-6 mt-5 pt-5">
    <div class="form-group">
        <label for="name">Nom</label>
        <input type="text" class="form-control" id="name" placeholder="Veuillez renseigner votre nom">
    </div>
    <div class="form-group">
        <label for="surname">Prénom</label>
        <input type="surname" class="form-control" id="surname" placeholder="Veuillez renseigner voutr prénom">
    </div>
    <div class="form-group">
        <label for="email">email</label>
        <input type="email" class="form-control" id="email" placeholder="xxx@exemple.com">
    </div>
    <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" id="message" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-primary float-right">Envoyer</button>
</form>
<?=
$content =  ob_get_contents();
ob_end_clean();