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
//Définition de la classe DESK

class DESK extends MAIN_CLASS {

// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<div align=\"center\">",
"<table border=\"0\" width=\"800\" cellspacing=\"0\" cellpadding=\"0\">",
"  <tbody>",
"    <tr>",
"      <td width=\"200\" height=\"550\" valign=\"middle\" align=\"justify\" rowspan=\"3\">",
"        <div style=\"overflow:scroll;height:540px;width:190px;margin: 3px 3px 3px 3px\">",
"        <p align=\"center\"><br />",
"        <b>Organisation des donn&eacute;es</b></p>",
"        <hr />",
"        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">",
"        </table>",
"        <hr />",
"        </div>",
"      </td>",
"      <td width=\"400\" height=\"100\" valign=\"middle\" align=\"center\"><font face=\"Arial\" size=\"2\">",
"        Bonjour ",
"         , bienvenue dans votre bureau.</font></td>",
"      <td width=\"200\" height=\"100\" valign=\"middle\" align=\"center\" >&nbsp; </td>",
"    </tr>",
"    <tr>",
"      <td width=\"400\" height=\"300\" valign=\"middle\" align=\"center\">",
"        <table border=\"0\" width=\"400\" cellspacing=\"0\" cellpadding=\"0\">",
"          <tbody>",
"            <tr>",
"              <td width=\"200\" height=\"150\" valign=\"bottom\"  align=\"center\">",
"              <a href=\"../Employeur/employ.php\" class=\"mainlink\">Employeur</a></td>",
"              <td width=\"200\" height=\"150\" valign=\"bottom\" align=\"center\">",
"              <a href=\"../Salarie/salari.php\"  class=\"mainlink\">Salari&eacute;</a></td>",
"            </tr>",
"            <tr>",
"              <td width=\"200\" height=\"150\" valign=\"bottom\" align=\"center\">",
"              <a href=\"../Rubrique/rubr.php\" class=\"mainlink\">Rubriques</a></td>",
"              <td width=\"200\" height=\"150\" valign=\"bottom\" align=\"center\">",
"              <a href=\"../Planpaie/definition.php\" class=\"mainlink\">Plans de paie</a></td>",
"            </tr>",
"          </tbody>",
"        </table>",
"      </td>",
"      <td width=\"200\" height=\"300\" align=\"justify\">",
"        <ul>",
"          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Statistiques</a></li>",
"          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">&eacute;ditions</a></li>",
"          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">D&eacute;clarations</a></li>",
"          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Forums</a></li>",
"          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Mailing listes</a></li>",
"          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Liens</a></li>",
"        </ul>",
"      </td>",
"    </tr>",
"    <tr>",
"      <td width=\"400\" height=\"150\" valign=\"middle\" align=\"center\"> </td>",
"      <td width=\"200\" height=\"150\" valign=\"middle\" align=\"center\">",
"      <p align=\"center\">machinbipaye<br/>",
"        </p>",
"      </td>",
"    </tr>",
"  </tbody>",
"</table>",
"<p align=\"center\">",
"</p>",
"</div>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array();
// ---------- méthodes de l'objet ------
// constructeur DESK
function DESK ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "DESK", "", $vars );
}

