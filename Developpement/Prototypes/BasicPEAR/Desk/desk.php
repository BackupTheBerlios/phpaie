<?php 
//********************************************************************
// phpaie 
//------------------------------------------------------------------
// Version: 0.1
//
// Copyright (c) 2002 by Jean-Charles Gibier (~Le Mulot Fou~)
// (http://www.phpaie.net)
// (webmaster@machinbidule.com)
//
// Support éventuel sur www.phpaie.net
//*********************************************************************
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as 
// published by the Free Software Foundation.
//*********************************************************************
?>
<?php 
//Insertion des fichiers de contrôle de session [par défaut]
require_once("DESK_def.php");
require_once("../inc/session_identifie.php");
//Création de l'objet page par défaut
$pg_DESK = new DESK( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
// Affichage de la présentation
// paramètre: action à effectuer si validation
// L'affichage de la présentation n'est pas pris en charge par $pg_DESK
//Récupération des variables pour le formulaire
$vars = $pg_DESK->getValidVars( );
?>
<? print "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"; ?>

<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3c.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"/>
<? require_once ("../inc/html_settings.php");
print "<link rel=\"stylesheet\" href=\"$css_style\" type=\"text/css\"/>\n"; ?>
<TITLE></TITLE>
</head>
<!-- < ? xml version="1.0" encoding="UTF-8"?> -->
<body>
<div align="center">
<table border="0" width="800" cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td width="200" height="550" valign="middle" align="justify" rowspan="3">
        <div style="overflow:scroll;height:540px;width:190px;margin: 3px 3px 3px 3px">
        <p align="center"><br />
        <b>Organisation des donn&eacute;es</b></p>
        <hr />
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
        </table>
        <hr />
        </div>
      </td>
      <td width="400" height="100" valign="middle" align="center"><font face="Arial" size="2">
        Bonjour 
<?php 
print  MAIN_CLASS::fetchOne("INSCRIPTION, CONNECTION", "INSCRIPTION.INSCRIPTION_PSEUDO_CKEY_VCH", " where INSCRIPTION.ID_INSCRIPTION = CONNECTION.ID_INSCRIPTION AND CONNECTION.CONNECTION_SID_CKEY_VCH = '".session_id()."'","");
?>
         , bienvenue dans votre bureau.</font></td>
      <td width="200" height="100" valign="middle" align="center" >&nbsp; </td>
    </tr>
    <tr>
      <td width="400" height="300" valign="middle" align="center">
        <table border="0" width="400" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td width="200" height="150" valign="bottom"  align="center">
              <a href="../Employeur/employ.php" class="mainlink">Employeur</a></td>
              <td width="200" height="150" valign="bottom" align="center">
              <a href="../Salarie/salari.php"  class="mainlink">Salari&eacute;</a></td>
            </tr>
            <tr>
              <td width="200" height="150" valign="bottom" align="center">
              <a href="../Rubrique/rubr.php" class="mainlink">Rubriques</a></td>
              <td width="200" height="150" valign="bottom" align="center">
              <a href="../Planpaie/definition.php" class="mainlink">Plans de paie</a></td>
            </tr>
          </tbody>
        </table>
      </td>
      <td width="200" height="300" align="justify">
        <ul>
          <li><a href="../common/NONIMP.html" class="mainmenu">Statistiques</a></li>
          <li><a href="../common/NONIMP.html" class="mainmenu">&eacute;ditions</a></li>
          <li><a href="../common/NONIMP.html" class="mainmenu">D&eacute;clarations</a></li>
          <li><a href="../common/NONIMP.html" class="mainmenu">Forums</a></li>
          <li><a href="../common/NONIMP.html" class="mainmenu">Mailing listes</a></li>
          <li><a href="../common/NONIMP.html" class="mainmenu">Liens</a></li>
        </ul>
      </td>
    </tr>
    <tr>
      <td width="400" height="150" valign="middle" align="center"> </td>
      <td width="200" height="150" valign="middle" align="center">
      <p align="center">machinbipaye<br/>
<?php echo '<font size ="-1">V 0.1<BR/>(Lun 15 Mar 2004 15:15:13)</font>';?>
        </p>
      </td>
    </tr>
  </tbody>
</table>
<p align="center">
<!-- footer2 footer.php~"{names}", "{params}", "{names2}", "{params2}"~"ATAB_NOMTBL_CKEY_VCH",INSCRIPTION, "PNAME", "DESK"-->
</p>
</div>
</body>
</html>
