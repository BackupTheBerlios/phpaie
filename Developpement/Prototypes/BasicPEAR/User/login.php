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
require_once("LOGIN_def.php");
require_once("../inc/session_libre.php");
//Récupération des variables des méthodes POST et GET
$pg_LOGIN = new LOGIN( ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET );
//Récupération des variables pour le formulaire
$vars = $pg_LOGIN->getValidVars( );
//INIT_PAGE enregistrement
//Lead enregistrement code ($ld_enrg_code)

//routines de de requêtage MySql
include "../inc/cnx_param.php";
if (!isset( $vars['RETURN_STATUS'] )) {
 $pg_LOGIN->message_status = "Veuillez vous identifier S.V.P.<br>";
 } else {
 if ($vars['RETURN_STATUS'] > 1)  {
  $pg_LOGIN->message_status = "erreur n $vars[RETURN_STATUS]<br>";
  }
 // condition incontournable les champs doivent être remplis
 $id  = $pg_LOGIN->fetchOne( "ID_INSCRIPTION", "where INSCRIPTION_PSEUDO_CKEY_VCH = '".$vars['INSCRIPTION_PSEUDO_CKEY_VCH']."' AND INSCRIPTION_PASSWORD_VCH = '".$vars['INSCRIPTION_PASSWORD_VCH']."'", "");
 //identifiant valide
 if ($id > 0 && isset( $PHPSESSID )) {
 //serialize_session($id, $SID);
 require_once("CONNECTION_def.php");
 CONNECTION::staticInsertDbVars(array ('ID_INSCRIPTION' => $id , 'CONNECTION_SID_CKEY_VCH' => $PHPSESSID, 'CONNECTION_HOUR_DATE' => date("y-m-d", time())));
 // Go away
 header("Location: $domaine/$fpath/Desk/desk.php".(isset($PHPSESSID) ?("?". session_name() ."=". session_id()) : "" ));
 exit;
 }
 $pg_LOGIN->message_status = "Votre identification &agrave; &eacute;chou&eacute;.<BR>Avez-vous oubli&eacute; votre mot de passe ?</BR><A HREF=../common/NONIMP.html>cliquez ici.</A>";
 //Unset RETURN_STATUS inhibe l'enregistrement des donn&eacute;es.
 unset( $pg_LOGIN->vars['RETURN_STATUS'] );
 unset( $HTTP_POST_VARS['RETURN_STATUS'] );
 unset( $HTTP_GET_VARS['RETURN_STATUS'] );
 }
//Trail code ($tr_code)


// Affichage de la présentation
// paramètre: action à effectuer si validation
$pg_LOGIN->pageDisplay("");
?>
