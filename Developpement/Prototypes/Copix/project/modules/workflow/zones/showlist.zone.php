<?php
/**
 * zone ZoneShowList
 */
/* If you want, you can give only the class name: all the records will be listed
 * BUT it's not a good idea: all the data manipulation must stay in actiongroup instance
 */  
class ZoneShowList extends CopixZone {

    function _createContent (&$toReturn) {

    	// class name of the list objects
        if ( ! isSet($this->params['list']) ) $_list = array();  
        else $_list = $this->params['list'];
        if ( ! isSet($this->params['tagged']) ) $_tagged = array();
        else $_tagged = $this->params['tagged'];

        $_template = & new ProjectTpl();
        $_template->assign('DATA_LIST'   , $this->params['dataList']);
        $_template->assign('OBJECT_LIST' , $_list);
        $_template->assign('TAGGED'    , $_tagged);
        $_template->assign('REQUEST'     , $this->params['requestUrl']);
      
        // retour de la fonction :
        $toReturn = $_template->fetch('showList.tpl');
        return true;
    }
} 

?>