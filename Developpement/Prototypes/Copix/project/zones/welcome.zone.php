<?php
/**
 * zone ZoneWelcome
 */
class ZoneWelcome extends CopixZone {
    function _createContent(&$toReturn) {

        $_template = & new CopixTpl();
        $_controller = & ProjectCoordination::instance();
        $_controller->getStandardTemplateData($_template);

        // retour de la fonction :
        $toReturn = $_template->fetch('welcome.tpl');
        return true;
    }
} 

?>