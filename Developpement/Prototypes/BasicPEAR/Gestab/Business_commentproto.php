<?php 
//********************************************************************
// machinbipaye 
//------------------------------------------------------------------
// Version: 0.1
//
// Copyright (c) 2002 by Jean-Charles Gibier (~Le Mulot Fou~)
// (http://www.machinbipaye.net)
// (webmaster@machinbidule.com)
//
// Support éventuel sur www.machinbipaye.net
//*********************************************************************
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as 
// published by the Free Software Foundation.
//*********************************************************************
?>
<?php
$vars = $this->vars;
//require_once("../inc/chklist.php");
//print "<font color=\"blue\">";
//$myChkList = new chklist($vars, "ID_COMMENTPROTO");
//print_r ($myChkList->getSelected ());
//			foreach ( $vars as $key=>$value )
//			{
//			print "<li>\$key $key => \$value $value</li>\n";
//			}
//Callback method de vérification

//print "</font>";
require_once ("../inc/db_funcs.php");
$tmpDb = openDb();
$dirName = queryOneDb( $tmpDb, "SELECT ATAB_REP_VCH FROM ATAB WHERE ATAB_NOMTBL_CKEY_VCH='".$this->getVar("ATAB_NOMTBL_CKEY_VCH")."'");
closeDb( $tmpDb );

