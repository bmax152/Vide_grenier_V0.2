<?php
session_start();
// Un utilisateur n'a pas besoin de la page de connexion
if (isset($_SESSION["id_util"])) {

    header("Location:accueil.php");
} else {

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | CIL de la Gravière</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/monstyle.css">
</head>

<body>
    <?php
    include 'inc_header.php';
    ?>

    <main id="connexion" class="boxSite">

        <form action="verif_login.php" method="post" id="loginDb">

            <h3>Connexion</h3>
            <div class="form-group">
            <label for="login">Mail: </label>
            <input type="text" class="form-control" name="login" id="login" placeholder="exemple@mail.com">
            </div>
            <div class="form-group">
            <label for="passConnec">Password: </label>
            <input type="password" class="form-control" name="passConnec" id="passConnec">
            </div>
            

            <input class="bouton" type="submit" value="Se connecter" id="subLog">
            <br/><a href="inscription.php">Pas de compte?</a>

            <div id="erreurLogin" class="red">
                <?php
                if (isset($_GET["erreur_log"])) {

                    echo $_GET["erreur_log"];
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