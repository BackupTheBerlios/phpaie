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
//Définition de la classe NAV

class NAV extends MAIN_CLASS {

// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<h3>Navigation</h3>",
"<table border=\"0\" cellpadding=\"5\">",
"</table>",
"<p>&nbsp;</p>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array("<p>&nbsp;</p>",
"<p>&nbsp; </p>",
);
// ---------- méthodes de l'objet ------
// constructeur NAV
function NAV ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "NAV", "User", $vars );
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
	'NAV_LANGUAGE' => array (
	'field_name'	=>	"NAV_LANGUAGE",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"100",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	"")
// @@@@FK_SET_INPUTS_INSERT_BEGINS_HERE@@@@
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

$handleName = "nav".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ navDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************/
function navDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (NAV)');
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

// $Id: NAV_def.php,v 1.1 2004/03/17 11:33:53 j-charles Exp $
    require_once 'conf3.php';
    require_once 'DB/DB.php';
    $dbc = DB::connect($liveuserConfig['permContainer']['dsn'], TRUE);
        $dbc->setFetchMode('DB_FETCHMODE_ASSOC');
    // get the area_define_name and the area_name of each area in current language.
    $res = $dbc->query('SELECT
                            A.area_define_name,
                            AN.area_name
                        FROM
                            liveuser_areas AS A
                        INNER JOIN
                            liveuser_area_names AS AN
                        ON
                            A.area_id = AN.area_id
                        INNER JOIN
                            liveuser_languages AS L
                        ON
                            AN.language_id = L.language_id
                        WHERE
                            L.two_letter_name = '.$dbc->quote($_GET['NAV_LANGUAGE']).'
                        ORDER BY
                            A.area_id'); 
$page->addBodyContent("<h3>Navigation</h3>\n");
$page->addBodyContent("<table border=\"0\" cellpadding=\"5\">\n");
// print navigation
    while ($row = $res->fetchRow()) {
        $page->addBodyContent('  <tr>');
        $page->addBodyContent('    <td><li></td>');
        $page->addBodyContent('    <td><a href="'.strtolower($row[0]).'.php" target="main">'.$row[1].'</a></td>');
        $page->addBodyContent('  </tr>');
    }
 
$page->addBodyContent("</table>\n");
$page->addBodyContent("<p>&nbsp;</p>\n");
$page->addBodyContent("<form method=\"POST\" action=\"liveuser3login.php\" target=\"_parent\">\n");
$page->addBodyContent("  <select  size=\"1\" onChange=\"submit()\" NAME=\"NAV_LANGUAGE\" >\n");
$res = $dbc->query('SELECT
                            two_letter_name,
                            native_name
                        FROM
                            liveuser_languages');
    // print language options
    while ($row = $res->fetchRow()) {
        $page->addBodyContent("    <option value=\"".$row[0]."\" ". (($row['two_letter_name'] == $_GET['NAV_LANGUAGE']) ?  'selected' : '') ." >\x0A".$row[1]."\x0A</option>");
    } 
$page->addBodyContent("  </select>\n");
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$page->addBodyContent("<p>&nbsp;</p>\n");
$page->addBodyContent("<p>&nbsp; </p>\n");
$page->display();
return 0;
}
/***********************************************************************************/

//------------------ navQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function navQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("NAV_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (NAV)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
// $Id: NAV_def.php,v 1.1 2004/03/17 11:33:53 j-charles Exp $
    require_once 'conf3.php';
    require_once 'DB/DB.php';
    $dbc = DB::connect($liveuserConfig['permContainer']['dsn'], TRUE);
        $dbc->setFetchMode('DB_FETCHMODE_ASSOC');
    // get the area_define_name and the area_name of each area in current language.
    $res = $dbc->query('SELECT
                            A.area_define_name,
                            AN.area_name
                        FROM
                            liveuser_areas AS A
                        INNER JOIN
                            liveuser_area_names AS AN
                        ON
                            A.area_id = AN.area_id
                        INNER JOIN
                            liveuser_languages AS L
                        ON
                            AN.language_id = L.language_id
                        WHERE
                            L.two_letter_name = '.$dbc->quote($_GET['NAV_LANGUAGE']).'
                        ORDER BY
                            A.area_id'); 
// print navigation
    while ($row = $res->fetchRow()) {
        $page->addBodyContent('  <tr>');
        $page->addBodyContent('    <td><li></td>');
        $page->addBodyContent('    <td><a href="'.strtolower($row[0]).'.php" target="main">'.$row[1].'</a></td>');
        $page->addBodyContent('  </tr>');
    }
 
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('NAV', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
$res = $dbc->query('SELECT
                            two_letter_name,
                            native_name
                        FROM
                            liveuser_languages');
    // print language options
    while ($row = $res->fetchRow()) {
        $page->addBodyContent("    <option value=\"".$row[0]."\" ". (($row['two_letter_name'] == $_GET['NAV_LANGUAGE']) ?  'selected' : '') ." >\x0A".$row[1]."\x0A</option>");
    } 
if ( isset($vars['NAV_LANGUAGE']) && $vars['NAV_LANGUAGE']) {
	$defaultValues['NAV_LANGUAGE'] = $vars['NAV_LANGUAGE'];
	} else {
	$defaultValues['NAV_LANGUAGE'] = array();
	}

$form->addElement('select', 'NAV_LANGUAGE',  array_shift($titles['NAV_LANGUAGE']), array());

// @@@@FK_SET_QFVARS_INSERT_BEGINS_HERE@@@@
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
$form->addGroup(array(), '', '', '');
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
if (file_exists("Business_nav.php")){
	require_once ("Business_nav.php");
	}
return $status;
}


//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("NAV", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("NAV", $pvars, NAV::getInitInputs());
}

}
?>
