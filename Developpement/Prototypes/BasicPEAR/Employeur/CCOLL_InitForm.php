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
	'formName' => 'CCOLL', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_CCOLL',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Convention collective',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'CCOLL_CODE_CKEY_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 11, 'maxlength' => 11)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'CCOLL_NOM_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 54, 'maxlength' => 54)),
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
			'name' => 'ID_CCOLL',
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
'button_B1' => array('reset', 'B1', 'Effacer'),
	)

);
?>
