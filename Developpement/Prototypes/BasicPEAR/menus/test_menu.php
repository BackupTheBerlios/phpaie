<?php 
//********************************************************************
// Phpaie 
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
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation.
//*********************************************************************
//<link rel="stylesheet" href="../css/Table.css" type="text/css"> 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Définition du plan de paie</title>
<base target="principal">
<META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE"> 
</head>
<body>
<b>

<HR>
Exemple de la classe menu (Les liens sont morts, c'est un exemple)
<HR><BR>

<TABLE border="0" cellpadding="0" cellspacing="0" width="100%">

<?php
// Ouvrez une section "TABLE" (ajoutez un style CSS c'est plus agréable)
// Ici -> implémentation de votre menu : d'abord la classe ...
require_once("menu.php");
// ensuite la description du menu (une simple chaîne)
require_once("t_string.php");
// String_to_Arbo crée l'instance menu (avec un titre)
$menu  = String_to_Arbo ($t_string, "Eléments");
// do_visibility met a jour les "extends" et les "collapses"
$menu -> do_visibility();
// Arbo_print affiche les cellules de la table contenant le menu
Arbo_print( $menu );
// On ferme la table. Le travail est fait
?>
</TABLE>

<?php
echo "<HR/>Contenu de \$t_string (chaîne de configuration)<HR/>";
echo str_replace(array("\r\n", "\r", "\n", "\t"), array("<BR/>", "<BR/>", "<BR/>", "&nbsp;&nbsp;&nbsp;"), $t_string);
?>
<br>Explications des param&egrave;tres du noeud :
<br>
<table BORDER COLS=2 WIDTH="100%" >
<tr>
<td>( 1,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

<td><font color="#006600">// 1 = noeud ouvert , 0 = noeud ferm&eacute;</font></td>
</tr>

<tr>
<td>Employeur,&nbsp;</td>

<td><font color="#006600">//&nbsp; titre affich&eacute;</font></td>
</tr>

<tr>
<td>1,</td>

<td>/<font color="#006600">/ identifiant (il do&icirc;t &ecirc;tre diff&eacute;rent
pour chaque noeud)</font></td>
</tr>

<tr>
<td>Employeur/EMPLOY1_MP.php,</td>

<td><font color="#006600">// Url de destination</font></td>
</tr>

<tr>
<td><i>Url de l'ic&ocirc;ne</i> | (<i>elements ...</i>))</td>

<td><font color="#006600">// noeud(s) fils ou l' url de l'ic&ocirc;ne (qui sera utilis&eacute;e
si l'élément est une feuille sinon l'ic&ocirc;ne par d&eacute;faut est un dossier)</font></td>
</tr>
</table>
<A HREF="menu.zip" >Récuperer les fichiers</A>
</body>
</html>
