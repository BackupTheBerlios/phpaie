<?php
/**
* @package	project
* @subpackage   core
* @version	
* @author	Pierre Raoul
* @copyright    2004 Pierre Raoul
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * Adaptation du Moteur de template Copix par surcharge de CopixTpl
 * Permet d'ajouter des bibliothèques de plugins Smarty
 * @package    project
 * @subpackage core
 */
class ProjectTpl extends CopixTpl {

    var $pageTitle = null;
    var $titleBar  = null;

    /**
     * Constructor
     */
    function ProjectTpl ( $pageTitle = null, $titleBar = null ){
        // CopixTpl::CopixTpl(); // CopixTpl n'a pas de constructeur
        if ( $pageTitle !== null ) {
            $this->pageTitle = $pageTitle;
            $this->assign( 'PAGE_TITLE', $pageTitle);
        }
        if ( $titleBar !== null ) {
            $this->titleBar = $titleBar;
            $this->assign( 'TITLE_BAR', $titleBar);
        }
    }
    
    /**
     * 
     */
    function processZone ($name, $params=array ()){
   	$_controller = & ProjectCoordination::instance();
        return $_controller->processZone ($name, $params);
    }

    /**
     * Give the hand to Smarty
     * @param string  $tplName    nom du fichier template
     * @param string  $funcName   nom de la fonction
     */
    function smartyPass ($tplName, $funcName){
        //include the Project wrapper of Smarty object  
        include_once (COPIX_PROJECT_PATH.COPIX_CORE_DIR.'ProjectSmartyTpl.class.php');
        $_tpl = new ProjectSmartyTpl ();
        $_tpl->assign ($this->_vars);
        if ($funcName == 'fetch'){
            return $_tpl->fetch ('file:'.$this->templateFile);
        }
        else{
            $_tpl->display ('file:'.$this->templateFile);
        }
    }

}
?>
