<?php
/**
* @package   copix
* @subpackage core
* @version   $Id: CopixCoordination.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author   Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link      http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * sert au stockage des paramètres d'execution
 *
 * @package   copix
 * @subpackage core
 * @see CopixCoordination
 */
class CopixExecParam {
   /**
   * @var string    nom du module demandé
   */
   var $module = COPIX_DEFAULT_VALUE_MODULE;
   /**
   * @var string    nom de l'action demandée
   */
   var $action = COPIX_DEFAULT_VALUE_ACTION;
   /**
   * @var string    nom du fichier desc demandé
   */
   var $desc   = COPIX_DEFAULT_VALUE_DESC;
}

/**
 * Coordinateur de l'application.
 * C'est l'objet principal de Copix, qui coordonne toute la cinematique de l'application,
 * et met en oeuvre toutes les fonctionnalités de Copix.
 *
 * @package  copix
 * @subpackage core
 */
class CopixCoordination {

   /**
   * contient toutes les variables de $_GET et $_POST²
   * @var array
   * @access private
   */
   var $vars;

   /**
   * contient les paramètres d'execution
   * @var CopixExecParam
   */
   var $execParam;
   /**
   * chemin principal d'execution
   * @var  string
   */
   var $execPath;
   /**
   * liste des plugins utilisés
   * @var  array
   */
   var $plugins=array();
   /**
   * url courante
   * @var  CopixUrl
   */
   var $url;

   /**
   * It set many properties of the object, get all GET and POST parameters, and start session.
   * @param   string  $configFile     chemin du fichier de configuration du projet
   */
   function CopixCoordination ($configFile){
      //the very first.
      $old_error_handler = set_error_handler('CopixErrorHandler');

      $this->url = & new CopixUrl($_SERVER['PHP_SELF'], $_GET);
      $this->vars = array_merge($_POST, $_GET);

      // register itself in the global variable.
      $GLOBALS['COPIX']['COORD'] = & $this;

      // creating CopixConfig Object and includes the asked configuration file.
      $GLOBALS['COPIX']['CONFIG'] = & CopixConfig::instance ();
      require ($configFile);

      // registering and creating plugins.
      foreach($GLOBALS['COPIX']['CONFIG']->plugins as $name){
         if ($plug = & CopixPluginFactory::create ($name)){
            $this->plugins[strtolower($name)] = & $plug;
         }
      }

      // do what we need for each plugin before starting the session
      $this->_beforeSessionStart ();
      session_start ();
   }

   /**
   * inclusion des définitions des objets destinés à être stockés en session
   * et traitement à faire avant le démarrage de la session. De base, invoque
   *   les methodes correspondantes des plugins.
   *
   * Dans cette fonction, il sera nécessaire de mettre les "include" des objets
   *  que l'on souhaite mettre en session.
   * rappel: en Php (4.0), pour qu'un objet puisse être stocké en session,
   *  il faut qu'il soit connu avant l'appel a session_start.
   * Cette fonction est destinée à être surchargée.
   * @access private
   */
   function _beforeSessionStart (){
      $this->_callPluginsMethod('beforeSessionStart');
   }

   /**
   * Fonction principale du coordinateur à appeler dans le index.php pour démarrer le framework.
   * gère la cinématique globale du fonctionnement du site.
   * @access public
   * @todo intégration d'une fonction _beforeProceed() appelée avant _doAction().
   */
   function process (){
      //Choix des couples actions pour la tache a réaliser.
      $execParams = & $this->_extractExecParam ();//trio desc, action, module

      CopixContext::push ($execParams->module);
      $action = $this->_convertExecParamsToAction ($execParams);//Action demandée.

      CopixContext::clear ();
      $this->_callPluginsMethodWithParam('beforeProcess', $action);

      CopixContext::push ($action->file->module);

      //Traitement de l'objet reçu.
      $this->_doAction ($action);
   }

