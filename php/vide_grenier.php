<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vide Grenier | CIL de la Gravière</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/monstyle.css">
</head>

<body>
    <?php
    include 'inc_header.php';

    try {
        include 'inc_bdd.php';

        $select_vg = 'SELECT * FROM videgrenier';
        $resultat = $base->prepare($select_vg);

        $resultat->execute();

        echo "<main id=\"videGrenier\" class=\"text-center\">";

        while ($ligne = $resultat->fetch()) {

            $id = $ligne['ID_VG'];
            $label = $ligne['LABEL_VG'];
            $date = $ligne['DATE_VG'];
            $heure = $ligne['HEURE_VG'];
            $addresse = $ligne['ADDRESSE_VG'];
            $nbrRestant = $ligne['NBR_RESTANT_VG'];
    
            ?>
            <section class="boxSite">
            <h3>Prochain événement du CIL de la Gravière:</h3>
            <h3><?php echo $label ?></h3>
            <p>Quand? le <?php echo $date ?>, <?php echo $heure ?></p>
            <p>Où? <?php echo $addresse ?></p>
            <p>Exposants ou Visiteurs, nous vous attendons nombreux !</p>
            <p>Réservé exclusivement aux particuliers.</p>
            <!-- <img src="../images/imgVG.jpg" alt="Image de Vide-grenier" id="imgVG"> -->
            <?php
    
            if ($nbrRestant > 0) {
    
                echo "<p>Plus que $nbrRestant places disponibles!</p>";
    
                if (isset($_SESSION['id_util'])) {
    
                    echo "<a href=\"reservation.php?idVG=" . $id . "\" class=\"bouton\">Réservez!</a>";
                } else {
        
                    echo "<a href=\"connexion.php\" class=\"bouton\">Connectez vous pour réserver</a>";
                }
            } else {
    
                echo "<p>Plus de places disponibles!</p>";
            }
    
            echo "</section>";

        }
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