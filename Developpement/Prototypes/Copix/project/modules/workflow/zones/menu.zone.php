<?php

/**
 * zone ZoneMenu
 */
class ZoneMenu extends CopixZone {

    function _createContent (&$toReturn) {
    	
    	$_returnUrl = new ProjectUrl('showBranchList', null, 'workflow');

        $_menu[] = array( 'label'  => CopixI18N::get ('|views.menu.branches') 
                            , 'action' => $_returnUrl->getUrl()
                            );
    	$_returnUrl->setAction('showWorkerList');
        $_menu[] = array( 'label'  => CopixI18N::get ('|views.menu.workers') 
                            , 'action' => $_returnUrl->getUrl()
                            );
    	$_returnUrl->setAction('showContractList');
        $_menu[] = array( 'label'  => CopixI18N::get ('|views.menu.contracts') 
                            , 'action' => $_returnUrl->getUrl()
                            );
    	$_returnUrl->setAction('information');
    	$_returnUrl->setModule('welcome');
        $_menu[] = array( 'label'  => CopixI18N::get ('|views.menu.help') 
                            , 'action' => $_returnUrl->getUrl()
                            );

        $_template = & new CopixTpl();

        $_template->assign( 'MENU_LIST', $_menu );

        // retour de la fonction :
        $toReturn = $_template->fetch('menu.tpl');
        return true;
    }
} 

?>