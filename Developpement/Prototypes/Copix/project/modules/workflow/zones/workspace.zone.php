<?php
/**
 * zone ZoneWorkspace
 */
class ZoneWorkspace extends CopixZone {

    function _createContent (&$toReturn) {

        $_template = & new CopixTpl();

        // retour de la fonction :
        $toReturn = $_template->fetch('workspace.tpl');
        return true;
    }
} 

?>