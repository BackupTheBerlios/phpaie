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
	'formName' => 'EMPLOY', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_EMPLOY',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Employeur',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_RAISON_CKEY_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 51, 'maxlength' => 51)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_NRUE_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 6, 'maxlength' => 6)),
		'nbArgsRule' => 1
		),
array (
		'name'=> 'EMPLOY_VOIE_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 20, 'maxlength' => 20)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_ADRESSE1_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 46, 'maxlength' => 46)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_ADRESSE2_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 46, 'maxlength' => 46)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_CP_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 11, 'maxlength' => 11)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_VILLE_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 46, 'maxlength' => 46)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_SIRET_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 17, 'maxlength' => 17)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'EMPLOY_APE_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 17, 'maxlength' => 17)),
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
			'name' => 'ID_EMPLOY',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:15 2004 SETFKEYS)
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
	'link_0' => array(
		'Args' => array(
			'NOUVEL_UTILISATEUR', "", "altuser.php",  "[Nouvel utilisateur]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_EMPLOY' => 'ID_EMPLOY',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:15 2004 SETFKEYS)

			'ID_INSCRIPTION' => 'ID_INSCRIPTION',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_1' => array(
		'Args' => array(
			'ORGANISMES_COLLECTEURS', "", "../Orgcoll/orgcol.php",  "[Organismes collecteurs]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_EMPLOY' => 'ID_EMPLOY',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:15 2004 SETFKEYS)

			'ID_INSCRIPTION' => 'ID_INSCRIPTION',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_2' => array(
		'Args' => array(
			'CONVENTION_COLLECTIVE', "", "ccoll.php",  "[Convention collective]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_EMPLOY' => 'ID_EMPLOY',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:15 2004 SETFKEYS)

			'ID_INSCRIPTION' => 'ID_INSCRIPTION',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_3' => array(
		'Args' => array(
			'VARIABLES_EMPLOYEUR', "", "../Formule/variablee.php",  "[Variables employeur]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_EMPLOY' => 'ID_EMPLOY',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:15 2004 SETFKEYS)

			'ID_INSCRIPTION' => 'ID_INSCRIPTION',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		)
	),
// Boutons submit etc ... 
'Buttons' => array (
//bouton 'Enregistrer'
'button_SUBMIT' => array('submit', 'SUBMIT', 'Enregistrer'),
//bouton 'Nouveau'
'button_B_NOUVEAU' => array('submit', 'B_NOUVEAU', 'Nouveau'),
//bouton 'Effacer'
'button_MAJ' => array('reset', 'MAJ', 'Effacer'),
	)
);
?>
