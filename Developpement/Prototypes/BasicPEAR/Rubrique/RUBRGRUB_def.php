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
//Définition de la classe RUBRGRUB
class RUBRGRUB extends MAIN_CLASS {
// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<-- barre_nvg1 -->",
"<div align=\"center\">",
"  <center>",
"<table border=\"0\" width=\"800\">",
"  <tbody>",
"    <tr>",
"      <td width=\"100%\">",
"        <p align=\"center\"><span class=\"title\">Liaison Groupe de rubriques \"",
"        \"- Rubrique</span></p>",
"      </td>",
"    </tr>",
"    <tr>",
"      <td width=\"100%\">",
"        <p align=\"center\">",
"  <span class=\"cscat\">Groupe de rubriques",
"  Rubrique : Affecter une ou plusieurs rubriques au",
"  groupe de rubriques.</span>",
"        </p>",
"      </td>",
"    </tr>",
"  </tbody>",
"</table>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array("<p align=\"center\">",
"<-- footer1 --></p>",
"</center>",
"</div>",
);
// ---------- méthodes de l'objet ------
// constructeur RUBRGRUB
function RUBRGRUB ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "RUBRGRUB", "Rubrique", $vars );
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
	'ID_RUBRGRUB' => array (
	'field_name'	=>	"ID_RUBRGRUB",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_GRUB (Sat May 15 11:48:33 2004 SETFKEYS)
	,
	'ID_GRUB' => array (
	'field_name'	=>	"ID_GRUB",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	1,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// _INP_INSERTED ID_RUBR (Sat May 15 11:48:30 2004 SETFKEYS)
	,
	'ID_RUBR' => array (
	'field_name'	=>	"ID_RUBR",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	1,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:26 2004 SETFKEYS)
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
$handleName = "rubrgrub".$this->displayHandle."Display";
return $this->$handleName( $action, $part );
}
//------------------ rubrgrubDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function rubrgrubDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (RUBRGRUB)');
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
$page->addBodyContent("<table border=\"0\" width=\"800\">\n");
$page->addBodyContent("  <tbody>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"100%\">\n");
$page->addBodyContent("        <p align=\"center\"><span class=\"title\">Liaison Groupe de rubriques \"\n");
print  MAIN_CLASS::fetchOne("GRUB", "GRUB_NOM_CKEY_VCH", " WHERE ID_GRUB = $vars[ID_GRUB]","");
$page->addBodyContent("        \"- Rubrique</span></p>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"100%\">\n");
$page->addBodyContent("        <p align=\"center\">\n");
$page->addBodyContent("  <span class=\"cscat\">Groupe de rubriques\n");
$page->addBodyContent("  Rubrique : Affecter une ou plusieurs rubriques au\n");
$page->addBodyContent("  groupe de rubriques.</span>\n");
$page->addBodyContent("        </p>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<form method=\"post\" name=\"employeur\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table border=\"0\" width=\"800\" HEIGHT=\"96\">\n");
$page->addBodyContent("    <tbody>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"548\" height=\"46\">\n");
$page->addBodyContent("<input type=\"hidden\" name=\"'MULTI_RECORDS'\" value=\"RUBR\" size=\"20\">");
Fetch_CHK("GRUB" );
$page->addBodyContent("        </td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("         <td align=\"left\" width=\"548\" height=\"1\">\n");
$page->addBodyContent("         </td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("    </tbody>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("<table border=\"0\" width=\"800\" cellspacing=\"0\" cellpadding=\"0\">\n");
$page->addBodyContent("  <tr>\n");
$page->addBodyContent("    <td width=\"50%\" align=\"center\" valign=\"middle\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("  <center>\n");
$page->addBodyContent("  <input type=\"submit\" value=\"Enregistrer\" name=\"SUBMIT\"><input type=\"reset\" value=\"Effacer\" name=\"MAJ\"></center>\n");
$page->addBodyContent("    </td>\n");
$page->addBodyContent("    <td width=\"50%\" align=\"center\" valign=\"middle\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("    <-- message1 -->\n");
$page->addBodyContent("    </td>\n");
$page->addBodyContent("  </tr>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent(( TRUE && isset ($vars['S_ID_I']) && isset ($vars['ID_EMPLOY1'])) ? "<a href=\"rubr.php?ID_GRUB=$vars[S_ID_I]&ID_EMPLOY1=$vars[ID_EMPLOY1]\">Créer une nouvelle rubrique</a>\n" : "<font color=\"#C0C0C0\">Créer une nouvelle rubrique </font>\n");
// _INP_INSERTED ID_EMPLOY  ( Sat May 15 11:48:26 2004 SETFKEYS)
// _INP_INSERTED ID_RUBR  ( Sat May 15 11:48:30 2004 SETFKEYS)
// _INP_INSERTED ID_GRUB  ( Sat May 15 11:48:33 2004 SETFKEYS)
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//Insertion automatique du paramètre ID_GRUB 
print "<input type=\"hidden\" name=\"ID_GRUB\" value=\"$vars[ID_GRUB]\" size=\"11\">\n";
//Insertion automatique du paramètre ID_RUBR 
print "<input type=\"hidden\" name=\"ID_RUBR\" value=\"$vars[ID_RUBR]\" size=\"11\">\n";
//Insertion automatique du paramètre ID_EMPLOY 
print "<input type=\"hidden\" name=\"ID_EMPLOY\" value=\"$vars[ID_EMPLOY]\" size=\"11\">\n";
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent("<-- footer1 --></p>\n");
$page->addBodyContent("</center>\n");
$page->addBodyContent("</div>\n");
$page->display();
return 0;
}
***********************************************************************************/
//------------------ rubrgrubQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function rubrgrubQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("RUBRGRUB_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}
$page->setTitle('Phpaie (RUBRGRUB)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('RUBRGRUB', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
if ( TRUE && isset ($vars['S_ID_I']) && isset ($vars['ID_EMPLOY1'])) {
	 $link_0 = &HTML_QuickForm::createElement('link', 'CRéER_UNE_NOUVELLE_RUBRIQUE', "", "rubr.php?ID_GRUB=$vars[S_ID_I]&ID_EMPLOY1=$vars[ID_EMPLOY1]",  "[Créer une nouvelle rubrique]", "class=\"formElemLink\"");
} else {
	 $link_0 = &HTML_QuickForm::createElement('static',  'CRéER_UNE_NOUVELLE_RUBRIQUE',  "", "[Créer une nouvelle rubrique]");
 }
// @@@@FK_SET_QFVARS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_GRUB (Sat May 15 11:48:33 2004 SETFKEYS)
	$form->_submitValues ['ID_GRUB'] = $vars['ID_GRUB'];
	$form->addElement('hidden', 'ID_GRUB');
// _INP_INSERTED ID_RUBR (Sat May 15 11:48:30 2004 SETFKEYS)
	$form->_submitValues ['ID_RUBR'] = $vars['ID_RUBR'];
	$form->addElement('hidden', 'ID_RUBR');
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:26 2004 SETFKEYS)
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
$button_MAJ = &HTML_QuickForm::createElement('reset', 'MAJ', 'Effacer');
$form->addGroup(array($button_MAJ), '', '', '');
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
if (file_exists("Business_rubrgrub.php")){
	require_once ("Business_rubrgrub.php");
	}
return $status;
}
//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("RUBRGRUB", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("RUBRGRUB", $pvars, RUBRGRUB::getInitInputs());
}
}
?>