   /**
   * Instancie l'objet ActionGroup correspondant au CopixAction, et éxecute la methode adéquate.
   *
   * @param CopixAction $ObjAction décrivant la classe ActionGroup et la méthode à utiliser
   * @todo  contrôler le fontionnement avec un type File, puis prévoir les fichiers inexistants.
   * @see CopixAction
   * @see CopixActionGroup
   * @see CopixActionReturn
   * @access private
   */
   function _doAction ($action) {
      //action en fonction du type de la demande.
      if ($action->type === COPIX_ACTION_TYPE_OBJ
          || $action->type === COPIX_ACTION_TYPE_MODULE){

         //recherche le fichier correspondant à l'objet ActionGroup à utiliser.
         if ($action->file->module === null){
            $action->file->module = CopixContext::get ();
         }
         $execPath = $action->file->getPath();
         $nomFichier = $execPath.COPIX_ACTIONGROUP_DIR.strtolower ($action->file->fileName).COPIX_ACTIONGROUP_EXT;

         if (is_readable ($nomFichier)){
            require_once ($nomFichier);
         }else{
            trigger_error(CopixI18N::get('copix:copix.error.load.actiongroup',$action->file->fileName), E_USER_ERROR);
            return;
         }

         //Nom des objets/méthodes à utiliser.
         $objName = COPIX_ACTIONGROUP_CLASSNAME.$action->file->fileName;
         $methName = $action->useMeth;

         //instance de l'objet, qui s'enregistre dans GLOBALS['COPIX']['ACTIONGROUP']
         $obj = & new $objName ();
         //Exécution du traitement.
         $this->_processResult ($obj->$methName ());
      }elseif ($action->type === COPIX_ACTION_TYPE_FILE){
         //demande d'inclusion d'un fichier "extérieur" au framework.
         //UTILISER UNIQUEMENT EN CAS DE NECESSITE BIEN PARTICULIERE ET EXCEPTIONNELLE.
         //inclusion du fichier.
         require_once ($action->useFile);
      }elseif ($action->type === COPIX_ACTION_TYPE_REDIRECT){
         //redirection automatique.
         $this->_processResult (new CopixActionReturn (COPIX_AR_REDIRECT, $action->url));
      }elseif ($action->type === COPIX_ACTION_TYPE_STATIC){
         //page statiques.
         $this->_processResult (new CopixActionReturn (COPIX_AR_STATIC, $action->useFile, $action->more));
      }elseif ($action->type === COPIX_ACTION_TYPE_ZONE){
         //implémenter l'action zone.
         $tpl = & new CopixTpl ();
         $tpl->assign ('TITLE_PAGE', $action->titlePage);
         $tpl->assign ('TITLE_BAR',  $action->titleBar);
         $tpl->assign ('MAIN', CopixZone::process ($action->zoneId, $action->zoneParams));
         $this->_processResult (new CopixActionReturn (COPIX_AR_DISPLAY, $tpl));
      }
    }

