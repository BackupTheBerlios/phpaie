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
//Définition de la classe COMMENTPROTO
class COMMENTPROTO extends MAIN_CLASS {
// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array();
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array();
// ---------- méthodes de l'objet ------
// constructeur COMMENTPROTO
function COMMENTPROTO ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "COMMENTPROTO", "Gestab", $vars );
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
	'COMMENTPROTO_COMMENT_TE' => array (
	'field_name'	=>	"COMMENTPROTO_COMMENT_TE",
	'field_title'	=>	"Ajouter un commentaire",
	'field_value'	=>	"",
	'field_type'	=>	"text",
	'field_length'	=>	"text",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'COMMENTPROTO_AUTHOR_CKEY_VCH' => array (
	'field_name'	=>	"COMMENTPROTO_AUTHOR_CKEY_VCH",
	'field_title'	=>	"Auteur",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"30",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ID_COMMENTPROTO' => array (
	'field_name'	=>	"ID_COMMENTPROTO",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ATAB_NOMTBL_CKEY_VCH (Sat May 15 11:48:04 2004 SETFKEYS)
	,
	'ATAB_NOMTBL_CKEY_VCH' => array (
	'field_name'	=>	"ATAB_NOMTBL_CKEY_VCH",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	1,
	'field_quoted'	=>	1,
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
$handleName = "commentproto".$this->displayHandle."Display";
return $this->$handleName( $action, $part );
}
//------------------ commentprotoDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function commentprotoDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (COMMENTPROTO)');
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
$this->resetVars();
$page->addBodyContent($this->listTableDbVars(0));
$page->addBodyContent("<p class=\"f_header\">Commentaires du prototype :\n");
$page->addBodyContent("<form method=\"POST\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table border=\"1\" width=\"71%\" cellpadding=\"0\">\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"22%\" class=\"f_title\" id=\"COMMENT_TE\">Ajouter un commentaire</td>\n");
$page->addBodyContent("      <td width=\"78%\"><textarea rows=\"2\"  cols=\"77\" NAME=\"COMMENTPROTO_COMMENT_TE\">$vars[COMMENTPROTO_COMMENT_TE]</textarea></td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"22%\" class=\"f_title\" id=\"AUTHOR_CKEY_VCH\">Auteur</td>\n");
$page->addBodyContent("      <td width=\"78%\"><input type=\"text\"  size=\"30\" NAME=\"COMMENTPROTO_AUTHOR_CKEY_VCH\" VALUE=\"$vars[COMMENTPROTO_AUTHOR_CKEY_VCH]\" ></td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"22%\"class=\"f_title\" id=\"CPML\">Copie sur la ML<font size=\"-2\">'phpaie@phpaie.net'</font></td>\n");
$page->addBodyContent("      <td width=\"78%\">\n");
$page->addBodyContent("<input type=\"checkbox\" name=\"CPML\" VALUE=\"\">");
$page->addBodyContent("		</td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("  <p align=\"center\">\n");
$page->addBodyContent("  <input type=\"submit\" value=\"Envoyer\" name=\"B1\">\n");
$page->addBodyContent("  <input type=\"submit\" value=\"Nouveau\" name=\"B_NOUVEAU\"></p>\n");
$page->addBodyContent(( TRUE) ? "<a href=\"Javascript:history.go(-1)?\">Retour</a>\n" : "<font color=\"#C0C0C0\">Retour </font>\n");
// _INP_INSERTED ATAB_NOMTBL_CKEY_VCH  ( Sat May 15 11:48:04 2004 SETFKEYS)
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//Insertion automatique du paramètre ATAB_NOMTBL_CKEY_VCH 
print "<input type=\"hidden\" name=\"ATAB_NOMTBL_CKEY_VCH\" value=\"$vars[ATAB_NOMTBL_CKEY_VCH]\" size=\"61\">\n";
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$page->display();
return 0;
}
***********************************************************************************/
//------------------ commentprotoQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function commentprotoQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("COMMENTPROTO_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}
$page->setTitle('Phpaie (COMMENTPROTO)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
$page->addBodyContent($this->listTableDbVars(0));
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('COMMENTPROTO', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
//--------------------------COMMENTPROTO_COMMENT_TE--------------------------
$form->addElement('textarea', 'COMMENTPROTO_COMMENT_TE',  array_shift($titles['COMMENTPROTO_COMMENT_TE']),'cols="77" rows="2" wrap="virtual"');
if ( isset($vars['COMMENTPROTO_COMMENT_TE']) && $vars['COMMENTPROTO_COMMENT_TE']) {
	$defaultValues['COMMENTPROTO_COMMENT_TE'] = $vars['COMMENTPROTO_COMMENT_TE'];
	}
//	--COMMENTPROTO_COMMENT_TE-
// Pas de rule test défini pour COMMENTPROTO_COMMENT_TE
//--------------------------COMMENTPROTO_AUTHOR_CKEY_VCH--------------------------
$form->addElement('text', 'COMMENTPROTO_AUTHOR_CKEY_VCH',  array_shift($titles['COMMENTPROTO_AUTHOR_CKEY_VCH']),array('size'=> 30, 'maxlength' => 30));
if ( isset($vars['COMMENTPROTO_AUTHOR_CKEY_VCH']) && $vars['COMMENTPROTO_AUTHOR_CKEY_VCH']) {
	$defaultValues['COMMENTPROTO_AUTHOR_CKEY_VCH'] = $vars['COMMENTPROTO_AUTHOR_CKEY_VCH'];
	}
// Pas de rule test défini pour COMMENTPROTO_AUTHOR_CKEY_VCH
//--------------------------COMMENTPROTO_CPML--------------------------
//Static COMMENTPROTO_CPML
$form->addElement('static', 'ST_CPML', 'Copie sur la ML');
$titles['CPML'] = array("Copie sur la ML");
//Type =  radio ou checkbox
if ( isset($vars['CPML']) && $vars['CPML']) {
	$defaultValues['CPML'] = $vars['CPML'];
	}
$form->addElement('checkbox',  'CPML',  array_shift($titles['CPML']), '<!-- PHP_PRINT -->', "");
if ( TRUE) {
	 $link_0 = &HTML_QuickForm::createElement('link', 'RETOUR', "", "Javascript:history.go(-1)",  "[Retour]", "class=\"formElemLink\"");
} else {
	 $link_0 = &HTML_QuickForm::createElement('static',  'RETOUR',  "", "[Retour]");
 }
// @@@@FK_SET_QFVARS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ATAB_NOMTBL_CKEY_VCH (Sat May 15 11:48:04 2004 SETFKEYS)
	$form->_submitValues ['ATAB_NOMTBL_CKEY_VCH'] = $vars['ATAB_NOMTBL_CKEY_VCH'];
	$form->addElement('hidden', 'ATAB_NOMTBL_CKEY_VCH');
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
//bouton 'Nouveau'
$button_B_NOUVEAU = &HTML_QuickForm::createElement('submit', 'B_NOUVEAU', 'Nouveau');
$form->addGroup(array($button_B1,$button_B_NOUVEAU), '', '', '');
$form->addGroup(array($link_0), 'LINKS', '', '&nbsp;');
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
if (file_exists("Business_commentproto.php")){
	require_once ("Business_commentproto.php");
	}
return $status;
}
//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("COMMENTPROTO", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("COMMENTPROTO", $pvars, COMMENTPROTO::getInitInputs());
}
}
?>
