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
//Définition de la classe INTROPROTO

class INTROPROTO extends MAIN_CLASS {

// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<p>Introduction</p>",
"<p>Ce prototype d&eacute;crit de mani&egrave;re pragmatique les cas d'utilisation &agrave; mettre",
"en oeuvre. &Eacute;ventuellement il servira &agrave; tester des modules simples r&eacute;pondant",
"&agrave; des besoins techniques pr&eacute;cis. Il&nbsp; n' a pas vocation &agrave; recr&eacute;er un",
"framework PHP. Il se propose &agrave;&nbsp; contrario de laisser place des que",
"possible &agrave; un d&eacute;veloppement homog&egrave;ne bas&eacute; sur des techniques &eacute;prouv&eacute;es",
"avec pour contrainte minimale l'int&eacute;gration de toutes les fonctions",
"pr&eacute;sent&eacute;es. Ces dispositions facilitent &eacute;galement un portage opportun vers un",
"autre technologie que PHP.</p>",
"<p>Voyons maintenant comment est mis en oeuvre ce prototype :</p>",
"<p>&nbsp;&nbsp;&nbsp; Le principe est d'accorder chaque cas d'utilisation &agrave; son",
"interface qui est une vue externe d'un objet. A chaque interface correspond donc",
"un objet qui se caract&eacute;rise dans notre mise en oeuvre par :</p>",
"<ul>",
"  <li>La diffusion des sources. Dans le cadre du prototypage l'&eacute;tude de code",
"    n'a pas d'importance en soi. N&eacute;anmoins PHPAIE est un produit ouvert et tout",
"    les sources de la classe utilis&eacute;e sont mis &agrave; la disposition des visiteurs",
"    pour d&eacute;tecter d'&eacute;ventuels probl&egrave;mes ou pour recevoir tout types de",
"    conseils susceptible d'am&eacute;liorer le principe du prototypage.&nbsp;</li>",
"  <li>Une pr&eacute;sentation du CU avec si possible les diagrammes &agrave; l'appui et une ",
"  	 explication concise permettant de recadrer le module &agrave; l'&eacute;tude dans ",
"  	 l'objectif poursuivi par le projet.</li>",
"  <li>La prise en compte des commentaires des contributeurs sur un forum",
"    simplifi&eacute;. Ces commentaires se devront d'&ecirc;tre aussi succincts que",
"    possible. Toutefois les discussions et les d&eacute;bats ayant leur espace de ",
"    pr&eacute;dilection sur la mailing liste du projet, les messages enregistr&eacute;s ici",
"    seront post&eacute;s directement sur celle-ci. </li>",
"</ul>",
"Chaque fois que l'&eacute;tude le n&eacute;c&eacute;sitera, nous ouvrirons un cas d'utilisation qui ",
"se traduira ici par une page accessible",
"<p>Pour proc&eacute;der &agrave; un test coh&eacute;rent vous devez vous enregistrer (si c'est",
"d&eacute;j&agrave; fait cliquez sur le lien &quot;D&eacute;j&agrave; enregistr&eacute;&quot;) :</p>",
);
// ---------- buffer a afficher après le formulaire Quickform------
var $footerBuffer	= array("<p>(On retrouvera le cas d'utilisation &quot;enregistrement d'un",
"utilisateur&quot; dans le prototype o&ugrave; il sera d&eacute;fini).</p>",
"<p>&nbsp;</p>",
);
// ---------- méthodes de l'objet ------
// constructeur INTROPROTO
function INTROPROTO ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "INSCRIPTION", "User", $vars );
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
	'INSCRIPTION_PSEUDO_CKEY_VCH' => array (
	'field_name'	=>	"INSCRIPTION_PSEUDO_CKEY_VCH",
	'field_title'	=>	"Identifiant",
	'field_value'	=>	"TEST",
	'field_type'	=>	"varchar",
	'field_length'	=>	"32",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	array('La saisie de l\'identifiant est obligatoire', 'required', 'patate' )),
	'INSCRIPTION_PASSWORD_VCH' => array (
	'field_name'	=>	"INSCRIPTION_PASSWORD_VCH",
	'field_title'	=>	"Mot de passe",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"32",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	array('La saisie du mot de passe est obligatoire', 'required' )),
	'ID_INSCRIPTION' => array (
	'field_name'	=>	"ID_INSCRIPTION",
	'field_title'	=>	"",
	'field_value'	=>	"",
	'field_type'	=>	"int",
	'field_length'	=>	"11",
	'field_fkey'	=>	0,
	'field_quoted'	=>	0,
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

$handleName = "introproto".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ introprotoDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function introprotoDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (INTROPROTO)');
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

$page->addBodyContent("<p>Introduction</p>\n");
$page->addBodyContent("<p>Ce prototype décrit de manière pragmatique les cas d'utilisation à mettre\n");
$page->addBodyContent("en oeuvre. Éventuellement il servira à tester des modules simples répondant\n");
$page->addBodyContent("à des besoins techniques précis. Il&nbsp; n' a pas vocation à recréer un\n");
$page->addBodyContent("framework PHP. Il se propose à&nbsp; contrario de laisser place des que\n");
$page->addBodyContent("possible à un développement homogène basé sur des techniques éprouvées\n");
$page->addBodyContent("avec pour contrainte minimale l'intégration de toutes les fonctions\n");
$page->addBodyContent("présentées. Ces dispositions facilitent également un portage opportun vers un\n");
$page->addBodyContent("autre technologie que PHP.</p>\n");
$page->addBodyContent("<p>Voyons maintenant comment est mis en oeuvre ce prototype :</p>\n");
$page->addBodyContent("<p>&nbsp;&nbsp;&nbsp; Le principe est d'accorder chaque cas d'utilisation à son\n");
$page->addBodyContent("interface qui est une vue externe d'un objet. A chaque interface correspond donc\n");
$page->addBodyContent("un objet qui se caractérise dans notre mise en oeuvre par :</p>\n");
$page->addBodyContent("<ul>\n");
$page->addBodyContent("  <li>La diffusion des sources. Dans le cadre du prototypage l'étude de code\n");
$page->addBodyContent("    n'a pas d'importance en soi. Néanmoins PHPAIE est un produit ouvert et tout\n");
$page->addBodyContent("    les sources de la classe utilisée sont mis à la disposition des visiteurs\n");
$page->addBodyContent("    pour détecter d'éventuels problèmes ou pour recevoir tout types de\n");
$page->addBodyContent("    conseils susceptible d'améliorer le principe du prototypage.&nbsp;</li>\n");
$page->addBodyContent("  <li>Une présentation du CU avec si possible les diagrammes à l'appui et une \n");
$page->addBodyContent("  	 explication concise permettant de recadrer le module à l'étude dans \n");
$page->addBodyContent("  	 l'objectif poursuivi par le projet.</li>\n");
$page->addBodyContent("  <li>La prise en compte des commentaires des contributeurs sur un forum\n");
$page->addBodyContent("    simplifié. Ces commentaires se devront d'être aussi succincts que\n");
$page->addBodyContent("    possible. Toutefois les discussions et les débats ayant leur espace de \n");
$page->addBodyContent("    prédilection sur la mailing liste du projet, les messages enregistrés ici\n");
$page->addBodyContent("    seront postés directement sur celle-ci. </li>\n");
$page->addBodyContent("</ul>\n");
$page->addBodyContent("Chaque fois que l'étude le nécésitera, nous ouvrirons un cas d'utilisation qui \n");
$page->addBodyContent("se traduira ici par une page accessible\n");
$page->addBodyContent("<p>Pour procéder à un test cohérent vous devez vous enregistrer (si c'est\n");
$page->addBodyContent("déjà fait cliquez sur le lien &quot;Déjà enregistré&quot;) :</p>\n");
$page->addBodyContent("<h3><span class=\"f_header\">Inscription :</span></h3>\n");
$page->addBodyContent("    <form method=\"POST\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n");
$page->addBodyContent("        <tr align=\"left\" valign=\"top\"> \n");
$page->addBodyContent("          <td align=\"right\" valign=\"middle\" class=\"f_title\" id=\"Pseudo_CKEY_VCH\">Identifiant</td>\n");
$page->addBodyContent("          <td>&nbsp;</td>\n");
$page->addBodyContent("          <td> \n");
$page->addBodyContent("          <input type=\"text\"  maxlength=\"15\" size=\"30\" style=\"width:150px; height:20px;\" NAME=\"INSCRIPTION_PSEUDO_CKEY_VCH\" VALUE=\"$vars[INSCRIPTION_PSEUDO_CKEY_VCH]\" >\n");
$page->addBodyContent("          </td>\n");
$page->addBodyContent("        </tr>\n");
$page->addBodyContent("        <tr align=\"left\" valign=\"top\"> \n");
$page->addBodyContent("          <td align=\"right\" valign=\"middle\" class=\"f_title\" id=\"Password_VCH\">Mot de passe</td>\n");
$page->addBodyContent("          <td>&nbsp;</td>\n");
$page->addBodyContent("          <td><input type=\"password\"  size=\"15\" maxlength=\"15\" style=\"width:150px;height:20px;\" NAME=\"INSCRIPTION_PASSWORD_VCH\" VALUE=\"$vars[INSCRIPTION_PASSWORD_VCH]\" ></td>\n");
$page->addBodyContent("        </tr>\n");
$page->addBodyContent("        <tr align=\"left\" valign=\"top\"> \n");
$page->addBodyContent("          <td align=\"right\" valign=\"middle\" class=\"f_title\" id=\"CPassword\">Confirmation mot de passe</td>\n");
$page->addBodyContent("          <td>&nbsp;</td>\n");
$page->addBodyContent("          <td> \n");
$page->addBodyContent("<input type=\"password\" name=\"CPassword\" size=\"15\" maxlength=\"15\" style=\"width:150px;height:20px;\" VALUE=\"\">");
$page->addBodyContent("          </td>\n");
$page->addBodyContent("        </tr>\n");
$page->addBodyContent("      </table>\n");
$page->addBodyContent("      <p align=\"center\"><input type=\"submit\" value=\"Envoyer\" name=\"B1\">\n");
$page->addBodyContent("    <p align=\"center\">\n");
$page->addBodyContent(( TRUE) ? "<a href=\"Javascript:history.go(-1)?\">Retour</a>\n" : "<font color=\"#C0C0C0\">Retour </font>\n");
$page->addBodyContent(( TRUE) ? "<a href=\"login.php?\">D&eacute;j&agrave; enregistr&eacute;</a>\n" : "<font color=\"#C0C0C0\">D&eacute;j&agrave; enregistr&eacute; </font>\n");
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("    </form>\n");
$page->addBodyContent("<p>(On retrouvera le cas d'utilisation &quot;enregistrement d'un\n");
$page->addBodyContent("utilisateur&quot; dans le prototype où il sera défini).</p>\n");
$page->addBodyContent("<p>&nbsp;</p>\n");
$page->display();
return 0;
}
***********************************************************************************/

