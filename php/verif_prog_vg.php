<?php
session_start();

if(isset($_SESSION['id_util']) && $_SESSION["admin"] == 1 && $_POST['label'] != "" && $_POST['date'] != "" && $_POST['heure'] != "" && $_POST['addresse'] != "" && $_POST['nombre'] != "" && $_POST['prix'] != ""){
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Programmation | CIL de la Gravière</title>
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

        $label = htmlspecialchars($_POST['label']);
        $date = htmlspecialchars($_POST['date']);
        $heure = htmlspecialchars($_POST['heure']);
        $addresse = htmlspecialchars($_POST['addresse']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $prix = htmlspecialchars($_POST['prix']);

        $insert_vg =  "INSERT INTO videgrenier (LABEL_VG, DATE_VG, HEURE_VG, ADDRESSE_VG, NBR_EMPLACEMENTS, NBR_RESTANT_VG, PRIX_EMPLACEMENTS) VALUES (:label, :date_vg, :heure, :addresse, :nbr, :nbr_restant, :prix)";

        $resultat_insert = $base->prepare($insert_vg);

        $resultat_insert->bindParam(':label', $label);
        $resultat_insert->bindParam(':date_vg', $date);
        $resultat_insert->bindParam(':heure', $heure);
        $resultat_insert->bindParam(':addresse', $addresse);
        $resultat_insert->bindParam(':nbr', $nombre);
        $resultat_insert->bindParam(':nbr_restant', $nombre);
        $resultat_insert->bindParam(':prix', $prix);
        $resultat_insert->execute();

        
            echo "<section id=\"progValidée\" class=\"boxSite\">Vide-grenier programé!<br/>
        <a class=\"nav-link\" href=\"panneau_admin.php\">Retour</a></section>";
        
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    } finally {

        $base = null; //fermeture de la connexion
    }
    ?>



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
    header("Location:accueil.php?erreur_prog=" . urlencode("*Une erreur est survenue, veuillez recommencer."));
}
?>