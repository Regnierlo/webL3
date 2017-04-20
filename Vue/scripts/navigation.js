//script javascript qui gère la navigation entre les page
//la façon de faire est loin d’être optimale car on passe par Ajax justement pour changer de page, à changer…
//il ne fait plus que l’accueil

var pages = {'Accueil': 0, 'Compte': 1, 'Carte': 2, 'Connexion': 3, 'Inscription': 4};

//Fonction qui permet de changer de page, en passant le numéro de celle-ci
function changer_page(page)
{
    //alert("requete "+page);
    var reponse = requete_ajax_synchrone("scripts/navigation.php", "page="+page);
    //alert(reponse);
    if (reponse != 'erreur')
        $(location).attr('href', location.href);
}

//Ajout des actions sur les boutons
//$('#navigation_accueil').on('click', function(){changer_page(pages["Accueil"]);});
//$('#navigation_inscription').on('click', function(){changer_page(pages["Inscription"]);});
//$('#navigation_connexion').on('click', function(){changer_page(pages["Connexion"]);});
//$('#navigation_compte').on('click', function(){changer_page(pages["Compte"]);});



//Fonction qui renvoie à l’accueil
function aller_accueil()
{
    $(location).attr('href', 'accueil.php');
}

//ajout de l’action sur l’image de Listique
$('#navigation_accueil').on('click', function(){aller_accueil();});