//------------------ introprotoQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function introprotoQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("INTROPROTO_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (INTROPROTO)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('INTROPROTO', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
//--------------------------INTROPROTO_Pseudo_CKEY_VCH--------------------------
//Static INTROPROTO_Pseudo_CKEY_VCH
$form->addElement('static', 'ST_Pseudo_CKEY_VCH', 'Identifiant');
$form->addElement('text', 'INSCRIPTION_PSEUDO_CKEY_VCH',  array_shift($titles['INSCRIPTION_PSEUDO_CKEY_VCH']),array('size'=> 30, 'maxlength' => 15));
if ( isset($vars['INSCRIPTION_PSEUDO_CKEY_VCH']) && $vars['INSCRIPTION_PSEUDO_CKEY_VCH']) {
	$defaultValues['INSCRIPTION_PSEUDO_CKEY_VCH'] = $vars['INSCRIPTION_PSEUDO_CKEY_VCH'];
	}

if(isset($this->inputs['INSCRIPTION_PSEUDO_CKEY_VCH']['field_match']) && $this->inputs['INSCRIPTION_PSEUDO_CKEY_VCH']['field_match'] != "") {
	list($message, $type , $format) =  $this->inputs['INSCRIPTION_PSEUDO_CKEY_VCH']['field_match'];
	$form->addRule('INSCRIPTION_PSEUDO_CKEY_VCH', $message, $type , $format);
	}

