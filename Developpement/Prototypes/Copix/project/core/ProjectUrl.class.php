<?php
/**
 * @package      project
 * @subpackage   core
 * @version
 * @author       Pierre Raoul
 * @copyright    2004 Pierre Raoul
 * @link         http://www.phpaie.net
 * @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
 */
/**
 * @todo 
 *     1/la création de la partie paramètres d'un URL est traité 2 fois dans
 *       Copix : CopixUrl::getUrl et fonction CopixUtils.lib.php/urlParams
 *       Cette seconde est utilisée au moins 2 fois dans le code de Copix
 *       Ne conserver que la classe CopixUrl ?
 *     2/prendre en comptre les tableaux en paramètre
 */


/**
 * Objet        url for request send to project's controller
 * @package     project
 * @subpackage  core
 */
class ProjectUrl extends CopixUrl {

    /**
     * ctor
     * @param    string  $action       Action name
     * @param    string  $description  Description name
     * @param    string  $module       Module name
     * @param    array   $params       specific parametres
     */
    function ProjectUrl( $action = null
                       , $description = null
                       , $module = null
                       , $params = array()
                       ){
            $_url = COPIX_NAME_CODE_ENTRY;
        CopixUrl::CopixUrl($_url, $params );
        if ($action !== null)      $this->setAction($action);
        if ($description !== null) $this->setDescription($description);
        if ($module !== null)      $this->setModule($module);
    }

    /**
     * set action parametre
     * @param    string    $value    parametre's value
     */
    function setAction($value = null){
        if ( $value === null ) $this->del(COPIX_NAME_CODE_ACTION);
        else $this->set(COPIX_NAME_CODE_ACTION, $value);
    }

    /**
     * set description parametre
     * @param    string    $value    parametre's value
     */
    function setDescription($value = null){
        if ( $value === null ) $this->del(COPIX_NAME_CODE_DESC);
        else $this->set(COPIX_NAME_CODE_DESC, $value);
    }

    /**
     * set module parametre
     * @param    string    $value    parametre's value
     */
    function setModule($value = null){
        if ( $value === null ) $this->del(COPIX_NAME_CODE_MODULE);
        else $this->set(COPIX_NAME_CODE_MODULE, $value);
    }
}
?>
