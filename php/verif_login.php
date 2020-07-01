<?php
session_start();

if (isset($_POST['login']) && isset($_POST['passConnec'])) {
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Verification Connexion | CIL de la Gravière</title>
</head>

<body>

    <?php

    try {
        include 'inc_bdd.php';
        
        // Recherche des logins dans la bdd login_password
        $select_login = 'SELECT * FROM utilisateur WHERE mail_util LIKE :mail AND mdp_util LIKE :pass';
        $resultat = $base->prepare($select_login);

        $log = htmlspecialchars($_POST['login']);
        $mdp = htmlspecialchars($_POST['passConnec']);
        $resultat->execute(array('mail' => $log, 'pass' => $mdp));

        $ok = false;
   
        while ($ligne = $resultat->fetch()) {

            $ok = true;
            $id = $ligne['ID_UTIL'];
            $admin = $ligne['ADMIN_UTIL'];
        }

        if ($ok) {
           
            $_SESSION["id_util"] = $id;
            $_SESSION["admin"] = $admin;
            header("Location:mon_compte.php");
        } else {

            header("Location:connexion.php?erreur_log=" . urlencode("*Login ou Mot de passe Incorrecte")); 
        }
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    } finally {

        $base = null; //fermeture de la connexion
    }

    ?>

</body>

</html>


<?php

} else {

    header("Location:accueil.php");
}
?>