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
	'formName' => 'LIVEUSER1LOGIN', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_INSCRIPTION',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Identification LiveUser (1)&nbsp;',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'handle',
		'addElement' => array(
			'type' =>'text',
			'label' => 'Identifiant',
			'args' => array('size'=> 15, 'maxlength' => 15)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'passwd',
		'addElement' => array(
			'type' =>'password',
			'label' => 'Mot de passe',
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
			'name' => 'ID_LIVEUSER1LOGIN',
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
	'link_0' => array(
		'Args' => array(
			'RETOUR', "", "Javascript:history.go(-1)",  "[Retour]", "class=\"formElemLink\""
			),
		'Paires'=> array(
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@

// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@

			)
		)
	),
// Boutons submit etc ... 
'Buttons' => array (
//bouton 'Envoyer'
'button_B1' => array('submit', 'B1', 'Envoyer'),
	)

);
?>
