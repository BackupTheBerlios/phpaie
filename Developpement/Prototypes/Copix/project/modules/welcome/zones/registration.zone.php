<?php
/**
 * zone ZoneRegistration
 */
class ZoneRegistration extends CopixZone {
    function _createContent (&$toReturn) {

        $_template = & new CopixTpl ();

        // retour de la fonction :
        $toReturn = $_template->fetch ('registration.tpl');
        return true;
    }
} 

?>