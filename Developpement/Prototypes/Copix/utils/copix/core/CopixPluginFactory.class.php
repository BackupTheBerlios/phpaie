<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixPluginFactory.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * fabrique de plugin
 * permet au coordinateur de gérer les plugins
 * @package	copix
 * @subpackage core
 */
class CopixPluginFactory {
   /**
   * instanciation d'un objet plugin.
   * instancie également l'objet de configuration associé
   * @param	string	$name	nom du plugin
   * @return	CopixPlugin		le plugin instancié
   */
   function & create ($name){
      require_once (COPIX_CORE_PATH .'CopixPlugin.class.php');
    	$fic= new CopixModuleFileSelector($name);
      $nom=strtolower($fic->fileName);
      $path= $fic->getPath(COPIX_PLUGINS_DIR) .$nom.'/'.$nom;
		$path_plugin= $path.'.plugin.php';
		$path_config= $path.'.plugin.conf.php';

      if (is_file ($path_plugin) && is_file ($path_config)){
         require_once ($path_config);
         require_once ($path_plugin);

         $classname = 'PluginConfig'.$fic->fileName;//nom de la classe de configuration.
         $config    = & new $classname ();//en deux étapes, impossible de mettre la ligne dans les paramètres du constructeur.

         $name     = 'Plugin'.$fic->fileName;
         $toReturn = & new $name ($config);//nouvel objet plugin, on lui passe en paramètre son objet de configuration.

         return $toReturn;//retour du plugin instancié.
      } else {
         trigger_error(CopixI18N::get ('copix:copix.error.unfounded.plugin',$name), E_USER_ERROR);
      }
   }

   /**
   * retourne la liste des plugins trouvés dans le répertoire des plugins.
   * @return array	la liste des plugins
   */
   function getPluginList (){
      $toReturn = array ();
      $rep=opendir(COPIX_PLUGINS_PATH);//open the plugin path
      if (!$rep){
         return null;
      }
      //throw the files.
      while ($file = readdir($rep)) {
      	if($file != '..' && $file !='.' && $file !=''){
      		if (is_file(COPIX_PLUGINS_PATH.$file) && !is_dir (COPIX_PLUGINS_PATH.$file)){
               $toReturn[] = $file;
      		}
      	}
      }
      //close&go
      closedir($rep);
      clearstatcache();
      return $toReturn;
   }
}
?>
