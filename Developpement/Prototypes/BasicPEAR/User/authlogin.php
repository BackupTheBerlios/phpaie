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
// Support �ventuel sur www.phpaie.net
//*********************************************************************
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as 
// published by the Free Software Foundation.
//*********************************************************************
?>
<?php
//Initialisation de la session [INIT_PAGE]
require_once("AUTHLOGIN_def.php");
require_once("../inc/session_libre.php");
//R�cup�ration des variables des m�thodes POST et GET
$pg_AUTHLOGIN = new AUTHLOGIN( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//R�cup�ration des variables pour le formulaire
$vars = $pg_AUTHLOGIN->getValidVars( );
//Trail code ($tr_code)

if(isset($status) && ($status < 0))
	{
	print "<font color=\"red\">Visiteur inconnu :<br/>";
	print_r ($username);
	print_r ($status);
	print "</font>";	
}

// Affichage de la pr�sentation
// param�tre: action � effectuer si validation
$pg_AUTHLOGIN->pageDisplay("");
?>
