<?php

require_once "Auth/Auth.php";
require_once("../inc/cnx_param.php");

function myOutput($username, $status)
{
	include("authlogin.php");
}

$params = array(
      'table'         => 'INSCRIPTION',
      'usernamecol'   => 'INSCRIPTION_PSEUDO_CKEY_VCH',
      'passwordcol'   => 'INSCRIPTION_PASSWORD_VCH',
      'dsn'           => $dsn ,
      'cryptType'     => 'none'
    );

$a = new Auth("DB", $params, "myOutput");
$a->logout(); 

$a->start();

if ($a->getAuth()) {
	//recupère les paramètres
	$vars = ( isset( $_POST ) && array_count_values($_POST) ) ? $_POST : $_GET;
	//serialize_session($id, $SID);
	require_once("CONNECTION_def.php");
	// les champs 'username' et 'password' doivent être remplis
	$id  = MAIN_CLASS::fetchOne("INSCRIPTION", "ID_INSCRIPTION", "where INSCRIPTION_PSEUDO_CKEY_VCH = '".$vars['username']."' AND INSCRIPTION_PASSWORD_VCH = '".$vars['password']."'", "");
	// On note la connexion et la correspondance id <-> sid
	CONNECTION::staticInsertDbVars(array ('ID_INSCRIPTION' => $id , 'CONNECTION_SID_CKEY_VCH' => $PHPSESSID, 'CONNECTION_HOUR_DATE' => date("y-m-d", time())));
	// Go away
	header("Location: $domaine/$fpath/Desk/desk.php".(isset($PHPSESSID) ?("?". session_name() ."=". session_id()) : "" ));
	exit;
	}
//obliger la reconnexion a chaque test
?>


