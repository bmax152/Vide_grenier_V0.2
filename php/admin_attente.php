<?php
session_start();

if (isset($_SESSION['id_util']) && $_SESSION["admin"] == 1) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des demandes en attentes | CIL de la Gravière</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/monstyle.css">
    </head>

    <body>
        <?php
        include 'inc_header.php';
        ?>
        <main id="listeAttente">
            <?php

            try {
                include 'inc_bdd.php';

                // liste des demande de VG en attente de validation ou d'annulation
                $select_attente =  "SELECT * FROM reservation JOIN videgrenier ON reservation.id_vg = videgrenier.id_vg JOIN statuts ON reservation.statu_resa = statuts.id_statuts WHERE STATU_RESA = 1";

                $resultat_select = $base->prepare($select_attente);
                $resultat_select->execute();

                $table = "<table class=\"table table-striped\"><tr><th>Label VG</th><th>Nom</th><th>Prenom</th><th>Nombre de place</th><th>Commentaires</th><th class=\"text-center\">Valider</th><th class=\"text-center\">Annuler</th></tr>";

                // TODO: bouton valider annuler sur chaque ligne qui envoient sur le script sql puis ramene ici


                while ($ligne = $resultat_select->fetch()) {

                    $table .= "<tr><td>" . $ligne['LABEL_VG'] . "</td><td>" . $ligne['NOM_RESA'] . "</td><td>" . $ligne['PRENOM_RESA'] . "</td><td>" . $ligne['NBR_RESA'] . "</td><td>" . $ligne['INFO_RESA'] . "</td><td class=\"text-center\"><input type=\"radio\" id=\"" . $ligne['ID_UTIL'] . "\" name=\"choix". $ligne['ID_VG']."_" .$ligne['ID_UTIL']."\" value=\"" . $ligne['ID_VG']."_" .$ligne['ID_UTIL']. "\"></td><td class=\"text-center\"><input type=\"radio\" id=\"" . $ligne['ID_UTIL'] . "\" name=\"choix". $ligne['ID_VG']."_" .$ligne['ID_UTIL']."\" value=\"" . $ligne['ID_VG']."_" .$ligne['ID_UTIL']. "\"></td></tr>";
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