    /**
    * Agit selon le résultat de l'execution de l'action de la méthode de l'objet ActionGroup
    * Methode qui va effectuer un affichage de template, une redirection etc... en fonction
    * du code indiqué par le CopixActionReturn.
    * @param CopixActionReturn      $ToProcess   indique le type de resultat
    * @see CopixActionGroup
    * @todo rajouter une sorte de "Fin de traitement" _DoEnd / _DoFirst
     * @access private
    */
    function _processResult ($toProcess){
      switch ($toProcess->code){
            case COPIX_AR_ERROR:
            //erreur
               $tpl = new CopixTpl();
               $tpl->assign('message', $toProcess->data);
               $tpl->display ($this->moduleDir.COPIX_TEMPLATE_PATH.'error.tpl');
               break;

            case COPIX_AR_DISPLAY:
            //affichage classique, dans le template principal.
                $this->_processStandard ($toProcess->data);//appel de la méthode de préparation de la page standard.
                $this->_doHTMLHeaders ($toProcess->data);
                //Par ex, bandeaux de pub, menus dynamiques, ... (propres aux projets.)
                CopixContext::clear ();

                $toProcess->data->display ($GLOBALS['COPIX']['CONFIG']->mainTemplate);
                break;

            case COPIX_AR_DISPLAY_IN:
                //affichage spécifique, dans un template indiqué.
                $this->_processStandard ($toProcess->data);//appel de la méthode de préparation de la page standard.
                $this->_doHTMLHeaders ($toProcess->data);

                //Par ex, bandeaux de pub, menus dynamiques, ... (propres aux projets.)
                $toProcess->data->display ($toProcess->more);
                break;

            case COPIX_AR_REDIRECT:
            //redirection standard, message http.
                header ('location: '.$toProcess->data);
                break;
            
            case COPIX_AR_STATIC :
                   $tpl = & new CopixTpl ();
                   $tpl->assign ('MAIN', $this->includeStatic ($toProcess->data));
                   $this->_processStandard ($tpl);
                   $this->_doHTMLHeaders ($tpl);
                   $waitForMore = array ('TITLE_PAGE', 'TITLE_BAR');
                   foreach ($waitForMore as $key){
                      if (isset ($toProcess->more[$key])){
                         $tpl->assign ($key, $toProcess->more[$key]);
                      }
                   }
                   //Affichage dans le template principal.
                   CopixContext::clear ();
                   $tpl->display ($GLOBALS['COPIX']['CONFIG']->mainTemplate);
                break;

            case COPIX_AR_DOWNLOAD:
               $fileName = $toProcess->data;
               if (is_readable ($fileName) && is_file ($fileName)){
                  //quick and dirty..... still.
                  if (strlen (trim ($toProcess->more))){
                     $fileNameOnly = $toProcess->more;
                  }else{
                     $fileNameOnly = explode ('/', str_replace ('\\', '/', $fileName));
                     $fileNameOnly = $fileNameOnly[count ($fileNameOnly)-1];
                  }

                  header("Content-Type: application/forcedownload");
                  header("Content-Disposition: attachment; filename=".$fileNameOnly);
                  header("Content-Description: File Transfert");
                  header("Content-Transfer-Encoding: binary");
                  header("Pragma: no-cache");
                  header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
                  header("Expires: 0");
                  header("Content-Length: ".filesize ($fileName));
                  flush();
                  readfile ($fileName);
               }
               break;

            case COPIX_AR_BINARY:
               $fileName = $toProcess->data;
               //echo $fileName;
               if (is_readable ($fileName) && is_file ($fileName)){
                  header("Content-Type: ".$toProcess->more);
                  header("Content-Length: ".filesize ($fileName));
                  flush();
                  readfile ($fileName);
               }
               break;

            case COPIX_AR_NONE:
               break;

            default:
               break;
       }

       //appel les plugins de post-processing.
      $this->_callPluginsMethodWithParam('afterProcess', $toProcess);
    }

   /**
   *Destinée à être surchargée, cette méthode est censée préparer les éléments
   * standards à la page du projet.
   * @access protected
   */
   function _processStandard (&$tplObject){
   }

   /**
   * Demande à CopixHTMLHeader de renseigner la variable HTML_HEAD
   */
   function _doHTMLHeaders (&$tplObject){
      $tplObject->assign ('HTML_HEAD', CopixHTMLHeader::get ());
   }

   /**
   * Détermine ce qui représente la partie critique de l'url qui identifie le code fonction à utiliser.
   * Instancie un objet CopixExecParam et définit ses propriétées selon les parametres de la page
   *
   * @access private
   * @return CopixExecParam    les parametres d'execution à utiliser.
   */
   function & _extractExecParam (){
      $execParam = & new CopixExecParam ();

      //module.
      if (isset ($this->vars[COPIX_NAME_CODE_MODULE])
           && (strlen (trim ($this->vars[COPIX_NAME_CODE_MODULE])) > 0)){
         $execParam->module = $this->_safeFilePath ($this->vars[COPIX_NAME_CODE_MODULE]);
      }
      //desc file.
      if ((isset ($this->vars[COPIX_NAME_CODE_DESC]))
           && (strlen (trim ($this->vars[COPIX_NAME_CODE_DESC])) > 0)){
         $execParam->desc = $this->_safeFilePath ($this->vars[COPIX_NAME_CODE_DESC]);
      }
      //action.
      if (isset ($this->vars[COPIX_NAME_CODE_ACTION]) 
           && (strlen (trim ($this->vars[COPIX_NAME_CODE_ACTION])) > 0)){
         $execParam->action = $this->vars[COPIX_NAME_CODE_ACTION];
      }

     if($GLOBALS['COPIX']['CONFIG']->checkTrustedModules && $execParam->module != ''){
         $a = isset($GLOBALS['COPIX']['CONFIG']->trustedModules[$execParam->module]);

         if(!$a ||( $a && !$GLOBALS['COPIX']['CONFIG']->trustedModules[$execParam->module]))
            trigger_error(CopixI18N::get('copix:copix.error.module.untrusted',$execParam->module), E_USER_ERROR);
      }


      return $execParam;
   }

