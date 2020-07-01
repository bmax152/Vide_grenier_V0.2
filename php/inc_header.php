<header id="en_tete">
<div class="row">
    <div id="logo" class="col-md-4">
    <a href="accueil.php"><img id="logoHead" src="../images/logo.png" class="img-fluid" alt="Logo"></a>
    </div>
    <nav id="menu_nav" class="col-md-8">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link" href="accueil.php">Actualités-Manifestations</a></li>
            <li class="nav-item"><a class="nav-link" href="infoCIL.php">Qui sommes-nous ?</a></li>
            <li class="nav-item"><a class="nav-link" href="vide_grenier.php">Vide-grenier</a></li>
            <li class="nav-item"><a class="nav-link" href="mailing_list.php">Mailing List</a></li>
            <?php
            if (isset($_SESSION['id_util'])) {

                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"mon_compte.php\">Mon compte</a></li>";
                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"deconnexion.php\">Déconnexion</a></li>";
            } else {

                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"inscription.php\">Rejoignez-nous</a></li>";
                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"connexion.php\">Connexion</a></li>";
            }

            ?>
        </ul>
    </nav>
</div>
<img id="paysageHead" src="../images/paysage.png" class="img-fluid" alt="Panorama">
</header>