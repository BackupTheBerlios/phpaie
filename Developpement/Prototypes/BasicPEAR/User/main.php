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
require_once("../inc/session_libre.php");
?>
<?php 
//Insertion des fichiers de contrôle de session [par défaut]
require_once("MAIN_def.php");
//Création de l'objet page par défaut
$pg_MAIN = new MAIN( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
// Affichage de la présentation
// paramètre: action à effectuer si validation
// L'affichage de la présentation n'est pas pris en charge par $pg_MAIN
//Récupération des variables pour le formulaire
$vars = $pg_MAIN->getValidVars( );
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
<body bgcolor="#ffffff">
<h1>Test Liveuser 3 (Php/Db_simple)<br>
</h1>
<h3>&nbsp;<br>
Vous pouvez utiliser la navigation pour tester une action !
<br>
</h3>
<div style="text-align: justify;">(Le changement de langue n'est pas
op&eacute;rationnel)<br>
Cette fois ci l' authentfication est bas&eacute;e sur le mod&egrave;le
le simple des 2 strat&eacute;gies propos&eacute;es par le package V2.1.<br>
Voici le mod&egrave;le pr&eacute;sent&eacute; dans la documentation (Il
est pas complet manque quelques tables):<br>
<br>
<img style="height: 277px; width: 502px;" alt="Perm_DB_Simple"
 src="../images/Perm_DB_Simple.png"><br>
<br>
On voit ici que les droits des utilisateurs ainsi que les zones de
permissions (o&ugrave; s'exercent localement ces droits) sont&nbsp;
individuels,c'est &agrave; dire propres aux entit&eacute;s 'utilsateur'
et 'zone'. Il n'y a pas de gestion de groupe d'utilisateurs ni de
gestion de domaine de zone. cela ne convient pas &agrave; notre
d&eacute;finition des CU concernant l'authentification puisque nous
avons besoin de ces fonctionalit&eacute;s. Il peut toutefois
pr&eacute;senter un syst&egrave;me d'utilisation que nous pourions
adopter : &agrave; chaque fois qu'un domaine est acc&eacute;d&eacute;
on demande l'identification de l'utilisateur.<br>
(L'alternative &eacute;tant : l'utilsateur ne s'identifie qu'une fois
et la pr&eacute;sentation du syst&egrave;me autorise ou interdit
l'acc&egrave;s aux donn&eacute;es et d&eacute;livre des messages
d'avertissement)<br>
De plus&nbsp; le test du container DB_Simple peut &ecirc;tre vu
comme&nbsp; une &eacute;tape pour adapter DB_Complex &agrave; notre
prototype et (ce qui n'est pas un luxe) nous pouvons cette fois
utiliser les identifiants enregistr&eacute;s dans le prototype.<br>
</div>
</body>
</html>
