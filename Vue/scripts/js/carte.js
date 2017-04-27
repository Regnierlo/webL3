//script javascript qui gère la sélection d’un élément sur la carte heuristique et sa mise à jour

//variable qui mémorise l’identifiant de l’élément sélectionné
var id_gen;

//fonction qui sélectionne un élément (surlignement et stockage la valeur)
function selectElt(id)
{
    //var id = elt.getAttribute('id');

    //changement du style pour montrer l’élément séletionné
    $('.element-carte').css('font-style', 'normal');
    $('#'+id).css('font-style', 'italic');

    //appel du script pour mémoriser l’élément sélectionné
    var reponse = requete_ajax_synchrone("scripts/php/carte.php", "action=select&id="+id);
    id_gen = id;
}

//ajout de l’action sur les éléments de la carte
$('.element-carte').on('click', function(){selectElt(this.getAttribute('id'));return false;/*e.stopPropagation();*/});



//fonction qui affiche la carte mise à jour en réponse à ajax
function afficheMajCarte()
{
    if (objetXHRasynchrone.readyState == 4)
    {
        //on récupère et on affiche
        var reponse = objetXHRasynchrone.responseText;
        $('#carte').html(reponse);

        //on remet le code qui a été annulé
        $('.element-carte').on('click', function(){selectElt(this.getAttribute('id'));return false;/*e.stopPropagation();*/});
        selectElt(id_gen);
    }
}

//fonction qui affiche les utilisateurs mis à jour en répons à ajax
function afficheMajUtilisateurs()
{
    if (objetXHRasynchrone.readyState == 4)
    {
        //on récupère et on affiche
        var reponse = objetXHRasynchrone.responseText;
        $('#utilisateurs').html(reponse);

        //on remet le code qui a été annulé
        $('.autoriser-edition').on('click', function()
        {
            alert(this.checked + ' ' + this.value);
            if (this.checked == true)
                ajouterEdition(this.value);
            else
                supprimerEdition(this.value);

        });
        $('.retirer-partage').on('click', function(e)
        {
            alert(this.checked);
            if (this.checked == false)
                arreterPartage(this.value);
        });
    }
}

//fonction qui demande la mise à jour de la carte avec ajax
function majPage()
{
    //appel du script pour récupérer les données de la carte elle-même avec ajax
    requete_ajax_asynchrone("scripts/php/afficher_carte.php", "", afficheMajCarte);
    //appel du script pour récupérer les données des utilisateurs de la carte
    requete_ajax_asynchrone("scripts/php/afficher_utilisateurs.php", "maj=vrai", afficheMajUtilisateurs);
}

setInterval(majPage, 5000);

//////////////////////////////////////
//toute la partie édition

//changement du nom de l’élément sélectionné
function renommerElt(nom)
{
    alert("changer nom " + nom);
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=renommer_elt&nom="+nom);
    alert(reponse);
    majPage();
}
$('#renommer').on('click', function()
{
    renommerElt($('#saisie-nom-elt').val());
});

//création d’un fils pour l’élément sélectionné
function creerFils()
{
    alert("créer fils ");
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=creer_fils");
    alert(reponse);
    majPage();
}
$('#ajouter-fils').on('click', creerFils);

//création d’un frère pour l’élément sélectionné (il sera ajouter en dernier élément du père)
function creerFrere()
{
    alert("créer frère ");
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=creer_frere");
    alert(reponse);
    majPage();
}
$('#ajouter-frere').on('click', creerFrere);

//suppression de l’élément sélectionné
function supprimerElt()
{
    alert("supprimer élément ");
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=supprimer_elt");
    alert(reponse);
    majPage();
}
$('#supprimer').on('click', supprimerElt);

//ajout du droit d’édition
function ajouterEdition(pseudo)
{
    alert("ajouter édition " + pseudo);
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=ajouter_edition&pseudo="+pseudo);
    majPage();
}

//suppression du droit d’édition
function supprimerEdition(pseudo)
{
    alert("supprimer édition " + pseudo);
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=supprimer_edition&pseudo="+pseudo);
    alert(reponse);
    majPage();
}

$('.autoriser-edition').on('click', function()
{
    alert(this.checked + ' ' + this.value);
    if (this.checked == true)
        ajouterEdition(this.value);
    else
        supprimerEdition(this.value);

});

//partage avec un utilisateur de la carte
function partager(pseudo)
{
    alert("partager " + pseudo);
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=partager&pseudo="+pseudo);
    alert(reponse);
    majPage();
}
$('#partager-carte').on('click', function(e)
{
    partager($('#saisie-pseudo-partage').val());
});

//arrêter le partage de la carte avec un utilisateur
function arreterPartage(pseudo)
{
    alert("arrêter partage " + pseudo);
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=arreter_partage&pseudo="+pseudo);
    alert(reponse);
    majPage();
}
$('.retirer-partage').on('click', function(e)
{
    alert(this.checked);
    if (this.checked == false)
        arreterPartage(this.value);
});

//renommer la carte
function renommerCarte(nom)
{
    alert("changer nom carte " + nom);
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=renommer_carte&nom="+nom);
    alert(reponse);
    majPage();
}
$('#renommer-carte').on('click', function()
{
    renommerCarte($('#saisie-nom-carte').val());
});

//supprimer la carte
function supprimerCarte()
{
    alert("supprimer carte ");
    var reponse = requete_ajax_synchrone('scripts/php/carte.php', "action=supprimer_carte");
    alert(reponse);
    majPage();
}
$('#supprimer-carte').on('click', supprimerCarte);



