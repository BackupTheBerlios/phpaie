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
require_once("INSCRIPTION_def.php");
require_once("../inc/session_libre.php");
//Récupération des variables des méthodes POST et GET
$pg_INSCRIPTION = new INSCRIPTION( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//Récupération des variables pour le formulaire
$vars = $pg_INSCRIPTION->getValidVars( );
	//INIT_PAGE location
if (!$pg_INSCRIPTION->fetchOne( "COUNT(*)", "WHERE INSCRIPTION_PSEUDO_CKEY_VCH = '".$vars['INSCRIPTION_PSEUDO_CKEY_VCH']."'", "") && isset ($vars['INSCRIPTION_PASSWORD_VCH']) && isset ($vars['INSCRIPTION_PSEUDO_CKEY_VCH']) && isset ($vars['CPassword']) && $vars['INSCRIPTION_PASSWORD_VCH'] == $vars['CPassword'] && $vars['INSCRIPTION_PSEUDO_CKEY_VCH'] != "" && $vars['INSCRIPTION_PASSWORD_VCH'] != "")
	{
//Lead location code ($ld_locat_code)

	//Inscription valide -> insertion et redirection
	$pg_INSCRIPTION->InsertDbVars();
	session_register("ID_VISITEUR");
	$ID_VISITEUR = $vars['ID'];

	include "../inc/cnx_param.php";
	//Tout s'est bien passé : on sort par là
	header("Location: $domain/$fpath/User/next.php".(isset($PHPSESSID) ?("?". session_name() ."=". session_id()) : "" ));
	exit;
	}
//Trail code ($tr_code)

if (isset( $vars['RETURN_STATUS'] ) && $vars['INSCRIPTION_PASSWORD_VCH'] == "")
	{
	$pg_INSCRIPTION->message_status = "Le mot de passe est vide.";
	$pg_INSCRIPTION->invalidateStatus();
	}
else if (isset( $vars['RETURN_STATUS'] ) && $vars['INSCRIPTION_PSEUDO_CKEY_VCH'] == "")
	{
	$pg_INSCRIPTION->message_status = "L'identifiant est vide.";
	$pg_INSCRIPTION->invalidateStatus();
	}
else if (isset ($vars['CPassword']) && $vars['INSCRIPTION_PASSWORD_VCH'] == $vars['CPassword'])
	{
	$pg_INSCRIPTION->message_status = "L'identifiant est d&eacute;j&agrave; attribu&eacute;.";
	$pg_INSCRIPTION->invalidateStatus();
	}
else if (isset ($vars['CPassword']) && $vars['INSCRIPTION_PASSWORD_VCH'] != $vars['CPassword'])
	{
	$pg_INSCRIPTION->message_status = "Les mots de passe ne correspondent pas.";
	$pg_INSCRIPTION->invalidateStatus();
	}
 
// Affichage de la présentation
// paramètre: action à effectuer si validation
$pg_INSCRIPTION->pageDisplay("");
?>
