var pages = {'Accueil': 0, 'Compte': 1, 'Carte': 2, 'Connexion': 3, 'Inscription': 4};

//Méthode qui permet de changer de page
function changer_page(page)
{
    //alert("requete "+page);
    var reponse = requete_ajax_synchrone("../scripts/navigation.php", "page="+page);
    //alert(reponse);
    if (reponse != 'erreur')
        $(location).attr('href', location.href);
}

$('#navigation_accueil').on('click', function(){changer_page(pages["Accueil"]);});
$('#navigation_inscription').on('click', function(){changer_page(pages["Inscription"]);});
$('#navigation_connexion').on('click', function(){changer_page(pages["Connexion"]);});
$('#navigation_compte').on('click', function(){changer_page(pages["Compte"]);});