<?php
// TODO :
// - comment rédiger les règles pour tout mettre en un même fichier XSLT ?
// - remonter l'élément "table" sous "daodefininition" ?
// - produire un fichier DAO par table
// En fait ne faudrait il pas un fichier commun à Copix Dao et à Pear::MDB ?
// Comment autrement disposer des informations telle que "autoincrement" ou "fk..." ?

/**
 * Create a CopixDao schema from a creation one: last step (see doCopixSchema1.php)
 * Use Pear::MDB library
 * 
 */
 
define ('LIB_MDB', '');

require_once LIB_MDB .'MDB.php' ;
MDB::loadFile('Manager');

$tmp_schema_file = 'dao-definition0.xml';
$CopixDao_schema_file = 'dao-definition1.xml';

// load a document
$source = domxml_open_file(realpath($tmp_schema_file));

// load thefirst style sheet
$stylesheet = domxml_xslt_stylesheet_file(realpath('e2a-4.xsl'));

// apply the style sheet to the document
$result = $stylesheet->process( $source 
                              , array('with-namespace' => 'no')
                              );

// save the styled document
$result->dump_file( realpath($CopixDao_schema_file) );

echo "\n<br>End of process. \n<br>";
?>