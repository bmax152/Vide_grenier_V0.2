<?php
session_start();

if (isset($_SESSION['id_util']) && $_SESSION["admin"] == 1 && $_POST["choix"] != "" && isset($_GET["id_resa"])) {
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update demande en attente | CIL de la Gravière</title>
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
                
                $update_resa = "UPDATE reservation_vg SET statu_resa = :statu WHERE id_resa = :id";
                $resultat_update = $base->prepare($update_resa);
                $resultat_update->bindParam(':id', $_GET["id_resa"]);
                $resultat_update->bindParam(':statu', $_POST["choix"]);

                $resultat_update->execute();
                echo "<section id=\"updateValidée\" class=\"boxSite\">Votre mis à jour de la demande est validée!<br/>
                    <a class=\"nav-link\" href=\"admin_voir_resa.php\">Retour aux reservation</a></section>";
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