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
	'formName' => 'CONNECTION', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (
array (
		'name'=> 'CONNECTION_SID_CKEY_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 40, 'maxlength' => 15)),
		'nbArgsRule' => 0
		),
	array (
		'name'  =>  'ST_ID_INSCRIPTION',
		'addElement' => array(
			'type' =>'static', 
			'label' => 'ID',
			'args' => ''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'CONNECTION_HOUR_DATE',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 15, 'maxlength' => 15)),
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
			'name' => 'ID_CONNECTION',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:11 2004 SETFKEYS)
,
array (
			'name' => 'ID_INSCRIPTION',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
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
