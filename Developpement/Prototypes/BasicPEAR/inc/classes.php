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
// Généré le Mon Mar 15 14:14:58 2004 par do_include
// Classe nécessaire à l'affichage des tableaux
class Attributs {
var $id;
var $visible;
var $larg;
var $content;
function Attributs ($i = 0, $v =0, $l =0, $c = "")
	{
	$this->id = $i;
	$this->visible = $v;
	$this->larg = $l;
	$this->content = $c;
	}
}

// Classe principale PHPAIE_main 

class MAIN_CLASS {
// ---------- nom de l'objet ------
var $name		= "";
// ---------- nom du répertoire de l'objet ------
var $directory	= "";
// ---------- variables du formulaire ------
var $vars	= array();
// ---------- libellés des variables du formulaire ------
var $titles	= array();
// ---------- inputs du formulaire ------
var $inputs	= array();
// ---------- buffer retour de l'action business ------
var $businessBuffer	= array();
// ---------- filtre de séléction SQL courant ------
var $cur_filter	= 0;
// ---------- identifiant courant ------
var $cur_id	= 0;
// ---------- message client ------
var $message_status		= "";
// ---------- message interne (debug)------
var $message_core		= "";
// ---------- dernière erreur ------
var $message_error		= "";
// ---------- URL du script du formulaire ------
var $formAction			= "";
// ---------- Ancre de la page ------
var $anchor				= "";
// ---------- méthode d'affichage ------
var $displayHandle		= "QuickForm";
//var $displayHandle		= "Default";

// ---------- méthode 'private' de vérification de validation------
function isFormValidated()
	{
	return (isset( $this->vars['RETURN_STATUS'] ) );
	}
// ---------- méthode 'private' de vérification de validité de l'identifiant courant ------
function isIdSet()
	{
	$id_name = $this->getIdName();
	//print "<font color=\"green\">isset(\$id_name)</font>".(isset($id_name))."<font color=\"green\">\$this->vars[\$id_name] > 0</font> ".($this->vars[$id_name] > 0)."(<font color=\"blue\">".$id_name." = " .$this->vars[$id_name].")</font><BR>";
	return ( isset($id_name) && $this->vars[$id_name] > 0 );
	}
// ---------- méthode 'private' status de la dernière opération ------
function isStatusOk()
	{
	return ( isset( $this->vars['RETURN_STATUS'] ) && $this->vars['RETURN_STATUS'] == 0 );
	}
// ---------- méthode 'private' de vérification de disposition de bouton 'nouveau' ------
function isNewButton()
	{
	return ( isset( $this->vars['B_NOUVEAU'] ) );
	}
// ---------- méthode 'private' de vérification d'état de multi-relation ------
function isMultiRecords()
	{
	return ( isset( $this->vars['MULTI_RECORDS'] ) );
	}
// ---------- Accesseurs ------
function getIdName()
	{
	return "ID_".$this->name;
	}

function getName()
	{
	return $this->name;
	}

function getDirectory()
	{
	return $this->directory;
	}

function getVars()
	{
	return $this->vars;
	}

function getVar( $index )
	{
	return $this->vars[$index];
	}

function getTitles()
	{
	return $this->titles;
	}

function getInputs()
	{
	return $this->inputs;
	}

function getCurId()
	{
	return $this->cur_id;
	}

function getMessageStatus()
	{
	return $this->message_status;
	}

function getMessageCore()
	{
	return $this->message_core;
	}

function getMessageError()
	{
	return $this->message_error;
	}

function getFormAction()
	{
	return $this->formAction;
	}

function getStatus()
	{
	return $this->vars['RETURN_STATUS'];
	}

function getAnchor()
	{
	return $this->anchor;
	}

function invalidateStatus()
	{
	unset ($this->vars['RETURN_STATUS']);
	unset ($GLOBALS['RETURN_STATUS']);
	}

function setName( $newName )
	{
	$this->name = $newName;
	}

function setVars( $newVars )
	{
	$this->vars = $newVars;
	}

function setVar( $index, $newVar )
	{
	$this->vars[$index] = $newVar;
	}

function setTitles( $newTitles )
	{
	$this->titles = $newTitles;
	}

function setInputs( $newInputs )
	{
	$this->inputs = $newInputs;
	}

function setCurId( $newCurId )
	{
	$id_name = $this->getIdName();
	$this->vars[$id_name] = $newCurId;
	}

function setStatus(  $newStatus )
	{
	$this->vars['RETURN_STATUS'] = $newStatus;
	}

function setAnchor(  $newAnchor )
	{
	$this->anchor = $newAnchor;
	}

// ---------- méthodes de l'objet ------
// MAIN_CLASS
function MAIN_CLASS ( $name_object, $directory, & $pvars )
	{
	$this->name			= $name_object;
	$this->directory	= $directory;
	$this->vars			= $pvars;
	$id_name 		= $this->getIdName();
	$this->cur_id 		= &$this->vars[$id_name];
	}

//------------- Inititialisation des valeurs---------
function initInputsVars( )
{
foreach ($this->inputs as $myarray) {
		if (! isset( $this->vars[$myarray['field_name']] )) {
		$this->vars[$myarray['field_name']]=$myarray['field_value'];
		}
	}
}

//------------- Inititialisation des valeurs clés étrangères sous forme de chaîne ---------
function getFKeysString( )
{
$fkeys = array();
foreach ($this->inputs as $myarray) {
		if ($myarray['field_fkey'] == 1) {
		$fkeys[] = $myarray['field_name']."=".$myarray['field_value'];
		}
	}
return implode('&',$fkeys);
}

//------------- Inititialisation des libellés des attributs (inputs) ---------
function initInputsTitles( )
{
foreach ($this->inputs as $myarray) {
		if (! isset( $this->titles[$myarray['field_name']] )) {
		$this->titles[$myarray['field_name']]=explode ('~', $myarray['field_title']);
		}
	}
}

// ---------- ResetVars vider toutes les variable du formulaire------
// si preserveFKeys = 0 :les clés étrangères sont mise à blanc dans le formulaire
function resetVars( $preserveFKeys = 1 )
{
$method = (isset( $_POST ) && array_count_values($_POST) ) ? '_POST' : '_GET';
foreach ($this->inputs as $myarray){
	if ( $preserveFKeys != 1 || $myarray['field_fkey'] != 1 ) {
		$GLOBALS[$method][$myarray['field_name']] ="";
		$this->vars[$myarray['field_name']]="";
		}
	}
unset($this->vars['RETURN_STATUS']);
unset ($GLOBALS['RETURN_STATUS']);
return 0;
}

//------------- Gestion des variables de la classe ---------
//Initialisation, modification et enregistrement
//des variables 'input' de la classe.
//
function registerForm ( )
{
$id_name = $this->getIdName();
// Debug statment
// foreach ( $GLOBALS as $key=>$value )
//	{
//	print "\$GLOBALS[\"$key\"] == $value<br>";
//	}
	if ($this->isIdSet()) {
		//l'identifiant est connu -> l'entité existe -> modification
		$this->updateDbVars();
		} else {
		//l'identifiant est inconnu -> insertion avec incrément de l'id
		$this->insertDbVars();
		}
	if ($this->isFormValidated() && !$this->isStatusOk()) {
//------Todo -> generer une exception -------------
print "DBG :".__FILE__." ".__LINE__." ".$this->message_error."<br/>";
		$this->message_error = "erreur n ".$this->getStatus()."<br>";
		}
//Retour à modifier (au plus vite)
return 0;
}

//------------- Accesseur pour les variables du formulaire---------
// -> Retourne les inputs valides (non nuls) du formulaire
// -> Si l'identifiant du formulaire n'est pas fixé
// -> les valeurs par défaut sont affectées
//
function getValidVars( )
{
$id_name = $this->getIdName();
//S'il n'y a pas d'identifiant ID
if (! isset($this->vars[$id_name ])) {
//les valeurs prises par défaut sont les
//valeurs d'origine de la présentation.
	$this->initInputsVars( );
	}
return  $this->vars;
}


//------ Section DB (enlever les 'this')------ Insertion des valeurs---------
//Cette fonction peut être appelée statiquement c'est pourquoi les accesseurs ne sont
//pas utilisés  mais les attributs sont directement affecté (attention transition PHP5)
//utilité du paramètre  ?
function insertDbVars( $newName = null, $newVars = null, $newInputs = null )
{
include_once("db_funcs.php");
//locales
$link = openDb();
$locvars = array();
$locvals = array();

//test la validité des inputs
if ($newVars != null) {
	$this->vars = $newVars;
	}

if ($newInputs != null) {
	$this->inputs = $newInputs;
	}

if ($newName != null) {
	$this->name = $newName;
	}

$id_name = "ID_".$this->name;
// affectation de l'identifiant.
$this->vars[$id_name] = getNextIdDb( $link , $this->name );

//mise à jour interne des champs
foreach ($this->inputs as $myarray) {
	if (isset($this->vars[$myarray['field_name']])) {
		// composistion de la requête
		$myarray['field_value'] = $this->vars[$myarray['field_name']];
		// affecter table des valeurs
		if ($myarray['field_quoted'])
			array_push ($locvals, "'".$myarray['field_value']."'");
		else
			array_push ($locvals, $myarray['field_value']);
		// affecter table des noms
		array_push ($locvars, $myarray['field_name']);
		}
	}

// partie gestion SQL
$sql_req = "INSERT INTO $this->name (".implode(',', $locvars).")
	values(".join( ',', $locvals).")";
//print "<BR>Query :<BR>$sql_req";
queryDb( $link, $sql_req );
// Methode statique -> affectation directe de l'attribut.
closeDb( $link );
// ---------8<----------8< cut here  8<------------8<-------
return 0;
}

//------ Section DB (enlever les 'this')------ Update des valeurs---------
function updateDbVars( $id = 0, $newName = null, $newVars = null, $newInputs = null )
{
include_once("db_funcs.php");
$link = openDb();
$locsets = array();

if ($newVars != null) {
	$this->vars = $newVars;
	}

if ($newInputs != null) {
	$this->inputs = $newInputs;
	}

if ($newName != null) {
	$this->name = $newName;
	}

// Affectation de l'identifiant courant.
if ( $id == 0 && $this->cur_id != 0 ) {
	$id = $this->getCurId();
	} elseif ( $id != 0 && $this->cur_id == 0 ) {
	$this->setCurId( $id );
	}

foreach ($this->inputs as $myarray) {
	if (isset($this->vars[$myarray['field_name']])) {
		// composistion de la requête UPDATE
		$myarray['field_value'] = $this->vars[$myarray['field_name']];
		// affecter table des valeurs
		if ($myarray['field_quoted'])
			array_push ($locsets, $myarray['field_name']."='".$myarray['field_value']."'");
		else
			array_push ($locsets, $myarray['field_name']."=".$myarray['field_value']);
		}
	}

// ---------8<----------8< cut here  8<------------8<-------
// Update uniquement si l'identifiant est défini
if ( $id != 0 ) {
	$sql_req = "UPDATE $this->name SET ".implode(",", $locsets)." where ID_$this->name = $id";
	} 
//print "<BR>Query :<BR>$sql_req";
queryDb( $link, $sql_req );

closeDb( $link );
// ---------8<----------8< cut here  8<------------8<-------
return 0;
}

//------ Section DB done !------ Fetch id ------
//fetchOne recherche un élément (unique : typiquement un ID)
//dans la base de donnée et le renvoie à l'appelant.
// fetchOne( NOMTABLE, NOMCOLONNE, CLAUSEWHERE, TYPESELECT )
function fetchOne( $nomtbl, $nomitem, $where_clause, $select_type )
{
	include_once("db_funcs.php");
	$where_clause = strtoupper ($where_clause);
	$nomtbl = strtoupper ($nomtbl);
	$nomitem = strtoupper ($nomitem);
	$nom_ndx="";
	$nom_col="";
	$nom_ali="";
	// Construction de la requete : les alias sont détectés
	if ( ereg( "(.*)\.(.*)", $nomitem, $r_nomitem )){
		$nom_ali = $r_nomitem[1].".";
		$nom_col = $r_nomitem[2];
		$nom_ndx = "ID_". ereg_replace ("_[^_]*(_KEY|_CKEY)(_TI|_SI|_MI|_I|_BI|_F|_DO|_DE|_C|_DATE|_TIME|_CH|_VCH|_TE|_BL)$", "", $r_nomitem[2]);
		} else {
		$nom_col = $nomitem;
		$nom_ndx = "ID_". $nomtbl;
		}
	$ret = -1;
	if ($nom_col=="*") {
		$nom_col = $nom_ndx ;
		}
	// Si aucun champ n'est rempli on les prend tous
	$sql_req = "SELECT $select_type $nomitem FROM $nomtbl $where_clause";
	//    print "<H2> $sql_req </H2>";
	$count_id = 0;
	$link = openDb();
	$ret = queryOneDb($link, $sql_req);
	closeDb($link);
	return $ret;
}

//------ Section DB Fetch LISTE ------
//Attention par convention interne tout les éléments de la base de données sont mis en MAJUSCULE
//fetchListe( NOMTABLE, NOMCOLONNE, CLAUSEWHERE, TYPESELECT , LSTSELECT, VARIABLES )
function fetchListe( $nomtbl = "", $nomitem = "", $where_clause = "", $select_type = "", $list_name = null)
{
include_once("db_funcs.php");
require_once("funcs.php");
if ($where_clause  != "") {
	$where_clause = strtoupper ($where_clause);
	} else {
	$where_clause = "WHERE 1";
	}

if ($nomtbl == "") {
	$nomtbl = $this->name;
	} else {
	$nomtbl= strtoupper ($nomtbl);
	}

if ($nomitem == "") {
	$nomitem = "*";
	} else {
	$nomitem = strtoupper ($nomitem);
	}

$req="$where_clause";
// Modification de la clause WHERE pour filtrer selon les critères présents dans $vars
//  -> si c'est le cas ajouter la paire argument, valeur dans la condition.
// ---------- filtre de séléction SQL ------
// Si $cur_filter = 0 => (défaut) les éléments sont filtrés en fonction
// des clé étrangères présentes dans les variables postées.
// Si $cur_filter = 1 => les éléments sont filtrés en fonction
// de toutes les variables postées et non vides.
//(Pour des raisons de débogage on ne teste pas la version du produit)

if ($cur_filter == 0) {
	foreach ($this->vars as $key=>$value) {
		if ( $this->inputs[$key]['field_fkey'] && array_key_exists ( $key, $this->inputs) ) {
			if ($this->inputs[$key]['field_quoted']) {
					// Le 'LIKE' est de parti pris
					$req .= " AND $key LIKE '${value}%'";
				} else {
					$req .= " AND $key=$value";
				}
			}
		}
	} else if($cur_filter == 1) {
	foreach ($this->vars as $key=>$value) {
		if ( $value != "" && strcmp ($key, "ID_VERSION") && array_key_exists ( $key , $this->inputs) ) {
			if ($this->inputs[$key]['field_quoted']) {
				// Le 'LIKE' est de parti pris
				$req .= " AND $key LIKE '${value}%'";
				} else {
				$req .= " AND $key=$value";
				}
			}
		}
	}
// Ordonancement de l'affichage des éléments par colonnes
if (isset ($GLOBALS['ORDER']) && $GLOBALS['ORDER'] != "") {
	$req .= " ORDER BY ".$GLOBALS['ORDER'];
	}
$nom_ndx="";
$nom_col="";
$nom_ali="";
if ( ereg( "(.*)\.(.*)", $nomitem, $r_nomitem )) {
	$nom_ali = $r_nomitem[1].".";
	$nom_col = $r_nomitem[2];
	$nom_ndx = "ID_". ereg_replace ("_[^_]*(_KEY|_CKEY)(_TI|_SI|_MI|_I|_BI|_F|_DO|_DE|_C|_DATE|_TIME|_CH|_VCH|_TE|_BL)$", "", $r_nomitem[2]);
	} else {
	$nom_col = $nomitem;
	$nom_ndx = "ID_". $nomtbl;
	}
if ($nomitem != "*") {
	$nomitem = $nom_ali.$nom_ndx.", ".$nomitem ;
	}
$req = "SELECT $select_type $nomitem FROM $nomtbl $req";
//print "<BR>Query :<BR>$req";
$link = openDb();
$result = queryDb($link, "$req");
closeDb($link);
return $result;
}


//------ Section DB headerTableDbVars ------
function fetchHeader( )
{
include_once("db_funcs.php");
$count_id = 0;

$start_query = (isset ($GLOBALS['QUERY_STRING']) && $GLOBALS['QUERY_STRING'] != "") ? "&" : "?";

if (isset ($GLOBALS['ORDER']) && $GLOBALS['ORDER'] != "") {
	$GLOBALS['REQUEST_URI'] = str_replace (strstr ($GLOBALS['REQUEST_URI'], $start_query."ORDER"), "", $GLOBALS['REQUEST_URI']);
	}

$link = openDb();
$result = queryDb( $link, "SELECT * FROM GESTAB WHERE GESTAB_NOMTBL_CKEY_VCH = '$this->name'" );

while ( $a_row = fetchRowAssocDb( $result ) ) {
	$colonnes[$a_row['GESTAB_NOMCOL_KEY_VCH']] = new attributs (($a_row['GESTAB_LNK_VCH'] == "ON" ) ? 1 : 0, ($a_row['GESTAB_VIS_VCH'] == "ON")  ? 1 : 0, $a_row['GESTAB_LARG_I'], "<a href=\"".$GLOBALS['REQUEST_URI'].$start_query."ORDER=".$a_row['GESTAB_NOMCOL_KEY_VCH']."\" class=\"tableLink\">".$a_row['GESTAB_TITRE_VCH']."</a>\n");
	// Tester s'il y a au mois 1 lien visible
	$count_id |= (($a_row['GESTAB_VIS_VCH'] == "ON") && ($a_row['GESTAB_LNK_VCH'] == "ON" )) ? 1 : 0 ;
	}
	// Afficher une colonne avec checkbox selection
	$result = queryDb( $link, "SELECT * FROM ATAB WHERE ATAB_NOMTBL_CKEY_VCH = '$this->name'");
	$a_row = fetchRowAssocDb( $result );
	$colonnes["ATAB_CHKSELECT_"]  = new attributs ( 1,  ($a_row["ATAB_CHKSELECT"] == "ON") , 10, "S&eacute;lectionner\n");
	// Afficher une colonne avec bouton selection 
	$colonnes["ATAB_SELECT_"]  = new attributs ( 1,  ($a_row["ATAB_SELECT"] == "ON") , 10, "S&eacute;lectionner\n");
	// Il n'y a pas de lien visible
	if(!$count_id && !$colonnes["ATAB_CHKSELECT_"]->visible && !$colonnes["ATAB_SELECT_"] ) {
		$colonnes["id"]  = new attributs ( 1,  1 , 10, "ID\n");
		}

	closeDb($link);
	return $colonnes;
}


//------ Section DB listTableDbVars ------
//Patramètres 
//$listAction : Liste des noms des actions applicables à la table
function listTableDbVars( $withForm = 1, $doNl2Br = 1, $listAction = "" )
{
//Ajouter les identifiants ajoutés precédemment au liens HREF de la table
//Cf MODIF_FP.pl
require_once('HTML/Table.php');
$table = new HTML_Table("class=\"localList\"");
$header = $this->fetchHeader();
$content = $this->fetchListe();

$id_name = $this->getIdName();
foreach ($header as $value) {
	if ($value->visible) {
		$tab_row[0][] = $value->content;
		}
	}

$fkeys = $this->getFKeysString();
$cpt_row = 1;
while ( $a_row = fetchRowAssocDb( $content ) ) {
	foreach ($header as $key=>$value) {
		if ($value->visible && $key != "ATAB_CHKSELECT_" && $key != "ATAB_SELECT_") {
			if ($doNl2Br == 1) {
				$tab_row[$cpt_row][] = nl2br(htmlentities($a_row[$key], ENT_QUOTES, $this->encoding));
				} else {
				$tab_row[$cpt_row][] = htmlentities($a_row[$key], ENT_QUOTES, $this->encoding);
				}
			}
		}
	// Afficher ou non la colonne des checkbox de selection
	if ($header['ATAB_CHKSELECT_']->visible) {
		$tab_row[$cpt_row][] = "<p align=\"center\"><input type=\"checkbox\" name=\"SEL_".$id_name."_".$a_row[$id_name]."\" value=\"ON\" ".(($this->vars["SEL_".$id_name."_".$a_row[$id_name]] == "ON") ? "CHECKED" : "")."><input type=\"hidden\" name=\"WAS_".$id_name."_".$a_row[$id_name]."\" value = \"".$this->vars["SEL_".$id_name."_".$a_row[$id_name]]."\" size=\"6\"></p>";
		}
	// Afficher ou non la colonne des liens de selection
	if ($header['ATAB_SELECT_']->visible) {
		$tab_row[$cpt_row][] = "<A HREF=\"".$_SERVER['PHP_SELF']."?".$id_name."=".$a_row[$id_name]."&".$fkeys."\">[$cpt_row]</A>";
		}
	$cpt_row ++;
	}

foreach($tab_row as $key => $value) {
	$table->addRow( $tab_row[$key], ($key == 0) ? "class=\"firstLine\"" : "");
	}

//formulaire ayant action sur le tableau
$str_form = "<div align=\"center\">\n";
if ( $withForm == 1 ) {
	$str_form .= "<form method=\"post\" name=\"{$this->name}_TBL\" action=\"".$_SERVER['PHP_SELF']."?".$GLOBALS['QUERY_STRING']."\">\n";
	}
$str_form .= $table->toHTML();
if ( $withForm == 1) {
	$str_form .= "<input type=\"submit\" value=\"S&eacute;lectionner\" name=\"SELECTIONNER_{$this->name}\">\n";
	$str_form .= "<input type=\"submit\" value=\"Supprimer\" name=\"SUPPRIMER_{$this->name}\">\n";
	$str_form .= "</form></div>\n";
	}
$str_form .= "\n";
return ($str_form);
}
//------ Section DB setDbVars ------
//Va rechercher les éléments d'une  table selon l'identifiant id
//rempli les  du formulaire et initialise RETURNV 
function setDbVars( $id = 0 )
{
	if ( $id == 0 && $this->cur_id != 0 ) {
 	$id = $this->getCurId();
		}
	include_once("db_funcs.php");
	$link = openDb();
	$req = "SELECT * FROM $this->name where ID_$this->name = $id";
  // print "<H1>$req </H1><BR>";
	$result = queryDb($link, $req);
 //$num_rows = mysql_num_rows( $result );
	//Aller chercher dans la table Gestab
	while ( $a_row = fetchRowAssocDb( $result ) ) {
		while (list($key, $value) = each ($a_row)) {
			// print "Clé: $key; Valeur: $value<br>";
			if (ereg("_DATE$",$key)) {
				$this->vars[$key] = date_php($value);
				} else {
				$this->vars[$key]=$value;
				}
			}
		}
 //mysql_free_result($result);
	closeDb( $link );
	return 0;
}
// -------- Section DB -------- Del ------
function deleteDbVars( $clause = "", $id = -1 )
{
include_once("db_funcs.php");
$link = openDb();
if ( isset( $clause ) && $clause !="") {
	$query = "DELETE FROM $this->name where $clause ";
	} else if (  $id  != -1 ) {
	$id_name = $this->getIdName();
	$query = "DELETE FROM $this->name where $id_name = $id";
	}
	$result = queryDb( $link, $query );
closeDb( $link );
return $result;
}


//------ Section DB Delete ------
// --------> sur liste faire un check ?? 

// -------- Section DB -------- Suppress------
//Supprime la table (version développement!!)
function suppressDbVars( )
{
include_once("db_funcs.php");
$link = openDb();
//------------- récupération de la référence à la table ---------
$query = "select ID_ATAB from ATAB where ATAB_NOMTBL_CKEY_VCH like '$this->name';";
$result = mysql_query( $query, $link )
	or die ( "Impossible de séléctionner les éléments  dans la table ATAB ".mysql_error() );
 $id_todel = mysql_result ($result, 0);
//------------- Suppression de la référence à la table ---------
$query = "delete from ATAB where ATAB_NOMTBL_CKEY_VCH like '$this->name';";
mysql_query( $query, $link )
	or die ( "Impossible de supprimer les éléments de la table $this->name dans la table ATAB ".mysql_error() );
//------------- Suppression des références aux colonnes ---------
$query = "delete  from GESTAB where GESTAB_IDTBL_CKEY_TI = $id_todel;";
mysql_query( $query, $link )
	or die ( "Impossible de supprimer les colonnes de la table $this->name ".mysql_error() );
//------------- Suppression physique de la table ---------
$query = "drop table $this->name;";
mysql_query( $query, $link )
	or die ( "Impossible de supprimer la table $this->name ".mysql_error() );
unset($id_todel);
mysql_free_result($result);
closeDb( $link );
return 0;
}

//--------- Section DB ---------- Suppression physique des dépendances la table ---------
function recursDeleteDbVars( $id )
{
include_once("db_funcs.php");
$link = openDb();
//print "Enregistrement dépendants de l'ID $id de la table $this->name<BR>";
//chercher la relation ayant cette table comme table mère.
$query = "SELECT R.ID_RELATIONS, R.RELATIONS_NAME_TFILLE_VCH FROM ATAB A, RELATIONS R where A.ATAB_NOMTBL_CKEY_VCH = '$this->name' AND A.ID_ATAB = R.RELATIONS_NAME_TMERE_VCH";
//print "1 Sélection deS  relationS avec $this->name en table mère <BR> $query <BR>";
$result = mysql_query( $query, $link );
while ( $a_row = mysql_fetch_row( $result ) ) {
	 $cpt_fetch = 0;
	 $meta_query = "DELETE FROM";
	 $select_query = "SELECT";
	 $name_Fille = "";
	 //print "2 Identifiant relation : $a_row[0] la table fille : $a_row[1]<BR>";
//chercher le nom de la table fille (à partir de son ID).
	 $query = "SELECT ATAB_NOMTBL_CKEY_VCH FROM ATAB where ID_ATAB = $a_row[1]";
	 //print "3 Récupération du nom de la table fille<BR> $query <BR>";
	 $resultZ = mysql_query( $query, $link );
	 $a_rowZ = mysql_fetch_row( $resultZ );
	 $name_Fille = $a_rowZ[0];
	 //print "4 Nom table Fille : $a_rowZ[0]<BR>";

	if ($cpt_fetch == 0) {
	$meta_query .= " $name_Fille  WHERE 1";
	$select_query .= " ID_$name_Fille FROM $name_Fille WHERE 1 ";
	$cpt_fetch ++;
	}
//chercher les éléments en relation mère-fille.
	 $query = "SELECT ID_LSTRELAT, LSTRELAT_NAME_CMERE_CKEY_VCH, LSTRELAT_NAME_CFILLE_CKEY_VCH, LSTRELAT_TYPE_RELATION_I FROM LSTRELAT where ID_RELATIONS = $a_row[0]";
	 // print "4.bis recherche des identifiants de colonne<BR> $query <BR>";
	 $result2 = mysql_query( $query, $link );
	 while ( $a_row2 = mysql_fetch_row( $result2 ) ) {
		$id_colm = 0;
		$nm_colm ="ID_$this->name";
		$id_colf = 0;
		$nm_colf ="ID_$name_Fille";
		// print "Identifiant lstrelat : $a_row2[0] indice col mere : $a_row2[1] indice col fille : $a_row2[2] rel : $a_row2[3]<BR>";
		$cpt_fetch ++;
		//chercher les éléments colonnes mère.
		//récupérer les noms de colonnes à mettre en relation pour la mère
		 $query = "SELECT GESTAB_NOMCOL_KEY_VCH FROM GESTAB where ID_GESTAB = $a_row2[1]";
		 // print "5 Récupération du nom de colonne coté table mère<BR>$query <BR>";
		$result3 = mysql_query( $query, $link );
		while ( $a_row3 = mysql_fetch_row( $result3 ) ) {
			$id_colm = $a_row2[1];
			$nm_colm = $a_row3[0];
			// print "6.bis id colm : $id_colm nom col mère : $nm_colm<BR>";
			}
		//chercher les éléments colonnes fille et récupérer les noms de
		//colonnes à mettre en relation pour la table fille
		$query = "SELECT GESTAB_NOMCOL_KEY_VCH FROM GESTAB where ID_GESTAB = $a_row2[2]";
		// print "6 Récupération du nom de colonne coté table fille<BR>$query ";
		$result3 = mysql_query( $query, $link );
		while ( $a_row3 = mysql_fetch_row( $result3 ) ) {
			$id_colf = $a_row2[2];
			$nm_colf = $a_row3[0];
			// print "6.bis id colf : $id_colf nom col fille : $nm_colf<BR>";
			}
		//print "7 id colm : $id_colm nom col mère : $nm_colm<BR>";
		// print "7 id colf : $id_colf nom col fille : $nm_colf<BR>";
		// Egalité systématique penser à vérifier \$a_row2[3] $a_row2[3]
		// AND systématique changer le modèle des méta-tables 
		$val_query = "SELECT $nm_colm FROM $this->name WHERE ID_$this->name = $id";
		// print "7.bis constitution de la clause select<BR> $val_query <BR>";
		$result_val = mysql_query( $val_query, $link );
		$a_row_val = mysql_fetch_row( $result_val ); 
		$meta_query .= " and $a_row_val[0] = $nm_colf";
		$select_query .= " and $a_row_val[0] = $nm_colf";
		}
		if ($cpt_fetch > 1) {
			// print "8 Séléctionner le prochain identifiant<BR>  $select_query<BR>";
			$result_sel = mysql_query( $select_query, $link );
			$a_row_sel = mysql_fetch_row( $result_sel );
			$id = $a_row_sel[0];
			// print "9 id = $id<BR>";
			if (isset($id)) {
				Delete_recurs($link, $name_Fille );
				}
			 // print "10 On delete <BR> meta_query = $meta_query <BR>";
			 $final_result = mysql_query( $meta_query, $link )
				or die ( "Impossible de supprimer des données dans la table $this->name ".mysql_error() );
			}
		}
closeDb( $link );
mysql_free_result($result);
mysql_free_result($resultZ);
mysql_free_result($result2);
mysql_free_result($result3);
mysql_free_result($result_val);
mysql_free_result($result_sel);
return(0);
}

//-------- Section DB ----------- Gestion de relation inter tables ---------
function checkNToNDbVars ( $TABLE_TO )
{
include_once("db_funcs.php");
$link = openDb();
// Caractère de liaison URL/QueryString
$start_query = (isset ($GLOBALS[QUERY_STRING]) &&  $GLOBALS[QUERY_STRING] != "") ? "&" :"?" ;


$l_result = mysql_query( "SELECT ID_$this->name from $this->name$TABLE_TO WHERE ID_$TABLE_TO = ".($this->vars ["ID_".$TABLE_TO]).";");
$l_num_rows = mysql_num_rows( $l_result );
// récupérer les valeurs de check modifiées
while ( $l_a_row = mysql_fetch_assoc( $l_result ) ) {
	while (list($key, $value) = each ($l_a_row)) {
		$founded[$value] = "CHECKED";
		}
	}
$req="";
foreach ($this->vars as $key=>$value) {
	if ($value != "" && (strstr($key,"${this}->name_" ) || !strcmp ($key, "ID_$this->name") || !strcmp ($key, "ID_VERSION")) ) {
		if (ereg("_TI$",$key) || ereg("_SI$",$key) ||
		ereg("_MI$",$key) || ereg("_I$",$key) ||
		ereg("_BI$",$key) || ereg("_F$",$key) ||
		ereg("_DO$",$key) || ereg("_DE$",$key) || 
		ereg("^ID_",$key)) {
			$req .= "$key=$value AND ";
			} else {
			// Le 'LIKE' est de parti pris
			$req .= "$key LIKE '${value}%' AND ";
			}
		}
// fabriquer une chaine avec select * where S_XXXX =$this->vars[S_XXXX] (ou $value) AND ...
// pour parvenir à la requête voulue
	}
if ($req!="") {
	$req = "SELECT * FROM $this->name where ".ereg_replace(" AND $", "", $req);
	} else {
	// Si aucun champ n'est rempli on prend tout
	$req = "SELECT * FROM $this->name";
	}
// Gestion du tri des colonnes => effacer l'éventuel critère précédent
if (isset ($GLOBALS['ORDER']) && $GLOBALS['ORDER'] != "") {
	$req .= " ORDER BY ".$GLOBALS['ORDER'];
	$GLOBALS[REQUEST_URI] = str_replace (strstr ($GLOBALS[REQUEST_URI], $start_query."ORDER"), "", $GLOBALS[REQUEST_URI]);
	}
//    print "<H1>$req </H1><BR>";
$count_id = 0;
$result = mysql_query( "SELECT * FROM GESTAB WHERE GESTAB_NOMTBL_CKEY_VCH = '$this->name'");
// Aller chercher dans la table Gestab
print "<table border=1 WIDTH=\"800\">\n";
print "<tr>\n";
while ( $a_row = mysql_fetch_assoc( $result ) ) {
	$colonnes[$a_row[GESTAB_NOMCOL_KEY_VCH]] = new Attributs (($a_row[GESTAB_LNK_VCH] == "ON" ) ? 1 : 0, ($a_row[GESTAB_VIS_VCH] == "ON")  ? 1 : 0, $a_row[GESTAB_LARG_I]);
	// Il y a au mois 1 lien visible
	$count_id |= (($a_row[GESTAB_VIS_VCH] == "ON") && ($a_row[GESTAB_LNK_VCH] == "ON" )) ? 1 : 0 ;
	while (list($key, $value) = each ($a_row)) {
		if ($key == "GESTAB_TITRE_VCH" && $a_row[GESTAB_VIS_VCH] == "ON") {
			print "	<td bgcolor=\"#808000\"><a href=\"".$GLOBALS[REQUEST_URI].$start_query."ORDER=".$a_row[GESTAB_NOMCOL_KEY_VCH]."\" class=\"tablelink\">$value</a></td>\n";
			}
		}
	}
// Afficher une colonne avec bouton suppression 
$result = mysql_query( "SELECT * FROM ATAB WHERE ATAB_NOMTBL_CKEY_VCH = '$this->name'");
$a_row = mysql_fetch_assoc( $result );
$colonnes["ATAB_CHKSELECT_"]  = new Attributs ( 1,  ($a_row["ATAB_CHKSELECT"] == "ON") , 10);
// Afficher une colonne avec bouton selection 
$colonnes["ATAB_SELECT_"]  = new Attributs ( 1,  ($a_row["ATAB_SELECT"] == "ON") , 10);
// Il n'y a pas de lien visible
if (!$count_id && !$colonnes["ATAB_CHKSELECT_"]->visible && !$colonnes["ATAB_SELECT_"] ) {
	$colonnes["id"]  = new Attributs ( 1,  1 , 10);
	print "   <td bgcolor=\"#887799\">ID</td>\n";
	}
if ($colonnes["ATAB_CHKSELECT_"]->visible) {
	print "   <td bgcolor=\"#887799\">Lier</td>\n";
	}
if ($colonnes["ATAB_SELECT_"]->visible) {
	print "   <td bgcolor=\"#887799\">selection</td>\n";
	}
print "</tr>\n";
$result = mysql_query( "$req");
$num_rows = mysql_num_rows( $result );
while ( $a_row = mysql_fetch_assoc( $result ) ) {
	print "<tr>\n";
	while (list($key, $value) = each ($a_row)) {
		if ($colonnes[$key]->visible) {
			if ($value  == "" )
				$value = "&nbsp;";
			if ($colonnes[$key]->id)
				print "	<td><a href=\"../$this->directory/${this}->name_1.php?ID=".$a_row["ID_$this->name"]."\">$value</a></td>\n";
			else
				print "	<td>$value</td>\n";
			}
		}
	if ($colonnes["ATAB_CHKSELECT_"]->visible) {
		$NID = $a_row["$name_index"];
		print "        <td align=\"center\"><input type=\"checkbox\" name=\"CHK_$NID\" value=\"$founded[$NID]\" $founded[$NID] >\n";
		print "        			 <input type=\"hidden\" name=\"WAS_$NID\" value=\"$founded[$NID]\"  size=\"20\"> </td>\n";
		}
	if ($colonnes["ATAB_SELECT_"]->visible) {
		print "	<td><a href=\"../->directory/.php?ID=".$a_row["$name_index"]."\">Select.</a></td>\n";
		}
	print "</tr>\n";
	}
print "</table>\n";
print "<p>Cette séléction comprend $num_rows enregistrement(s)</p>";
closeDb( $link );
return 0;
}

}
?>
