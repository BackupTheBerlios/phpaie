<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixTpl.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
* @todo Use I18N resources.
*/

/**
 * Moteur de template générique
 * Offre une couche d'abstraction pour la manipulation de moteur de templates
 * Supporte les templates PHP (*.ptpl) et Smarty (*.tpl)
 * @package	copix
 * @subpackage core
 */
class CopixTpl {
   /**
   * Tableau associatif des variables déja assignées au template
   * @var   array
   */
   var $_vars = array ();

  /**
   * fichier du template
   * @var string
   */
   var $templateFile;

   /**
   * Assignation d'une variable au conteneur.
   * @param string  $varName    nom de la variable
   * @param mixed   $varValue   valeur de la variable
   */
   function assign ($varName, $varValue){
      $this->_vars[$varName] = $varValue;
   }
   /**
   * regarde si la variable est assignée ou non.
   * @param string  $varName    nom de la variable
   * @return    boolean indique si variable assignée ou non
   */
   function isAssigned ($varName){
      return isset ($this->_vars[$varName]);
   }

   /**
   * retourne la donnée assignée (si elle existe)
   * @param string  $varName    nom de la variable
   * @return    mixed   valeur de la variable ou null si inexistante
   */
   function & getAssigned ($varName){
      if ($this->isAssigned ($varName)){
         return $this->_vars[$varName];
      }else{
         return null;
      }
   }

   /**
   * Affiche à l'écran la sortie du template.
   * @param string $tplName	nom du fichier template
   */
   function display ($tplName){
      if(count($GLOBALS['COPIX']['CONFIG']->tpl_sub_dirs) == 0){
         $this->templateFile = $GLOBALS['COPIX']['COORD']->extractFilePath ($tplName, COPIX_TEMPLATES_DIR);
         if(!$this->templateFile)
            trigger_error (CopixI18N::get('copix:copix.error.unfounded.template',$tplName), E_USER_ERROR);
      }else{
         $dir=COPIX_TEMPLATES_DIR.implode('/',$GLOBALS['COPIX']['CONFIG']->tpl_sub_dirs).'/';

         $this->templateFile = $GLOBALS['COPIX']['COORD']->extractFilePath ($tplName, $dir);
         if (!$this->templateFile){
            $dir=COPIX_TEMPLATES_DIR;
            $this->templateFile = $GLOBALS['COPIX']['COORD']->extractFilePath ($tplName, $dir);
            if(!$this->templateFile)
               trigger_error (CopixI18N::get('copix:copix.error.unfounded.template',$tplName), E_USER_ERROR);
         }
      }

      if ($this->isSmarty ($this->templateFile)){
         $this->smartyPass ($this->templateFile, 'display');
      }else{
         //déclare les variables locales pour le template.
         extract ($this->_vars);
         include ($this->templateFile);
      }
   }

   /**
   * retourne les données du template
   * @param string $tplName	nom du fichier template
   * @return    string  contenu resultat du template parsé
   */
   function fetch ($tplName){
      if(count($GLOBALS['COPIX']['CONFIG']->tpl_sub_dirs) == 0){
         $this->templateFile = $GLOBALS['COPIX']['COORD']->extractFilePath ($tplName, COPIX_TEMPLATES_DIR);
         if(!$this->templateFile)
            trigger_error (CopixI18N::get('copix:copix.error.unfounded.template',$tplName), E_USER_ERROR);
      }else{
         $dir=COPIX_TEMPLATES_DIR.implode('/',$GLOBALS['COPIX']['CONFIG']->tpl_sub_dirs).'/';

         $this->templateFile = $GLOBALS['COPIX']['COORD']->extractFilePath ($tplName, $dir);
         if (!$this->templateFile){
            $dir=COPIX_TEMPLATES_DIR;
            $this->templateFile = $GLOBALS['COPIX']['COORD']->extractFilePath ($tplName, $dir);
            if(!$this->templateFile)
               trigger_error (CopixI18N::get('copix:copix.error.unfounded.template',$tplName), E_USER_ERROR);
         }
      }
      if ($this->isSmarty ($this->templateFile)){
         return $this->smartyPass ($this->templateFile, 'fetch');
      }

      //déclare les variables locales pour le template.
      extract ($this->_vars);
      ob_start ();
      include ($this->templateFile);
      $toReturn = ob_get_contents();
      ob_end_clean();
      return $toReturn;
   }

   /**
   * passage du traitement à smarty.... (après inclusion si nécessaire.)
   * @param string  $tplName    nom du fichier template
   * @param string  $funcName   nom de la fonction
   */
   function smartyPass ($tplName, $funcName){
      //inclusion de l'objet Smarty Aston.
      include_once (COPIX_CORE_PATH.'CopixSmartyTpl.class.php');//inclusion d'un smarty
                   //paramétré pour Copix.
      $tpl = new CopixSmartyTpl ();
      $tpl->assign ($this->_vars);
      if ($funcName == 'fetch'){
         return $tpl->fetch ('file:'.$this->templateFile);
      }else{
			$tpl->display ('file:'.$this->templateFile);
      }
   }

   /**
   * regarde si le template appartient à smarty...
   *
   * Globalement si le fichier porte l'extention .tpl
   *   si .ptpl, c'est un template copix
   * @param string  $tplName    nom du template
   * @return    boolean indique si template smarty
   */
   function isSmarty ($tplName){
      return (substr ($tplName, -4) == '.tpl');
   }

   /**
   * récupère la liste des variable déja assignées.
   * @return    array   liste
   */
   function & getTemplateVars (){
      return $this->_vars;
   }
}
?>
