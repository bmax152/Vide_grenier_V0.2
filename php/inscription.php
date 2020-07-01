<?php
session_start();
// Un utilisateur n'a pas besoin de la page d'inscription
if (isset($_SESSION["id_util"])) {

    header("Location:accueil.php");
} else {


?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription | CIL de la Gravière</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/monstyle.css">
    </head>

    <body>
        <?php
        include 'inc_header.php';
        ?>

        <main id="inscription" class="boxSite">

            <form method="post" action="verif_inscription.php" id="inscDB">
                <h3>Inscription</h3>
                <div class="form-group">
                    <label for="mail">*Mail: </label>
                    <input type="text" class="form-control" name="mail" id="mail" placeholder="exemple@mail.com">
                </div>
                <div class="form-group">
                    <label for="password">*Mot de passe (6 caractère minimum): </label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="repeat_password">*Répéter Mot de passe: </label>
                    <input type="password" class="form-control" name="repeat_password" id="repeat_password">
                </div>
                <div class="form-group">
                    <label for="nom">Nom: </label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Dupont">
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom: </label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Jean">
                </div>
                <div class="form-group">
                    <label for="tel">Tel.: </label>
                    <input type="text" class="form-control" name="tel" id="tel" placeholder="0XXXXXXXXX">
                </div>
                <div class="form-group">
                    <label for="description">Une déscription à partager? : </label>
                    <textarea name="description" id="description" cols="31" rows="5" placeholder="280 caractéres maximum..."></textarea>
                </div>
                <div class="form-group">
                    <!-- A l'inscription, le mail est ajouter par trigger dans la table 'mailing_list' -->
                    <p>En vous inscrivant, vous recevrez automatiquement les newsletter.</p>
                    <p>Vous pouvez vous désinscrire à tout moments.</p>
                    <p>(*)Champs obligatoires</p>
                </div>

                <input class="bouton" type="submit" value="Valider" id="subInscription">

                <div id="erreurInscription" class="red">
                    <?php
                    if (isset($_GET["erreur_inscription"])) {

                        echo $_GET["erreur_inscription"];
                    }
                    ?>
                </div>
            </form>




        </main>



        <?php
        include 'inc_footer.php';
        ?>

        <script src="../js/jquery-3.5.0.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/myscript.js"></script>
    </body>

    </html>

<?php
}
?>