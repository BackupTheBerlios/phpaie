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
	'formName' => 'MOEUVREPROTO', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_MOEUVREPROTO',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Mise en oeuvre du prototype',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'MOEUVREPROTO_EXPLIC_TE',
		'addElement' => array(
			'type' => 'textarea',
			'label' => '',
			'args' => 'cols="77" rows="2" wrap="virtual"'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'MOEUVREPROTO_LIENSUPP_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 90, 'maxlength' => 90)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'MOEUVREPROTO_SOURCEURL_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 90, 'maxlength' => 90)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'MOEUVREPROTO_NODENUM_CKEY_I',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 14, 'maxlength' => 14)),
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
			'name' => 'ID_MOEUVREPROTO',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ATAB_NOMTBL_CKEY_VCH (Sat May 15 11:48:08 2004 SETFKEYS)
,
array (
			'name' => 'ATAB_NOMTBL_CKEY_VCH',
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
//bouton 'Retablir'
'button_B2' => array('reset', 'B2', 'Retablir'),
	)
);
?>
