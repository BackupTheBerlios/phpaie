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
//Définition de la classe INDEX

class INDEX extends MAIN_CLASS {

// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<h1>Test for the LoginManager class</h1>",
"<p>This example is intended to be used with the Auth/DB and the Perm/DB_Complex ",
"  driver.</p>",
"<p>To set this up follow these steps:</p>",
"<ol>",
"  <li>Copy the files in this directory into your web root.</li>",
"  <li>Configure your DSN and the PEAR path in the main.inc.php.</li>",
"  <li>Set up a test database by importing demodata.sql.</li>",
"</ol>",
"<p><a href=\"news_new.php\">Go for it.</a></p>",
"<hr>",
"<p><i>Login Data for this Example:</i></p>",
"<table border=\"1\">",
"  <tr> ",
"    <th width=\"100\">Handle</th>",
"    <th width=\"100\">Group</th>",
"    <th width=\"100\">Password</th>",
"  </tr>",
"  <tr> ",
"    <td width=\"100\">admin</td>",
"    <td width=\"100\">ADMINS</td>",
"    <td width=\"100\">test</td>",
"  </tr>",
"  <tr> ",
"    <td width=\"100\">userA</td>",
"    <td width=\"100\">GroupA+B</td>",
"    <td width=\"100\">test</td>",
"  </tr>",
"  <tr> ",
"    <td width=\"100\">userB</td>",
"    <td width=\"100\">GroupA</td>",
"    <td width=\"100\">test</td>",
"  </tr>",
"  <tr> ",
"    <td width=\"100\">userC</td>",
"    <td width=\"100\">GroupB</td>",
"    <td width=\"100\">test</td>",
"  </tr>",
"</table>",
"<p>&nbsp;</p>",
"<p>&nbsp;</p>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array();
// ---------- méthodes de l'objet ------
// constructeur INDEX
function INDEX ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "INDEX", "", $vars );
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

$handleName = "index".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ indexDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function indexDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (INDEX)');
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

$page->addBodyContent("<h1>Test for the LoginManager class</h1>\n");
$page->addBodyContent("<p>This example is intended to be used with the Auth/DB and the Perm/DB_Complex \n");
$page->addBodyContent("  driver.</p>\n");
$page->addBodyContent("<p>To set this up follow these steps:</p>\n");
$page->addBodyContent("<ol>\n");
$page->addBodyContent("  <li>Copy the files in this directory into your web root.</li>\n");
$page->addBodyContent("  <li>Configure your DSN and the PEAR path in the main.inc.php.</li>\n");
$page->addBodyContent("  <li>Set up a test database by importing demodata.sql.</li>\n");
$page->addBodyContent("</ol>\n");
$page->addBodyContent("<p><a href=\"news_new.php\">Go for it.</a></p>\n");
$page->addBodyContent("<hr>\n");
$page->addBodyContent("<p><i>Login Data for this Example:</i></p>\n");
$page->addBodyContent("<table border=\"1\">\n");
$page->addBodyContent("  <tr> \n");
$page->addBodyContent("    <th width=\"100\">Handle</th>\n");
$page->addBodyContent("    <th width=\"100\">Group</th>\n");
$page->addBodyContent("    <th width=\"100\">Password</th>\n");
$page->addBodyContent("  </tr>\n");
$page->addBodyContent("  <tr> \n");
$page->addBodyContent("    <td width=\"100\">admin</td>\n");
$page->addBodyContent("    <td width=\"100\">ADMINS</td>\n");
$page->addBodyContent("    <td width=\"100\">test</td>\n");
$page->addBodyContent("  </tr>\n");
$page->addBodyContent("  <tr> \n");
$page->addBodyContent("    <td width=\"100\">userA</td>\n");
$page->addBodyContent("    <td width=\"100\">GroupA+B</td>\n");
$page->addBodyContent("    <td width=\"100\">test</td>\n");
$page->addBodyContent("  </tr>\n");
$page->addBodyContent("  <tr> \n");
$page->addBodyContent("    <td width=\"100\">userB</td>\n");
$page->addBodyContent("    <td width=\"100\">GroupA</td>\n");
$page->addBodyContent("    <td width=\"100\">test</td>\n");
$page->addBodyContent("  </tr>\n");
$page->addBodyContent("  <tr> \n");
$page->addBodyContent("    <td width=\"100\">userC</td>\n");
$page->addBodyContent("    <td width=\"100\">GroupB</td>\n");
$page->addBodyContent("    <td width=\"100\">test</td>\n");
$page->addBodyContent("  </tr>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<p>&nbsp;</p>\n");
$page->addBodyContent("<p>&nbsp;</p>\n");
$page->display();
return 0;
}
***********************************************************************************/

//------------------ indexQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function indexQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("INDEX_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (INDEX)');
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
if (file_exists("Business_index.php")){
	require_once ("Business_index.php");
	}
return $status;
}


//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("INDEX", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("INDEX", $pvars, INDEX::getInitInputs());
}

}
?>
