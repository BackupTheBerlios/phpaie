<?php
/**
 * Create a CopixDao schema from a creation one: first step (see doCopixSchema2.php)
 * Use Pear::MDB library
 * 
 */
 
define ('LIB_MDB', '');

require_once LIB_MDB .'MDB.php' ;
MDB::loadFile('Manager');

$creation_schema_file = 'mdb-schema.xml';
$CopixDao_schema_file = 'dao-definition0.xml';

// load a document
$source = domxml_open_file(realpath($creation_schema_file));

// load thefirst style sheet
$stylesheet = domxml_xslt_stylesheet_file(realpath('e2a.xsl'));

// apply the style sheet to the document
$result = $stylesheet->process( $source 
                              , array('with-namespace' => 'no')
                              );

// save the styled document
$result->dump_file( realpath($CopixDao_schema_file) );

echo "\n<br>End of process #0. \n<br>";
?>