   /**
   * recupere le descripteur de page CopixAction grace aux parametres d'execution.
   *
   * La fonction cherche le fichier de description correpondant au code fonctionnalité.
   * retourne ensuite le CopixAction correpondant.
   * CopixAction décrit un couple ActionGroup et une de ses méthodes.
   * On utilise un fichier de description pour des raisons de sécurité (impossibilité de saisir un code inexistant)
   * et pour des raisons de modularité (exemple du versionning)
   *
   * @access private
   * @param  CopixExecParam $param  objet contenant le nom du module, de l'action à executer, du fichier desc à utiliser
   * @return CopixAction  descripteur ActionGroup / méthode.
   */
   function _convertExecParamsToAction ($param){
      //détermine le chemin d'exécution.
      $path = $param->module === null ? COPIX_PROJECT_PATH : COPIX_MODULE_PATH . $param->module .'/';
      $fileToRead = $path . COPIX_DESC_DIR . strtolower ($param->desc) . COPIX_DESC_EXT;

      // verification de l'existence du fichier
      if(!file_exists($fileToRead)){
         if(!file_exists($path))
            trigger_error(CopixI18N::get('copix:copix.error.load.module',$param->module), E_USER_ERROR);
         else
            trigger_error(CopixI18N::get('copix:copix.error.load.desc',$param->desc), E_USER_ERROR);
      }
      include ($fileToRead); //LAISSER INCLUDE (PAS ONCE). Php n'arrive pas a rafraichir sans cela.
      //Dans l'idée: inclusion une première fois, les variables sont connues de la fonction.
      //La deuxième fois, ne réinclus pas le fichier, et du coups les variables sont connues mais comme globales.

      // on verifie si la variable correspondante à l'action existe
      if (!isset (${$param->action})){
        trigger_error(CopixI18N::get ('copix:copix.error.unfounded.action',$param->action), E_USER_ERROR);
      }

      $this->execParam = $param;
      return ${$param->action};
   }

    /**
    * Appel les méthodes de plugin.
     * @access private
     * @param   string  $method nom de la méthode à appeler dans chaque plugin
    */
    function _callPluginsMethod($method){
       foreach($this->plugins as $name => $obj){
          $this->plugins[$name]->$method ();
       }
    }

    /**
    * Appel les méthodes paramétrées des plugins.
     * @access private
     * @param   string  $method nom de la méthode à appeler dans chaque plugin
     * @param   CopixExecParam
    */
    function _callPluginsMethodWithParam($method, &$param){
       foreach($this->plugins as $name => $obj){
          $this->plugins[$name]->$method ($param);
       }
    }

   /**
   * permet à un traitement exterieur (page, zone) de recuperer un element de configuration d'un plugin
   * @param string   $plugin_name   nom du plugin
   * @param string   $plugin_parameter_name   nom de la propriete de l'objet de configuration du plugin
   */
   function getPluginConf($pluginName , $plugin_parameter_name){
      $pluginName=strtolower($pluginName);
      if(isset($this->plugins[$pluginName])){
         if(isset($this->plugins[$pluginName]->config->$plugin_parameter_name))
            return $this->plugins[$pluginName]->config->$plugin_parameter_name;
      }
      return null;
   }

   /**
   * gets a given plugin if registered
   * @param string   $plugin_name   nom du plugin
   */
   function & getPlugin ($pluginName){
      $pluginName=strtolower($pluginName);
      if (isset ($this->plugins[$pluginName])){
         return $this->plugins[$pluginName];
      }else{
         return null;
      }
      //The following line DOES NOT work, so keep the actual code.
      //      return isset ($this->plugins[$pluginName]) ? $this->plugins[$pluginName] : null;
   }

