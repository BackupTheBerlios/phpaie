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
//--------------fonctions diverses-------------
function setMetaBase ( $tableName, $order )
{
include_once("db_funcs.php");
$link = openDb();
if ($order == "SET_DEF_SELECT_COL") {
	$sql_req = "UPDATE ATAB SET ATAB_CHKSELECT='OFF', ATAB_SELECT='ON' where ATAB_NOMTBL_CKEY_VCH=$tableName";
	//print "<BR>Query :<BR>$sql_req";
	queryDb( $link, $sql_req );
	} elseif ($order == "SET_NONE_COL") {
	$sql_req = "UPDATE ATAB SET ATAB_CHKSELECT='OFF', ATAB_SELECT='OFF' where ATAB_NOMTBL_CKEY_VCH=$tableName";
	//print "<BR>Query :<BR>$sql_req";
	queryDb( $link, $sql_req );
	}

closeDb( $link );
return 0;
?>
