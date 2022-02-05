<form action="index.php?page=inscription" method= "post" enctype="multipart/form-data">
    <label for="name">Nom :</label>
    <input type="text" placeholder="votre nom" name="name" id="name" value="<?php echo $name; ?>">
    <br />
    <label for="firstname">Prénom :</label>
    <input type="text" placeholder="votre prénom" name="firstname" id="firstname" value="<?php echo $firstname; ?>">
    <br />
    <label for="email">E-mail :</label>
    <input type="text" placeholder="email@email.fr" name="email" id="email" value="<?php echo $email; ?>">
    <br />
    <label for="pseudo">Pseudo :</label>
    <input type="text" placeholder="Pseudo" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>">
    <br />
    <label for="password">Mot de passe :</label>
    <input type="password" name="password">
    <br />
    <label for="passwordVerif">Vérification mot de passe :</label>
    <input type="password" name="passwordVerif">
    <br />
    <label for="bio">Bio :</label>
    <br />
    <textarea placeholder="bio" name="bio" id="bio" value="<?php echo $bio; ?>"></textarea>
    <br />
    <label for="avatar">Choisissez un avatar :</label>
    <br />
    <input type="file" name="avatar" accept="image/*">
    <br />
    <input type="reset" value="Effacer">
    <input type="submit" value="Valider" name="inscription">
</form>
