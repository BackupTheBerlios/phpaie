<?php
/**
 * zone ZoneLegalNotice
 */
class ZoneLegalNotice extends CopixZone {
    function _createContent (&$toReturn) {

        $_controller = & ProjectCoordination::instance();

        $_template = & new CopixTpl ();
        $_controller->getStandardTemplateData($_template); // TODO : créer une classe dérivée de CopixTpl le faisant en auto

        // retour de la fonction :
        $toReturn = $_template->fetch ('legalNotice.tpl');
        return true;
    }
} 

?>