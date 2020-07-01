<?php
session_start();

if (isset($_SESSION["id_util"]) && $_SESSION["admin"] == 1 && isset($_GET['idVG'])) {

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un vide-grenier | CIL de la Gravière</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/monstyle.css">
    </head>

    <body>
        <?php
        include 'inc_header.php';
        ?>
        <?php

        try {
            include 'inc_bdd.php';

            $update_vg =  "UPDATE videgrenier SET LABEL_VG = :label, DATE_VG = :date_vg, HEURE_VG = :heure, ADDRESSE_VG = :addresse, NBR_EMPLACEMENTS = :nbr, NBR_RESTANT_VG = :restant, PRIX_EMPLACEMENTS = :prix WHERE ID_VG = :id_vg";

            $resultat_update = $base->prepare($update_vg);

            $id_vg = $_GET['idVG'];
            $label = htmlspecialchars($_POST['label']);
            $date = htmlspecialchars($_POST['date']);
            $heure = htmlspecialchars($_POST['heure']);
            $addresse = htmlspecialchars($_POST['addresse']);
            $nombre = htmlspecialchars($_POST['nombre']);
            $restant = htmlspecialchars($_POST['nombreRes']);
            $prix = htmlspecialchars($_POST['prix']);

            //Test si JS n'a pas fonctionné
            if($id_vg == "" || $label == "" || $date == "" || $heure == "" || $addresse == "" || $nombre == "" || $restant == "" || $prix == "" ){

                header("Location:admin_update_vg.php?erreur_prog=" . urlencode("*Un problème est survenu. Réessayer."));
            }

            $resultat_update->bindParam(':label', $label);
            $resultat_update->bindParam(':date_vg', $date);
            $resultat_update->bindParam(':heure', $heure);
            $resultat_update->bindParam(':addresse', $addresse);
            $resultat_update->bindParam(':nbr', $nombre);
            $resultat_update->bindParam(':restant', $restant);
            $resultat_update->bindParam(':prix', $prix);
            $resultat_update->bindParam(':id_vg', $id_vg);


            $resultat_update->execute();

            echo "<section id=\"updateVgValidée\" class=\"boxSite\">Votre modification est validée<br/>
        <a class=\"nav-link\" href=\"admin_liste_vg.php\">Retour à la liste</a></section>";

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
    header("Location:admin_liste_vg.php?erreurUpdateVG=" . urlencode("*Une erreur est survenue, veuillez recommencer."));
}
?>