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
require_once("INDEX_def.php");
require_once("../inc/session_libre.php");
//Création de l'objet page par défaut
$pg_INDEX = new INDEX( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
// Affichage de la présentation
// paramètre: action à effectuer si validation
// L'affichage de la présentation n'est pas pris en charge par $pg_INDEX
//Récupération des variables pour le formulaire
$vars = $pg_INDEX->getValidVars( );
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
<body bgcolor="#FFFFFF">
<h1>Test for the LoginManager class</h1>
<p>This example is intended to be used with the Auth/DB and the Perm/DB_Complex 
  driver.</p>
<p>To set this up follow these steps:</p>
<ol>
  <li>Copy the files in this directory into your web root.</li>
  <li>Configure your DSN and the PEAR path in the main.inc.php.</li>
  <li>Set up a test database by importing demodata.sql.</li>
</ol>
<p><a href="news_new.php">Go for it.</a></p>
<hr>
<p><i>Login Data for this Example:</i></p>
<table border="1">
  <tr> 
    <th width="100">Handle</th>
    <th width="100">Group</th>
    <th width="100">Password</th>
  </tr>
  <tr> 
    <td width="100">admin</td>
    <td width="100">ADMINS</td>
    <td width="100">test</td>
  </tr>
  <tr> 
    <td width="100">userA</td>
    <td width="100">GroupA+B</td>
    <td width="100">test</td>
  </tr>
  <tr> 
    <td width="100">userB</td>
    <td width="100">GroupA</td>
    <td width="100">test</td>
  </tr>
  <tr> 
    <td width="100">userC</td>
    <td width="100">GroupB</td>
    <td width="100">test</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
