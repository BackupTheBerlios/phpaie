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
//--------------classe chklist-------------
// Généré le Mon Mar 15 14:14:58 2004 par do_include
// Classe type container chklist
// Prend les variables postée par le formulaire
// et en extrait les inputs checkbox d'une liste
// Nota : les nom des checkbox d'une liste commencent par
// "SEL_" -> état de la check box actuel 
// ou "WAS_" -> état lors du précédant appel du formlaire
// suivi du nom de l'dentifiant de l'objet.
// (ce qui permet de savoir si l'input 'est' ou 'était' séléctionné)
// Met à jour les listes suivantes :
// $selected = liste des variables sélectionnées
// $unselected = liste des variables NON sélectionnées
// $selected2unselected = liste des variables passant de sélectionnées a NON sélectionnées
// $unselected2selected = liste des variables passant de NON sélectionnées à sélectionnées
// $unchanged = liste des variables dont l'état n'a pas changé
// $listId = nom de l'index listé 
// $nbObj = Nombre d'objets de type checklist détectés 
class Chklist {
var $selected = array();
var $unselected = array();
var $selected2unselected = array();
var $unselected2selected = array();
var $unchanged = array();
var $listId; // nom de l'index listé 
var $nbObj; //Nombre d'objets de type checklist détectés 
//---------- Constructeur 
//$vars : array inputs du formulaire 
//$idName : nom de l'index listé par la checklist
function chklist ($vars, $idName)
	{
	return $this->getListObj ($vars, $idName);
	}
//---------- Functions 
function getListObj ($vars, $idName)
//
	{

	if ( empty($vars) ) {
		return 0;
		}

	$listId = $idName;

	$newSelectedItemsChk = array ();
	$oldSelectedItemsChk = array ();

	// TODO en faire une fonction get (infoType)(mais dans quel objet ?)
	// ajouter une méthode (set) qui initialise les variables de type Check d'un widget

	//trier parmi les variables les inputs appartenant à la checklist
	//et parmi celles-ci trier l'état actuel "SEL_" et l'état précédant "WAS_"
	while (list ($lkey, $lval) = each ($vars)) {
	 	$new_index = substr($lkey, 4);
	 	$new_index = str_replace($idName."_", "", $new_index);

	 	if ( strstr	($lkey, "SEL_".$idName."_"))
	 		$newSelectedItemsChk[$new_index] =  $lval;
	 	if ( strstr	($lkey, "WAS_".$idName."_"))
	 		$oldSelectedItemsChk[$new_index] =  $lval;
	 	}

	//déterminer quel changement à eut lieu
	while ( list ($key, $val) = each ($oldSelectedItemsChk)) {
		if ($oldSelectedItemsChk[$key] == "ON" && $newSelectedItemsChk[$key] == "ON") {
			//$key n'a pas bougé -> On
			$this->selected[$key] = 1;
			$this->unchanged[$key] = 1;
	 	} else if ( !$oldSelectedItemsChk[$key]  && !isset($newSelectedItemsChk[$key]) ) {
			//$key n'a pas bougé -> Off
			$this->unselected[$key] = 1;
			$this->unchanged[$key] = 1;
	 	} else if ( $oldSelectedItemsChk[$key] == "ON"  && !isset($newSelectedItemsChk[$key]) ) {
			//$key est passé de On à Off
			$this->unselected[$key] = 1;
			$this->selected2unselected[$key] = 1;
		} else if ( !$oldSelectedItemsChk[$key] && $newSelectedItemsChk[$key] == "ON" ) {
			//$key est passé de Off à On
			$this->selected[$key] = 1;
			$this->unselected2selected[$key] = 1;
			}
	    }
	return (0);
	}
function getSelected ()
	{
		return $this->selected;
	}
function getUnselected ()
	{
		return $this->unselected;
	}
function getSelected2unselected ()
	{
		return $this->selected2unselected;
	}
function getUnselected2selected ()
	{
		return $this->unselected2selected;
	}
function getUnchanged ()
	{
		return $this->unchanged;
	}
function getNbObj ()
	{
		return $this->nbObj;
	}
}
?>
