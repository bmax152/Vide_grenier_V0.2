<?php
session_start();
// On test seulement les champs obligatoires
if ($_POST['mail'] != "" && $_POST['password'] !="") {
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | CIL de la Gravière</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/monstyle.css">
</head>

<body>
    <?php
    include 'inc_header.php';
    ?>

    <!-- Partie BDD inscription -->
    <?php

    try {
        include 'inc_bdd.php';

        // Test compte existent 
        $mail = htmlspecialchars($_POST['mail']);

        $select_util =  "SELECT * FROM utilisateur WHERE mail_util = :doublon";

        $resultat_select = $base->prepare($select_util);

        $resultat_select->bindParam(':doublon', $mail);
        $resultat_select->execute();

        $okDoublon = false;

        // On test si un résultat est retourné
        while ($ligneDoublon = $resultat_select->fetch()) {

            $okDoublon = true;
        }

        // Si true, alors on renvois le visiteur, son addresse mail est déjà utilisée
        if ($okDoublon) {

            header("Location:inscription.php?erreur_inscription=" . urlencode("*Cette adresse e-mail est déjà utilisée"));
        } else {

            // Test des chaines vide non obligatoires
            if ($_POST['nom'] == "") {

                $tempNom = "";
                $valueNom = "";
            } else {

                $tempNom = ", nom_util";
                $valueNom = ", :nom";
            }

            if ($_POST['prenom'] == "") {

                $tempPrenom = "";
                $valuePrenom = "";
            } else {

                $tempPrenom = ", prenom_util";
                $valuePrenom = ", :prenom";
            }

            if ($_POST['tel'] == "") {

                $tempTel = "";
                $valueTel = "";
            } else {

                $tempTel = ", tel_util";
                $valueTel = ", :tel";
            }

            if ($_POST['description'] == "") {

                $tempDesc = "";
                $valueDesc = "";
            } else {

                $tempDesc = ", desc_util";
                $valueDesc = ", :descr";
            }

            $insert_util = "INSERT INTO utilisateur (mail_util, mdp_util $tempNom $tempPrenom $tempTel $tempDesc) VALUES (:mail, :mdp $valueNom $valuePrenom $valueTel $valueDesc )";
            $resultat_insert = $base->prepare($insert_util);


            $resultat_insert->bindParam(':mail', $mail);
            $password = htmlspecialchars($_POST['password']);
            $resultat_insert->bindParam(':mdp', $password);

            if ($_POST['nom'] != "") {

                $nom = htmlspecialchars($_POST['nom']);
                $resultat_insert->bindParam(':nom', $nom);
            }

            if ($_POST['prenom'] != "") {

                $prenom = htmlspecialchars($_POST['prenom']);
                $resultat_insert->bindParam(':prenom', $prenom);
            }

            if ($_POST['tel'] != "") {

                $tel = htmlspecialchars($_POST['tel']);
                $resultat_insert->bindParam(':tel', $tel);
            }

            if ($_POST['description'] != "") {

                $description = htmlspecialchars($_POST['description']);
                $resultat_insert->bindParam(':descr', $description);
            }

            $resultat_insert->execute();
            echo "<section id=\"inscriptionValidée\" class=\"boxSite\">Votre inscription est validée!<br/>
        <a class=\"nav-link\" href=\"connexion.php\">Connexion</a></section>";
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