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
//Définition de la classe MAIN

class MAIN extends MAIN_CLASS {

// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<h1>Test Liveuser 3 (Php/Db_simple)<br>",
"</h1>",
"<h3>&nbsp;<br>",
"Vous pouvez utiliser la navigation pour tester une action !",
"<br>",
"</h3>",
"<div style=\"text-align: justify;\">(Le changement de langue n'est pas",
"op&eacute;rationnel)<br>",
"Cette fois ci l' authentfication est bas&eacute;e sur le mod&egrave;le",
"le simple des 2 strat&eacute;gies propos&eacute;es par le package V2.1.<br>",
"Voici le mod&egrave;le pr&eacute;sent&eacute; dans la documentation (Il",
"est pas complet manque quelques tables):<br>",
"<br>",
"<img style=\"height: 277px; width: 502px;\" alt=\"Perm_DB_Simple\"",
" src=\"../images/Perm_DB_Simple.png\"><br>",
"<br>",
"On voit ici que les droits des utilisateurs ainsi que les zones de",
"permissions (o&ugrave; s'exercent localement ces droits) sont&nbsp;",
"individuels,c'est &agrave; dire propres aux entit&eacute;s 'utilsateur'",
"et 'zone'. Il n'y a pas de gestion de groupe d'utilisateurs ni de",
"gestion de domaine de zone. cela ne convient pas &agrave; notre",
"d&eacute;finition des CU concernant l'authentification puisque nous",
"avons besoin de ces fonctionalit&eacute;s. Il peut toutefois",
"pr&eacute;senter un syst&egrave;me d'utilisation que nous pourions",
"adopter : &agrave; chaque fois qu'un domaine est acc&eacute;d&eacute;",
"on demande l'identification de l'utilisateur.<br>",
"(L'alternative &eacute;tant : l'utilsateur ne s'identifie qu'une fois",
"et la pr&eacute;sentation du syst&egrave;me autorise ou interdit",
"l'acc&egrave;s aux donn&eacute;es et d&eacute;livre des messages",
"d'avertissement)<br>",
"De plus&nbsp; le test du container DB_Simple peut &ecirc;tre vu",
"comme&nbsp; une &eacute;tape pour adapter DB_Complex &agrave; notre",
"prototype et (ce qui n'est pas un luxe) nous pouvons cette fois",
"utiliser les identifiants enregistr&eacute;s dans le prototype.<br>",
"</div>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array();
// ---------- méthodes de l'objet ------
// constructeur MAIN
function MAIN ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "MAIN", "", $vars );
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

$handleName = "main".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ mainDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function mainDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (MAIN)');
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

$page->addBodyContent("<h1>Test Liveuser 3 (Php/Db_simple)<br>\n");
$page->addBodyContent("</h1>\n");
$page->addBodyContent("<h3>&nbsp;<br>\n");
$page->addBodyContent("Vous pouvez utiliser la navigation pour tester une action !\n");
$page->addBodyContent("<br>\n");
$page->addBodyContent("</h3>\n");
$page->addBodyContent("<div style=\"text-align: justify;\">(Le changement de langue n'est pas\n");
$page->addBodyContent("op&eacute;rationnel)<br>\n");
$page->addBodyContent("Cette fois ci l' authentfication est bas&eacute;e sur le mod&egrave;le\n");
$page->addBodyContent("le simple des 2 strat&eacute;gies propos&eacute;es par le package V2.1.<br>\n");
$page->addBodyContent("Voici le mod&egrave;le pr&eacute;sent&eacute; dans la documentation (Il\n");
$page->addBodyContent("est pas complet manque quelques tables):<br>\n");
$page->addBodyContent("<br>\n");
$page->addBodyContent("<img style=\"height: 277px; width: 502px;\" alt=\"Perm_DB_Simple\"\n");
$page->addBodyContent(" src=\"../images/Perm_DB_Simple.png\"><br>\n");
$page->addBodyContent("<br>\n");
$page->addBodyContent("On voit ici que les droits des utilisateurs ainsi que les zones de\n");
$page->addBodyContent("permissions (o&ugrave; s'exercent localement ces droits) sont&nbsp;\n");
$page->addBodyContent("individuels,c'est &agrave; dire propres aux entit&eacute;s 'utilsateur'\n");
$page->addBodyContent("et 'zone'. Il n'y a pas de gestion de groupe d'utilisateurs ni de\n");
$page->addBodyContent("gestion de domaine de zone. cela ne convient pas &agrave; notre\n");
$page->addBodyContent("d&eacute;finition des CU concernant l'authentification puisque nous\n");
$page->addBodyContent("avons besoin de ces fonctionalit&eacute;s. Il peut toutefois\n");
$page->addBodyContent("pr&eacute;senter un syst&egrave;me d'utilisation que nous pourions\n");
$page->addBodyContent("adopter : &agrave; chaque fois qu'un domaine est acc&eacute;d&eacute;\n");
$page->addBodyContent("on demande l'identification de l'utilisateur.<br>\n");
$page->addBodyContent("(L'alternative &eacute;tant : l'utilsateur ne s'identifie qu'une fois\n");
$page->addBodyContent("et la pr&eacute;sentation du syst&egrave;me autorise ou interdit\n");
$page->addBodyContent("l'acc&egrave;s aux donn&eacute;es et d&eacute;livre des messages\n");
$page->addBodyContent("d'avertissement)<br>\n");
$page->addBodyContent("De plus&nbsp; le test du container DB_Simple peut &ecirc;tre vu\n");
$page->addBodyContent("comme&nbsp; une &eacute;tape pour adapter DB_Complex &agrave; notre\n");
$page->addBodyContent("prototype et (ce qui n'est pas un luxe) nous pouvons cette fois\n");
$page->addBodyContent("utiliser les identifiants enregistr&eacute;s dans le prototype.<br>\n");
$page->addBodyContent("</div>\n");
$page->display();
return 0;
}
***********************************************************************************/

//------------------ mainQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function mainQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("MAIN_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (MAIN)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
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
if (file_exists("Business_main.php")){
	require_once ("Business_main.php");
	}
return $status;
}


//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("MAIN", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("MAIN", $pvars, MAIN::getInitInputs());
}

}
?>
