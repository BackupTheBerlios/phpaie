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
require_once("CHGPWD_def.php");
require_once("../inc/session_libre.php");
//R�cup�ration des variables des m�thodes POST et GET
$pg_CHGPWD = new CHGPWD( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//R�cup�ration des variables pour le formulaire
$vars = $pg_CHGPWD->getValidVars( );
//INIT_PAGE enregistrement
//Lead enregistrement code ($ld_enrg_code)

//routines de de requ�tage MySql
include "../inc/cnx_param.php";
if (!isset( $vars['RETURN_STATUS'] ))
	{
	$pg_CHGPWD->message_status = "Veuillez vous identifier puis modifier votre mot de passe S.V.P.<br>";
	}
else
	{
	if ($vars['RETURN_STATUS'] > 1)
		{
		$pg_CHGPWD->message_status = "erreur n $vars[RETURN_STATUS]<br>";
			$pg_CHGPWD->invalidateStatus();
		}
	// condition incontournable les champs doivent �tre remplis
	$pg_CHGPWD->vars['ID']  = $pg_CHGPWD->fetchOne( "ID_INSCRIPTION", "where ".(($vars['INSCRIPTION_PASSWORD_VCH'] == $vars['CPassword']) ? "1" : "0" )." AND INSCRIPTION_PSEUDO_CKEY_VCH = '".$vars['INSCRIPTION_PSEUDO_CKEY_VCH']."' AND INSCRIPTION_PASSWORD_VCH = '".$vars['OPassword']."'", "");
	//identifiant invalide
	if ($pg_CHGPWD->vars['ID'] > 0)
		{
		$pg_CHGPWD->updateDbVars( $pg_CHGPWD->vars['ID'] );
		$pg_CHGPWD->message_status = "Votre mot de passe est modifi�.";
		}
	elseif ($vars['INSCRIPTION_PASSWORD_VCH'] != $vars['CPassword'])
		{
		$pg_CHGPWD->message_status = "Les mots de passe ne correspondent pas.";
		}
	else
		{
		$pg_CHGPWD->message_status = "Votre identification � �chou�.";
		}
	//interdire l'enregistrement
	$pg_CHGPWD->invalidateStatus();
	}
//Trail code ($tr_code)


// Affichage de la pr�sentation
// param�tre: action � effectuer si validation
$pg_CHGPWD->pageDisplay("");
?>
