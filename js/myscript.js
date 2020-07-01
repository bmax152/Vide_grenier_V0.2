$(document).ready(function () {
// TODO : effet sur case non remplis obligatoire

    const regMail = RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
    const regNomPrenom = new RegExp("^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$", "i");
    const regCodePostal = new RegExp("^[0-9]{5}$");
    const regTel = new RegExp("^[0-9]{10}");
    const regMdp = new RegExp("^.{6,}");
    const regDate = new RegExp("^(0[1-9]|[1-2][0-9]|[3][0-1])/([0][1-9]|[1][0-2])/[0-9]{4}$");
    const regHeure = new RegExp("^[d][e]\\s([0-9]|[1-2][0-9])[h]\\s[à]\\s([0-9]|[1-2][0-9])[h]$");

    // Test du form d'inscription
    $("#inscDB").submit(function(event) {

        var login = $("#mail").val();
        var password = $("#password").val();
        var repPassword = $("#repeat_password").val();
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var telephone = $("#tel").val();
        var description = $("#description").val();

        
        if (login == "" || password == "" || repPassword == "") {

            $("#erreurInscription").html("*Veuillez remplir tous les champs requis");
            
            return false;
        } else if (login.length > 50 || regMail.test(login) == false){

            $("#erreurInscription").html("*Veuillez vérifier votre mail.");
            return false;
        } else if (password != repPassword || regMdp.test(password) == false){

            $("#erreurInscription").html("*Veuillez vérifier votre mots de passe.");
            return false;
        }else if (nom != ""  && ((nom.length > 50 )|| regNomPrenom.test(nom) == false)){

            $("#erreurInscription").html("*Veuillez vérifier votre nom.");
            return false;
        } else if ( prenom != "" && ((prenom.length > 50) || regNomPrenom.test(prenom) == false)){

            $("#erreurInscription").html("*Veuillez vérifier votre  prénom.");
            return false;
        } else if (telephone != "" && ((telephone.length > 10) || regTel.test(telephone) == false)){

            $("#erreurInscription").html("*Veuillez vérifier votre numéros de téléphone.");
            return false;
        } else if (description != "" && description.length > 280){

            $("#erreurInscription").html("*Veuillez raccourcir votre déscription ("+description.length+"/280 caractères maximum).");
            return false;
        } else {

            $("#erreurLogin").html("");
            return true;
        }
    });


    // Test du form de mis à jour
    $("#updateDB").submit(function(event) {

        var login = $("#mail").val();
        var oldPassword = $("#old_password").val();
        var newPassword = $("#new_password").val();
        var repPassword = $("#repeat_password").val();
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var telephone = $("#tel").val();
        var description = $("#description").val();

        
        if (login != "" && (login.length > 50 || regMail.test(login) == false)){

            $("#erreurUpdateInscription").html("*Veuillez vérifier votre mail.");
            return false;
        } else if (oldPassword != "" && (newPassword == "" || repPassword == "")|| (oldPassword == "" && (newPassword != "" || repPassword != "")) ||(oldPassword != "" && newPassword != repPassword ) || (newPassword != "" && regMdp.test(newPassword) == false) || (oldPassword != "" && regMdp.test(oldPassword) == false) || (repPassword != "" && regMdp.test(repPassword) == false)){

            $("#erreurUpdateInscription").html("*Veuillez vérifier les mots de passe.");
            return false;
        }else if (nom != ""  && ((nom.length > 50 )|| regNomPrenom.test(nom) == false)){

            $("#erreurUpdateInscription").html("*Veuillez vérifier votre nom.");
            return false;
        } else if ( prenom != "" && ((prenom.length > 50) || regNomPrenom.test(prenom) == false)){

            $("#erreurUpdateInscription").html("*Veuillez vérifier votre  prénom.");
            return false;
        } else if (telephone != "" && ((telephone.length > 10) || regTel.test(telephone) == false)){

            $("#erreurUpdateInscription").html("*Veuillez vérifier votre numéros de téléphone.");
            return false;
        } else if (description != "" && description.length > 280){

            $("#erreurUpdateInscription").html("*Veuillez raccourcir votre déscription (" + description.length + "/280 caractères maximum).");
            return false;
        } else {

            $("#erreurUpdateInscription").html("");
            return true;
        }
    });

    // Test du form de connection
    $("#loginDb").submit(function(event) {

        var login = $("#login").val();
        var password = $("#passConnec").val();
        
        if (login == "" || password == "") {

            $("#erreurLogin").html("*Veuillez remplir tous les champs requis");
            return false;
        } else if (login.length > 50 || regMail.test(login) == false){

            $("#erreurLogin").html("*Veuillez vérifier votre mail.");
            return false;
        } else if (regMdp.test(password) == false){

            $("#erreurLogin").html("*Mot de passe incorrecte");
        } else {

            $("#erreurLogin").html("");
            return true;
        }
    });


    // Test du form de reservation
    $("#resaDB").submit(function(event) {

        var mail = $("#mail").val();
        var nom = $("#nom").val();
        var prenom = $("#prenom").val();
        var addresse = $("#addresse").val();
        var codePostal = $("#codePostal").val();
        var ville = $("#ville").val();
        var portable = $("#portable").val();
        var numCNI = $("#numCNI").val();
        var dateCNI = $("#dateCNI").val();
        var parCNI = $("#parCNI").val();
        var immatriculation = $("#immatriculation").val();
        var nbrEmplacement = $("#nbrEmplacement").val();
        var infoCheck = $("#infoCheck").prop('checked');
        var commercantCheck = $("#commercantCheck").prop('checked');
        var objetCheck = $("#objetCheck").prop('checked');
        var manifestationCheck = $("#manifestationCheck").prop('checked');
        var parkingCheck = $("#parkingCheck").prop('checked');
        var remarque = $("#remarque").val();
        
        if (mail == "" || nom == "" || prenom == "" || addresse == "" || codePostal == "" || ville == "" || portable == "" || numCNI == "" || dateCNI == "" || parCNI == "" || nbrEmplacement == ""  || infoCheck == false  || commercantCheck == false || objetCheck == false || manifestationCheck == false || parkingCheck == false  ) {

            $("#erreurReservation").html("*Veuillez remplir tous les champs requis");
            return false;
        } else if (mail.length > 50 || regMail.test(mail) == false){

            $("#erreurReservation").html("*Veuillez vérifier votre mail.");
            return false;
        } else if (nom.length > 50 || regNomPrenom.test(nom) == false){

            $("#erreurReservation").html("*Veuillez vérifier votre nom.");
            return false;
        } else if (prenom.length > 50 || regNomPrenom.test(prenom) == false){

            $("#erreurReservation").html("*Veuillez vérifier votre  prénom.");
            return false;
        } else if (addresse.length > 100){

            $("#erreurReservation").html("*Veuillez vérifier votre adresse.");
            return false;
        } else if (codePostal.length > 6 || regCodePostal.test(codePostal)){

            $("#erreurReservation").html("*Veuillez vérifier votre code postal.");
            return false;
        } else if (ville.length > 50){

            $("#erreurReservation").html("*Veuillez vérifier votre ville.");
            return false;
        } else if (portable.length > 10){

            $("#erreurReservation").html("*Veuillez vérifier votre numéros de portable.");
            return false;
        }  else if (numCNI.length > 12 || parCNI.length > 50){

            $("#erreurReservation").html("*Veuillez vérifier vos informations de votre CNI.");
            return false;
        }  else if (immatriculation != "" && immatriculation.length > 9){

            $("#erreurReservation").html("*Veuillez vérifier votre plaque d'immatriculation.");
            return false;
        }  else if (nbrEmplacement.isInteger == false){

            $("#erreurReservation").html("*Veuillez vérifier votre nombre de places.");
            return false;
        } else if (remarque != "" && remarque.length > 150){

            $("#erreurReservation").html("*Veuillez raccourcir votre déscription (" + remarque.length + "/150 caractères maximum).");
            return false;
        } else {

            $("#erreurReservation").html("");
            return true;
        }
    });

    // Test du form d'inscription mailing
    $("#mailingForm").submit(function(event) {

        var mail = $("#mailInscription").val();
        
        if (mail == "" ) {

            $("#erreurMailing").html("*Veuillez indiquer votre mail");
            return false;
        } else if (mail.length > 50 || regMail.test(mail) == false){

            $("#erreurMailing").html("*Veuillez vérifier votre mail.");
            return false;
        }else {

            $("#erreurMailing").html("");
            return true;
        }
    });

    // Test du form de désinscription mailing
    $("#cancelMailingForm").submit(function(event) {

        var mail = $("#mailCancel").val();
        
        if (mail == "" ) {

            $("#erreurCancelMailing").html("*Veuillez indiquer votre mail");
            return false;
        } else if (mail.length > 50 || regMail.test(mail) == false){

            $("#erreurCancelMailing").html("*Veuillez vérifier votre mail.");
            return false;
        }else {

            $("#erreurCancelMailing").html("");
            return true;
        }
    });

    // Prix dynamique
    $( "#nbrEmplacement" ).change(function() {
        
        var nbr = parseInt($("#nbrEmplacement").val());
        var prix = parseInt($("#prixJS").val());
        var totalPrix = nbr*prix

        $("#resultatPrix").html("Soit un total de " + totalPrix + "€.");
      });


    //   Test form Programmation VG
    $("#progDB").submit(function(event) {

        var label = $("#label").val();
        var date = $("#date").val();
        var heure = $("#heure").val();
        var addresse = $("#addresse").val();
        var nombre = $("#nombre").val();
        var prix = $("#prix").val();
        
        if (label == "" || date == "" || heure == "" || addresse == "" || nombre == "" || prix == "" ) {

            $("#erreurProg").html("*Veuillez remplir tous les champs");
            return false;
        } else if (label.length > 50){

            $("#erreurProg").html("*Nom trop long.");
            return false;
        } else if (date.length > 11 || regDate.test(date) == false){

            $("#erreurProg").html("*Date au mauvais format.");
            return false;
        } else if (heure.length > 15 || regHeure.test(heure) == false){

            $("#erreurProg").html("*Heure au mauvais format.");
            return false;
        } else if (addresse.length > 100){

            $("#erreurProg").html("*Adresse trop longue.");
            return false;
        } else {

            $("#erreurProg").html("");
            return true;
        }
    });

    //   Test Suppression utilisateur
    $("#formSupp").submit(function(event) {

        var choix = $("input[type='radio'][name='choix']:checked").val();

        if (choix == undefined) {

            $("#erreurSupp").html("*Veuillez selectionnez un utilisateur.");
            return false;
        }  else {

            $("#erreurSupp").html("");
            return true;
        }
    });

    //   Test Suppression ml
    $("#formSuppMl").submit(function(event) {

        var choix = $("input[type='radio'][name='choix_ml']:checked").val();

        if (choix == undefined) {

            $("#erreurSuppMl").html("*Veuillez selectionnez un e-mail.");
            return false;
        }  else {

            $("#erreurSuppMl").html("");
            return true;
        }
    });
});