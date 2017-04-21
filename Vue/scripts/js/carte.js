//script javascript qui gère la sélection d’un élément sur la carte heuristique et sa mise à jour

//fonction qui sélectionne un élément (surlignement et stockage la valeur)
function selectElt(elt)
{
    //alert(elt);
    var id = elt.getAttribute('id');

    //changement du style pour montrer l’élément séletionné
    $('.element-carte').css('font-style', 'normal');
    $('#'+id).css('font-style', 'italic');

    //appel du script pour mémoriser l’élément sélectionné
    var reponse = requete_ajax_synchrone("scripts/php/carte.php", "id="+id);
}

//ajout de l’action sur les éléments de la carte
$('.element-carte').on('click', function(e){selectElt(this);return false;/*e.stopPropagation();*/});



//fonction qui affiche la carte mise à jour en réponse à ajax
function afficheMajCarte()
{
    if (objetXHRasynchrone.readyState == 4)
    {
        var reponse = objetXHRasynchrone.responseText;
        $('#carte').html(reponse);
    }
}

//fonction qui demande la mise à jour de la carte avec ajax
function majCarte()
{
    //appel du script pour récupérer les données de la carte avec ajax
    //requete_ajax_asynchrone("scripts/php/afficher_carte.php", "", afficheMajCarte);

    //on fait en synchrone pour le moment parce que ça marche pas sinon
    var reponse = requete_ajax_synchrone("scripts/php/afficher_carte.php", "");
    $('#carte').html(reponse);
}

//setTimeout(majCarte, 5000);
setInterval(majCarte, 5000);

//$('body').on('click',majCarte);
