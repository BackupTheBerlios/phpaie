<?php
/**
 * Create a data base with Pear:MDB schema 
 *
 */
 
define ('LIB_MDB', '');

require_once LIB_MDB .'MDB.php' ;
MDB::loadFile('Manager');

$mdb_schema_file = 'mdb-schema.xml';
$dbName = 'copixwebapp' ;


// set the array of "variables" in the  $schema_file
$variables=array();

// set the array of "options" for the DBMS
// Note: it's possible to set options with 
$options=array(  'UseTransactions' => true
               , 'DefaultTableType' => 'INNODB'
               , 'persistent' => false
               , 'debug' => 5
               );

// set the array of information for the connexion to the DBMS
// Note: DSN format = DBMS_type://user_name:password@hostserver.DB_name
$dbinfo = array(
                 'phptype'  => 'mysql'
               , 'username' => 'root'
               , 'hostspec' => 'localhost'
               , 'password' => 'pierre'
               );   

$manager = new MDB_manager();

$manager->connect( $dbinfo, $options );

$success = $manager->updateDataBase( $mdb_schema_file
,''
//                                   , $mdb_schema_file .'.before'
                                   , $variables
                                   ) ;

if ( MDB::isError( $success ) ) {
    echo 'Error: ' .$success->getMessage() .'\n<br>' ;
    echo $success->toString()  ." \n<br>";
}

if ( count( $manager->warnings ) > 0 ) {
	echo 'Warning: \n' .implode( $manager->getWarnings(), '!\n' ) .'\n' ;
}	 

$manager->disconnect( );
$dbLink = mysql_pconnect (
                 'localhost'
               , 'root'
               , 'pierre'
               );   
    // @todo: ici il faudrait en fait récupérer le nom de la BDD figurant dans 
    //        le schéma ! 
$dbResult = mysql_select_db($dbName, $dbLink);
/*    
    // @todo: et ici il faudrait en fait récupérer le nom des tables de séquence
    //        de la BDD figurant dans le schéma ! 
$query = 'ALTER TABLE person_id_seq CHANGE sequence id INTEGER';
$dbResult = mysql_query($query, $dbLink) ;
$query = 'ALTER TABLE branch_id_seq CHANGE sequence id INTEGER';
$dbResult = mysql_query($query, $dbLink) ;
*/
echo "\n<br>End of process. \n<br>";
?>
