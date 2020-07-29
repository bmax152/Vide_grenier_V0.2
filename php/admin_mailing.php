<?php
session_start();

if (isset($_SESSION['id_util']) && $_SESSION["admin"] == 1) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste de la mailing liste | CIL de la Gravière</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/monstyle.css">
    </head>

    <body>
        <?php
        include 'inc_header.php';
        ?>
        <main id="listeMail">
            <?php

            try {
                include 'inc_bdd.php';

                // Nbr mail pour pagination
                $countMail = "SELECT COUNT(*) FROM mailing_list";

                $resultatCount = $base->prepare($countMail);

                $resultatCount->execute();
                $nbrMail = $resultatCount->fetchColumn();
                $nbrPage = (int) ($nbrMail / 25) + 1;

                if (isset($_GET['page'])) {

                    $page = $_GET['page'];
                } else {

                    $page = 1;
                }

                $nbrLigneBase = ($page - 1) * 3;

                $select_mail =  "SELECT * FROM mailing_list LIMIT $nbrLigneBase, 25";

                $resultat_select = $base->prepare($select_mail);
                $resultat_select->execute();

                $table = "<table class=\"table table-striped\"><tr><th>Mail</th><th class=\"text-center\">Supprimer Mail</th></tr>";

                while ($ligne = $resultat_select->fetch()) {

                    $table .= "<tr><td>" . $ligne['MAIL_ML'] . "</td><td class=\"text-center\"><input type=\"radio\" id=\"" . $ligne['ID_ML'] . "\" name=\"choix_ml\" value=\"" . $ligne['ID_ML'] . "\"></td>";
                }

                $table .= "</table>";
                echo "<section class = \"boxSite\">";
                echo "<form method=\"POST\" action=\"admin_erase_ml.php\" id=\"formSuppMl\">";
                echo $table;
                echo "<div class=\"text-center\"><button class=\"bouton\" type=\"submit\">Supprimer</button></div></form>";
               


                echo "<section class=\"row\" id=\"suivantPrecedent\">";

                if ($page != 1) {

                    echo "<div class=\"text-left col-md-6\"><a class=\"bouton\" href=\"admin_mailing.php?page=" . ($page - 1) . "\"><--</a></div>";
                } else {

                    echo "<div class=\"text-left col-md-6\"></div>";
                }

                if ($page != $nbrPage) {

                    echo "<div class=\"text-right col-md-6\"><a class=\"bouton\" href=\"admin_mailing.php?page=" . ($page + 1) . "\">--></a></div>";
                } else {

                    echo "<div class=\"text-right col-md-6\"></div>";
                }

                echo "</section>";


                echo "<div id=\"erreurSuppMl\" class=\"red\">";
                if (isset($_GET["erreur_supp_ml"])) {

                    echo $_GET["erreur_supp_ml"];
                }
                echo "</div>";


                echo "</section>";
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
    header("Location:accueil.php");
}
?>