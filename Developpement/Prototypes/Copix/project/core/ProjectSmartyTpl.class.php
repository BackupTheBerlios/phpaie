<?php
/**
* @package      project
* @subpackage   core
* @version
* @author	Pierre Raoul
* @copyright    2004 Pierre Raoul
* @licence  http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

/**
 * Surcharge l'objet CopixSmartyTpl pour permettre de charger plusieurs chemins de plugins Smarty
 * @package     project
 * @subpackage  core
 */
class ProjectSmartyTpl extends CopixSmartyTpl {

    /**
     * Initialize the tplEngine with the right parameters.
     */
    function ProjectSmartyTpl (){
        CopixSmartyTpl::CopixSmartyTpl();

        // Add here pathes to other Smarty plugin directories:  
        // $this->plugins_dir[] =  COPIX_PROJECT_PATH.'smarty_plugins/';  
        $this->plugins_dir[] = PROJECT_SMARTY_PLUGIN_PATH;  
    }

}
?>
