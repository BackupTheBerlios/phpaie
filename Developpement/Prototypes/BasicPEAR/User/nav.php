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
require_once("NAV_def.php");
require_once("../inc/session_libre.php");
//Trail code ($tr_code)

require_once("NAV_def.php");
require_once("../inc/session_libre.php");

$pg_NAV = new NAV( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//Désactiver QuickForm
$pg_NAV->displayHandle = "Default";
//Récupération des variables pour le formulaire
$pg_NAV->pageDisplay("");

?>
