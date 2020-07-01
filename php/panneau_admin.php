<?php
session_start();

if(isset($_SESSION['id_util']) && $_SESSION["admin"] == 1){
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Administrateur | CIL de la Gravière</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/monstyle.css">
</head>

<body>
    <?php
    include 'inc_header.php';
    ?>

    <main id="panneaux">

        <section class="boxSite" id="ajoutVG">

        <h2>Vide-greniers:</h2>
        <h3>Programmer un prochain vide-grenier</h3>
        <a href="admin_prog_vg.php" class="bouton">Programmer</a>
        <h3>Modifier un vide-grenier</h3>
        <a href="admin_liste_vg.php" class="bouton">Modifier</a>

        </section>

        <section class="boxSite" id="configUtilisateur">

        <h2>Utilisateurs:</h2>
        <h3>Voir les Utilisateurs:</h3>
        <a href="admin_util.php" class="bouton">Voir</a>
        <h3>Voir les demandes en attentes:</h3>
        <a href="admin_attente.php" class="bouton">Voir</a>
        
        </section>

        <section class="boxSite" id="configMailing">

        <h2>Mailing Liste:</h2>
        <h3>Voir la Mailing Liste:</h3>
        <a href="admin_mailing.php" class="bouton">Voir</a>
        
        </section>
  
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