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
$formDef = array (
'HTML_QuickForm_def' => array (
	'formName' => 'ALTUSER', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_ALTUSER',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Utilisateur',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'ALTUSER_NOM_CKEY_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 38, 'maxlength' => 38)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'ALTUSER_PRENOM_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 38, 'maxlength' => 38)),
		'nbArgsRule' => 0
		),
	
array (
		'name'=> 'ALTUSER_FONCTION_VCH', 
		'addElement' =>  array (
			'type' =>'select',
			'label' => '',
			'args' => array('1' => 'Comptable', '2' => 'Responsable occasionnel', '3' => 'Responsable attitr&eacute;', '4' => 'Autres')),
		'nbArgsRule' => 0
		),
	array (
		'name'  =>  'ST_ROLE_I',
		'addElement' => array(
			'type' =>'static', 
			'label' => 'Role',
			'args' => ''
			),
		'nbArgsRule' => 0
		),
array (
		'name' => 'MSG_STATUS', 
		'addElement' => array (
			'type' => 'static'
			),
		'nbArgsRule' => 0
		),
array (
		'name' => 'RETURN_STATUS',
		'addElement' => array (
			'type' => 'hidden' 
			),
		'nbArgsRule' => 0
		),
array (
			'name' => 'ID_ALTUSER',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@

// @@@@FK_SET_INITFORM_INSERT_ENDS_HERE@@@@

	),
//GroupLinks
'Links' => array(
	
	),
// Boutons submit etc ... 
'Buttons' => array (
//bouton 'Enregistrer'
'button_SUBMIT' => array('submit', 'SUBMIT', 'Enregistrer'),
//bouton 'Effacer'
'button_MAJ' => array('reset', 'MAJ', 'Effacer'),
	)

);
?>
