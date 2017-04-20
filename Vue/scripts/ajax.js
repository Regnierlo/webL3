var type_requete = 'get';

function requete_ajax_synchrone(script, parametres)
{
    //création de l’objet XMLHttpREquest
    var objetXHR = new XMLHttpRequest();

    //Création de la requête http de type "type_requete" au script php "script" et en mode synchrone
    objetXHR.open(type_requete, script+"?"+parametres, false);

    //envoi de la requête
    objetXHR.send(null);

    //récupération du résultat
    var reponse = objetXHR.responseText;

    //affichage dans le champ prévu
    return reponse;
}