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
// Support �ventuel sur www.phpaie.net
//*********************************************************************
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as 
// published by the Free Software Foundation.
//*********************************************************************
include_once("../inc/classes.php");
include_once("../inc/funcs.php");
//D�finition de la classe LOGIN

class LOGIN extends MAIN_CLASS {

// ---------- Type d'encodage de la page------
var $encoding	= "UTF-8";
// ---------- buffer a afficher avant le formulaire Quickform------
var $headerBuffer	= array("<br>",
"Ceci est une version 'from scratch' du module d'identification",
"<hr>",
"<p>Une version d'identification utilisant PEAR::Auth est dispo <a",
" href=\"PearLogin.php\">ici</a>.<br>",
"(PearLogin.php est une version en test).</p>",
"<hr>",
"<p>Une version LiveUser (auth XML driver = pas de gestion des",
"permissions)",
"est dispo <a href=\"liveuser1login.php\">ici</a>.<br>",
"(LiveUser1.php est une version en test).</p>",
"<hr>",
"<p>Une version LiveUser (auth XML driver = avec gestion des",
"permissions)",
"est dispo <a href=\"liveuser2login.php\">ici</a>.<br>",
"(LiveUser2.php est une version en test).</p>",
"<hr>",
"<p>&nbsp;Une version LiveUser (Db_simple )",
"est dispo <a href=\"liveuser3login.php\">ici</a>.<br>",
"(LiveUser3.php est une version en test).</p>",
"<hr>",
"<p>&nbsp;",
"</p>",
"<p></p>",
);
// ---------- buffer a afficher apr�s le formulaire Quickform------
var $footerBuffer	= array("<p>",
"</p>",
);
// ---------- m�thodes de l'objet ------
// constructeur LOGIN
function LOGIN ( $vars )
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
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"32",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'INSCRIPTION_PASSWORD_VCH' => array (
	'field_name'	=>	"INSCRIPTION_PASSWORD_VCH",
	'field_title'	=>	"Mot de passe",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"32",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
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
// Le formulaire n'est pas valid�
if (!$this->isFormValidated()) {
// L'identifiant est connu
	if ($this->isIdSet()) {
		//Initialisation des valeurs de l'identifiant courant
		$this->setDbVars( );
		} else {
		//Initialisation des valeurs par d�faut
		$this->initInputsVars( );
		}
	} else {
// Le formulaire est valid� (ou autre bouton formulaire)
	if ($this->isNewButton()) {
		// RAZ des variables
		$id_name = $this->getIdName();
		$this->resetVars();
		unset( $this->vars[$id_name]);
		unset( $this->vars['B_NOUVEAU']);
		}
	}

$handleName = "login".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ loginDefaultDisplay ---------------------
// Fonction d'affichage de la page � d�faut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le d�buggage ou pour les pr�sentations
// -> Ne n�cessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais n�cessitant quand m�me du package Pear HTML)
/***********************************************************************************
function loginDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (LOGIN)');
$vars = $this->vars;
$titles = $this->titles;
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
//Callback method de v�rification
if ($this->isFormValidated() && $action !=  "") {
	$this->$action();
	}

if (($ret_ba = $this->businessAction()) != 0) {
	return $ret_ba;
	}

$page->addBodyContent("<h3><span class=\"f_header\">Identification</span></h3>\n");
$page->addBodyContent("<br>\n");
$page->addBodyContent("Ceci est une version 'from scratch' du module d'identification\n");
$page->addBodyContent("<hr>\n");
$page->addBodyContent("<p>Une version d'identification utilisant PEAR::Auth est dispo <a\n");
$page->addBodyContent(" href=\"PearLogin.php\">ici</a>.<br>\n");
$page->addBodyContent("(PearLogin.php est une version en test).</p>\n");
$page->addBodyContent("<hr>\n");
$page->addBodyContent("<p>Une version LiveUser (auth XML driver = pas de gestion des\n");
$page->addBodyContent("permissions)\n");
$page->addBodyContent("est dispo <a href=\"liveuser1login.php\">ici</a>.<br>\n");
$page->addBodyContent("(LiveUser1.php est une version en test).</p>\n");
$page->addBodyContent("<hr>\n");
$page->addBodyContent("<p>Une version LiveUser (auth XML driver = avec gestion des\n");
$page->addBodyContent("permissions)\n");
$page->addBodyContent("est dispo <a href=\"liveuser2login.php\">ici</a>.<br>\n");
$page->addBodyContent("(LiveUser2.php est une version en test).</p>\n");
$page->addBodyContent("<hr>\n");
$page->addBodyContent("<p>&nbsp;Une version LiveUser (Db_simple )\n");
$page->addBodyContent("est dispo <a href=\"liveuser3login.php\">ici</a>.<br>\n");
$page->addBodyContent("(LiveUser3.php est une version en test).</p>\n");
$page->addBodyContent("<hr>\n");
$page->addBodyContent("<p>&nbsp;\n");
$page->addBodyContent("</p>\n");
$page->addBodyContent("<p></p>\n");
$page->addBodyContent("<form method=\"post\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n");
$page->addBodyContent("    <tbody>\n");
$page->addBodyContent("      <tr align=\"left\" valign=\"top\">\n");
$page->addBodyContent("        <td align=\"right\" valign=\"middle\" class=\"f_title\" id=\"Pseudo_CKEY_VCH\">Identifiant</td>\n");
$page->addBodyContent("        <td><input type=\"text\" size=\"30\"  maxlength=\"15\" style=\"width: 150px; height: 20px;\" NAME=\"INSCRIPTION_PSEUDO_CKEY_VCH\" VALUE=\"$vars[INSCRIPTION_PSEUDO_CKEY_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr align=\"left\" valign=\"top\">\n");
$page->addBodyContent("        <td align=\"right\" valign=\"middle\" class=\"f_title\" id=\"Password_VCH\">Mot de passe</td>\n");
$page->addBodyContent("        <td><input type=\"password\" size=\"15\"  maxlength=\"15\" style=\"width: 150px; height: 20px;\" NAME=\"INSCRIPTION_PASSWORD_VCH\" VALUE=\"$vars[INSCRIPTION_PASSWORD_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("    </tbody>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("  <p align=\"center\"> <input type=\"submit\" value=\"Envoyer\" name=\"B1\"></p>\n");
$page->addBodyContent(( TRUE) ? "<a href=\"Javascript:history.go(-1)?\">Retour</a></form>\n" : "<font color=\"#C0C0C0\">Retour</form> </font>\n");
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$page->addBodyContent("<p>\n");
$page->addBodyContent($this->message_status);
$page->addBodyContent("<!-- footer2 footer.php~\"{names}\", \"{params}\", \"{names2}\", \"{params2}\"~\"ATAB_NOMTBL_CKEY_VCH\",$this->getName(), \"PNAME\", \"LOGIN\"-->\n");
$page->addBodyContent("</p>\n");
$page->display();
return 0;
}
***********************************************************************************/

//------------------ loginQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action � d�clencher (fonction)
// $part : which part of the page (0 : all)
function loginQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("LOGIN_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'ent�te
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (LOGIN)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('LOGIN', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
//--------------------------LOGIN_Pseudo_CKEY_VCH--------------------------
//Static LOGIN_Pseudo_CKEY_VCH
$form->addElement('static', 'ST_Pseudo_CKEY_VCH', 'Identifiant');
$form->addElement('text', 'INSCRIPTION_PSEUDO_CKEY_VCH',  array_shift($titles['INSCRIPTION_PSEUDO_CKEY_VCH']),array('size'=> 30, 'maxlength' => 15));
if ( isset($vars['INSCRIPTION_PSEUDO_CKEY_VCH']) && $vars['INSCRIPTION_PSEUDO_CKEY_VCH']) {
	$defaultValues['INSCRIPTION_PSEUDO_CKEY_VCH'] = $vars['INSCRIPTION_PSEUDO_CKEY_VCH'];
	}

// Pas de rule test d�fini pour INSCRIPTION_PSEUDO_CKEY_VCH

//--------------------------LOGIN_Password_VCH--------------------------
//Static LOGIN_Password_VCH
$form->addElement('static', 'ST_Password_VCH', 'Mot de passe');
$form->addElement('password', 'INSCRIPTION_PASSWORD_VCH',  array_shift($titles['INSCRIPTION_PASSWORD_VCH']),array('size'=> 15, 'maxlength' => 15));
if ( isset($vars['INSCRIPTION_PASSWORD_VCH']) && $vars['INSCRIPTION_PASSWORD_VCH']) {
	$defaultValues['INSCRIPTION_PASSWORD_VCH'] = $vars['INSCRIPTION_PASSWORD_VCH'];
	}

//	--INSCRIPTION_PASSWORD_VCH-
// Pas de rule test d�fini pour INSCRIPTION_PASSWORD_VCH

if ( TRUE) {
	 $link_0 = &HTML_QuickForm::createElement('link', 'RETOUR', "", "Javascript:history.go(-1)",  "[Retour]", "class=\"formElemLink\"");
} else {
	 $link_0 = &HTML_QuickForm::createElement('static',  'RETOUR',  "", "[Retour]");
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
//mettre � jour $vars[$id_name]
	$form->_submitValues [$id_name] = $vars[$id_name];
	}
$form->addElement('hidden', $id_name);
// submit final
//bouton 'Envoyer'
$button_B1 = &HTML_QuickForm::createElement('submit', 'B1', 'Envoyer');
$form->addGroup(array($button_B1), '', '', '');
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
$page->addBodyContent( str_replace(array("{names}", "{params}", "{names2}", "{params2}"), array("ATAB_NOMTBL_CKEY_VCH",$this->getName(), "PNAME", "LOGIN"), file("../common/footer.php"))); //QCKFSET.pl 200 
//fin du formulaire

// insertion du buffer de pied de pr�sentation
if (!empty($this->footerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->footerBuffer));
	}


if (($ret_ba = $this->businessAction()) != 0) {
	return $ret_ba;
	}

// insertion du buffer message objet m�tier
if (!empty($this->businessBuffer)) {
	$page->addBodyContent(implode ("\n", $this->businessBuffer));
	}

$page->display();
return 0;
}


//----------------------- M�thode m�tier apr�s validation par d�faut ----------------
function businessAction( )
{
$status = 0;
if (file_exists("Business_login.php")){
	require_once ("Business_login.php");
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
MAIN_CLASS::insertDbVars("INSCRIPTION", $pvars, LOGIN::getInitInputs());
}

}
?>
