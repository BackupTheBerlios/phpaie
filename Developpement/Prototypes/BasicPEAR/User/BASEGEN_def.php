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
//Définition de la classe BASEGEN

class BASEGEN extends MAIN_CLASS {

// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<BR>",
"1  cr&eacute;ation <a href=\"LOGIN_C.php\">LOGIN_C.php</a><BR>",
"1  insertion <a href=\"LOGIN_1.php\">LOGIN_1.php</a><BR>",
"1  recherche <a href=\"LOGIN_F.php\">LOGIN_F.php</a><BR>",
"1  liste <a href=\"LOGIN_CW.php\">LOGIN_CW.php</a><BR>",
"1  supression <a href=\"LOGIN_S.php\">LOGIN_S.php</a><BR>",
"1  liste (Gestab) <a href=\"LOGIN_FS.php\">LOGIN_FS.php</a><BR>",
"1  enregistrement de la table <a href=\"LOGIN_G.php\">LOGIN_G.php</a><BR>",
"1  enregistrement + liste de la table <a href=\"\"> (1L)</a><BR>",
"<TD>",
"<BR>",
"2  cr&eacute;ation <a href=\"INSCRIPTION_C.php\">INSCRIPTION_C.php</a><BR>",
"2  insertion <a href=\"INSCRIPTION_1.php\">INSCRIPTION_1.php</a><BR>",
"2  recherche <a href=\"INSCRIPTION_F.php\">INSCRIPTION_F.php</a><BR>",
"2  liste <a href=\"INSCRIPTION_CW.php\">INSCRIPTION_CW.php</a><BR>",
"2  supression <a href=\"INSCRIPTION_S.php\">INSCRIPTION_S.php</a><BR>",
"2  liste (Gestab) <a href=\"INSCRIPTION_FS.php\">INSCRIPTION_FS.php</a><BR>",
"2  enregistrement de la table <a href=\"INSCRIPTION_G.php\">INSCRIPTION_G.php</a><BR>",
"2  enregistrement + liste de la table <a href=\"\"> (1L)</a><BR>",
"<TD>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array();
// ---------- méthodes de l'objet ------
// constructeur BASEGEN
function BASEGEN ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "BASEGEN", "", $vars );
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

$handleName = "basegen".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ basegenDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function basegenDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (BASEGEN)');
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

$page->addBodyContent("<BR>\n");
$page->addBodyContent("1  création <a href=\"LOGIN_C.php\">LOGIN_C.php</a><BR>\n");
$page->addBodyContent("1  insertion <a href=\"LOGIN_1.php\">LOGIN_1.php</a><BR>\n");
$page->addBodyContent("1  recherche <a href=\"LOGIN_F.php\">LOGIN_F.php</a><BR>\n");
$page->addBodyContent("1  liste <a href=\"LOGIN_CW.php\">LOGIN_CW.php</a><BR>\n");
$page->addBodyContent("1  supression <a href=\"LOGIN_S.php\">LOGIN_S.php</a><BR>\n");
$page->addBodyContent("1  liste (Gestab) <a href=\"LOGIN_FS.php\">LOGIN_FS.php</a><BR>\n");
$page->addBodyContent("1  enregistrement de la table <a href=\"LOGIN_G.php\">LOGIN_G.php</a><BR>\n");
$page->addBodyContent("1  enregistrement + liste de la table <a href=\""> (1L)</a><BR>\n");
$page->addBodyContent("<TD>\n");
$page->addBodyContent("<BR>\n");
$page->addBodyContent("2  création <a href=\"INSCRIPTION_C.php\">INSCRIPTION_C.php</a><BR>\n");
$page->addBodyContent("2  insertion <a href=\"INSCRIPTION_1.php\">INSCRIPTION_1.php</a><BR>\n");
$page->addBodyContent("2  recherche <a href=\"INSCRIPTION_F.php\">INSCRIPTION_F.php</a><BR>\n");
$page->addBodyContent("2  liste <a href=\"INSCRIPTION_CW.php\">INSCRIPTION_CW.php</a><BR>\n");
$page->addBodyContent("2  supression <a href=\"INSCRIPTION_S.php\">INSCRIPTION_S.php</a><BR>\n");
$page->addBodyContent("2  liste (Gestab) <a href=\"INSCRIPTION_FS.php\">INSCRIPTION_FS.php</a><BR>\n");
$page->addBodyContent("2  enregistrement de la table <a href=\"INSCRIPTION_G.php\">INSCRIPTION_G.php</a><BR>\n");
$page->addBodyContent("2  enregistrement + liste de la table <a href=\""> (1L)</a><BR>\n");
$page->addBodyContent("<TD>\n");
$page->display();
return 0;
}
***********************************************************************************/

//------------------ basegenQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function basegenQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("BASEGEN_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (BASEGEN)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );

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
if (file_exists("Business_basegen.php")){
	require_once ("Business_basegen.php");
	}
return $status;
}


//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("BASEGEN", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("BASEGEN", $pvars, BASEGEN::getInitInputs());
}

}
?>
