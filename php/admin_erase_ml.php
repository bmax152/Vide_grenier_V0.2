<?php
session_start();

if (isset($_SESSION['id_util']) && $_SESSION["admin"] == 1 && $_POST['choix_ml'] > 0 ) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suppression d'un mail dans ML | CIL de la Gravière</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/monstyle.css">
    </head>

    <body>
        <?php
        include 'inc_header.php';
        ?>
        <main id="suppMl">
            <?php

            try {
                include 'inc_bdd.php';

                $delete_mail =  "DELETE FROM mailing_list WHERE ID_ML = :id";

                $resultat_delete = $base->prepare($delete_mail);
                $delete = $_POST['choix_ml'];
                $resultat_delete->bindParam(':id', $delete);
                $resultat_delete->execute();

                echo "<section id=\"supValidée\" class=\"boxSite\">Mail supprimer<br/>
        <a class=\"nav-link\" href=\"admin_mailing.php\">Retour à la Mailing Liste</a></section>";
            } catch (Exception $e) {

                die('Erreur : ' . $e->getMessage());
            } finally {

                $base = null; //fermeture de la connexion
            }
            ?>


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

} else {
    header("Location:admin_mailing.php?erreur_supp_ml=" . urlencode("*Une erreur est survenue, veuillez recommencer."));
}
?>