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
include_once("../inc/classes.php");
include_once("../inc/funcs.php");
//Définition de la classe GRUB
class GRUB extends MAIN_CLASS {
// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<-- barre_nvg1 -->",
"<div align=\"center\">",
"  <center>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array("<p align=\"center\">",
"<-- footer1 -->",
"</p>",
"</center>",
"</div>",
);
// ---------- méthodes de l'objet ------
// constructeur GRUB
function GRUB ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "GRUB", "Rubrique", $vars );
}
//----------------------- Set input vars ----------------
function getInitInputs( )
{
return array (
	'ID_VERSION' => array (
	'field_name'	=>	"ID_VERSION",
	'field_title'	=>	"",
	'field_value'	=>	"1",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	""),
	'GRUB_NOM_CKEY_VCH' => array (
	'field_name'	=>	"GRUB_NOM_CKEY_VCH",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"56",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ID_GRUB' => array (
	'field_name'	=>	"ID_GRUB",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:13 2004 SETFKEYS)
	,
	'ID_EMPLOY' => array (
	'field_name'	=>	"ID_EMPLOY",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	1,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_ENDS_HERE@@@@
);
}
//------------------ pageDisplay ---------------------
// pageDisplay(
// $displayHandle : handle of the display fct
// $action : URL of the script action (such as PHP_SELF)
// $part : which part of the page (0 : all) )
// Action par 
function pageDisplay( $action = "", $part = 0 )
{
$this->initInputsTitles();
// Le formulaire n'est pas validé
if (!$this->isFormValidated()) {
// L'identifiant est connu
	if ($this->isIdSet()) {
		//Initialisation des valeurs de l'identifiant courant
		$this->setDbVars( );
		} else {
		//Initialisation des valeurs par défaut
		$this->initInputsVars( );
		}
	} else {
// Le formulaire est validé (ou autre bouton formulaire)
	if ($this->isNewButton()) {
		// RAZ des variables
		$id_name = $this->getIdName();
		$this->resetVars();
		unset( $this->vars[$id_name]);
		unset( $this->vars['B_NOUVEAU']);
		}
	}
$handleName = "grub".$this->displayHandle."Display";
return $this->$handleName( $action, $part );
}
//------------------ grubDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function grubDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (GRUB)');
$vars = $this->vars;
$titles = $this->titles;
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
//Callback method de vérification
if ($this->isFormValidated() && $action !=  "") {
	$this->$action();
	}
if (($ret_ba = $this->businessAction()) != 0) {
	return $ret_ba;
	}
$page->addBodyContent("<-- barre_nvg1 -->\n");
$page->addBodyContent("<div align=\"center\">\n");
$page->addBodyContent("  <center>\n");
$page->addBodyContent("<form method=\"post\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table border=\"0\" width=\"800\" height=\"1\">\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"664\" height=\"1\" colspan=\"3\">\n");
$page->addBodyContent("        <p align=\"center\"><span class=\"title\">Groupe de rubriques</span></p>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"664\" height=\"1\" colspan=\"3\">Les renseignements inscrits en <strong>gras</strong> \n");
$page->addBodyContent("        sont obligatoires pour une bonne fonction du service. Les champs\n");
$page->addBodyContent("        optionnels sont nécessaires lorsqu' ils rentrent dans la composition\n");
$page->addBodyContent("        d'un calcul (voir rubriques et formules).</td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"97\" height=\"1\"><strong>Nom</strong> </td>\n");
$page->addBodyContent("      <td width=\"346\" height=\"1\"><input type=\"text\"  size=\"56\" NAME=\"GRUB_NOM_CKEY_VCH\" VALUE=\"$vars[GRUB_NOM_CKEY_VCH]\" ></td>\n");
$page->addBodyContent("      <td width=\"221\" height=\"2\" rowspan=\"2\">\n");
$page->addBodyContent("        <p align=\"center\"><span class=\"cscat\">Groupe de rubriques<br>\n");
$page->addBodyContent("        <font size=\"-2\">Les rubriques sont agrégées en fonction&nbsp; du\n");
$page->addBodyContent("        bordereau de versement.</span></p>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"97\" height=\"1\"></td>\n");
$page->addBodyContent("      <td width=\"346\" height=\"1\">\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("  <table border=\"0\" width=\"800\" height=\"19\">\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"332\" height=\"1\" align=\"center\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("  <input type=\"submit\"      value=\"Envoyer\" name=\"B1\"><input type=\"submit\" value=\"Nouveau\" name=\"B_NOUVEAU\"><input type=\"reset\" value=\"Effacer\" name=\"B2\"></td>\n");
$page->addBodyContent("      <td width=\"332\" height=\"1\" align=\"center\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("      <-- message1 -->\n");
$page->addBodyContent("	   </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("  <p align=\"center\"> \n");
$page->addBodyContent(( TRUE && isset ($vars['S_ID_I']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['ID_ORGANCO'])) ? "<a href=\"grub.php?ID_GRUB=$vars[S_ID_I]&ID_EMPLOY1=$vars[ID_EMPLOY1]&ID_ORGANCO=$vars[ID_ORGANCO]\">Périodes de versement</a> -\n" : "<font color=\"#C0C0C0\">Périodes de versement - </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['S_ID_I']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['ID_ORGANCO'])) ? " <a href=\"rubgrub.php?ID_GRUB=$vars[S_ID_I]&ID_EMPLOY1=$vars[ID_EMPLOY1]&ID_ORGANCO=$vars[ID_ORGANCO]\">Rubriques affectées</a>  \n" : "<font color=\"#C0C0C0\"> Rubriques affectées   </font>\n");
$page->addBodyContent("</p>\n");
// _INP_INSERTED ID_EMPLOY  ( Mon Mar 15 14:17:13 2004 SETFKEYS)
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//Insertion automatique du paramètre ID_EMPLOY 
print "<input type=\"hidden\" name=\"ID_EMPLOY\" value=\"$vars[ID_EMPLOY]\" size=\"11\">\n";
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent("<-- footer1 -->\n");
$page->addBodyContent("</p>\n");
$page->addBodyContent("</center>\n");
$page->addBodyContent("</div>\n");
$page->display();
return 0;
}
***********************************************************************************/
//------------------ grubQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function grubQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("GRUB_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}
$page->setTitle('Phpaie (GRUB)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('GRUB', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
$form->addElement('text', 'GRUB_NOM_CKEY_VCH',  array_shift($titles['GRUB_NOM_CKEY_VCH']),array('size'=> 56, 'maxlength' => 56));
if ( isset($vars['GRUB_NOM_CKEY_VCH']) && $vars['GRUB_NOM_CKEY_VCH']) {
	$defaultValues['GRUB_NOM_CKEY_VCH'] = $vars['GRUB_NOM_CKEY_VCH'];
	}
// Pas de rule test défini pour GRUB_NOM_CKEY_VCH
if ( TRUE && isset ($vars['S_ID_I']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['ID_ORGANCO'])) {
	 $link_0 = &HTML_QuickForm::createElement('link', 'PéRIODES_DE_VERSEMENT', "", "grub.php?ID_GRUB=$vars[S_ID_I]&ID_EMPLOY1=$vars[ID_EMPLOY1]&ID_ORGANCO=$vars[ID_ORGANCO]",  "[Périodes de versement]", "class=\"formElemLink\"");
} else {
	 $link_0 = &HTML_QuickForm::createElement('static',  'PéRIODES_DE_VERSEMENT',  "", "[Périodes de versement]");
 }
if ( TRUE && isset ($vars['S_ID_I']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['ID_ORGANCO'])) {
	 $link_1 = &HTML_QuickForm::createElement('link', 'RUBRIQUES_AFFECTéES', "", "rubgrub.php?ID_GRUB=$vars[S_ID_I]&ID_EMPLOY1=$vars[ID_EMPLOY1]&ID_ORGANCO=$vars[ID_ORGANCO]",  "[Rubriques affectées]", "class=\"formElemLink\"");
} else {
	 $link_1 = &HTML_QuickForm::createElement('static',  'RUBRIQUES_AFFECTéES',  "", "[Rubriques affectées]");
 }
// @@@@FK_SET_QFVARS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Mon Mar 15 14:17:13 2004 SETFKEYS)
	$form->_submitValues ['ID_EMPLOY'] = $vars['ID_EMPLOY'];
	$form->addElement('hidden', 'ID_EMPLOY');
// @@@@FK_SET_QFVARS_INSERT_ENDS_HERE@@@@
$form->addElement('static', 'MSG_STATUS', $this->message_status);
if ( $this->isFormValidated() ) {
	$form->_submitValues ['RETURN_STATUS'] = $vars['RETURN_STATUS'];
	}
$form->addElement('hidden', 'RETURN_STATUS');
$id_name = $this->getIdName();
if ( isset($vars[$id_name])) {
//mettre à jour $vars[$id_name]
	$form->_submitValues [$id_name] = $vars[$id_name];
	}
$form->addElement('hidden', $id_name);
// submit final
//bouton 'Effacer'
$button_B2 = &HTML_QuickForm::createElement('reset', 'B2', 'Effacer');
$form->addGroup(array($button_B2), '', '', '');
$form->addGroup(array($link_0,$link_1), 'LINKS', '', '&nbsp;');
$renderer->setGroupTemplate('<table class="formGroupLink" ><tr>{content}</tr></table>', 'LINKS');
$renderer->setGroupElementTemplate('<td>{element}</td>', 'LINKS');
if (isset($defaultValues)) {
	$form->setDefaults($defaultValues);
	}
if($this->isFormValidated() && ($form->validate() == 0))	{
	$this->invalidateStatus();
	}
$form->accept($renderer);
$page->addBodyContent($renderer->tohtml());
if ($this->isFormValidated()) {
// Form is validated, then processes the data
	if ( $action != "") {
		$this->$action();
		}
	}
************************* END TO substitute **************/
//fin du formulaire
// insertion du buffer de pied de présentation
if (!empty($this->footerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->footerBuffer));
	}
if (($ret_ba = $this->businessAction()) != 0) {
	return $ret_ba;
	}
// insertion du buffer message objet métier
if (!empty($this->businessBuffer)) {
	$page->addBodyContent(implode ("\n", $this->businessBuffer));
	}
$page->display();
return 0;
}
//----------------------- Méthode métier après validation par défaut ----------------
function businessAction( )
{
$status = 0;
if (file_exists("Business_grub.php")){
	require_once ("Business_grub.php");
	}
return $status;
}
//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("GRUB", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("GRUB", $pvars, GRUB::getInitInputs());
}
}
?>
