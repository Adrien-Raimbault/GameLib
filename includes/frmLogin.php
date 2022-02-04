<form action="index.php?page=login" method= "post">
    <label for="email">Mail :</label>
    <input type="text" placeholder="votre mail" name="email" id="email" value="<?php echo $email; ?>">
   
    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" id="mdp">
    <br />
    <input type="reset" value="Effacer">
    <input type="submit" value="Envoyer" name="frm">
</form>