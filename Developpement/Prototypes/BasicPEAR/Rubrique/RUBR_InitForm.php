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
<?php
if (!isset ($vars[ID_GRUB]) || $vars[ID_GRUB] == "")
{
$HTTP_POST_VARS[ID_GRUB] = 0;
$HTTP_GET_VARS[ID_GRUB] = 0;
$loc_elem = $vars[ELEMENT];
$session_return = $session_cnt;
}
?>
<?php
if (isset ($vars[ID_GRUB]))
{
unset($vars[ID_GRUB]);
}
?>
$formDef = array (
'HTML_QuickForm_def' => array (
	'formName' => 'RUBR', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (array (
		'name' =>  'header_RUBR',
		'addElement' => array(
			'type' =>'header',
			'label' =>'Rubrique :',
			'args' =>''
			),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_CODE_VCH_CKEY',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 8, 'maxlength' => 8)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_LIBEL_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 51, 'maxlength' => 51)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_AFF_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 51, 'maxlength' => 51)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_BASE_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 15, 'maxlength' => 15)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TXQ_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 15, 'maxlength' => 15)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TXSAL_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 15, 'maxlength' => 15)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TXPAT_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 15, 'maxlength' => 15)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_VISIBLE_VCH',
		'addElement' => array(
			'type' =>'text',
			'label' => '',
			'args' => array('size'=> 15, 'maxlength' => 15)),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TGR',
		'addElement' => array(
			'type' =>'radio',
			'label' => '',
			'args' => 'VG'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TGR',
		'addElement' => array(
			'type' =>'radio',
			'label' => '',
			'args' => 'VR'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_MODE_CALC_I', 
		'addElement' =>  array (
			'type' =>'select',
			'label' => '',
			'args' => array('1' => 'Base * Taux', '2' => 'Base * Quantit&eacute;', '3' => 'Base * Taux salarial', '4' => 'Base * Taux patronal', '5' => 'Base', '6' => 'Taux')),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TRUB_I', 
		'addElement' =>  array (
			'type' =>'select',
			'label' => '',
			'args' => array('1' => 'Composante du brut', '2' => 'Composante des contributions', '3' => 'Composante des cotisations', '4' => 'Texte ins&eacute;r&eacute;', '5' => 'Autres')),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TRP',
		'addElement' => array(
			'type' =>'radio',
			'label' => '',
			'args' => 'VN'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TRP',
		'addElement' => array(
			'type' =>'radio',
			'label' => '',
			'args' => 'VA'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TRP',
		'addElement' => array(
			'type' =>'radio',
			'label' => '',
			'args' => 'VB'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TRP',
		'addElement' => array(
			'type' =>'radio',
			'label' => '',
			'args' => 'VC'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_TRP',
		'addElement' => array(
			'type' =>'radio',
			'label' => '',
			'args' => 'VD'),
		'nbArgsRule' => 0
		),
array (
		'name'=> 'RUBR_REGLERP_VCH',
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
			'name' => 'ID_RUBR',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)
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
			'AFFECTER_BASE', "", "../Formule/ecalcul.php",  "[Affecter Base]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR','ID_EMPLOY1' => 'ID_EMPLOY1','RUBR_BASE_VCH' => 'RUBR_BASE_VCH',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_1' => array(
		'Args' => array(
			'AFFECTER_TAUX_/_QT&EACUTE;', "", "../Formule/ecalcul.php",  "[Affecter Taux / Qt&eacute;]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR','ID_EMPLOY1' => 'ID_EMPLOY1','RUBR_TXQ_VCH' => 'RUBR_TXQ_VCH',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_2' => array(
		'Args' => array(
			'AFFECTER_TAUX_SALARIAL', "", "../Formule/ecalcul.php",  "[Affecter Taux salarial]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR','ID_EMPLOY1' => 'ID_EMPLOY1','RUBR_TXSAL_VCH' => 'RUBR_TXSAL_VCH',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_3' => array(
		'Args' => array(
			'AFFECTER_TAUX_PATRONAL', "", "../Formule/ecalcul.php",  "[Affecter Taux Patronal]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR','ID_EMPLOY1' => 'ID_EMPLOY1','RUBR_TXPAT_VCH' => 'RUBR_TXPAT_VCH',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_4' => array(
		'Args' => array(
			'AFFECTER_VISIBILIT&EACUTE;', "", "../Formule/ecalcul.php",  "[Affecter visibilit&eacute;]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR','ID_EMPLOY1' => 'ID_EMPLOY1','VISIBLE_VCH' => 'VISIBLE_VCH',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_5' => array(
		'Args' => array(
			'TOTALISATEURS_AFFECT&EACUTE;S', "", "totalisrubr.php",  "[Totalisateurs affect&eacute;s]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR','ID_EMPLOY1' => 'ID_EMPLOY1',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_6' => array(
		'Args' => array(
			'P&EACUTE;RIODES_DE_VALIDIT&EACUTE;', "", "../common/NONIMP.html",  "[P&eacute;riodes de validit&eacute;]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_7' => array(
		'Args' => array(
			'P&EACUTE;RIODES_DE_D&EACUTE;CLENCHEMENT', "", "../common/NONIMP.html",  "[P&eacute;riodes de d&eacute;clenchement]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_8' => array(
		'Args' => array(
			'ENCHA&ICIRC;NEMENTS', "", "../common/NONIMP.html",  "[Encha&icirc;nements]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_RUBR' => 'ID_RUBR','ID_EMPLOY1' => 'ID_EMPLOY1',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_9' => array(
		'Args' => array(
			'VARIABLES', "", "../Formule/variablea.php",  "[Variables]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_EMPLOY1' => 'ID_EMPLOY1',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
		// @@@@FK_SET_INITFORM_LINK_INSERT_ENDS_HERE@@@@
			)
		),'link_10' => array(
		'Args' => array(
			'&EACUTE;L&EACUTE;MENTS_DE_CALCUL', "", "../Formule/ecalcul.php",  "[&Eacute;l&eacute;ments de calcul]", "class=\"formElemLink\""
			),
		'Paires'=> array('ID_EMPLOY1' => 'ID_EMPLOY1',
// @@@@FK_SET_INITFORM_LINK_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:17 2004 SETFKEYS)

			'ID_EMPLOY' => 'ID_EMPLOY',
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
