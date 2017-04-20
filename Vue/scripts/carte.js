//script javascript qui gère la sélection d’un élément sur la carte heuristique

//fonction qui sélectionne un élément (surlignement et stockage la valeur)
function selectElt(elt)
{
    var id = elt.getAttribute('id');

    //changement du style pour montrer l’élément séletionné
    $('.element-carte').css('font-style', 'normal');
    $('#'+id).css('font-style', 'italic');

    //appel du script pour mémoriser l’élément sélectionné
    var reponse = requete_ajax_synchrone("scripts/carte.php", "id="+id);
}

//ajout de l’action sur les éléments de la carte
$('.element-carte').on('click', function(e){selectElt(this);e.stopPropagation();});
