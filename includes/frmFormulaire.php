<form action="index.php?page=formulaire" method= "post">
    <label for="nom">Nom :</label>
    <input type="text" placeholder="votre nom" name="nom" id="nom" value="<?php echo $nom; ?>">
    <br />
    <label for="prenom">Prénom :</label>
    <input type="text" placeholder="votre prénom" name="prenom" id="prenom" value="<?php echo $prenom; ?>">
    <br />
    <label for="email">E-mail :</label>
    <input type="text" placeholder="email@email.fr" name="email" id="email" value="<?php echo $email; ?>">
    <br />
    <label for="pass">Mot de passe :</label>
    <input type="password" name="pass1">
    <br />
    <label for="pass">Vérification mot de passe :</label>
    <input type="password" name="pass2">
    <br />
    <input type="reset" value="Effacer">
    <input type="submit" value="Valider">
    <input type="hidden" name="frm">
</form>