//--------------------------INTROPROTO_Password_VCH--------------------------
//Static INTROPROTO_Password_VCH
$form->addElement('static', 'ST_Password_VCH', 'Mot de passe');
$form->addElement('password', 'INSCRIPTION_PASSWORD_VCH',  array_shift($titles['INSCRIPTION_PASSWORD_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['INSCRIPTION_PASSWORD_VCH']) && $vars['INSCRIPTION_PASSWORD_VCH']) {
	$defaultValues['INSCRIPTION_PASSWORD_VCH'] = $vars['INSCRIPTION_PASSWORD_VCH'];
	}

//	--INSCRIPTION_PASSWORD_VCH-
if(isset($this->inputs['INSCRIPTION_PASSWORD_VCH']['field_match']) && $this->inputs['INSCRIPTION_PASSWORD_VCH']['field_match'] != "") {
	list($message, $type) =  $this->inputs['INSCRIPTION_PASSWORD_VCH']['field_match'];
	$form->addRule('INSCRIPTION_PASSWORD_VCH', $message, $type);
	}

//--------------------------INTROPROTO_CPassword--------------------------
//Static INTROPROTO_CPassword
$form->addElement('static', 'ST_CPassword', 'Confirmation mot de passe');
$titles['CPassword'] = array("Confirmation mot de passe");
$form->addElement('password', 'CPassword',  array_shift($titles['CPassword']),array('size'=> 15, 'maxlength' => 15));
if ( TRUE) {
	 $link_0 = &HTML_QuickForm::createElement('link', 'RETOUR', "", "Javascript:history.go(-1)",  "[Retour]", "class=\"formElemLink\"");
} else {
	 $link_0 = &HTML_QuickForm::createElement('static',  'RETOUR',  "", "[Retour]");
 }
if ( TRUE) {
	 $link_1 = &HTML_QuickForm::createElement('link', 'D&EACUTE;J&AGRAVE;_ENREGISTR&EACUTE;', "", "login.php",  "[D&eacute;j&agrave; enregistr&eacute;]", "class=\"formElemLink\"");
} else {
	 $link_1 = &HTML_QuickForm::createElement('static',  'D&EACUTE;J&AGRAVE;_ENREGISTR&EACUTE;',  "", "[D&eacute;j&agrave; enregistr&eacute;]");
 }

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
//bouton 'Envoyer'
$button_B1 = &HTML_QuickForm::createElement('submit', 'B1', 'Envoyer');
$form->addGroup(array($button_B1), '', '', '');
$form->addGroup(array($link_0,$link_1), 'LINKS', '', '&nbsp;');
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
if (file_exists("Business_introproto.php")){
	require_once ("Business_introproto.php");
	}
return $status;
}


//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("INSCRIPTION", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("INSCRIPTION", $pvars, INTROPROTO::getInitInputs());
}

}
?>
