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
?>
<?php
print <input type=\"text\" name=\"handle\" size=\"15\" maxlength=\"15\" style=\"width:150px;height:20px;\" VALUE=\"\">;
?>
<?php
print <input type=\"password\" name=\"passwd\" size=\"15\" maxlength=\"15\" style=\"width:150px;height:20px;\" VALUE=\"\">;
?>

<?php 
// $id_name = $this->getIdName(); //HTMSET.pl 498
print "<input type=\"hidden\" name=\"RETURN_STATUS\" VALUE=\"" .(isset($vars['RETURN_STATUS'])  ? $vars['RETURN_STATUS'] : "") ."\">\n";
print "<input  type=\"hidden\" name=\"$id_name\" readonly=\"readonly\" VALUE=\"" .(isset($vars[$id_name])  ? $vars[$id_name] : "") ."\">\n";
?> 

<!-- @@@@FK_SET_PHP_INSERT_BEGINS_HERE@@@@ -->
<!-- @@@@FK_SET_PHP_INSERT_ENDS_HERE@@@@ -->
<?php print $this->message_status; ?>
