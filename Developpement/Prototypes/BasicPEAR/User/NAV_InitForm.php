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
<?php
// $Id: NAV_InitForm.php,v 1.2 2004/07/20 21:33:14 j-charles Exp $
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
?>
<?php
// print navigation
    while ($row = $res->fetchRow()) {
        $page->addBodyContent('  <tr>');
        $page->addBodyContent('    <td><li></td>');
        $page->addBodyContent('    <td><a href="'.strtolower($row[0]).'.php" target="main">'.$row[1].'</a></td>');
        $page->addBodyContent('  </tr>');
    }
 
?>
<?php
$res = $dbc->query('SELECT
                            two_letter_name,
                            native_name
                        FROM
                            liveuser_languages');
    // print language options
    while ($row = $res->fetchRow()) {
        $page->addBodyContent("    <option value=\"".$row[0]."\" ". (($row['two_letter_name'] == $_GET['NAV_LANGUAGE']) ?  'selected' : '') ." >\x0A".$row[1]."\x0A</option>");
    } 
?>
$formDef = array (
'HTML_QuickForm_def' => array (
	'formName' => 'NAV', 
	'method' =>'post' ,
	'action' =>''
	),
'Content' =>array (
	
array (
		'name'=> 'NAV_LANGUAGE', 
		'addElement' =>  array (
			'type' =>'select',
			'label' => '',
			'args' => array()),
		'nbArgsRule' => 0
		),
array (
		'name' => 'MSG_STATUS', 
		'addElement' => array (
			'type' => 'static'
			),
		'nbArgsRule' => 0
		),
array (
		'name' => 'RETURN_STATUS',
		'addElement' => array (
			'type' => 'hidden' 
			),
		'nbArgsRule' => 0
		),
array (
			'name' => 'ID_NAV',
			'addElement' => array(
			'type' => 'hidden'
			),
		'nbArgsRule' => 0
		)
// @@@@FK_SET_INITFORM_INSERT_BEGINS_HERE@@@@

// @@@@FK_SET_INITFORM_INSERT_ENDS_HERE@@@@

	),
//GroupLinks
'Links' => array(
	
	),
// Boutons submit etc ... 
'Buttons' => array (
	)

);
?>
