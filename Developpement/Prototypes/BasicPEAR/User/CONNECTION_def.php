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
//Définition de la classe CONNECTION
class CONNECTION extends MAIN_CLASS {
// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array();
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array();
// ---------- méthodes de l'objet ------
// constructeur CONNECTION
function CONNECTION ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "CONNECTION", "User", $vars );
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
	'CONNECTION_SID_CKEY_VCH' => array (
	'field_name'	=>	"CONNECTION_SID_CKEY_VCH",
	'field_title'	=>	"SID",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"40",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'CONNECTION_HOUR_DATE' => array (
	'field_name'	=>	"CONNECTION_HOUR_DATE",
	'field_title'	=>	"Date et heure",
	'field_value'	=>	"",
	'field_type'	=>	"date",
	'field_length'	=>	"date",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ID_CONNECTION' => array (
	'field_name'	=>	"ID_CONNECTION",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Mon Mar 15 14:17:06 2004 SETFKEYS)
	,
	'ID_INSCRIPTION' => array (
	'field_name'	=>	"ID_INSCRIPTION",
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
$handleName = "connection".$this->displayHandle."Display";
return $this->$handleName( $action, $part );
}
//------------------ connectionDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function connectionDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (CONNECTION)');
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
$page->addBodyContent("<form method=\"post\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n");
$page->addBodyContent("    <tbody>\n");
$page->addBodyContent("      <tr align=\"left\" valign=\"top\">\n");
$page->addBodyContent("        <td align=\"right\" valign=\"middle\" class=\"f_title\" id=\"SID_CKEY_VCH\">SID</td>\n");
$page->addBodyContent("        <td>&nbsp;</td>\n");
$page->addBodyContent("        <td><input type=\"text\"  maxlength=\"15\" size=\"40\" style=\"width: 235; height: 20\" / NAME=\"CONNECTION_SID_CKEY_VCH\" VALUE=\"$vars[CONNECTION_SID_CKEY_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr align=\"left\" valign=\"top\">\n");
$page->addBodyContent("        <td align=\"right\" valign=\"middle\" class=\"f_title\" id=\"ID_INSCRIPTION\">ID</td>\n");
$page->addBodyContent("        <td>&nbsp;</td>\n");
$page->addBodyContent("        <td>\n");
$page->addBodyContent("$vars[ID_INSCRIPTION] ");
$page->addBodyContent("        </td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr align=\"left\" valign=\"top\">\n");
$page->addBodyContent("        <td align=\"right\" valign=\"middle\" class=\"f_title\"  id=\"HOUR_DATE\">Date et heure</td>\n");
$page->addBodyContent("        <td></td>\n");
$page->addBodyContent("        <td><input type=\"text\" size=\"15\"    maxlength=\"15\" style=\"width:150px;height:20px;\" / NAME=\"CONNECTION_HOUR_DATE\" VALUE=\"$vars[CONNECTION_HOUR_DATE]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("    </tbody>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("  <p align=\"center\">\n");
$page->addBodyContent("  <input type=\"submit\" value=\"Envoyer\" name=\"B1\" /></p>\n");
// _INP_INSERTED ID_INSCRIPTION  ( Mon Mar 15 14:17:06 2004 SETFKEYS)
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//Insertion automatique du paramètre ID_INSCRIPTION 
print "<input type=\"hidden\" name=\"ID_INSCRIPTION\" value=\"$vars[ID_INSCRIPTION]\" size=\"11\">\n";
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$page->display();
return 0;
}
***********************************************************************************/
//------------------ connectionQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function connectionQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("CONNECTION_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}
$page->setTitle('Phpaie (CONNECTION)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('CONNECTION', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
//--------------------------CONNECTION_SID_CKEY_VCH--------------------------
$form->addElement('text', 'CONNECTION_SID_CKEY_VCH',  array_shift($titles['CONNECTION_SID_CKEY_VCH']),array('size'=> 40, 'maxlength' => 15));
if ( isset($vars['CONNECTION_SID_CKEY_VCH']) && $vars['CONNECTION_SID_CKEY_VCH']) {
	$defaultValues['CONNECTION_SID_CKEY_VCH'] = $vars['CONNECTION_SID_CKEY_VCH'];
	}
// Pas de rule test défini pour CONNECTION_SID_CKEY_VCH
//--------------------------CONNECTION_ID_INSCRIPTION--------------------------
//Static CONNECTION_ID_INSCRIPTION
$form->addElement('static', 'ST_ID_INSCRIPTION', 'ID');
//--------------------------CONNECTION_HOUR_DATE--------------------------
$form->addElement('text', 'CONNECTION_HOUR_DATE',  array_shift($titles['CONNECTION_HOUR_DATE']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['CONNECTION_HOUR_DATE']) && $vars['CONNECTION_HOUR_DATE']) {
	$defaultValues['CONNECTION_HOUR_DATE'] = $vars['CONNECTION_HOUR_DATE'];
	}
// Pas de rule test défini pour CONNECTION_HOUR_DATE
// @@@@FK_SET_QFVARS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Mon Mar 15 14:17:06 2004 SETFKEYS)
	$form->_submitValues ['ID_INSCRIPTION'] = $vars['ID_INSCRIPTION'];
	$form->addElement('hidden', 'ID_INSCRIPTION');
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
//bouton 'Envoyer'
$button_B1 = &HTML_QuickForm::createElement('submit', 'B1', 'Envoyer');
$form->addGroup(array($button_B1), '', '', '');
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
if (file_exists("Business_connection.php")){
	require_once ("Business_connection.php");
	}
return $status;
}
//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("CONNECTION", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("CONNECTION", $pvars, CONNECTION::getInitInputs());
}
}
?>
