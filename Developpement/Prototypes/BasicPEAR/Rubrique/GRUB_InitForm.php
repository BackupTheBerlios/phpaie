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
	'formName' => 'GRUB', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (
array (
		'name'=> 'GRUB_NOM_CKEY_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 56, 'maxlength' => 56)),
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
			'name' => 'ID_GRUB',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:19 2004 SETFKEYS)
,
array (
			'name' => 'ID_EMPLOY',
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
			'PéRIODES_DE_VERSEMENT', "", "grub.php",  "[Périodes de versement]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_GRUB' => 'S_ID_I','ID_EMPLOY1' => 'ID_EMPLOY1','ID_ORGANCO' => 'ID_ORGANCO',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:19 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_1' => array(
		'Args' => array(
			'RUBRIQUES_AFFECTéES', "", "rubgrub.php",  "[Rubriques affectées]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_GRUB' => 'S_ID_I','ID_EMPLOY1' => 'ID_EMPLOY1','ID_ORGANCO' => 'ID_ORGANCO',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:19 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		)
	),
// Boutons submit etc ... 
'Buttons' => array (
//bouton 'Effacer'
'button_B2' => array('reset', 'B2', 'Effacer'),
	)
);
?>