   /**
   * creates a filePath from a given string module|file and from the given
   * type of the file (zone, template, static)
   * @param    string  $fileId     "nom de fichier" ou "nom de module|nom de fichier"
   * @param    string  $subDir     nom de répertoire relatif (en principe une des valeur COPIX_xxx_DIR definie dans project.inc.php)
   * @param    string  $extension
   * @return   string  chemin du fichier indiqué ou false si inconnu
   */
   function extractFilePath ($fileId, $subDir , $extension = '') {
      $fileInfo = & CopixSelectorFactory::create ($fileId);
      $fileName = $fileInfo->fileName;

      if($extension != ''){
         $fileName = strtolower($fileName).$extension;
      }

      $moduleFile = $fileInfo ->getPath($subDir) . $fileName;
      $projectOverloadedFilePath = $fileInfo->getOverloadedPath($subDir);

      if($projectOverloadedFilePath !== null){
         $projectOverloadedFilePath.=$fileName;
         if(is_readable($projectOverloadedFilePath))
            return $projectOverloadedFilePath;
      }

        if(is_readable($moduleFile)){
         return $moduleFile;
      }else{
         return false;
         //trigger_error (CopixI18N::get ('copix:copix.error.resolve',$fileId), E_USER_ERROR);         return null;
      }
   }

   /**
   * Creation d'un objet zone et appel de sa méthode process.
   * @param string $name le nom de la zone a instancier.
   * @param array   $params un tableau a passer a la fonction processZone de l'objet zone.
   */
   function processZone ($name, $params=array ()){
      //Récupération des éléments critiques.
      $fileInfo = & new CopixModuleFileSelector($name);

      CopixContext::push ($fileInfo->module);

      //Récupère le nom du fichier en fonction du module courant.
      $fileName = $fileInfo->getPath(COPIX_ZONES_DIR). strtolower($fileInfo->fileName) . COPIX_ZONE_EXT;

      if (!is_readable ($fileName)){
         trigger_error (CopixI18N::get('copix:copix.error.load.zone',$fileInfo->fileName), E_USER_ERROR);
      }

      //inclusion du fichier.
      require_once($fileName);
      $objName = COPIX_ZONE_CLASSNAME.$fileInfo->fileName;
      $objTraitement = & new $objName ();

      $toReturn = $objTraitement->processZone ($params);
      CopixContext::pop ();

      return $toReturn;
    }

   /**
   * Include a static file.
   *
   * we're gonna parse the file for a | (pipe), if founded, we're gonna
   *   include the static file from the module path.
   *  Else, we'll include the file considering the project path
   * @param    string $idOfFile le nom formaté du fichier
   */
   function includeStatic ($idOfFile){
       //Récupération des éléments critiques.
      $fileInfo = new CopixModuleFileSelector($idOfFile);

      //makes the fileName.
      $fileName = $fileInfo->getPath(COPIX_STATIC_DIR). $fileInfo->fileName;

      //test & go.
      if (is_readable ($fileName)){
         ob_start ();
         readfile ($fileName);
         $toShow = ob_get_contents();
         ob_end_clean();
         return $toShow;
      }else{
         trigger_error (CopixI18N::get ('copix:copix.error.unfounded.static',$fileName), E_USER_ERROR);
      }
   }

    /**
    * Deletes special characters that could be considered as tricky whith
    *    action descriptions
    * @param    string  $path   chemin à traité
    * @return   string  chemin nettoyé des caractères interdits
    * @access private
    */
    function _safeFilePath ($path){
       return str_replace (array ('.', ';', '/', '\\', '>', '-', '[', ']', '(', ')'), '', $path);
    }

    /**
    * calls a the method methodName of a plugin named pluginName, with the given
    *    parameters.
    * This can be used to call plugin methods wich we are not sure they are
    *   registered eg: stats, debug, ...
    * @param string $pluginName the name of the plugin we wants to call the method from
    * @param string $methodName the name of the method we're gonna call
    * @param array $params associative array of the parameters we're gonna pass to the plugin method.
    * @return mixed value returned by plugin method
    */
    //@param boolean $notRegitered given buy ref, is set to true only if the plugin method was not founded.
    function & callPluginMethod ($pluginName, $methodName, $params=array()){ //, & $notRegistered){
       $plugin = & $this->getPlugin($pluginName);
       if ($plugin === null){
          return null;
       }
       if (!method_exists($plugin, $methodName)){
          return null;
       }

       // we don't use call_user_method_array or call_user_func_array, because
       // this function don't return value by reference... It can be a problem for method
       // of plugin which return value by ref..
       extract($params);
       $phpCodeCall = '$result = & $plugin->'.$methodName.'('.implode (',', array_keys ($params)).');';
       eval ($phpCodeCall);
       return $result;
    }
}
?>
