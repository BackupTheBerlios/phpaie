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
	'formName' => 'INSCRIPTION', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_INSCRIPTION',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Inscription :',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'INSCRIPTION_PSEUDO_CKEY_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 32, 'maxlength' => 15)),
		'nbArgsRule' => 3
		),
array (
		'name'=> 'INSCRIPTION_PASSWORD_VCH',
		'addElement' => array(
			'type' =>'password',
			'label' => '',
			'args' => '<td><input type=\"password\"  size=\"32\" maxlength=\"15\" style=\"width:150px;height:20px;\"></td>'),
		'nbArgsRule' => 2
		),
array (
		'name'=> 'CPassword',
		'addElement' => array(
			'type' =>'password',
			'label' => 'Confirmation mot de passe',
			'args' => ''),
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
			'name' => 'ID_INSCRIPTION',
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
//bouton 'Envoyer'
'button_B1' => array('submit', 'B1', 'Envoyer'),
	)

);
?>