//----------------------- Set input vars ----------------
function getInitInputs( )
{
return array (
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

$handleName = "desk".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ deskDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function deskDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (DESK)');
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

$page->addBodyContent("<div align=\"center\">\n");
$page->addBodyContent("<table border=\"0\" width=\"800\" cellspacing=\"0\" cellpadding=\"0\">\n");
$page->addBodyContent("  <tbody>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"200\" height=\"550\" valign=\"middle\" align=\"justify\" rowspan=\"3\">\n");
$page->addBodyContent("        <div style=\"overflow:scroll;height:540px;width:190px;margin: 3px 3px 3px 3px\">\n");
$page->addBodyContent("        <p align=\"center\"><br />\n");
$page->addBodyContent("        <b>Organisation des donn&eacute;es</b></p>\n");
$page->addBodyContent("        <hr />\n");
$page->addBodyContent("        <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\n");
$page->addBodyContent("        </table>\n");
$page->addBodyContent("        <hr />\n");
$page->addBodyContent("        </div>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("      <td width=\"400\" height=\"100\" valign=\"middle\" align=\"center\"><font face=\"Arial\" size=\"2\">\n");
$page->addBodyContent("        Bonjour \n");
print  MAIN_CLASS::fetchOne("INSCRIPTION, CONNECTION", "INSCRIPTION.INSCRIPTION_PSEUDO_CKEY_VCH", " where INSCRIPTION.ID_INSCRIPTION = CONNECTION.ID_INSCRIPTION AND CONNECTION.CONNECTION_SID_CKEY_VCH = '".session_id()."'","");
$page->addBodyContent("         , bienvenue dans votre bureau.</font></td>\n");
$page->addBodyContent("      <td width=\"200\" height=\"100\" valign=\"middle\" align=\"center\" >&nbsp; </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"400\" height=\"300\" valign=\"middle\" align=\"center\">\n");
$page->addBodyContent("        <table border=\"0\" width=\"400\" cellspacing=\"0\" cellpadding=\"0\">\n");
$page->addBodyContent("          <tbody>\n");
$page->addBodyContent("            <tr>\n");
$page->addBodyContent("              <td width=\"200\" height=\"150\" valign=\"bottom\"  align=\"center\">\n");
$page->addBodyContent("              <a href=\"../Employeur/employ.php\" class=\"mainlink\">Employeur</a></td>\n");
$page->addBodyContent("              <td width=\"200\" height=\"150\" valign=\"bottom\" align=\"center\">\n");
$page->addBodyContent("              <a href=\"../Salarie/salari.php\"  class=\"mainlink\">Salari&eacute;</a></td>\n");
$page->addBodyContent("            </tr>\n");
$page->addBodyContent("            <tr>\n");
$page->addBodyContent("              <td width=\"200\" height=\"150\" valign=\"bottom\" align=\"center\">\n");
$page->addBodyContent("              <a href=\"../Rubrique/rubr.php\" class=\"mainlink\">Rubriques</a></td>\n");
$page->addBodyContent("              <td width=\"200\" height=\"150\" valign=\"bottom\" align=\"center\">\n");
$page->addBodyContent("              <a href=\"../Planpaie/definition.php\" class=\"mainlink\">Plans de paie</a></td>\n");
$page->addBodyContent("            </tr>\n");
$page->addBodyContent("          </tbody>\n");
$page->addBodyContent("        </table>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("      <td width=\"200\" height=\"300\" align=\"justify\">\n");
$page->addBodyContent("        <ul>\n");
$page->addBodyContent("          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Statistiques</a></li>\n");
$page->addBodyContent("          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">&eacute;ditions</a></li>\n");
$page->addBodyContent("          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">D&eacute;clarations</a></li>\n");
$page->addBodyContent("          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Forums</a></li>\n");
$page->addBodyContent("          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Mailing listes</a></li>\n");
$page->addBodyContent("          <li><a href=\"../common/NONIMP.html\" class=\"mainmenu\">Liens</a></li>\n");
$page->addBodyContent("        </ul>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"400\" height=\"150\" valign=\"middle\" align=\"center\"> </td>\n");
$page->addBodyContent("      <td width=\"200\" height=\"150\" valign=\"middle\" align=\"center\">\n");
$page->addBodyContent("      <p align=\"center\">machinbipaye<br/>\n");
$page->addBodyContent('<font size ="-1">V 0.1<BR/>(Sam 15 Mai 2004 13:46:30)</font>');
$page->addBodyContent("        </p>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent("<!-- footer2 footer.php~\"{names}\", \"{params}\", \"{names2}\", \"{params2}\"~\"ATAB_NOMTBL_CKEY_VCH\",INSCRIPTION, \"PNAME\", \"DESK\"-->\n");
$page->addBodyContent("</p>\n");
$page->addBodyContent("</div>\n");
$page->display();
return 0;
}
***********************************************************************************/

//------------------ deskQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function deskQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("DESK_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (DESK)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
$page->addBodyContent( str_replace(array("{names}", "{params}", "{names2}", "{params2}"), array("ATAB_NOMTBL_CKEY_VCH",INSCRIPTION, "PNAME", "DESK"), file("../common/footer.php"))); //QCKFSET.pl 200 
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
if (file_exists("Business_desk.php")){
	require_once ("Business_desk.php");
	}
return $status;
}


//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("DESK", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("DESK", $pvars, DESK::getInitInputs());
}

}
?>
