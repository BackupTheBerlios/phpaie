<?php
/**
 * @package    phpaie
 * @subpackage project/config
 * @version    
 * @author     Pierre Raoul
 * @copyright  2004 Phpaie
 * @link       http://www.phpaie.net
 * @licence    http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
 */

/**
 *
 * Manage the Framework's parametres needed by Copix
 * To be used when Coordination object not yet created 
 */
class ProjectConfig extends CopixConfig
{

    /**
     * Get the instance
     *
     */
    function & instance() {
        if (! isSet($GLOBALS['COPIX']) )
            $GLOBALS['COPIX'] = array();
        if (! isSet($GLOBALS['COPIX']['CONFIG']) )
            $GLOBALS['COPIX']['CONFIG'] = & CopixConfig::instance();
        if (! isSet($GLOBALS['COPIX']['CONFIG']->compile_resource) )
            $GLOBALS['COPIX']['CONFIG']->compile_resource = null;
        return $GLOBALS['COPIX']['CONFIG'];
    }

}
?>
