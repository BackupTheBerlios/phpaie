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
//Définition de la classe ALTUSER

class ALTUSER extends MAIN_CLASS {

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
"</table><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">",
"  <tbody>",
"    <tr>",
"      <td width=\"100%\">Les champs de ce formulaire sont  les &eacute;l&eacute;ments",
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
// constructeur ALTUSER
function ALTUSER ( $vars )
{
// ---------- nom de l'identifiant courant ------
	$this->inputs = $this->getInitInputs();
	MAIN_CLASS::MAIN_CLASS ( "ALTUSER", "Employeur", $vars );
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
	'ALTUSER_NOM_CKEY_VCH' => array (
	'field_name'	=>	"ALTUSER_NOM_CKEY_VCH",
	'field_title'	=>	"Nom",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"38",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ALTUSER_PRENOM_VCH' => array (
	'field_name'	=>	"ALTUSER_PRENOM_VCH",
	'field_title'	=>	"Pr&eacute;nom",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"38",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ALTUSER_FONCTION_VCH' => array (
	'field_name'	=>	"ALTUSER_FONCTION_VCH",
	'field_title'	=>	"Fonction",
	'field_value'	=>	"",
	'field_type'	=>	"varchar",
	'field_length'	=>	"100",
	'field_fkey'	=>	0,
	'field_quoted'	=>	1,
	'field_match'	=>	""),
	'ID_ALTUSER' => array (
	'field_name'	=>	"ID_ALTUSER",
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

$handleName = "altuser".$this->displayHandle."Display";
return $this->$handleName( $action, $part );

}

//------------------ altuserDefaultDisplay ---------------------
// Fonction d'affichage de la page à défaut de 'handle display' 
// -> Volontairement mise sous commentaire :
// -> Remplace la fonction QFormDisplay pour le débuggage ou pour les présentations
// -> Ne nécessitant pas de : caching, buffering, actions etc ... 
// -> (Bref quelque chose de simple mais nécessitant quand même du package Pear HTML)
/***********************************************************************************
function altuserDefaultDisplay( $action, $part )
{
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
$page->addStyleSheet($css_style);
$page->setTitle('Phpaie (ALTUSER)');
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
$page->addBodyContent("        <center>\n");
$page->addBodyContent("<h3><span class=\"f_header\">Utilisateur</span></h3>\n");
$page->addBodyContent("        </center>\n");
$page->addBodyContent("      </td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"800\">\n");
$page->addBodyContent("  <tbody>\n");
$page->addBodyContent("    <tr>\n");
$page->addBodyContent("      <td width=\"100%\">Les champs de ce formulaire sont  les éléments\n");
$page->addBodyContent("        obligatoires d'un bulletin conforme à la législation sur la paie. Il\n");
$page->addBodyContent("        apparaîtront dans les éditions tels que vous les avez enregistr&eacute;s\n");
$page->addBodyContent("        après validation.</td>\n");
$page->addBodyContent("    </tr>\n");
$page->addBodyContent("  </tbody>\n");
$page->addBodyContent("</table>\n");
$page->addBodyContent("<form method=\"post\" name=\"ALTUSER\" action=\"".$_SERVER['PHP_SELF'].(isset($this->anchor)  && !empty ($this->anchor)) ? ("#".$this->anchor) : ""."\">\n");
$page->addBodyContent("  <table border=\"0\" width=\"800\" HEIGHT=\"84\">\n");
$page->addBodyContent("    <tbody>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"14%\" height=\"23\" class=\"f_title\" id=\"NOM_CKEY_VCH\">Nom</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("        <input type=\"text\" size=\"38\"  NAME=\"ALTUSER_NOM_CKEY_VCH\" VALUE=\"$vars[ALTUSER_NOM_CKEY_VCH]\" ></td>\n");
$page->addBodyContent("        <td align=\"center\" width=\"30%\" height=\"115\" rowspan=\"5\">\n");
$page->addBodyContent("        <span class=\"cscat\">Identification personnelle :<br>\n");
$page->addBodyContent("Informations sur la personne charg&eacute;e d'établir la paie de\n");
$page->addBodyContent("votre entreprise.</span></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"14%\" height=\"23\" class=\"f_title\" id=\"PRENOM_VCH\">Pr&eacute;nom</td>\n");
$page->addBodyContent("         <td align=\"left\" width=\"56%\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("         <input type=\"text\" size=\"38\"   NAME=\"ALTUSER_PRENOM_VCH\" VALUE=\"$vars[ALTUSER_PRENOM_VCH]\" ></td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"14%\" height=\"23\"class=\"f_title\" id=\"FONCTION_VCH\">Fonction</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\" colspan=\"2\">\n");
$page->addBodyContent("          <select  NAME=\"ALTUSER_FONCTION_VCH\" >\n");
if ($vars[ALTUSER_FONCTION_VCH] == "Comptable")
	$page->addBodyContent("<option value=\"Comptable\" selected=\"selected\" selected=\"selected\">Comptable</option>\n");
 else
	$page->addBodyContent("            <option =\"selected\">Comptable</option>");
if ($vars[ALTUSER_FONCTION_VCH] == "Responsable occasionnel")
	$page->addBodyContent("<option value=\"Responsable occasionnel\" selected=\"selected\">Responsable occasionnel</option>\n");
 else
	$page->addBodyContent("            <option >Responsable occasionnel</option>");
if ($vars[ALTUSER_FONCTION_VCH] == "Responsable attitre")
	$page->addBodyContent("<option value=\"Responsable attitre\" selected=\"selected\">Responsable attitr&eacute;</option>\n");
 else
	$page->addBodyContent("            <option >Responsable attitr&eacute;</option>");
if ($vars[ALTUSER_FONCTION_VCH] == "Autres")
	$page->addBodyContent("<option value=\"Autres\" selected=\"selected\">Autres</option>\n");
 else
	$page->addBodyContent("            <option >Autres</option>");
$page->addBodyContent("          </select>      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"left\" width=\"14%\" height=\"23\" class=\"f_title\" id=\"ROLE_I\">Role</td>\n");
$page->addBodyContent("        <td align=\"left\" width=\"56%\" height=\"23\" colspan=\"2\">ici placer une LB contanant les roles définis</td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("      <tr>\n");
$page->addBodyContent("        <td align=\"center\" width=\"50%\" height=\"23\" colspan=\"2\" valign=\"middle\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("  		<input type=\"submit\" value=\"Enregistrer\" name=\"SUBMIT\">\n");
$page->addBodyContent("		<input type=\"reset\" value=\"Effacer\" name=\"MAJ\"></td>\n");
$page->addBodyContent("        <td align=\"center\" width=\"50%\" height=\"23\" colspan=\"2\" valign=\"middle\" bgcolor=\"#C0C0C0\">\n");
$page->addBodyContent("        </td>\n");
$page->addBodyContent("      </tr>\n");
$page->addBodyContent("    </tbody>\n");
$page->addBodyContent("  </table>\n");
$page->addBodyContent("        <-- message1 -->\n");
//* @@@@FK_SET_VARS_INSERT_BEGINS_HERE@@@@
//* @@@@FK_SET_VARS_INSERT_ENDS_HERE@@@@
// $id_name = $this->getIdName(); //HTMSET.pl 498
$page->addBodyContent("<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n");
$page->addBodyContent("<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n");
$page->addBodyContent("</form>\n");
$page->addBodyContent("<p align=\"center\">\n");
$page->addBodyContent("<-- footer1 -->\n");
$page->addBodyContent("</p>\n");
$page->addBodyContent("</center>\n");
$page->addBodyContent("</div>\n");
$page->display();
return 0;
}
***********************************************************************************/

//------------------ altuserQuickFormDisplay ---------------------
// Fonction d'affichage de la page utilisant le package QuickForm de Pear
// $action : action à déclencher (fonction)
// $part : which part of the page (0 : all)
function altuserQuickFormDisplay( $action, $part )
{
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
require_once ("HTML/QuickForm.php");
require_once ("HTML/Page.php");
require_once ("../inc/html_settings.php");
require_once ("../inc/init_qform.php");
require_once ("ALTUSER_InitForm.php");
$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
// insertion du buffer d'entête
if (!empty($this->headerBuffer)) {
	$page->addBodyContent(implode ("\n", $this->headerBuffer));
	}

$page->setTitle('Phpaie (ALTUSER)');
$page->addStyleSheet($css_style);
InitForm( $page, $this, $formDef, $action );
/************************* TO substitute **************
$vars = $this->vars;
$titles = $this->titles;
$renderer =& new  Phpaie_Renderer_Default ();
$form = new HTML_QuickForm('ALTUSER', 'post' , (isset($this->anchor)  && !empty ($this->anchor)) ? "#".$this->anchor : "");
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span><span style="font-size:80%;">: champs obligatoires.</span>';
//--------------------------ALTUSER_NOM_CKEY_VCH--------------------------
$form->addElement('text', 'ALTUSER_NOM_CKEY_VCH',  array_shift($titles['ALTUSER_NOM_CKEY_VCH']),array('size'=> 38, 'maxlength' => 38));
if ( isset($vars['ALTUSER_NOM_CKEY_VCH']) && $vars['ALTUSER_NOM_CKEY_VCH']) {
	$defaultValues['ALTUSER_NOM_CKEY_VCH'] = $vars['ALTUSER_NOM_CKEY_VCH'];
	}

// Pas de rule test défini pour ALTUSER_NOM_CKEY_VCH

//--------------------------ALTUSER_PRENOM_VCH--------------------------
$form->addElement('text', 'ALTUSER_PRENOM_VCH',  array_shift($titles['ALTUSER_PRENOM_VCH']),array('size'=> 38, 'maxlength' => 38));
if ( isset($vars['ALTUSER_PRENOM_VCH']) && $vars['ALTUSER_PRENOM_VCH']) {
	$defaultValues['ALTUSER_PRENOM_VCH'] = $vars['ALTUSER_PRENOM_VCH'];
	}

// Pas de rule test défini pour ALTUSER_PRENOM_VCH

//--------------------------ALTUSER_FONCTION_VCH--------------------------
if ( isset($vars['ALTUSER_FONCTION_VCH']) && $vars['ALTUSER_FONCTION_VCH']) {
	$defaultValues['ALTUSER_FONCTION_VCH'] = $vars['ALTUSER_FONCTION_VCH'];
	} else {
	$defaultValues['ALTUSER_FONCTION_VCH'] = array();
	}

$form->addElement('select', 'ALTUSER_FONCTION_VCH',  array_shift($titles['ALTUSER_FONCTION_VCH']), array('1' => 'Comptable', '2' => 'Responsable occasionnel', '3' => 'Responsable attitr&eacute;', '4' => 'Autres'));
//--------------------------ALTUSER_ROLE_I--------------------------
//Static ALTUSER_ROLE_I
$form->addElement('static', 'ST_ROLE_I', 'Role');

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
//bouton 'Enregistrer'
$button_SUBMIT = &HTML_QuickForm::createElement('submit', 'SUBMIT', 'Enregistrer');
//bouton 'Effacer'
$button_MAJ = &HTML_QuickForm::createElement('reset', 'MAJ', 'Effacer');
$form->addGroup(array($button_SUBMIT,$button_MAJ), '', '', '');
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
if (file_exists("Business_altuser.php")){
	require_once ("Business_altuser.php");
	}
return $status;
}


//------------------ Fetch id ---------------------
// fetchOne(  NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
// (A renomer en staticFetchOne)
function fetchOne( $nomitem, $where_clause, $select_type )
{
return MAIN_CLASS::fetchOne ("ALTUSER", $nomitem, $where_clause, $select_type );
}
function staticInsertDbVars( $pvars )
{
MAIN_CLASS::insertDbVars("ALTUSER", $pvars, ALTUSER::getInitInputs());
}

}
?>
