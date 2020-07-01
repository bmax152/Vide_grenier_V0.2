<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailing List | CIL de la Gravière</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/monstyle.css">
</head>

<body>
    <?php
    include 'inc_header.php';
    ?>

    <main id="mailing">

        <section class="boxSite">
            <h3>Inscription dans la mailing List du site</h3>
            <h4>Pourquoi? Pour rester au courant des actualitées bien sûr!</h4>
            <form action="verif_mailing.php" method="post" id="mailingForm">


                <div class="form-group">
                    <label for="mailInscription">Mail: </label>
                    <input type="text" class="form-control" name="mailInscription" id="mailInscription" placeholder="exemple@mail.com">
                </div>

                <input class="bouton" type="submit" value="S'inscrire" id="subMailing">

                <div id="erreurMailing" class="red">
                    <?php
                    if (isset($_GET["erreur_mailing"])) {

                        echo $_GET["erreur_mailing"];
                    }
                    ?>
                </div>
            </form>
        </section>

        <section class="boxSite">
            <h3>Désinscription de la mailing List du site</h3>
            <h4>Dommage de vous voir partirs...</h4>
            <form action="verif_cancel_mailing.php" method="post" id="cancelMailingForm">

                <div class="form-group">
                    <label for="mailCancel">Mail: </label>
                    <input type="text" class="form-control" name="mailCancel" id="mailCancel" placeholder="exemple@mail.com">
                </div>

                <input class="bouton" type="submit" value="Se désinscrire" id="subCancelMailing">

                <div id="erreurCancelMailing" class="red">
                    <?php
                    if (isset($_GET["erreur_cancel_mailing"])) {

                        echo $_GET["erreur_cancel_mailing"];
                    }
                    ?>
                </div>
            </form>
        </section>

    </main>
    <?php
    include 'inc_footer.php';
    ?>

    <script src="../js/jquery-3.5.0.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/myscript.js"></script>
</body>

</html>