<?php
session_start();

if (isset($_SESSION['id_util']) && $_SESSION["admin"] == 1) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des utilisateurs | CIL de la Gravière</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/monstyle.css">
    </head>

    <body>
        <?php
        include 'inc_header.php';
        ?>
        <main id="listeUtil">
            <?php

            try {
                include 'inc_bdd.php';

                // Un admin ne peut voir les autres admin
                $select_util =  "SELECT * FROM utilisateur WHERE ADMIN_UTIL IS NULL";

                $resultat_select = $base->prepare($select_util);
                $resultat_select->execute();

                $table = "<table class=\"table table-striped\"><tr><th>Mail</th><th>Nom</th><th>Prenom</th><th>Telephone</th><th>Description</th><th class=\"text-center\">Supprimer Utilisateur</th></tr>";

                while ($ligne = $resultat_select->fetch()) {

                    $table .= "<tr><td>" . $ligne['MAIL_UTIL'] . "</td><td>" . $ligne['NOM_UTIL'] . "</td><td>" . $ligne['PRENOM_UTIL'] . "</td><td>" . $ligne['TEL_UTIL'] . "</td><td>" . $ligne['DESC_UTIL'] . "</td><td class=\"text-center\"><input type=\"radio\" id=\"" . $ligne['ID_UTIL'] . "\" name=\"choix\" value=\"" . $ligne['ID_UTIL'] . "\"></td></tr>";
                }

                $table .= "</table>";
                echo "<section class = \"boxSite\">";
                echo "<form method=\"POST\" action=\"admin_erase_util.php\" id=\"formSupp\">";
                echo $table;
                echo "<div><button class=\"bouton\" type=\"submit\">Supprimer</button></div></form>";
                echo "<div id=\"erreurSupp\" class=\"red\">";
                if (isset($_GET["erreur_supp"])) {

                    echo $_GET["erreur_supp"];
                }
                echo "</div></section>";
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