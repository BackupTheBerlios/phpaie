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
//Définition de la classe RUBR
class RUBR extends MAIN_CLASS {
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
"        <center>",
"        </center>",
"      </td>",
"    </tr>",
"  </tbody>",
"</table>",
"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">",
"  <tbody>",
"    <tr>      <td width=\"100%\">Les champs de ce formulaire sont  les &eacute;l&eacute;ments",
"        obligatoires d'un bulletin conforme &agrave; la l&eacute;gislation sur la paie. Il",
"        appara&icirc;tront dans les &eacute;ditions tels que vous les avez enregistr&eacute;s",
"        apr&egrave;s validation.</td>",
"    </tr>",
"  </tbody>",
"</table>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array("<p align=\"center\">",
"<-- footer1 -->",
"</p>",
"</center>",
"</div>",
);
// ---------- méthodes de l'objet ------
// constructeur RUBR
function RUBR ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "RUBR", "Rubrique", $vars );
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
	'RUBR_CODE_VCH_CKEY' => array (
	'field_name'	=>	"RUBR_CODE_VCH_CKEY",
	'field_title'	=>	"Code",
	'field_value'	=>	"00000000",
	'field_type'	=>	"varchar",
	'field_length'	=>	"8",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_LIBEL_VCH' => array (
	'field_name'	=>	"RUBR_LIBEL_VCH",
	'field_title'	=>	"Libell&eacute;",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"51",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_AFF_VCH' => array (
	'field_name'	=>	"RUBR_AFF_VCH",
	'field_title'	=>	"Affichage",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"51",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_BASE_VCH' => array (
	'field_name'	=>	"RUBR_BASE_VCH",
	'field_title'	=>	"Base",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_TXQ_VCH' => array (
	'field_name'	=>	"RUBR_TXQ_VCH",
	'field_title'	=>	"Taux / Qt&eacute;",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_TXSAL_VCH' => array (
	'field_name'	=>	"RUBR_TXSAL_VCH",
	'field_title'	=>	"Taux salarial",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_TXPAT_VCH' => array (
	'field_name'	=>	"RUBR_TXPAT_VCH",
	'field_title'	=>	"Taux Patronal",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_VISIBLE_VCH' => array (
	'field_name'	=>	"RUBR_VISIBLE_VCH",
	'field_title'	=>	"Visible si",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_TGR' => array (
	'field_name'	=>	"RUBR_TGR",
	'field_title'	=>	"",
	'field_value'	=>	"VG",
	'field_type'	=>	"varchar",
	'field_length'	=>	"20",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_MODE_CALC_I' => array (
	'field_name'	=>	"RUBR_MODE_CALC_I",
	'field_title'	=>	"Mode de calcul",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	""),
	'RUBR_TRUB_I' => array (
	'field_name'	=>	"RUBR_TRUB_I",
	'field_title'	=>	"Type de rubrique",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	""),
	'RUBR_TRP' => array (
	'field_name'	=>	"RUBR_TRP",
	'field_title'	=>	"Rubrique plafonn&eacute;e ?",
	'field_value'	=>	"VN",
	'field_type'	=>	"varchar",
	'field_length'	=>	"20",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_REGLERP_VCH' => array (
	'field_name'	=>	"RUBR_REGLERP_VCH",
	'field_title'	=>	"R&egrave;gle&nbsp;plafond",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_R6_VCH' => array (
	'field_name'	=>	"RUBR_R6_VCH",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_R5_VCH' => array (
	'field_name'	=>	"RUBR_R5_VCH",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_R7_VCH' => array (
	'field_name'	=>	"RUBR_R7_VCH",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'RUBR_R8_VCH' => array (
	'field_name'	=>	"RUBR_R8_VCH",
	'field_title'	=>	"",
	'field_value'	=>	"0",
	'field_type'	=>	"varchar",
	'field_length'	=>	"15",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ID_RUBR' => array (
	'field_name'	=>	"ID_RUBR",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:22 2004 SETFKEYS)
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
$handleName = "rubr".$this->displayHandle."Display";
return $this->$handleName( $action, $part );
}
//------------------ rubrDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function rubrDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (RUBR)');
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
if (!isset ($vars[ID_GRUB]) || $vars[ID_GRUB] == "")
{
$HTTP_POST_VARS[ID_GRUB] = 0;
$HTTP_GET_VARS[ID_GRUB] = 0;
$loc_elem = $vars[ELEMENT];
$session_return = $session_cnt;
}
$page->addBodyContent("<-- barre_nvg1 -->\n");
$page->addBodyContent("<div align=\"center\">\n");
$page->addBodyContent("  <center>\n");
$page->addBodyContent("<table border=\"0\" width=\"800\">\n");
$page->addBodyContent("  <tbody>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"100%\">\n");
$page->addBodyContent("        <center>\n");
$page->addBodyContent("			<h3><span class=\"f_header\">Rubrique :</span></h3>\n");
$page->addBodyContent("        </center>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">\n");
$page->addBodyContent("  <tbody>\n");
$page->addBodyContent("    <tr>      <td width=\"100%\">Les champs de ce formulaire sont  les &eacute;l&eacute;ments\n");
$page->addBodyContent("        obligatoires d'un bulletin conforme à la l&eacute;gislation sur la paie. Il\n");
$page->addBodyContent("        appara&icirc;tront dans les &eacute;ditions tels que vous les avez enregistr&eacute;s\n");
$page->addBodyContent("        après validation.</td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<form method=\"post\" name=\"rubrique\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table border=\"0\" width=\"800\" HEIGHT=\"197\">\n");
$page->addBodyContent("    <tbody>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" class=\"f_title\" id=\"CODE_VCH_CKEY\" >Code</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"423\" height=\"23\" colspan=\"4\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"8\"   NAME=\"RUBR_CODE_VCH_CKEY\" VALUE=\"$vars[RUBR_CODE_VCH_CKEY]\" ></td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"232\" height=\"161\" rowspan=\"6\">\n");
$page->addBodyContent("  <center>\n");
$page->addBodyContent("  <span class=\"cscat\">D&eacute;finition de la rubrique :<br>\n");
$page->addBodyContent("  <font size=\"-2\"><b>D&eacute;crit le comportement et le calcul d'une ligne du\n");
$page->addBodyContent("  bulletin. Un ligne peut repr&eacute;senter un gain, une retenue, une cotisation, une\n");
$page->addBodyContent("  contribution ou un texte .</span>\n");
$page->addBodyContent("  </center>\n");
$page->addBodyContent("        </td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" class=\"f_title\" id=\"LIBEL_VCH\">Libell&eacute;</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"423\" height=\"23\" colspan=\"4\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"51\"  NAME=\"RUBR_LIBEL_VCH\" VALUE=\"$vars[RUBR_LIBEL_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" valign=\"middle\"  class=\"f_title\" id=\"AFF_VCH\">Affichage</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"423\" height=\"23\" colspan=\"4\" valign=\"middle\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"51\"   NAME=\"RUBR_AFF_VCH\" VALUE=\"$vars[RUBR_AFF_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" class=\"f_title\" id=\"BASE_VCH\">Base</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"132\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"15\"    NAME=\"RUBR_BASE_VCH\" VALUE=\"$vars[RUBR_BASE_VCH]\" >\n");
$page->addBodyContent("        </td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"89\" height=\"23\" class=\"f_title\" id=\"TXQ_VCH\">Taux / Qt&eacute;</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"202\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"15\"    NAME=\"RUBR_TXQ_VCH\" VALUE=\"$vars[RUBR_TXQ_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" class=\"f_title\" id=\"TXSAL_VCH\">Taux salarial</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"132\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"15\"    NAME=\"RUBR_TXSAL_VCH\" VALUE=\"$vars[RUBR_TXSAL_VCH]\" ></td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"89\" height=\"23\" class=\"f_title\" id=\"TXPAT_VCH\">Taux Patronal</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"202\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"15\"    NAME=\"RUBR_TXPAT_VCH\" VALUE=\"$vars[RUBR_TXPAT_VCH]\" >\n");
$page->addBodyContent("        </td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" class=\"f_title\" id=\"VISIBLE_VCH\">Visible si</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"69\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"15\"  NAME=\"RUBR_VISIBLE_VCH\" VALUE=\"$vars[RUBR_VISIBLE_VCH]\" >\n");
$page->addBodyContent("        </td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"68\" height=\"23\">&nbsp;est vrai.</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"143\" height=\"23\"></td>\n");
$page->addBodyContent("        <td align=\"center\" width=\"143\" height=\"23\" valign=\"middle\">\n");
$page->addBodyContent("".(($vars[RUBR_TGR] == "VG") ? "        <input type=\"radio\"   checked NAME=\"RUBR_TGR\" VALUE=\"$vars[RUBR_TGR]\" >Gain" : "        <input type=\"radio\"  NAME=\"RUBR_TGR\" VALUE=\"VG\" >Gain" )."\n");
$page->addBodyContent("".(($vars[RUBR_TGR] == "VR") ? "        <input type=\"radio\"    checked NAME=\"RUBR_TGR\" VALUE=\"$vars[RUBR_TGR]\" >Retenue</td>" : "        <input type=\"radio\"   NAME=\"RUBR_TGR\" VALUE=\"VR\" >Retenue</td>" )."\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" class=\"f_title\" id=\"MODE_CALC_I\">Mode de calcul</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"219\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("        <select size=\"1\"  NAME=\"RUBR_MODE_CALC_I\" >\n");
if ($vars[RUBR_MODE_CALC_I] == "1")
	$page->addBodyContent("<option value=\"1\" selected=\"selected\">Base * Taux</option>\n");
 else
	$page->addBodyContent("            <option >Base * Taux</option>");
if ($vars[RUBR_MODE_CALC_I] == "2")
	$page->addBodyContent("<option value=\"2\" selected=\"selected\">Base * Quantit&eacute;</option>\n");
 else
	$page->addBodyContent("            <option >Base * Quantit&eacute;</option>");
if ($vars[RUBR_MODE_CALC_I] == "3")
	$page->addBodyContent("<option value=\"3\" selected=\"selected\">Base * Taux salarial</option>\n");
 else
	$page->addBodyContent("            <option >Base * Taux salarial</option>");
if ($vars[RUBR_MODE_CALC_I] == "4")
	$page->addBodyContent("<option selected value=\"4\" selected=\"selected\">Base * Taux patronal</option>\n");
 else
	$page->addBodyContent("            <option  >Base * Taux patronal</option>");
if ($vars[RUBR_MODE_CALC_I] == "5")
	$page->addBodyContent("<option value=\"5\" selected=\"selected\">Base</option>\n");
 else
	$page->addBodyContent("            <option >Base</option>");
if ($vars[RUBR_MODE_CALC_I] == "6")
	$page->addBodyContent("<option value=\"6\" selected=\"selected\">Taux</option>\n");
 else
	$page->addBodyContent("            <option >Taux</option>");
$page->addBodyContent("          </select></td>        <td align=\"left\" width=\"218\" height=\"23\" class=\"f_title\" id=\"TRUB_I\">Type de rubrique</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"218\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("        <select size=\"1\"  NAME=\"RUBR_TRUB_I\" >\n");
if ($vars[RUBR_TRUB_I] == "1")
	$page->addBodyContent("<option value=\"1\" selected selected=\"selected\">Composante du brut</option>\n");
 else
	$page->addBodyContent("            <option >Composante du brut</option>");
if ($vars[RUBR_TRUB_I] == "2")
	$page->addBodyContent("<option value=\"2\" selected=\"selected\">Composante des contributions</option>\n");
 else
	$page->addBodyContent("            <option >Composante des contributions</option>");
if ($vars[RUBR_TRUB_I] == "3")
	$page->addBodyContent("<option value=\"3\" selected=\"selected\">Composante des cotisations</option>\n");
 else
	$page->addBodyContent("            <option >Composante des cotisations</option>");
if ($vars[RUBR_TRUB_I] == "4")
	$page->addBodyContent("<option value=\"4\" selected=\"selected\">Texte ins&eacute;r&eacute;</option>\n");
 else
	$page->addBodyContent("            <option >Texte ins&eacute;r&eacute;</option>");
if ($vars[RUBR_TRUB_I] == "5")
	$page->addBodyContent("<option value=\"5\" selected=\"selected\">Autres</option>\n");
 else
	$page->addBodyContent("            <option >Autres</option>");
$page->addBodyContent("          </select></td>      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"125\" height=\"23\" class=\"f_title\" id=\"TRP\">Rubrique plafonn&eacute;e ?</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"219\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("".(($vars[RUBR_TRP] == "VN") ? "          <input type=\"radio\"    checked NAME=\"RUBR_TRP\" VALUE=\"$vars[RUBR_TRP]\" >Non" : "          <input type=\"radio\"   NAME=\"RUBR_TRP\" VALUE=\"VN\" >Non" )."\n");
$page->addBodyContent("".(($vars[RUBR_TRP] == "VA") ? "          <input type=\"radio\"    checked NAME=\"RUBR_TRP\" VALUE=\"$vars[RUBR_TRP]\" >A " : "          <input type=\"radio\"   NAME=\"RUBR_TRP\" VALUE=\"VA\" >A " )."\n");
$page->addBodyContent("".(($vars[RUBR_TRP] == "VB") ? "          <input type=\"radio\"    checked NAME=\"RUBR_TRP\" VALUE=\"$vars[RUBR_TRP]\" >B" : "          <input type=\"radio\"   NAME=\"RUBR_TRP\" VALUE=\"VB\" >B" )."\n");
$page->addBodyContent("".(($vars[RUBR_TRP] == "VC") ? "          <input type=\"radio\"    checked NAME=\"RUBR_TRP\" VALUE=\"$vars[RUBR_TRP]\" >C " : "          <input type=\"radio\"   NAME=\"RUBR_TRP\" VALUE=\"VC\" >C " )."\n");
$page->addBodyContent("".(($vars[RUBR_TRP] == "VD") ? "          <input type=\"radio\"    checked NAME=\"RUBR_TRP\" VALUE=\"$vars[RUBR_TRP]\" >D</td>" : "          <input type=\"radio\"   NAME=\"RUBR_TRP\" VALUE=\"VD\" >D</td>" )."\n");
$page->addBodyContent("        <td align=\"left\" width=\"218\" height=\"23\" class=\"f_title\" id=\"REGLERP_VCH\">R&egrave;gle&nbsp;plafond</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"109\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"15\"  NAME=\"RUBR_REGLERP_VCH\" VALUE=\"$vars[RUBR_REGLERP_VCH]\" ></td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"109\" height=\"23\">\n");
$page->addBodyContent("        <input type=\"hidden\" size=\"15\"    NAME=\"RUBR_R6_VCH\" VALUE=\"$vars[RUBR_R6_VCH]\" >\n");
$page->addBodyContent("        <input type=\"hidden\" size=\"15\"    NAME=\"RUBR_R5_VCH\" VALUE=\"$vars[RUBR_R5_VCH]\" >\n");
$page->addBodyContent("        <input type=\"hidden\" size=\"15\"    NAME=\"RUBR_R7_VCH\" VALUE=\"$vars[RUBR_R7_VCH]\" >\n");
$page->addBodyContent("        <input type=\"hidden\" size=\"15\"    NAME=\"RUBR_R8_VCH\" VALUE=\"$vars[RUBR_R8_VCH]\" >\n");
$page->addBodyContent("        </td>\n");
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
if (isset ($vars[ID_GRUB]))
{
unset($vars[ID_GRUB]);
}
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_BASE_VCH'])) ? "<a href=\"../Formule/ecalcul.php?ELEMENT=RUBR_BASE_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_BASE_VCH=$vars[RUBR_BASE_VCH]\">Affecter Base</a>\n" : "<font color=\"#C0C0C0\">Affecter Base </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_TXQ_VCH'])) ? "<a href=\"../Formule/ecalcul.php?ELEMENT=RUBR_TXQ_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_TXQ_VCH=$vars[RUBR_TXQ_VCH]\">Affecter Taux / Qt&eacute;</a>			\n" : "<font color=\"#C0C0C0\">Affecter Taux / Qt&eacute;			 </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_TXSAL_VCH'])) ? "<a href=\"../Formule/ecalcul.php?ELEMENT=RUBR_TXSAL_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_TXSAL_VCH=$vars[RUBR_TXSAL_VCH]\">Affecter Taux salarial</a>        \n" : "<font color=\"#C0C0C0\">Affecter Taux salarial         </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_TXPAT_VCH'])) ? "<a href=\"../Formule/ecalcul.php?ELEMENT=RUBR_TXPAT_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_TXPAT_VCH=$vars[RUBR_TXPAT_VCH]\">Affecter Taux Patronal</a>        \n" : "<font color=\"#C0C0C0\">Affecter Taux Patronal         </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['VISIBLE_VCH'])) ? "<a href=\"../Formule/ecalcul.php?ELEMENT=VISIBLE_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&VISIBLE_VCH=$vars[VISIBLE_VCH]\">Affecter visibilit&eacute;</a>        \n" : "<font color=\"#C0C0C0\">Affecter visibilit&eacute;         </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1'])) ? "<a href=\"totalisrubr.php?ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]\">Totalisateurs affect&eacute;s</a> - \n" : "<font color=\"#C0C0C0\">Totalisateurs affect&eacute;s -  </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR'])) ? "<a href=\"../common/NONIMP.html?ID_RUBR=$vars[ID_RUBR]\">P&eacute;riodes de validit&eacute;</a> - \n" : "<font color=\"#C0C0C0\">P&eacute;riodes de validit&eacute; -  </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR'])) ? "<a href=\"../common/NONIMP.html?ID_RUBR=$vars[ID_RUBR]\">P&eacute;riodes de d&eacute;clenchement</a> -\n" : "<font color=\"#C0C0C0\">P&eacute;riodes de d&eacute;clenchement - </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1'])) ? "<a href=\"../common/NONIMP.html?ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]\">Encha&icirc;nements</a> - \n" : "<font color=\"#C0C0C0\">Encha&icirc;nements -  </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_EMPLOY1'])) ? "<a href=\"../Formule/variablea.php?ID_EMPLOY1=$vars[ID_EMPLOY1]\">Variables</a> - \n" : "<font color=\"#C0C0C0\">Variables -  </font>\n");
$page->addBodyContent(( TRUE && isset ($vars['ID_EMPLOY1'])) ? "<a href=\"../Formule/ecalcul.php?ID_EMPLOY1=$vars[ID_EMPLOY1]\">&Eacute;l&eacute;ments de calcul</a>\n" : "<font color=\"#C0C0C0\">&Eacute;l&eacute;ments de calcul </font>\n");
$page->addBodyContent("<br>\n");
$page->addBodyContent("Les renseignements inscrits en <strong>gras</strong>  sont obligatoires pour une bonne fonction du service. Les champs optionnels sont\n");
$page->addBodyContent("n&eacute;cessaires lorsqu' ils rentrent dans la composition d'un calcul (voir rubriques et formules).</p>\n");
// _INP_INSERTED ID_EMPLOY  ( Sat May 15 11:48:22 2004 SETFKEYS)
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//Insertion automatique du paramètre ID_EMPLOY 
print "<input type=\"hidden\" name=\"ID_EMPLOY\" value=\"$vars[ID_EMPLOY]\" size=\"11\">\n";
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$this->resetVars();
$page->addBodyContent($this->listTableDbVars());
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent("<-- footer1 -->\n");
$page->addBodyContent("</p>\n");
$page->addBodyContent("</center>\n");
$page->addBodyContent("</div>\n");
$page->display();
return 0;
}
***********************************************************************************/
//------------------ rubrQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function rubrQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("RUBR_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}
$page->setTitle('Phpaie (RUBR)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
if (!isset ($vars[ID_GRUB]) || $vars[ID_GRUB] == "")
{
$HTTP_POST_VARS[ID_GRUB] = 0;
$HTTP_GET_VARS[ID_GRUB] = 0;
$loc_elem = $vars[ELEMENT];
$session_return = $session_cnt;
}
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('RUBR', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
//--------------------------RUBR_CODE_VCH_CKEY--------------------------
$form->addElement('text', 'RUBR_CODE_VCH_CKEY',  array_shift($titles['RUBR_CODE_VCH_CKEY']),array('size'=> 8, 'maxlength' => 8));
if ( isset($vars['RUBR_CODE_VCH_CKEY']) && $vars['RUBR_CODE_VCH_CKEY']) {
	$defaultValues['RUBR_CODE_VCH_CKEY'] = $vars['RUBR_CODE_VCH_CKEY'];
	}
// Pas de rule test défini pour RUBR_CODE_VCH_CKEY
//--------------------------RUBR_LIBEL_VCH--------------------------
$form->addElement('text', 'RUBR_LIBEL_VCH',  array_shift($titles['RUBR_LIBEL_VCH']),array('size'=> 51, 'maxlength' => 51));
if ( isset($vars['RUBR_LIBEL_VCH']) && $vars['RUBR_LIBEL_VCH']) {
	$defaultValues['RUBR_LIBEL_VCH'] = $vars['RUBR_LIBEL_VCH'];
	}
// Pas de rule test défini pour RUBR_LIBEL_VCH
//--------------------------RUBR_AFF_VCH--------------------------
$form->addElement('text', 'RUBR_AFF_VCH',  array_shift($titles['RUBR_AFF_VCH']),array('size'=> 51, 'maxlength' => 51));
if ( isset($vars['RUBR_AFF_VCH']) && $vars['RUBR_AFF_VCH']) {
	$defaultValues['RUBR_AFF_VCH'] = $vars['RUBR_AFF_VCH'];
	}
// Pas de rule test défini pour RUBR_AFF_VCH
//--------------------------RUBR_BASE_VCH--------------------------
$form->addElement('text', 'RUBR_BASE_VCH',  array_shift($titles['RUBR_BASE_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['RUBR_BASE_VCH']) && $vars['RUBR_BASE_VCH']) {
	$defaultValues['RUBR_BASE_VCH'] = $vars['RUBR_BASE_VCH'];
	}
// Pas de rule test défini pour RUBR_BASE_VCH
//--------------------------RUBR_TXQ_VCH--------------------------
$form->addElement('text', 'RUBR_TXQ_VCH',  array_shift($titles['RUBR_TXQ_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['RUBR_TXQ_VCH']) && $vars['RUBR_TXQ_VCH']) {
	$defaultValues['RUBR_TXQ_VCH'] = $vars['RUBR_TXQ_VCH'];
	}
// Pas de rule test défini pour RUBR_TXQ_VCH
//--------------------------RUBR_TXSAL_VCH--------------------------
$form->addElement('text', 'RUBR_TXSAL_VCH',  array_shift($titles['RUBR_TXSAL_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['RUBR_TXSAL_VCH']) && $vars['RUBR_TXSAL_VCH']) {
	$defaultValues['RUBR_TXSAL_VCH'] = $vars['RUBR_TXSAL_VCH'];
	}
// Pas de rule test défini pour RUBR_TXSAL_VCH
//--------------------------RUBR_TXPAT_VCH--------------------------
$form->addElement('text', 'RUBR_TXPAT_VCH',  array_shift($titles['RUBR_TXPAT_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['RUBR_TXPAT_VCH']) && $vars['RUBR_TXPAT_VCH']) {
	$defaultValues['RUBR_TXPAT_VCH'] = $vars['RUBR_TXPAT_VCH'];
	}
// Pas de rule test défini pour RUBR_TXPAT_VCH
//--------------------------RUBR_VISIBLE_VCH--------------------------
$form->addElement('text', 'RUBR_VISIBLE_VCH',  array_shift($titles['RUBR_VISIBLE_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['RUBR_VISIBLE_VCH']) && $vars['RUBR_VISIBLE_VCH']) {
	$defaultValues['RUBR_VISIBLE_VCH'] = $vars['RUBR_VISIBLE_VCH'];
	}
// Pas de rule test défini pour RUBR_VISIBLE_VCH
//Type =  radio ou checkbox
if ( isset($vars['RUBR_TGR']) && $vars['RUBR_TGR']) {
	$defaultValues['RUBR_TGR'] = $vars['RUBR_TGR'];
	}
$form->addElement('radio',  'RUBR_TGR',  array_shift($titles['RUBR_TGR']), '        Gain', "VG");
//Type =  radio ou checkbox
$form->addElement('radio',  'RUBR_TGR',  array_shift($titles['RUBR_TGR']), '        Retenue', "VR");
//--------------------------RUBR_MODE_CALC_I--------------------------
if ( isset($vars['RUBR_MODE_CALC_I']) && $vars['RUBR_MODE_CALC_I']) {
	$defaultValues['RUBR_MODE_CALC_I'] = $vars['RUBR_MODE_CALC_I'];
	} else {
	$defaultValues['RUBR_MODE_CALC_I'] = array(4);
	}
$form->addElement('select', 'RUBR_MODE_CALC_I',  array_shift($titles['RUBR_MODE_CALC_I']), array('1' => 'Base * Taux', '2' => 'Base * Quantit&eacute;', '3' => 'Base * Taux salarial', '4' => 'Base * Taux patronal', '5' => 'Base', '6' => 'Taux'));
if ( isset($vars['RUBR_TRUB_I']) && $vars['RUBR_TRUB_I']) {
	$defaultValues['RUBR_TRUB_I'] = $vars['RUBR_TRUB_I'];
	} else {
	$defaultValues['RUBR_TRUB_I'] = array(1);
	}
$form->addElement('select', 'RUBR_TRUB_I',  array_shift($titles['RUBR_TRUB_I']), array('1' => 'Composante du brut', '2' => 'Composante des contributions', '3' => 'Composante des cotisations', '4' => 'Texte ins&eacute;r&eacute;', '5' => 'Autres'));
//--------------------------RUBR_TRP--------------------------
//Type =  radio ou checkbox
if ( isset($vars['RUBR_TRP']) && $vars['RUBR_TRP']) {
	$defaultValues['RUBR_TRP'] = $vars['RUBR_TRP'];
	}
$form->addElement('radio',  'RUBR_TRP',  array_shift($titles['RUBR_TRP']), '          Non', "VN");
//Type =  radio ou checkbox
$form->addElement('radio',  'RUBR_TRP',  array_shift($titles['RUBR_TRP']), '          A ', "VA");
//Type =  radio ou checkbox
$form->addElement('radio',  'RUBR_TRP',  array_shift($titles['RUBR_TRP']), '          B', "VB");
//Type =  radio ou checkbox
$form->addElement('radio',  'RUBR_TRP',  array_shift($titles['RUBR_TRP']), '          C ', "VC");
//Type =  radio ou checkbox
$form->addElement('radio',  'RUBR_TRP',  array_shift($titles['RUBR_TRP']), '          D', "VD");
//--------------------------RUBR_REGLERP_VCH--------------------------
$form->addElement('text', 'RUBR_REGLERP_VCH',  array_shift($titles['RUBR_REGLERP_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['RUBR_REGLERP_VCH']) && $vars['RUBR_REGLERP_VCH']) {
	$defaultValues['RUBR_REGLERP_VCH'] = $vars['RUBR_REGLERP_VCH'];
	}
// Pas de rule test défini pour RUBR_REGLERP_VCH
if (isset ($vars[ID_GRUB]))
{
unset($vars[ID_GRUB]);
}
if ( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_BASE_VCH'])) {
	 $link_0 = &HTML_QuickForm::createElement('link', 'AFFECTER_BASE', "", "../Formule/ecalcul.php?ELEMENT=RUBR_BASE_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_BASE_VCH=$vars[RUBR_BASE_VCH]",  "[Affecter Base]", "class=\"formElemLink\"");
} else {
	 $link_0 = &HTML_QuickForm::createElement('static',  'AFFECTER_BASE',  "", "[Affecter Base]");
 }
if ( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_TXQ_VCH'])) {
	 $link_1 = &HTML_QuickForm::createElement('link', 'AFFECTER_TAUX_/_QT&EACUTE;', "", "../Formule/ecalcul.php?ELEMENT=RUBR_TXQ_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_TXQ_VCH=$vars[RUBR_TXQ_VCH]",  "[Affecter Taux / Qt&eacute;]", "class=\"formElemLink\"");
} else {
	 $link_1 = &HTML_QuickForm::createElement('static',  'AFFECTER_TAUX_/_QT&EACUTE;',  "", "[Affecter Taux / Qt&eacute;]");
 }
if ( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_TXSAL_VCH'])) {
	 $link_2 = &HTML_QuickForm::createElement('link', 'AFFECTER_TAUX_SALARIAL', "", "../Formule/ecalcul.php?ELEMENT=RUBR_TXSAL_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_TXSAL_VCH=$vars[RUBR_TXSAL_VCH]",  "[Affecter Taux salarial]", "class=\"formElemLink\"");
} else {
	 $link_2 = &HTML_QuickForm::createElement('static',  'AFFECTER_TAUX_SALARIAL',  "", "[Affecter Taux salarial]");
 }
if ( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['RUBR_TXPAT_VCH'])) {
	 $link_3 = &HTML_QuickForm::createElement('link', 'AFFECTER_TAUX_PATRONAL', "", "../Formule/ecalcul.php?ELEMENT=RUBR_TXPAT_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&RUBR_TXPAT_VCH=$vars[RUBR_TXPAT_VCH]",  "[Affecter Taux Patronal]", "class=\"formElemLink\"");
} else {
	 $link_3 = &HTML_QuickForm::createElement('static',  'AFFECTER_TAUX_PATRONAL',  "", "[Affecter Taux Patronal]");
 }
if ( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1']) && isset ($vars['VISIBLE_VCH'])) {
	 $link_4 = &HTML_QuickForm::createElement('link', 'AFFECTER_VISIBILIT&EACUTE;', "", "../Formule/ecalcul.php?ELEMENT=VISIBLE_VCH&ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]&VISIBLE_VCH=$vars[VISIBLE_VCH]",  "[Affecter visibilit&eacute;]", "class=\"formElemLink\"");
} else {
	 $link_4 = &HTML_QuickForm::createElement('static',  'AFFECTER_VISIBILIT&EACUTE;',  "", "[Affecter visibilit&eacute;]");
 }
if ( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1'])) {
	 $link_5 = &HTML_QuickForm::createElement('link', 'TOTALISATEURS_AFFECT&EACUTE;S', "", "totalisrubr.php?ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]",  "[Totalisateurs affect&eacute;s]", "class=\"formElemLink\"");
} else {
	 $link_5 = &HTML_QuickForm::createElement('static',  'TOTALISATEURS_AFFECT&EACUTE;S',  "", "[Totalisateurs affect&eacute;s]");
 }
if ( TRUE && isset ($vars['ID_RUBR'])) {
	 $link_6 = &HTML_QuickForm::createElement('link', 'P&EACUTE;RIODES_DE_VALIDIT&EACUTE;', "", "../common/NONIMP.html?ID_RUBR=$vars[ID_RUBR]",  "[P&eacute;riodes de validit&eacute;]", "class=\"formElemLink\"");
} else {
	 $link_6 = &HTML_QuickForm::createElement('static',  'P&EACUTE;RIODES_DE_VALIDIT&EACUTE;',  "", "[P&eacute;riodes de validit&eacute;]");
 }
if ( TRUE && isset ($vars['ID_RUBR'])) {
	 $link_7 = &HTML_QuickForm::createElement('link', 'P&EACUTE;RIODES_DE_D&EACUTE;CLENCHEMENT', "", "../common/NONIMP.html?ID_RUBR=$vars[ID_RUBR]",  "[P&eacute;riodes de d&eacute;clenchement]", "class=\"formElemLink\"");
} else {
	 $link_7 = &HTML_QuickForm::createElement('static',  'P&EACUTE;RIODES_DE_D&EACUTE;CLENCHEMENT',  "", "[P&eacute;riodes de d&eacute;clenchement]");
 }
if ( TRUE && isset ($vars['ID_RUBR']) && isset ($vars['ID_EMPLOY1'])) {
	 $link_8 = &HTML_QuickForm::createElement('link', 'ENCHA&ICIRC;NEMENTS', "", "../common/NONIMP.html?ID_RUBR=$vars[ID_RUBR]&ID_EMPLOY1=$vars[ID_EMPLOY1]",  "[Encha&icirc;nements]", "class=\"formElemLink\"");
} else {
	 $link_8 = &HTML_QuickForm::createElement('static',  'ENCHA&ICIRC;NEMENTS',  "", "[Encha&icirc;nements]");
 }
if ( TRUE && isset ($vars['ID_EMPLOY1'])) {
	 $link_9 = &HTML_QuickForm::createElement('link', 'VARIABLES', "", "../Formule/variablea.php?ID_EMPLOY1=$vars[ID_EMPLOY1]",  "[Variables]", "class=\"formElemLink\"");
} else {
	 $link_9 = &HTML_QuickForm::createElement('static',  'VARIABLES',  "", "[Variables]");
 }
if ( TRUE && isset ($vars['ID_EMPLOY1'])) {
	 $link_10 = &HTML_QuickForm::createElement('link', '&EACUTE;L&EACUTE;MENTS_DE_CALCUL', "", "../Formule/ecalcul.php?ID_EMPLOY1=$vars[ID_EMPLOY1]",  "[&Eacute;l&eacute;ments de calcul]", "class=\"formElemLink\"");
} else {
	 $link_10 = &HTML_QuickForm::createElement('static',  '&EACUTE;L&EACUTE;MENTS_DE_CALCUL',  "", "[&Eacute;l&eacute;ments de calcul]");
 }
// @@@@FK_SET_QFVARS_INSERT_BEGINS_HERE@@@@
// _INP_INSERTED ID_EMPLOY (Sat May 15 11:48:22 2004 SETFKEYS)
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
//bouton 'Enregistrer'
$button_SUBMIT = &HTML_QuickForm::createElement('submit', 'SUBMIT', 'Enregistrer');
//bouton 'Nouveau'
$button_B_NOUVEAU = &HTML_QuickForm::createElement('submit', 'B_NOUVEAU', 'Nouveau');
//bouton 'Effacer'
$button_MAJ = &HTML_QuickForm::createElement('reset', 'MAJ', 'Effacer');
$form->addGroup(array($button_SUBMIT,$button_B_NOUVEAU,$button_MAJ), '', '', '');
$form->addGroup(array($link_0,$link_1,$link_2,$link_3,$link_4,$link_5,$link_6,$link_7,$link_8,$link_9,$link_10), 'LINKS', '', '&nbsp;');
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
if (file_exists("Business_rubr.php")){
	require_once ("Business_rubr.php");
	}
return $status;
}
//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("RUBR", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("RUBR", $pvars, RUBR::getInitInputs());
}
}
?>
