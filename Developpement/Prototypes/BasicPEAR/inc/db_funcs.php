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


//------ Section DB --------------fonctions ouverture DB-------------
function openDb()
	{
	if (!class_exists ( "DB" )) {
		include_once("DB/DB.php");
		}
	include("cnx_param.php");
	$theDb = DB::connect($dsn);
	// Handle possible errors
	if (DB::isError($theDb)) {
//------Todo -> generer une exception -------------
print "DBG :".__FILE__." ".__LINE__." ".$this->message_error."<br/>";
	    $this->message_error = $theDb->getMessage();
		return 0; 
		}
	return $theDb; 
	}


//------ Section DB --------------fonction fermeture DB-------------
function closeDb( $theDb )
	{
	if (!class_exists ( "DB" )) {
		include_once("DB/DB.php");
		}
	$theDb->disconnect();
	}


//--------------------fonction query DB-------------
function queryDb( $theDb, $query )
	{
	if (!class_exists ( "DB" )) {
		include_once("DB/DB.php");
		}
	$result = $theDb->query($query);
	if (DB::isError($result)) {
//------Todo -> generer une exception -------------
print "DBG :".__FILE__." ".__LINE__." <font color=\"blue\">".$query."</font> ".$this->message_error."<br/>";
	    $this->message_error = $result->getMessage();
		return 0; 
		}
	return $result;
	}


//--------------------fonction queryOne -------------
function queryOneDb( $theDb, $query )
	{
	if (!class_exists ( "DB" )) {
		include_once("DB/DB.php");
		}
	$result = $theDb->getOne($query);
	if (DB::isError($result)) {
//------Todo -> generer une exception -------------
print "DBG :".__FILE__." ".__LINE__." <font color=\"blue\">".$query."</font> ".$this->message_error."<br/>";
	    $this->message_error = $result->getMessage();
		return 0; 
		}
	return $result;
	}


//--------------------fonction getNextId -------------
function getNextIdDb( $theDb , $idTable )
	{
	//	if (!class_exists ( "DB" )) {}
	if (!class_exists ( "DB" )) {
		include_once("DB/DB.php");
		}
//	settype ($theDb, "DB");
	$result = $theDb->nextId($idTable);
	if (DB::isError($result)) {
//------Todo -> generer une exception -------------
print "DBG :".__FILE__." ".__LINE__." ".$this->message_error."<br/>";
	    $this->message_error = $result->getMessage();
		return 0; 
		}
	return $result;
	}
//--------------------fonction fetchRowAssocDb -------------
function fetchRowAssocDb( $linkResult )
	{
	if (!class_exists ( "DB" )) {
		include_once("DB/DB.php");
		}
	$result = $linkResult->fetchRow(DB_FETCHMODE_ASSOC);
	if (DB::isError($result)) {
//------Todo -> generer une exception -------------
print "DBG :".__FILE__." ".__LINE__." ".$this->message_error."<br/>";
	    $this->message_error = $result->getMessage();
		return 0; 
		}
	return $result;
	}
?>
