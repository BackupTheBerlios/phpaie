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
	'formName' => 'RUBRGRUB', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (
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
			'name' => 'ID_RUBRGRUB',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_GRUB (Sat May 15 11:48:33 2004 SETFKEYS)
,
array (
			'name' => 'ID_GRUB',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// _INP_INSERTED ID_RUBR (Sat May 15 11:48:30 2004 SETFKEYS)
,
array (
			'name' => 'ID_RUBR',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:26 2004 SETFKEYS)
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
			'CRéER_UNE_NOUVELLE_RUBRIQUE', "", "rubr.php",  "[Créer une nouvelle rubrique]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_GRUB' => 'S_ID_I','ID_EMPLOY1' => 'ID_EMPLOY1',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_GRUB (Sat May 15 11:48:33 2004 SETFKEYS)

			'ID_GRUB' => 'ID_GRUB',
		// _INP_INSERTED ID_RUBR (Sat May 15 11:48:30 2004 SETFKEYS)
			'ID_RUBR' => 'ID_RUBR',
		// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:26 2004 SETFKEYS)
			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		)
	),
// Boutons submit etc ... 
'Buttons' => array (
//bouton 'Effacer'
'button_MAJ' => array('reset', 'MAJ', 'Effacer'),
	)
);
?>
