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
require_once("NEXT_def.php");
require_once("../inc/session_libre.php");
//Création de l'objet page par défaut
$pg_NEXT = new NEXT( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
// Affichage de la présentation
// paramètre: action à effectuer si validation
// L'affichage de la présentation n'est pas pris en charge par $pg_NEXT
//Récupération des variables pour le formulaire
$vars = $pg_NEXT->getValidVars( );
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
Bonjour
<!-- FETCHNAME -->
Votre identification est terminée.
</body>
</html>
