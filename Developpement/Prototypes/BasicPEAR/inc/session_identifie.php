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
session_start();
//mise à jour des variables de session 
require_once("../inc/classes.php");
//$local_userid est la variable identifiant localement l'utilisteur connecté dans la BdD
$local_userid = MAIN_CLASS::fetchOne("INSCRIPTION, CONNECTION", 
	"INSCRIPTION.ID_INSCRIPTION", 
	"where INSCRIPTION.ID_INSCRIPTION = CONNECTION.ID_INSCRIPTION AND CONNECTION.CONNECTION_SID_CKEY_VCH = '".$PHPSESSID."'",
	"");
if ($local_userid <= 0) {
	echo "VISITEUR INCONNU. <BR>\n";
	exit(0);
	}
//VERSION en cours d'execution
session_register("ID_VERSION");
$ID_VERSION = 1;
setlocale (LC_TIME, "fr");
?>
