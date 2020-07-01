<?php
session_start();

if (isset($_SESSION["id_util"]) && isset($_GET['idVG'])) {

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation | CIL de la Gravière</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/monstyle.css">
</head>

<body>
    <?php
    include 'inc_header.php';

    try {
        include 'inc_bdd.php';

        $select_vg = 'SELECT * FROM videgrenier WHERE ID_VG = :id';
        $resultat = $base->prepare($select_vg);

        $resultat->bindParam(':id', $_GET['idVG']);
        $resultat->execute();

        while ($ligne = $resultat->fetch()) {

            $label = $ligne['LABEL_VG'];
            $date = $ligne['DATE_VG'];
            $heure = $ligne['HEURE_VG'];
            $addresse = $ligne['ADDRESSE_VG'];
            $nbrRestant = $ligne['NBR_RESTANT_VG'];
            $prixPlace = $ligne['PRIX_EMPLACEMENTS'];
        }
    } catch (Exception $e) {

        die('Erreur : ' . $e->getMessage());
    } finally {

        $base = null; //fermeture de la connexion
    }
    ?>
    <!-- Récupere la valeur en JS pour calcule dynamique -->
    <input type = hidden id = prixJS value = <?php echo $prixPlace;?>/>

    <section id="infoResa" class="boxSite">
        <h3>Réservation: </h3>
        <h3><?php echo $label ?></h3>
        <p>Quand? le <?php echo $date ?>, <?php echo $heure ?></p>
        <p>Où? <?php echo $addresse ?></p>
        <p>Plus que <?php echo $nbrRestant ?> places disponibles.</p>
    </section>

    <main id="reservationVideGrenier" class="boxSite">



        <form method="post" action="verif_resa.php?idVG=<?php echo $_GET['idVG']?>" id="resaDB">

            <div class="form-group">
                <label for="mail">*Mail: </label>
                <input type="text" class="form-control" name="mail" id="mail" placeholder="exemple@mail.com">
            </div>
            <div class="form-group">
                <label for="nom">*Nom: </label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Dupont">
            </div>
            <div class="form-group">
                <label for="prenom">*Prénom: </label>
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Jean">
            </div>
            <label for="addresse">*Adresse: </label>
            <input type="text" class="form-control" name="addresse" id="addresse" placeholder="4 avenus de l'exemple">
            </div>
            </div>
            <label for="postal">*Code Postal: </label>
            <input type="text" class="form-control" name="postal" id="postal" placeholder="XXXXX">
            </div>
            </div>
            <label for="ville">*Ville: </label>
            <input type="text" class="form-control" name="ville" id="ville" placeholder="Saint exemple">
            </div>
            <div class="form-group">
                <label for="portable">*Portable: </label>
                <input type="text" class="form-control" name="portable" id="portable" placeholder="0XXXXXXXXX">
            </div>
            <div class="form-group">
                <label for="numCNI">*N° Carte d'identité: </label>
                <input type="text" class="form-control" name="numCNI" id="numCNI" placeholder="">
            </div>
            <div class="form-group">
                <label for="dateCNI">*Délivrée le: </label>
                <input type="text" class="form-control" name="dateCNI" id="dateCNI" placeholder="XX/XX/XXXX">
            </div>
            <div class="form-group">
                <label for="parCNI">*Délivrée par: </label>
                <input type="text" class="form-control" name="parCNI" id="parCNI" placeholder="Préfecture de ...">
            </div>
            <div class="form-group">
                <label for="immatriculation">Plaque d'immatriculation: </label>
                <input type="text" class="form-control" name="immatriculation" id="immatriculation" placeholder="'AB-123-CD' ou '123 AB 45'">
            </div>
            <div class="form-group">
                <label for="nbrEmplacement">*Nombre d'emplacements désirer: </label>
                <input type="number" class="form-control" name="nbrEmplacement" id="nbrEmplacement" placeholder="" min="1" max="<?php echo $nbrRestant?>">
                <span> <?php echo $prixPlace ?>€ la place.</span>
                <span id='resultatPrix'></span>
                
            </div>
            <p class="text-justify">Ces emplacements vous sont personnels et seront déclarés au registre réglementaire pour remise au Maire de la commune à l'issu du Vide Grenier.</p>

            <p class="text-justify">Ils sont donc non revendable ni cessibles.
                Possibilité de nous contacter pour augmenter la taille ultérieurement (minimum 15j avant la manifestation, en fonction des places disponibles).</p>

            <p class="text-justify">Par contre, si nous sommes avertis 7 jours calendaires avant, d’un empêchement majeur de votre part, nous vous rembourserons le montant de votre réservation moins les frais de réservation et de service s'élevant à 4€.</p>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="infoCheck">
                <label class="form-check-label text-justify" for="infoCheck">*Je certifie sur l'honneur l'exactitude des informations remplies</label>
            </div><br />
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="commercantCheck">
                <label class="form-check-label text-justify" for="commercantCheck">*Je certifie sur l'honneur de ne pas être commerçant(e)</label>
            </div><br />
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="objetCheck">
                <label class="form-check-label text-justify" for="objetCheck">*Je certifie sur l'honneur de ne vendre que des objets personnels et usagés (Article L 310-2 du Code de commerce)</label>
            </div><br />
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="manifestationCheck">
                <label class="form-check-label text-justify" for="manifestationCheck">*Je certifie sur l'honneur de non-participation à 2 autres manifestations de même nature au cours de l’année civile. (Article R321-9 du Code pénal)</label>
            </div><br />
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="parkingCheck">
                <label class="form-check-label text-justify" for="parkingCheck">*Je m'engage a laisser libre les emplacements de parking réservés à la décharge des véhicules (cf emplacements verts sur photos plus bas), à défaut je sais que je pourrai recevoir un Procès Verbal pour infraction à l'arrêté de non stationnement publié par la Mairie pour le jour de la manifestation.</label>
            </div><br />
            <div class="form-group">
            <label for="remarque">Une remarque? : </label>
            <textarea name="remarque" id="remarque" cols="40" rows="5" placeholder="150 caractéres maximum..."></textarea>
            </div>
            <div class="form-group">
            
            <div class="form-group">
                <p>(*)Champs obligatoires</p>
            </div>

            <input class="bouton" type="submit" value="Valider" id="subInscription">

            <div id="erreurReservation" class="red">
                <?php
                if (isset($_GET["erreur_reservation"])) {

                    echo $_GET["erreur_reservation"];
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