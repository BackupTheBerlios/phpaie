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
//Initialisation de la session [INIT_PAGE]
require_once("ALTUSER_def.php");
require_once("../inc/session_identifie.php");
//Récupération des variables des méthodes POST et GET
$pg_ALTUSER = new ALTUSER( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//Récupération des variables pour le formulaire
$vars = $pg_ALTUSER->getValidVars( );
//INIT_PAGE enregistrement
//Lead enregistrement code ($ld_enrg_code)


//Trail code ($tr_code)


// Affichage de la présentation
// paramètre: action à effectuer si validation
$pg_ALTUSER->pageDisplay("");
?>
