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
// Avant enregistrement dans mysql reformater
// la date jj/mm/aaaa en aaaa-mm-jj
function date_mysql($date)
	{
	$date_f = explode("/", $date); 
	$temp = $date_f[0]; 
	$date_f[0] = $date_f[2];
	$date_f[2] = $temp; 
	return implode("-", $date_f); 
	}

function date_php($date)
	{
	$date_f = explode("-", $date); 
	$temp = $date_f[0]; 
	$date_f[0] = $date_f[2];
	$date_f[2] = $temp; 
	return implode("/", $date_f); 
	}

// Enregistrement de la trace
	function trace($fichier , $args){
	$contenu = "";
	$args = func_get_args();
	foreach(array_slice($args, 1, count($args)) as $a) {
	 if (is_object($a) || is_resource($a)) {
	 // ignore
	 	} else if (is_array($a)){ // pas de gestion des tableaux associatifs
	 	$contenu .= implode("\n", array_values($a))."\n";
	 	} else {
	 	$contenu .= $a."\n";
	 	}
	 }
	// fichier vide?
	if ($contenu == "") { return FALSE;}

	$fp = fopen($fichier, "a+");
	if (!$fp){ return $fp;}
	$r = fwrite($fp, $contenu);
	fclose($fp);
	return $r;
	}
?>
