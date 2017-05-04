//Fichier qui contient toutes les fonctions spécifiques à l’utilisation d’Ajax

var type_requete = 'post';

//Création des l’objets XMLHttpREquest
var objetXHR = new XMLHttpRequest();
var objetXHRasynchrone = new XMLHttpRequest();

/*
Envoie une requete ajax synchrone et renvoie sa réponse
script est le script php à appeler
parametres définit les paramètres (déjà formés) à envoyer au script
 */
function requete_ajax_synchrone(script, parametres)
{
    //Création de la requête http de type "type_requete" au script php "script" et en mode synchrone
    if (type_requete == 'get')
        objetXHR.open(type_requete, script+"?"+parametres, false);
    else
        objetXHR.open(type_requete, script, false);

    //Envoi de la requête
    if (type_requete == 'get')
        objetXHR.send(null);
    else
        objetXHR.send(parametres);

    //Récupération du résultat
    var reponse = objetXHR.responseText;

    //Renvoi de la réponse
    return reponse;
}

/*
 Envoie une requete ajax asynchrone et indique sa fonction de traitement
 script est le script php à appeler
 parametres définit les paramètres (déjà formés) à envoyer au script
 fonction_traitement est la fonction à appeler pour le traitement
 */
function requete_ajax_asynchrone(script, parametres, fonction_traitement)
{
    //Désignation de la fonction de rappel
    objetXHRasynchrone.onreadystatechange = fonction_traitement;

    //Création de la requête http de type "type_requete" au script php "script" et en mode asynchrone
    if (type_requete == 'get')
        objetXHRasynchrone.open(type_requete, script+"?"+parametres, false);
    else
        objetXHRasynchrone.open(type_requete, script, false);

    //Envoi de la requête
    if (type_requete == 'get')
        objetXHRasynchrone.send(null);
    else
        objetXHRasynchrone.send(parametres);
}

/*
    Pour la sécurité des appels php avec ajax, un équivalent de htmlspecialchars pour javascript
 */
function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };

    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

