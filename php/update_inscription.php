<?php
session_start();

if (isset($_SESSION["id_util"]) && $_POST['mail'] != "") {

?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mis à jour du profil | CIL de la Gravière</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/monstyle.css">
    </head>

    <body>
        <?php
        include 'inc_header.php';

        try {
            include 'inc_bdd.php';

            $select_util = "SELECT * FROM utilisateur WHERE id_util = :id_util";
            $resultat_select = $base->prepare($select_util);
            $resultat_select->bindParam(':id_util', $_SESSION["id_util"]);
            $resultat_select->execute();

            while ($ligne = $resultat_select->fetch()) {

                $mail = htmlspecialchars($_POST['mail']);
                $oldPassword = htmlspecialchars($_POST['old_password']);
                $newPassword = htmlspecialchars($_POST['new_password']);
                $repPassword = htmlspecialchars($_POST['repeat_password']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $tel = htmlspecialchars($_POST['tel']);
                $description = htmlspecialchars($_POST['description']);

                if (($oldPassword != "" && ($oldPassword != $ligne['MDP_UTIL'] || $newPassword !=  $repPassword)) || $mail == "") {

                    header("Location:mon_compte.php?erreur_update_inscription=" . urlencode("*Email ou Mot de passe Incorrecte"));
                } else {

                    // Test des chaines vide
                    if ($nom == "") {

                        $tempNom = "";
                    } else {

                        $tempNom = ", nom_util = :nom"; 
                    }

                    if ($prenom == "") {

                        $tempPrenom = "";
                    } else {

                        $tempPrenom = ", prenom_util = :prenom";
                    }

                    if ($tel == "") {

                        $tempTel = "";
                    } else {

                        $tempTel = ", tel_util = :tel";
                    }

                    if ($description == "") {

                        $tempDesc = "";
                    } else {

                        $tempDesc = ", desc_util = :descr";
                    }

                    if ($newPassword == "") {

                        $tempPass = "";
                    } else {

                        $tempPass = ", mdp_util = :mdp";
                    }

                    $update_utilisateur = "UPDATE utilisateur SET mail_util = :mail $tempNom $tempPrenom $tempTel $tempDesc $tempPass WHERE id_util = :id";
                    $resultat_update = $base->prepare($update_utilisateur);
                    $resultat_update->bindParam(':id', $_SESSION["id_util"]);
                    $resultat_update->bindParam(':mail', $mail);

                    if ($nom != "") {

                        $resultat_update->bindParam(':nom', $nom);
                    } 

                    if ($prenom != "") {

                        $resultat_update->bindParam(':prenom', $prenom);
                    } 

                    if ($tel != "") {

                        $resultat_update->bindParam(':tel', $tel);
                    } 

                    if ($description != "") {

                        $resultat_update->bindParam(':descr', $description);
                    } 

                    if ($newPassword != "") {

                        $resultat_update->bindParam(':mdp', $newPassword);
                    } 

                    $resultat_update->execute();
                    echo "<section id=\"updateValidée\" class=\"boxSite\">Votre mis à jour est validée!<br/>
                    <a class=\"nav-link\" href=\"mon_compte.php\">Retour à mon compte</a></section>";
                }
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