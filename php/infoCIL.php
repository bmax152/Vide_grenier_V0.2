<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui sommes-nous ? | CIL de la Gravière</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/monstyle.css">
</head>

<body>
    <?php
    include 'inc_header.php';
    ?>

    <main id="quiSommeNous" class="boxSite">
        <img src="../images/logo.png" class="img-fluid" alt="Logo">
        
        <h1 class="text-center">Qui sommes-nous ?</h1>

        <p class="text-justify">Le C.I.L. est une association à but non lucratif, servant d’interlocuteur entre les habitants du quartier et les élus locaux. Association indépendante et apolitique, sans parti pris d’âge, d’origine sociale diverse, d’ancienneté dans le secteur, composée de bénévoles motivés pour la défense des intérêts de notre quartier.</p>

        <h2 class="text-center">Pour quoi faire ?</h2>

        <p class="text-justify">Le champ d’activité concerne, non pas la défense d’intérêts particuliers, mais des questions d’intérêt général : voirie, circulation, propreté, voisinage, vie sociale etc.</p>

            <p class="text-justify">– Etre acteurs, et non pas spectateurs du destin de notre quartier ou notre cité. Les urbanistes et les élus élaborent des projets, les mettent en œuvre et les concrétisent. Les habitants les vivent !</p>

            <p class="text-justify">– Etablir des relations de confiance avec toutes les autorités qui régissent notre ville et notre quartier.</p>

            <p class="text-justify">– Proposer aux autorités responsables, des suggestions favorisant le bien vivre de notre quartier.</p>

            <p class="text-justify">– Prendre en compte l’arrivée d’une population nouvelle. Dans cette nouvelle dimension chacun doit trouver sa place.</p>

            <p class="text-justify">– Participer, en complément des Associations, à des animations visant à rendre notre quartier plus vivant.</p>

            <p class="text-justify">– Chercher des partenaires pour nous aider à financer nos manifestations diverses, qui bénéficieront de nos supports de communication.</p>

            <p class="text-justify">– Nous affirmer par le nombre et le sérieux, être une association écoutée et consultée sur tous les thèmes énumérés ci-dessus.</p>

            <p class="text-justify">C’est le challenge que doit relever chaque adhérent pour animer un Comité d’Intérêt Local efficace.</p>

            <p class="text-justify font-weight-bold">N’hésitez pas à nous faire part de toutes remarques et idées constructives pour défendre, avec nous, nos intérêts communs et réfléchir au devenir de notre quartier.</p>

            <?php
                if(isset($_SESSION["id_util"])){

                }else{
                    // Un visiteur peu s'inscrire à partir de cette page

                    echo "<div id=\"lienRejoinNous\"><a href=\"inscription.php\" class=\"bouton\">Rejoignez-nous!</a></div>";
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