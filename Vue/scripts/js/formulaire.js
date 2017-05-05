function surligne(champ, erreur)
{
    if(erreur)
      champ.style.backgroundColor = "#fba";
    else
      champ.style.backgroundColor = "";
}


function verifPrenom(champ)
{
    surligne(champ, false);
}

function verifNom(champ)
{
  surligne(champ, false);
}

function verifMail(champ)
{
  var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
  if(!regex.test(champ.value))
  {
    surligne(champ, true);
    return false;
  }
  else
  {
    surligne(champ, false);
    return true;
  }
}

function verifPseudo(champ)
{
  //il faut rajouter la condition de non existance du pseudo
  if(champ.value.length < 4 || champ.value.length > 20)
  {
    surligne(champ, true);
  }
  return false;
  else
  {
    surligne(champ, false)
    return true;
  }
}

function verifMotdePasse(champ)
{
  if(champ.value.length <4 || champ.value.length > 8)
  {
    surligne(champ, true);
  }
  return false;
  else
  {
    surligne(champ, false)
    return true;
  }
}


function verifInscription(f)
{
  var NomOk = verifNom(f.saisie_prenom);
  var PrenomOk = verifPrenom(f.saisie_nom);
  var MailOk = verifMail(f.saisie_mail);
  var PseudoOk = verifPseudo(f.saisie_pseudo);
  var MdpOk = verifMotdePasse(f.saisie_mdp);
  if(NomOk && PrenomOk && MailOk && PseudoOk && MdpOk)
  {
    return true;
  }
  else
  {
    alert("veuillez remplir correctement tout les champs");
    return false;
  }
}

function test()
{
  alert("ok");
}