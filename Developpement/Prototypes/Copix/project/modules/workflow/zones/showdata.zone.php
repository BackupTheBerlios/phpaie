<?php
/**
 * zone ZoneShowData
 */
class ZoneShowData extends CopixZone {

    function _createContent (&$toReturn) {

    	// class name of the entity
        if ( !isSet($this->params['entity']) ) return false; 
        
        $_template = & new ProjectTpl();
        $_template->assign('ENTITY'      , $this->params['entity']);
        $_template->assign('DATA_LIST'   , $this->params['dataList']);
        $_template->assign('REQUEST'     , $this->params['requestUrl']);
      
        // retour de la fonction :
        $toReturn = $_template->fetch('showData.tpl');
        return true;
    }
} 

?>