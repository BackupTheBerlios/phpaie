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
require_once("INTROPROTO_def.php");
require_once("../inc/session_libre.php");
//R�cup�ration des variables des m�thodes POST et GET
$pg_INTROPROTO = new INTROPROTO( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//R�cup�ration des variables pour le formulaire
$vars = $pg_INTROPROTO->getValidVars( );
//INIT_PAGE enregistrement
//Assertion de la condition de la redirection ($condition)
if (!$pg_INTROPROTO->fetchOne( "COUNT(*)", "WHERE INSCRIPTION_PSEUDO_CKEY_VCH = '".$vars['INSCRIPTION_PSEUDO_CKEY_VCH']."'", "") && isset ($vars['INSCRIPTION_PASSWORD_VCH']) && isset ($vars['INSCRIPTION_PSEUDO_CKEY_VCH']) && isset ($vars['CPassword']) && $vars['INSCRIPTION_PASSWORD_VCH'] == $vars['CPassword'] && $vars['INSCRIPTION_PSEUDO_CKEY_VCH'] != "" && $vars['INSCRIPTION_PASSWORD_VCH'] != "")
	{
//Lead enregistrement code ($ld_enrg_code)

	//Enregistrement ou restitution du formulaire
//TODO : Conditions � mettre en oeuvre Engistrement/Location
	//INIT_PAGE location
//Lead location code ($ld_locat_code)

	//Inscription valide -> insertion et redirection
	$pg_INTROPROTO->InsertDbVars();
	session_register("ID_VISITEUR");
	$ID_VISITEUR = $vars['ID'];

	include "../inc/cnx_param.php";
	//Tout s'est bien pass� : on sort par l�
	header("Location: $domain/$fpath/User/login.php".(isset($PHPSESSID) ?("?". session_name() ."=". session_id()) : "" ));
	exit;
	}
//Trail code ($tr_code)

if (isset( $vars['RETURN_STATUS'] ) && $vars['INSCRIPTION_PASSWORD_VCH'] == "")
	{
	$pg_INTROPROTO->message_status = "<font color=\"red\">Le mot de passe est vide.</font>";
	$pg_INTROPROTO->invalidateStatus();
	}
else if (isset( $vars['RETURN_STATUS'] ) && $vars['INSCRIPTION_PSEUDO_CKEY_VCH'] == "")
	{
	$pg_INTROPROTO->message_status = "<font color=\"red\">L'identifiant est vide.</font>";
	$pg_INTROPROTO->invalidateStatus();
	}
else if (isset ($vars['CPassword']) && $vars['INSCRIPTION_PASSWORD_VCH'] == $vars['CPassword'])
	{
	$pg_INTROPROTO->message_status = "<font color=\"red\">L'identifiant est d&eacute;j&agrave; attribu&eacute;.</font>";
	$pg_INTROPROTO->invalidateStatus();
	}
else if (isset ($vars['CPassword']) && $vars['INSCRIPTION_PASSWORD_VCH'] != $vars['CPassword'])
	{
	$pg_INTROPROTO->message_status = "<font color=\"red\">Les mots de passe ne correspondent pas.</font>";
	$pg_INTROPROTO->invalidateStatus();
	}
 
// Affichage de la pr�sentation
// param�tre: action � effectuer si validation
$pg_INTROPROTO->pageDisplay("");
?>