//Redirection Explications -------------------------------------
if ( isset( $vars['Explications'] )) {
	require_once ("HTML/Page.php");
	require_once("MOEUVREPROTO_def.php");
	require_once ("../inc/html_settings.php");
	$page = new HTML_Page(array ('lineend'   => 'unix', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
//	$page->addStyleSheet($css_style);
	$page->setTitle('Phpaie -(EXplications)-');
// A modifier absolument 2 requêtes	suivantes à fusionner.
	$buffer = MOEUVREPROTO::fetchOne("MOEUVREPROTO_EXPLIC_TE" ,  "where ATAB_NOMTBL_CKEY_VCH ='".$this->getVar("ATAB_NOMTBL_CKEY_VCH")."'", "" );
	$ind = MOEUVREPROTO::fetchOne("ID_MOEUVREPROTO" ,  "where ATAB_NOMTBL_CKEY_VCH ='".$this->getVar("ATAB_NOMTBL_CKEY_VCH")."'", "" );
	$page->addBodyContent("<p align=\"center\"><font face=\"Arial\"><b><a href=\"Javascript:history.go(-1)\">retour</a></b></font></p>\n");
	$page->addBodyContent( "<table border=\"0\" bgcolor=\"#CCCCFF\" width=\"100%\"><caption>Pr&eacute;sentation</caption><tbody><tr><td>[".$this->getVar("ATAB_NOMTBL_CKEY_VCH")."] (Package :".$dirName.")</td></tr></tbody></table>");
	$page->addBodyContent( $buffer);
	$page->addBodyContent("<p align=\"center\"><font face=\"Arial\"><b><a href=\"Javascript:history.go(-1)\">retour</a></b></font></p>\n");
	$page->addBodyContent("<p align=\"center\"><a href=\"../Gestab/moeuvreproto.php?".$GLOBALS[QUERY_STRING]."&ID_MOEUVREPROTO=".$ind."\">[Modification]</a></p>\n");
	$page->display();
	// Sortie
	$status = -1;
	}
//Commentaires -------------------------------------
else if (isset( $vars['Commentaires'] )) {}
//Envoyer -------------------------------------
else if (isset( $vars['B1'] ) &&  $vars['B1'] == "Envoyer" && isset( $vars['CPML'])) {

//$to = "phpaie@machinbidule.com"; 
//$to = "phpaie@phpaie.net"; 
$to = "j-c.gibier@wanadoo.fr";
$sujet = "[Prototype] :".$this->getVar("ATAB_NOMTBL_CKEY_VCH")." (".$this->getVar("COMMENTPROTO_AUTHOR_CKEY_VCH").")"; 
//Php renvoie une chaine dont les quotes et les doubles quotes sont protégées -> il faut en rétablir l'aspect
$message = stripslashes( $this->getVar("COMMENTPROTO_COMMENT_TE") );

$reply = "j-c.gibier@wanadoo.fr";
//$from = "phpaie@machinbidule.com";
//$from = "phpaie@phpaie.net";
$from = "j-c.gibier@wanadoo.fr";
$fichier = "";
$typemime = "";
$nom = "prototype";

 $limite = "_parties_".md5(uniqid (rand())); 
 
 $mail_mime = "Date: ".date("l j F Y, G:i")."\n"; 
 $mail_mime .= "MIME-Version: 1.0\n"; 
 $mail_mime .= "Content-Type: multipart/mixed;\n"; 
 $mail_mime .= " boundary=\"----=$limite\"\n\n"; 
 
 $limite2 = "_parties_".md5 (uniqid (rand())); 
 
 
 //Le message en texte simple pour les navigateurs qui n'acceptent pas le HTML 
 $texte_simple .= "This is a multi-part message in MIME format.\n\n"; 
 $texte_simple .= "------=$limite\n"; 
 $texte_simple .= "Content-Type: multipart/alternative;\n"; 
 $texte_simple .= "\tboundary=\"----=$limite2\"\n\n"; 
 
 $texte_simple .= "------=$limite2\n"; 
// $texte_simple .= "Content-Type: text/plain; \tcharset=\"US-ASCII\"\n"; 
// $texte_simple .= "Content-Type: text/plain; \tcharset=\"ISO-8859-1\"\n"; 
 $texte_simple .= "Content-Type: text/plain; \tcharset=$this->encoding\n"; 
 $texte_simple .= "Content-Transfer-Encoding: quoted-printable\n\n"; 
 $texte_simple .= strip_tags(eregi_replace("<br>", "\n", $message)); 
 $texte_simple .= "\n\n"; 
 
 //le message en html original 
 $texte_html = "------=$limite2\n"; 
// $texte_html .= "Content-Type: text/html; charset=\"US-ASCII\"\n"; 
// $texte_html .= "Content-Type: text/plain; \tcharset=\"ISO-8859-1\"\n"; 
 $texte_html .= "Content-Type: text/plain; \tcharset=$this->encoding\n"; 
 $texte_html .= "Content-Transfer-Encoding: quoted-printable\n\n"; 
 $texte_html .= $message; 
 $texte_html .= "\n\n\n------=$limite2--\n"; 
 
 //le fichier 
 if (!empty($fichier)) {
	$attachement = "------=$limite\n"; 
	$attachement .= "Content-Type: $typemime; name=\"$nom\"\n"; 
	$attachement .= "Content-Transfer-Encoding: base64\n"; 
	$attachement .= "Content-Disposition: attachment; 
	filename=\"$nom\"\n\n"; 
	 
	$fd = fopen( $fichier, "r" ); 
	$contenu = fread( $fd, filesize( $fichier ) ); 
	fclose( $fd ); 
	$attachement .= chunk_split(base64_encode($contenu)); 
	
	$attachement .= "\n\n\n------=$limite\n"; 
	}
 return mail($to, $sujet, $texte_simple.$texte_html.$attachement,
"Reply-to: 
 $reply\nFrom: 
 $from\n".$mail_mime); 
 
	$this->businessBuffer[] = "<p align=\"center\"><font face=\"Arial\"><b>(Commentaire envoyé à la ML du projet)</b></font></p>\n";
//	$status = -1;
	}
//Accueil -------------------------------------
else if (isset( $vars['Accueil'] )) {
	include "../inc/cnx_param.php";
	header("Location: $domaine/~PHPAIE");
	// Sortie
	exit;
	}
//Sources -------------------------------------
else if (isset( $vars['Sources'] )) {
	require_once ("HTML/Page.php");
	require_once ("../inc/html_settings.php");
	
	// récupérer le répertoire ou se trouve le source ...
	$page = new HTML_Page(array ('lineend'   => 'unix', 'charset'  => 'ISO-8859-1', 'doctype'   => 'XHTML 1.0 Strict', 'language'  => 'fr',   'cache'	=> 'false'   ));
	$page->setTitle('Phpaie -(SOurces)-');
	$page->addBodyContent("<p align=\"center\"><font face=\"Arial\"><b><a href=\"Javascript:history.go(-1)\">retour</a></b></font></p>\n");

	$page->addBodyContent( "<table border=\"0\" bgcolor=\"#CCCCFF\" width=\"100%\"><caption>Objet :".$this->getVar("PNAME")." (Package :".$dirName.")</caption><tbody><tr><td>".$this->getVar("PNAME")."_def.php</td></tr></tbody></table>");
	$dispFileName = "../".$dirName."/".$this->getVar("PNAME")."_def.php";
	if (file_exists( $dispFileName )){
		$page->addBodyContent( highlight_file ($dispFileName , 1));
		}
	$page->addBodyContent( "<table border=\"0\" bgcolor=\"#CCCCFF\" width=\"100%\"><caption>Objet :".$this->getVar("PNAME")." (Package :".$dirName.")</caption><tbody><tr><td>".strtolower($this->getVar("PNAME")).".php</td></tr></tbody></table>");
	$dispFileName = "../".$dirName."/".strtolower($this->getVar("PNAME")).".php";
	if (file_exists( $dispFileName )){
		$page->addBodyContent( highlight_file ($dispFileName , 1));
		}

	$page->addBodyContent( "<table border=\"0\" bgcolor=\"#CCCCFF\" width=\"100%\"><caption>Objet :".$this->getVar("PNAME")." (Package :".$dirName.")</caption><tbody><tr><td>Business_".strtolower($this->getVar("PNAME")).".php</td></tr></tbody></table>");
	$dispFileName = "../".$dirName."/Business_".strtolower($this->getVar("PNAME")).".php";
	if (file_exists( $dispFileName )){
		$page->addBodyContent( highlight_file ($dispFileName , 1));
		}

	$page->addBodyContent("<p align=\"center\"><font face=\"Arial\"><b><a href=\"Javascript:history.go(-1)\">retour</a></b></font></p>\n");
	$page->display();
	// Sortie
	$status = -1;
	}
?>
