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
require_once("BASEGEN_def.php");
require_once("../inc/session_libre.php");
//Création de l'objet page par défaut
$pg_BASEGEN = new BASEGEN( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
// Affichage de la présentation
// paramètre: action à effectuer si validation
// L'affichage de la présentation n'est pas pris en charge par $pg_BASEGEN
//Récupération des variables pour le formulaire
$vars = $pg_BASEGEN->getValidVars( );
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
<body>
<BR>
1  création <a href="LOGIN_C.php">LOGIN_C.php</a><BR>
1  insertion <a href="LOGIN_1.php">LOGIN_1.php</a><BR>
1  recherche <a href="LOGIN_F.php">LOGIN_F.php</a><BR>
1  liste <a href="LOGIN_CW.php">LOGIN_CW.php</a><BR>
1  supression <a href="LOGIN_S.php">LOGIN_S.php</a><BR>
1  liste (Gestab) <a href="LOGIN_FS.php">LOGIN_FS.php</a><BR>
1  enregistrement de la table <a href="LOGIN_G.php">LOGIN_G.php</a><BR>
1  enregistrement + liste de la table <a href=""> (1L)</a><BR>
<TD>
<BR>
2  création <a href="INSCRIPTION_C.php">INSCRIPTION_C.php</a><BR>
2  insertion <a href="INSCRIPTION_1.php">INSCRIPTION_1.php</a><BR>
2  recherche <a href="INSCRIPTION_F.php">INSCRIPTION_F.php</a><BR>
2  liste <a href="INSCRIPTION_CW.php">INSCRIPTION_CW.php</a><BR>
2  supression <a href="INSCRIPTION_S.php">INSCRIPTION_S.php</a><BR>
2  liste (Gestab) <a href="INSCRIPTION_FS.php">INSCRIPTION_FS.php</a><BR>
2  enregistrement de la table <a href="INSCRIPTION_G.php">INSCRIPTION_G.php</a><BR>
2  enregistrement + liste de la table <a href=""> (1L)</a><BR>
<TD>
</body>
