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
//Définition de la classe EMPLOY
class EMPLOY extends MAIN_CLASS {
// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<div align=\"center\">",
"  <center>",
"<table border=\"0\" width=\"800\">",
"  <tbody>",
"    <tr>",
"      <td width=\"100%\">",
"        <center>",
"        </center>",
"      </td>",
"    </tr>",
"  </tbody>",
"</table>",
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">",
"  <tbody>",
"    <tr>  ",
"        <td width=\"100%\">Les champs de ce formulaire sont les &eacute;l&eacute;ments",
"        obligatoires d'un bulletin conforme &agrave; la l&eacute;gislation sur la paie. Il",
"        appara&icirc;tront dans les &eacute;ditions tels que vous les avez enregistr&eacute;s",
"        apr&egrave;s validation.</td>",
"    </tr>",
"  </tbody>",
"</table>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array("<p align=\"center\">",
"</p>",
"</center>",
"</div>",
);
// ---------- méthodes de l'objet ------
// constructeur EMPLOY
function EMPLOY ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "EMPLOY", "Employeur", $vars );
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
	'EMPLOY_RAISON_CKEY_VCH' => array (
	'field_name'	=>	"EMPLOY_RAISON_CKEY_VCH",
	'field_title'	=>	"Raison",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"51",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'EMPLOY_NRUE_VCH' => array (
	'field_name'	=>	"EMPLOY_NRUE_VCH",
	'field_title'	=>	"Adresse&nbsp;N&#176;",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"6",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	array('Le numéro de rue de 1 à 4 caractères', 'rangelength','1,4' )),
	'EMPLOY_VOIE_VCH' => array (
	'field_name'	=>	"EMPLOY_VOIE_VCH",
	'field_title'	=>	"Voie",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"20",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'EMPLOY_ADRESSE1_VCH' => array (
	'field_name'	=>	"EMPLOY_ADRESSE1_VCH",
	'field_title'	=>	"Adresse",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"46",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'EMPLOY_ADRESSE2_VCH' => array (
	'field_name'	=>	"EMPLOY_ADRESSE2_VCH",
	'field_title'	=>	"Adresse",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"46",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'EMPLOY_CP_VCH' => array (
	'field_name'	=>	"EMPLOY_CP_VCH",
	'field_title'	=>	"Code",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'EMPLOY_VILLE_VCH' => array (
	'field_name'	=>	"EMPLOY_VILLE_VCH",
	'field_title'	=>	"Ville",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"46",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'EMPLOY_SIRET_VCH' => array (
	'field_name'	=>	"EMPLOY_SIRET_VCH",
	'field_title'	=>	"Siret",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"17",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'EMPLOY_APE_VCH' => array (
	'field_name'	=>	"EMPLOY_APE_VCH",
	'field_title'	=>	"Ape",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"17",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ID_EMPLOY' => array (
	'field_name'	=>	"ID_EMPLOY",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:15 2004 SETFKEYS)
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
$handleName = "employ".$this->displayHandle."Display";
return $this->$handleName( $action, $part );
}
//------------------ employDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function employDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (EMPLOY)');
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
include_once("../common/BARRE_NVG.php");
$page->addBodyContent("<div align=\"center\">\n");
$page->addBodyContent("  <center>\n");
$page->addBodyContent("<table border=\"0\" width=\"800\">\n");
$page->addBodyContent("  <tbody>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"100%\">\n");
$page->addBodyContent("        <center>\n");
$page->addBodyContent("        <h3><span class=\"f_header\">Employeur</span></h3>\n");
$page->addBodyContent("        </center>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">\n");
$page->addBodyContent("  <tbody>\n");
$page->addBodyContent("    <tr>  \n");
$page->addBodyContent("        <td width=\"100%\">Les champs de ce formulaire sont les éléments\n");
$page->addBodyContent("        obligatoires d'un bulletin conforme à la législation sur la paie. Il\n");
$page->addBodyContent("        apparaîtront dans les éditions tels que vous les avez enregistrés\n");
$page->addBodyContent("        après validation.</td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<form method=\"post\" name=\"employeur\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table border=\"0\" width=\"800\" HEIGHT=\"1\">\n");
$page->addBodyContent("    <tbody>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"RAISON_CKEY_VCH\" width=\"14%\" height=\"23\">Raison</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"51\"  NAME=\"EMPLOY_RAISON_CKEY_VCH\" VALUE=\"$vars[EMPLOY_RAISON_CKEY_VCH]\" ></td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"30%\" height=\"90\" rowspan=\"9\">\n");
$page->addBodyContent("  <center>\n");
$page->addBodyContent("  <span class=\"cscat\">Identification de l'entreprise : <br>\n");
$page->addBodyContent("  Informations sur l' entreprise ou le particulier\n");
$page->addBodyContent("  officiant comme employeur.</span>\n");
$page->addBodyContent("  </center>\n");
$page->addBodyContent("        </td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("<!-- ADD_FORM_RULE NRUE_VCH~'Le numéro de rue de 1 à 4 caractères'~ 'rangelength'~'1,4' -->\n");
$page->addBodyContent("<!-- ADD_FORM_RULE RUE_VCH~'Le Nom de la rue est obligatoire'~'required'-->\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"NRUE_VCH\" width=\"14%\" height=\"23\">Adresse&nbsp;N&#176;</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"6\"  NAME=\"EMPLOY_NRUE_VCH\" VALUE=\"$vars[EMPLOY_NRUE_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"VOIE_VCH\" width=\"14%\" height=\"23\">Voie</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"20\"  NAME=\"EMPLOY_VOIE_VCH\" VALUE=\"$vars[EMPLOY_VOIE_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"ADRESSE1_VCH\" width=\"14%\" height=\"23\">Adresse</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"46\"   NAME=\"EMPLOY_ADRESSE1_VCH\" VALUE=\"$vars[EMPLOY_ADRESSE1_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"ADRESSE2_VCH\" width=\"14%\" height=\"23\">Adresse</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"46\"   NAME=\"EMPLOY_ADRESSE2_VCH\" VALUE=\"$vars[EMPLOY_ADRESSE2_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"CP_VCH\" width=\"14%\" height=\"23\">Code</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"11\"   NAME=\"EMPLOY_CP_VCH\" VALUE=\"$vars[EMPLOY_CP_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"VILLE_VCH\" width=\"14%\" height=\"1\">Ville</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"1\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"46\"   NAME=\"EMPLOY_VILLE_VCH\" VALUE=\"$vars[EMPLOY_VILLE_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"SIRET_VCH\" width=\"14%\" height=\"1\">Siret</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"1\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"17\"   NAME=\"EMPLOY_SIRET_VCH\" VALUE=\"$vars[EMPLOY_SIRET_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" class=\"f_title\" id=\"APE_VCH\" width=\"14%\" height=\"1\">Ape</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"1\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"17\"   NAME=\"EMPLOY_APE_VCH\" VALUE=\"$vars[EMPLOY_APE_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("    </tbody>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("<table border=\"0\" width=\"800\" cellspacing=\"0\" cellpadding=\"0\">\n");
$page->addBodyContent("  <tr>\n");
$page->addBodyContent("    <td width=\"50%\" align=\"center\" valign=\"middle\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("  <center>\n");
$page->addBodyContent("  <input type=\"submit\" value=\"Enregistrer\" name=\"SUBMIT\">\n");
$page->addBodyContent("  <input type=\"submit\" value=\"Nouveau\" name=\"B_NOUVEAU\">\n");
$page->addBodyContent("  <input type=\"reset\" value=\"Effacer\" name=\"MAJ\">\n");
$page->addBodyContent("  </center>\n");
$page->addBodyContent("    </td>\n");
$page->addBodyContent("    <td width=\"50%\" align=\"center\" valign=\"middle\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("    <-- message1 -->\n");
$page->addBodyContent("    </td>\n");
$page->addBodyContent("  </tr>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_EMPLOY'])) ? "<a href=\"altuser.php?ID_EMPLOY=$vars[ID_EMPLOY]\">Nouvel utilisateur</a> - \n" : "<font color=\"#C0C0C0\">Nouvel utilisateur -  </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_EMPLOY'])) ? "<a href=\"../Orgcoll/orgcol.php?ID_EMPLOY=$vars[ID_EMPLOY]\">Organismes collecteurs</a> - \n" : "<font color=\"#C0C0C0\">Organismes collecteurs -  </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_EMPLOY'])) ? "<a href=\"ccoll.php?ID_EMPLOY=$vars[ID_EMPLOY]\">Convention collective</a> - \n" : "<font color=\"#C0C0C0\">Convention collective -  </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_EMPLOY'])) ? "<a href=\"../Formule/variablee.php?ID_EMPLOY=$vars[ID_EMPLOY]\">Variables employeur</a><br>\n" : "<font color=\"#C0C0C0\">Variables employeur<br> </font>\n");
$page->addBodyContent("Les renseignements inscrits en <strong>gras</strong>  sont obligatoires pour une bonne fonction du service. Les champs optionnels sont\n");
$page->addBodyContent("nécessaires lorsqu' ils rentrent dans la composition d'un calcul (voir\n");
$page->addBodyContent("rubriques et formules).</p>\n");
// _INP_INSERTED ID_INSCRIPTION  ( Sat May 15 11:48:15 2004 SETFKEYS)
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//Insertion automatique du paramètre ID_INSCRIPTION 
print "<input type=\"hidden\" name=\"ID_INSCRIPTION\" value=\"$vars[ID_INSCRIPTION]\" size=\"11\">\n";
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$this->resetVars();
$page->addBodyContent($this->listTableDbVars());
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent("<!-- footer2 footer.php~\"{names}\", \"{params}\", \"{names2}\", \"{params2}\"~\"ATAB_NOMTBL_CKEY_VCH\",$this->getName(), \"PNAME\", \"EMPLOY\"-->\n");
$page->addBodyContent("</p>\n");
$page->addBodyContent("</center>\n");
$page->addBodyContent("</div>\n");
$page->display();
return 0;
}
***********************************************************************************/
//------------------ employQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function employQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("EMPLOY_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}
$page->setTitle('Phpaie (EMPLOY)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
// include_once("../common/BARRE_NVG.php");QCKFSET.pl 213
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('EMPLOY', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
//--------------------------EMPLOY_RAISON_CKEY_VCH--------------------------
$form->addElement('text', 'EMPLOY_RAISON_CKEY_VCH',  array_shift($titles['EMPLOY_RAISON_CKEY_VCH']),array('size'=> 51, 'maxlength' => 51));
if ( isset($vars['EMPLOY_RAISON_CKEY_VCH']) && $vars['EMPLOY_RAISON_CKEY_VCH']) {
	$defaultValues['EMPLOY_RAISON_CKEY_VCH'] = $vars['EMPLOY_RAISON_CKEY_VCH'];
	}
// Pas de rule test défini pour EMPLOY_RAISON_CKEY_VCH
//--------------------------EMPLOY_NRUE_VCH--------------------------
$form->addElement('text', 'EMPLOY_NRUE_VCH',  array_shift($titles['EMPLOY_NRUE_VCH']),array('size'=> 6, 'maxlength' => 6));
if ( isset($vars['EMPLOY_NRUE_VCH']) && $vars['EMPLOY_NRUE_VCH']) {
	$defaultValues['EMPLOY_NRUE_VCH'] = $vars['EMPLOY_NRUE_VCH'];
	}
// Pas de rule test défini pour EMPLOY_NRUE_VCH
//--------------------------EMPLOY_VOIE_VCH--------------------------
$form->addElement('text', 'EMPLOY_VOIE_VCH',  array_shift($titles['EMPLOY_VOIE_VCH']),array('size'=> 20, 'maxlength' => 20));
if ( isset($vars['EMPLOY_VOIE_VCH']) && $vars['EMPLOY_VOIE_VCH']) {
	$defaultValues['EMPLOY_VOIE_VCH'] = $vars['EMPLOY_VOIE_VCH'];
	}
// Pas de rule test défini pour EMPLOY_VOIE_VCH
//--------------------------EMPLOY_ADRESSE1_VCH--------------------------
$form->addElement('text', 'EMPLOY_ADRESSE1_VCH',  array_shift($titles['EMPLOY_ADRESSE1_VCH']),array('size'=> 46, 'maxlength' => 46));
if ( isset($vars['EMPLOY_ADRESSE1_VCH']) && $vars['EMPLOY_ADRESSE1_VCH']) {
	$defaultValues['EMPLOY_ADRESSE1_VCH'] = $vars['EMPLOY_ADRESSE1_VCH'];
	}
// Pas de rule test défini pour EMPLOY_ADRESSE1_VCH
//--------------------------EMPLOY_ADRESSE2_VCH--------------------------
$form->addElement('text', 'EMPLOY_ADRESSE2_VCH',  array_shift($titles['EMPLOY_ADRESSE2_VCH']),array('size'=> 46, 'maxlength' => 46));
if ( isset($vars['EMPLOY_ADRESSE2_VCH']) && $vars['EMPLOY_ADRESSE2_VCH']) {
	$defaultValues['EMPLOY_ADRESSE2_VCH'] = $vars['EMPLOY_ADRESSE2_VCH'];
	}
// Pas de rule test défini pour EMPLOY_ADRESSE2_VCH
//--------------------------EMPLOY_CP_VCH--------------------------
$form->addElement('text', 'EMPLOY_CP_VCH',  array_shift($titles['EMPLOY_CP_VCH']),array('size'=> 11, 'maxlength' => 11));
if ( isset($vars['EMPLOY_CP_VCH']) && $vars['EMPLOY_CP_VCH']) {
	$defaultValues['EMPLOY_CP_VCH'] = $vars['EMPLOY_CP_VCH'];
	}
// Pas de rule test défini pour EMPLOY_CP_VCH
//--------------------------EMPLOY_VILLE_VCH--------------------------
$form->addElement('text', 'EMPLOY_VILLE_VCH',  array_shift($titles['EMPLOY_VILLE_VCH']),array('size'=> 46, 'maxlength' => 46));
if ( isset($vars['EMPLOY_VILLE_VCH']) && $vars['EMPLOY_VILLE_VCH']) {
	$defaultValues['EMPLOY_VILLE_VCH'] = $vars['EMPLOY_VILLE_VCH'];
	}
// Pas de rule test défini pour EMPLOY_VILLE_VCH
//--------------------------EMPLOY_SIRET_VCH--------------------------
$form->addElement('text', 'EMPLOY_SIRET_VCH',  array_shift($titles['EMPLOY_SIRET_VCH']),array('size'=> 17, 'maxlength' => 17));
if ( isset($vars['EMPLOY_SIRET_VCH']) && $vars['EMPLOY_SIRET_VCH']) {
	$defaultValues['EMPLOY_SIRET_VCH'] = $vars['EMPLOY_SIRET_VCH'];
	}
// Pas de rule test défini pour EMPLOY_SIRET_VCH
//--------------------------EMPLOY_APE_VCH--------------------------
$form->addElement('text', 'EMPLOY_APE_VCH',  array_shift($titles['EMPLOY_APE_VCH']),array('size'=> 17, 'maxlength' => 17));
if ( isset($vars['EMPLOY_APE_VCH']) && $vars['EMPLOY_APE_VCH']) {
	$defaultValues['EMPLOY_APE_VCH'] = $vars['EMPLOY_APE_VCH'];
	}
// Pas de rule test défini pour EMPLOY_APE_VCH
if ( TRUE && isset ($vars['ID_EMPLOY'])) {
	 $link_0 = &HTML_QuickForm::createElement('link', 'NOUVEL_UTILISATEUR', "", "altuser.php?ID_EMPLOY=$vars[ID_EMPLOY]",  "[Nouvel utilisateur]", "class=\"formElemLink\"");
} else {
	 $link_0 = &HTML_QuickForm::createElement('static',  'NOUVEL_UTILISATEUR',  "", "[Nouvel utilisateur]");
 }
if ( TRUE && isset ($vars['ID_EMPLOY'])) {
	 $link_1 = &HTML_QuickForm::createElement('link', 'ORGANISMES_COLLECTEURS', "", "../Orgcoll/orgcol.php?ID_EMPLOY=$vars[ID_EMPLOY]",  "[Organismes collecteurs]", "class=\"formElemLink\"");
} else {
	 $link_1 = &HTML_QuickForm::createElement('static',  'ORGANISMES_COLLECTEURS',  "", "[Organismes collecteurs]");
 }
if ( TRUE && isset ($vars['ID_EMPLOY'])) {
	 $link_2 = &HTML_QuickForm::createElement('link', 'CONVENTION_COLLECTIVE', "", "ccoll.php?ID_EMPLOY=$vars[ID_EMPLOY]",  "[Convention collective]", "class=\"formElemLink\"");
} else {
	 $link_2 = &HTML_QuickForm::createElement('static',  'CONVENTION_COLLECTIVE',  "", "[Convention collective]");
 }
if ( TRUE && isset ($vars['ID_EMPLOY'])) {
	 $link_3 = &HTML_QuickForm::createElement('link', 'VARIABLES_EMPLOYEUR', "", "../Formule/variablee.php?ID_EMPLOY=$vars[ID_EMPLOY]",  "[Variables employeur]", "class=\"formElemLink\"");
} else {
	 $link_3 = &HTML_QuickForm::createElement('static',  'VARIABLES_EMPLOYEUR',  "", "[Variables employeur]");
 }
// @@@@FK_SET_QFVARS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_INSCRIPTION (Sat May 15 11:48:15 2004 SETFKEYS)
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
//bouton 'Enregistrer'
$button_SUBMIT = &HTML_QuickForm::createElement('submit', 'SUBMIT', 'Enregistrer');
//bouton 'Nouveau'
$button_B_NOUVEAU = &HTML_QuickForm::createElement('submit', 'B_NOUVEAU', 'Nouveau');
//bouton 'Effacer'
$button_MAJ = &HTML_QuickForm::createElement('reset', 'MAJ', 'Effacer');
$form->addGroup(array($button_SUBMIT,$button_B_NOUVEAU,$button_MAJ), '', '', '');
$form->addGroup(array($link_0,$link_1,$link_2,$link_3), 'LINKS', '', '&nbsp;');
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
$page->addBodyContent($this->listTableDbVars());
$page->addBodyContent( str_replace(array("{names}", "{params}", "{names2}", "{params2}"), array("ATAB_NOMTBL_CKEY_VCH",$this->getName(), "PNAME", "EMPLOY"), file("../common/footer.php"))); //QCKFSET.pl 200 
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
if (file_exists("Business_employ.php")){
	require_once ("Business_employ.php");
	}
return $status;
}
//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("EMPLOY", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("EMPLOY", $pvars, EMPLOY::getInitInputs());
}
}
?>
