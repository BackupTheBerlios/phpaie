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
	'formName' => 'COMMENTPROTO', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_COMMENTPROTO',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Commentaires du prototype :',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'COMMENTPROTO_COMMENT_TE',
		'addElement' => array(
			'type' => 'textarea',
			'label' => '',
			'args' => 'cols="77" rows="2" wrap="virtual"'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'COMMENTPROTO_AUTHOR_CKEY_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 30, 'maxlength' => 30)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'CPML',
		'addElement' => array(
			'type' =>'checkbox',
			'label' => 'Copie sur la ML',
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
			'name' => 'ID_COMMENTPROTO',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ATAB_NOMTBL_CKEY_VCH (Mon Mar 15 14:16:59 2004 SETFKEYS)
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
	'link_0' => array(
		'Args' => array(
			'RETOUR', "", "Javascript:history.go(-1)",  "[Retour]", "class=\"formElemLink\""
			),
		'Paires'=> array(
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ATAB_NOMTBL_CKEY_VCH (Mon Mar 15 14:16:59 2004 SETFKEYS)

			'ATAB_NOMTBL_CKEY_VCH' => 'ATAB_NOMTBL_CKEY_VCH',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		)
	),
// Boutons submit etc ... 
'Buttons' => array (
//bouton 'Envoyer'
'button_B1' => array('submit', 'B1', 'Envoyer'),
//bouton 'Nouveau'
'button_B_NOUVEAU' => array('submit', 'B_NOUVEAU', 'Nouveau'),
	)
);
?>
