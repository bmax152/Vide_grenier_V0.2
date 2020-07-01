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

            $select_vg =  "SELECT * FROM videgrenier WHERE ID_VG = :id_vg";
            
            $resultat_select = $base->prepare($select_vg);
            $id_vg = $_GET['idVG']; 
            $resultat_select->bindParam(':id_vg', $id_vg);
            
            $resultat_select->execute();
            

            while ($ligne = $resultat_select->fetch()) {
                
                $label = $ligne['LABEL_VG'];
                $date = $ligne['DATE_VG'];
                $heure = $ligne['HEURE_VG'];
                $addresse = $ligne['ADDRESSE_VG'];
                $nombre = $ligne['NBR_EMPLACEMENTS'];
                $restant = $ligne['NBR_RESTANT_VG'];
                $prix = $ligne['PRIX_EMPLACEMENTS'];
            }
        } catch (Exception $e) {

            die('Erreur : ' . $e->getMessage());
        } finally {

            $base = null; //fermeture de la connexion
        }
        ?>

        <main id="programation" class="boxSite">

            <form method="post" action="verif_update_vg.php?idVG=<?php echo $id_vg ?>" id="progDB">
                <h3>Programmation</h3>
                <div class="form-group">
                    <label for="label">*Nom du vide-grenier: </label>
                    <input type="text" class="form-control" value="<?php echo $label ?>" name="label" id="label" placeholder="Vide-grenier annuel">
                </div>
                <div class="form-group">
                    <label for="date">*Date (format "XX/XX/XXXX"): </label>
                    <input type="text" class="form-control" value="<?php echo $date ?>" name="date" id="date" placeholder="XX/XX/XXXX">
                </div>
                <div class="form-group">
                    <label for="heure">*Heure (format "de Xh à Xh"): </label>
                    <input type="text" class="form-control" value="<?php echo $heure ?>" name="heure" id="heure" placeholder="de Xh à Xh">
                </div>
                <div class="form-group">
                    <label for="addresse">*Adresse: </label>
                    <input type="text" class="form-control" value="<?php echo $addresse ?>" name="addresse" id="addresse" placeholder="Esplanade de la Gravière, Avenue De Limburg., Sainte-foy-lès-lyon 69110">
                </div>
                <div class="form-group">
                    <label for="nombre">*Nombres d'emplacement: </label>
                    <input type="number" min="1" class="form-control" value="<?php echo $nombre ?>" name="nombre" id="nombre">
                </div>
                <div class="form-group">
                    <label for="nombreRes">*Nombres d'emplacement restant: </label>
                    <input type="number" min="1" class="form-control" value="<?php echo $restant ?>" name="nombreRes" id="nombreRes">
                </div>
                <div class="form-group">
                    <label for="prix">*Prix à l'unité: </label>
                    <input type="number" min="1" class="form-control" value="<?php echo $prix ?>" name="prix" id="prix">
                </div>
                <p>(*)Champs obligatoires</p>
                </div>
                <div class="text-center">
                    <input class="bouton" type="submit" value="Valider" id="subProg">
                </div>
                <div id="erreurProg" class="red">
                    <?php
                    if (isset($_GET["erreur_prog"])) {

                        echo $_GET["erreur_prog"];
                    }
                    ?>
                </div>
            </form>




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