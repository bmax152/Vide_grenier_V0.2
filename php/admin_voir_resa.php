<?php
session_start();

if (isset($_SESSION['id_util']) && $_SESSION["admin"] == 1 && isset($_GET["id_resa"])) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Voir demande en attente | CIL de la Gravière</title>
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
                $select_attente =  "SELECT * FROM reservation_vg JOIN videgrenier ON reservation_vg.id_vg = videgrenier.id_vg JOIN statuts ON reservation_vg.statu_resa = statuts.id_statuts WHERE STATU_RESA = 1 AND ID_RESA = :id_resa";

                $resultat_select = $base->prepare($select_attente);
                $id_resa = htmlspecialchars($_GET["id_resa"]);
                $resultat_select->bindParam(':id_resa', $id_resa);
                $resultat_select->execute();

                echo "<section class = \"boxSite\">";

                while ($ligne = $resultat_select->fetch()) {
                    echo "<section id=\"recapResa\">";
                    echo "<h4>" . $ligne['LABEL_VG'] . "</h4><br/>";
                    echo "<p>Statut de la réservation: " . $ligne['LABEL_STATUTS'] . "</p>";
                    echo "<p>Date: " . $ligne['DATE_VG'] . " " . $ligne['HEURE_VG']  . "</p>";
                    echo "<p>Adresse: " . $ligne['ADDRESSE_VG'] . "</p>";
                    echo "<p>Nom Prénom de réservation: " . $ligne['NOM_RESA'] . " " . $ligne['PRENOM_RESA'] . "</p>";

                    echo "<p>N° Carte d'identiter: " . $ligne['CNI_RESA'] . "</p>";
                    echo "<p>Délivrer le: " . $ligne['DELIVRE_CNI_RESA'] . "</p>";
                    echo "<p>Délivrer par: " . $ligne['PAR_CNI_RESA'] . "</p>";

                    echo "<p>Mail de contacte: " . $ligne['MAIL_RESA'] . "</p>";
                    echo "<p>Portable: " . $ligne['PORTABLE_RESA'] . "</p>";
                    if ($ligne['IMMATRICULATION_RESA'] != "") {
                        echo "<p>Immatriculation enregistrer: " . $ligne['IMMATRICULATION_RESA'] . "</p>";
                    }
                    echo "<p>Nombre de places réservées: " . $ligne['NBR_RESA'] . "</p>";
                    if ($ligne['INFO_RESA'] != "") {
                        echo "<p>Informations: " . $ligne['INFO_RESA'] . "</p>";
                    }
                    echo "<br/></section>";
                    ////////////////////////////////////////////////////////////////

                    echo "<form class=\"row boxSite\" method=\"POST\" action=\"admin_update_resa.php?id_resa=" . $id_resa . "\" id=\"formUpdateResa\">";
                    echo "<div class=\"col-md-3\">Votre Choix: </div> ";
                    echo "<div class=\"col-md-3\"><input type=\"radio\" id=\"choix\" name=\"choix\" value=\"2\">";
                    echo "<label for=\"choix\">Valider</label></div>";
                    echo "<div class=\"col-md-3\"><input type=\"radio\" id=\"choix\" name=\"choix\" value=\"3\">";
                    echo "<label for=\"choix\">Annuler</label></div>";
                    echo "<div class=\"col-md-3 text-center\"><button class=\"bouton\" type=\"submit\">Appliquer</button></div></form>";
                    echo "</form";



                    echo "<div id=\"erreurSupp\" class=\"red\">";
                    if (isset($_GET["erreur_supp"])) {

                        echo $_GET["erreur_supp"];
                    }
                    echo "</div>";
                    //////////////////////////////////////////////////
                }

                echo "<div id=\"erreur\" class=\"red\">";
                if (isset($_GET["erreur"])) {

                    echo $_GET["erreur"];
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