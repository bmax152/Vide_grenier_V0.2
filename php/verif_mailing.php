<?php
session_start();

if ($_POST['mailInscription'] != "") {

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Mailing Liste | CIL de la Gravière</title>
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

        // Test mailing existent 
        $mail = htmlspecialchars($_POST['mailInscription']);

        $select_mailing =  "SELECT * FROM mailing_list WHERE mail_ml = :mail";

        $resultat_select = $base->prepare($select_mailing);

        $resultat_select->bindParam(':mail', $mail);
        $resultat_select->execute();

        $okDoublon = false;

        // On test si un résultat est retourné
        while ($ligneDoublon = $resultat_select->fetch()) {

            $okDoublon = true;
        }

        if ($okDoublon) {

            header("Location:mailing_list.php?erreur_mailing=" . urlencode("*Cette adresse e-mail est déjà utilisée"));
        } else {

            $insert_mailing = "INSERT INTO mailing_list (MAIL_ML) VALUES (:mail_ml)";
            $resultat_insert = $base->prepare($insert_mailing);

            $resultat_insert->bindParam(':mail_ml', $mail);
            $resultat_insert->execute();
            echo "<section id=\"mailingValidée\"  class=\"boxSite\">Votre Inscription est validée!<br/>
        <a class=\"nav-link\" href=\"accueil.php\">Accueil</a></section>";
        }
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

header("Location:accueil.php");
}
?>