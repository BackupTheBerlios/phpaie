<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixConfig.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
class CopixGroupConfig {
   var $group      = null;
   var $configVars = array ();

   /**
   * constructor.
   */
   function CopixGroupConfig ($name){
      $this->group = $name;
      $this->load ();
   }

   /**
   * loads the group (will choose xml / php cache)
   */
   function load (){
      $fileName = $this->_getCompiledFileName ();
      if (file_exists ($fileName) && is_readable ($fileName)){
         include ($fileName);
         $this->configVars = unserialize (stripslashes ($vars));//we assume vars is the varname of the compiled config variables.
      }else{
         $this->_loadXML ();
      }
   }

   function _getCompiledFileName (){
      return $GLOBALS['COPIX']['CONFIG']->compile_config_dir.str_replace (array ('|', ':'), array ('_M_', '_K_'), $this->group);
   }

   /**
   * gets a value from the config file (the current group)
   */
   function get ($id){
      if (isset ($this->configVars[$id])){
         return $this->configVars[$id]['Value'];
      }else{
         trigger_error ('unknow variable '.$id);
      }
   }
   
   /**
   * check if the given param exists.
   */
   function exists ($id){
      return isset ($this->configVars[$id]);
   }
   
   /**
   * gets the list of known params.
   */
   function getParams (){
      return $this->configVars;
   }

   /**
   * saves the value for id, will compile if different from the actual value.
   */
   function set ($id, $value){
      if (isset ($this->configVars[$id])){
         $this->configVars[$id]['Value'] = $value;
         $this->_compile ();
      }else{
         trigger_error ('unknow variable '.$id.' not set.');
      }
   }

   /**
   * compile to the hard drive.
   */
   function _compile (){
      $compileString = '<?php $vars=\''.addslashes (serialize ($this->configVars)).'\'; ?>';
      require_once (COPIX_UTILS_PATH . 'CopixFileLocker.class.php');
      $objectWriter = & new CopixFileLocker ();
      $objectWriter->write ($this->_getCompiledFileName (), $compileString, 'w');
   }

   /**
   * load from xml
   */
   function _loadXML (){
      require_once (COPIX_UTILS_PATH . 'CopixSimpleXml.class.php');

      $select = & CopixSelectorFactory::create ($this->group.'config.xml');
      if (!$select->isValid){
         trigger_error ('Invalid config file');
      }

      //checks if the file exists
      $fileName = $select->getPath (COPIX_CONFIG_DIR.'config.xml');
      if (! (file_exists ($fileName) && is_readable ($fileName))){
         return;
      }

      $this->configVars = array();
      $parser   = & new CopixSimpleXml();

      $xml = $parser->parseFile($fileName);
      foreach (is_array ($xml->PARAMETERS->PARAMETER) ? $xml->PARAMETERS->PARAMETER : array ($xml->PARAMETERS->PARAMETER) as $key=>$child){
         $attributes = $child->attributes ();
         //we stores in a key with the following format module|attributeName
         $this->configVars[$this->group.$attributes['NAME']] = array ('Name'=>$attributes['NAME'],'Caption'=>$attributes['CAPTION'],'Default'=>$attributes['DEFAULT'],'Value'=>$attributes['DEFAULT']);
      }
   }
}

/**
 * fichier de configuration principal du framework
 * definit une classe dont les propriétés representent tout les paramètres
 * du framework, avec leurs valeurs par défaut.
 * Pour indiquer des valeurs spécifiques, il faut le faire via le fichier
 * de configuration copix.conf.php
 * @package	copix
 * @subpackage core
 */

class CopixConfig {
   /* ========================================= paramètres généraux */

   /**
    * indique si le système d'autorisation des modules est activé
    * @var boolean
    */
   var $checkTrustedModules = false;

   /**
    * liste des modules autorisés
    * 'nom_du_module'=>true/false
    * @var array
    */
   var $trustedModules = array();


   /* ========================================= infos plugins */

   /**
   * tableau contenant les noms des plugins enregistrés.
   * array( 'nomplugin', 'nomplugin2', 'nomPlugin3', ...)
   * @var array
   */
   var $plugins = array ();

   /* ========================================= parametres traitement des erreurs  */

   /**
   * configuration du handler de message, lorsque le mode debuggage est actif
   * le tableau indique, pour chaque code erreur, les actions à effectuer
   * pour traiter les messages, et ce qu'il faut faire apres traitement du message
   * la valeur indiquant tout ça est une des constantes ERR_*, ou une combinaison
   * de celle-ci (ou logique entre les constantes) definit dans le constructeur
   * @var array
   */
   var $errorDebugOn = array();

   /**
   * configuration du handler de message, lorsque le mode debuggage est inactif definit dans le constructeur
   * @var array
   */
   var $errorDebugOff = array();

   /**
   * chaine des codes erreurs
   * @var array
   */
   var $errorCodeString = array ();

   /**
   * Action par défaut lorsque le code erreur n'existe pas
   * @var int
   */
   var $errorDefaultAction = ERR_MSG_ECHO_EXIT;

   /**
   * chaine de formatage pour l'enregistrement des messages
   * @var string
   */
   var $errorMessageFormat = "%date%\t[%code%]\t%msg%\t%file%\t%line%\n";

   /**
   * chaine de formatage pour l'affichage des messages
   * @var string
   */
   var $errorMessageFormatDisplay = "<p style=\"margin:0;\"><b>[%code%]</b> <span style=\"color:#FF0000\">%msg%</span> \t%file%\t%line%</p>\n";

   /**
   * fichier où sont stockées les erreurs si l'enregistrement est demandé
   * @var string
   */
   var $errorLogFile='cpx_error.log';

   /**
   * url de redirection quand une redirection est demandé et lorsque une erreur survient
   * @var string
   */
   var $errorRedirect='errors.php';

   /**
   * addresse email où envoyer un email d'avertissement lorsque une erreur survient
   * @var string
   */
   var $errorEmail='root@localhost';

   /**
   * entete du mail
   * @var string
   */
   var $errorEmailHeaders="From: webmaster@yoursite.com\nX-Mailer: Copix\nX-Priority: 1 (Highest)\n";


   /* =========================================  Paramétrage du cache */

   /**
   * Si la fonctionnalité de cache est autorisée
   * @var boolean
   * @see CopixCache
   */
   var $cacheEnabled = true;

   /**
   * Liste des autorisation de cache.
   * @var array
   * @see CopixCache
   */
   var $cacheTypeEnabled = array ();
   /**
   * Répertoires des différents types de cache.. terminer le nom par un / ou \
   * n'indiquer que le chemin relatif au chemin des caches définit dans la constante COPIX_CACHE_PATH
   * @var array
   * @see CopixCache
   */
   var $cacheTypeDir = array ();

   /**
    * type de cache par défaut
    */
   var $defaultCache = 'Default';
   /**
   * Utilisation d'un système de lock ?
   * @var boolean
   * @see CopixCache
   */
   var $useLockFile = true;

   /**
   * Automatic DAO
   */
   var $compile_dao_dir   = '';
   var $compile_dao_check = true;
   var $compile_dao_forced = true;


   /* =========================================  internationalisation */

   /**
    * code langage par defaut
    * @var string
    */
   var $default_language = 'fr';

   /**
    * code pays par defaut
    * @var string
    */
   var $default_country  = 'FR';

   /**
    * indique si on doit compiler les ressources ou pas
    * @var boolean
    */
   var $compile_resource = true;

   /**
    * reservé
    * @deprecated
    */
   var $compile_resource_check = false;
   /**
    * repertoire où sont stockés les ressources compilées
    * @var string
    */
   var $compile_resource_dir = '';

   /* =========================================  paramétrages du moteur de template */

   /**
   * chemin d'un sous repertoire à partir du repertoire de template
   * sous forme de liste de repertoire
   * est déstiné à être modifié dynamiquement par les plugins (d'internationalisation par exemple)
   */
   var $tpl_sub_dirs=array();

   /**
   * chemin vers les templates
   * @var string
   */
   var $template_dir   = '';

   /**
   * indique si mode debuggage
   * @var boolean
   */
   var $debugging      = false;

   /**
   * indique si le moteur de template doit verifier la compilation (smarty)
   * @var boolean
   */
   var $compile_check  = true;

   /**
   * indique si il faut toujours recompiler
   * @var boolean
   */
   var $force_compile  = false;

   /**
   * indique si il faut mettre en cache le resultat du template
   * @var int
   */
   var $caching        = 0;

   /**
   * chemin vers le repertoire de cache pour le moteur de template
   * @var string
   */
   var $cache_dir      = '';

   /**
   * chemin vers les templates compilés (smarty)
   * @var string
   */
   var $compile_dir    = '';
   
   /**
   * Doit on utiliser des sous répertoires pour la compilation des templates.
   * (Smarty uniquement)
   */
   var $use_sub_dirs   = true;

   /**
   * nom du fichier template principal
   * @var string
   */
   var $mainTemplate = 'main.ptpl';

   var $config_dir = './configs';

   //---------------------------------------------------------------
   //---------------------------------------------------------------
   //--End of config file.
   var $configGroups = array ();

   /**
   * @private
   */
   function CopixConfig(){
      $this->errorCodeString = array(
         E_ERROR         => 'ERREUR',
         E_WARNING       => 'WARNING',
         E_NOTICE        => 'NOTICE',
         E_USER_ERROR    => 'CPX_ERREUR',
         E_USER_WARNING  => 'CPX_WARNING',
         E_USER_NOTICE   => 'CPX_NOTICE'
      );

      $this->compile_resource_dir   = COPIX_CACHE_PATH.'resource_compile/';

      $this->template_dir   = COPIX_PROJECT_PATH.'templates/';
      $this->compile_dir    = COPIX_CACHE_PATH.'tpl_compile/';
      $this->cache_dir      = COPIX_CACHE_PATH.'tpl_cache/';
      $this->compile_dao_dir = COPIX_CACHE_PATH.'dao_compile/';

      $this->errorDebugOn = array (
         E_ERROR   		=> ERR_MSG_ECHO | ERR_ACT_EXIT,
         E_WARNING 		=> ERR_MSG_ECHO,
         E_NOTICE  		=> ERR_MSG_ECHO,
         E_USER_ERROR 	=> ERR_MSG_ECHO_EXIT,
         E_USER_WARNING => ERR_MSG_ECHO,
         E_USER_NOTICE 	=> ERR_MSG_ECHO
      );

      $this->errorDebugOff = array(
         E_ERROR   		=> ERR_MSG_ECHO_EXIT,
         E_WARNING 		=> ERR_MSG_ECHO,
         E_NOTICE  		=> ERR_MSG_NOTHING,
         E_USER_ERROR 	=> ERR_MSG_ECHO_EXIT,
         E_USER_WARNING => ERR_MSG_ECHO,
         E_USER_NOTICE 	=> ERR_MSG_NOTHING
      );
   }

   /**
   * enregistrement d'un plugin
   * @param string  $name   nom du plugin
   */
   function registerPlugin($name){
      if (!in_array ($name, $this->plugins)){
         $this->plugins[] = $name;
      }
   }

   /**
   * Singleton.
   */
   function & instance (){
      static $me = false;
      if ($me === false){
         $me = new CopixConfig ();
      }
      return $me;
   }

   /**
   * gets the value of a parameter
   * @param id - string [special:][module]|name
   * @return string
   */
   function get ($id){
      $select = CopixSelectorFactory::create ($id);
      if (!$select->isValid) {
         trigger_error ('Invalid selector'.$id, E_USER_ERROR);
      }
      $me    = & CopixConfig::instance ();
      $group = & $me->_getGroupConfig ($select->getQualifier ());
      return $group->get ($id);
   }

   /**
   * check if the given param exists.
   */
   function exists ($id){
      $select = CopixSelectorFactory::create ($id);
      if (!$select->isValid) {
         trigger_error ('Invalid selector'.$id, E_USER_ERROR);
      }
      $me    = & CopixConfig::instance ();
      $group = & $me->_getGroupConfig ($select->getQualifier ());
      return $group->exists ($id);
   }

   /**
   * gets all parameters
   * @param group - string [special:][module]
   * @return array
   */
   function getParams ($groupName){
      $me    = & CopixConfig::instance ();
      $group = & $me->_getGroupConfig ($groupName);
      return $group->getParams ();
   }

   /**
   * sets the value of a parameter
   */
   function set ($id, $value){
      $select = & CopixSelectorFactory::create ($id);
      if (!$select->isValid){
         trigger_error ('Invalid selector'.$id, E_USER_ERROR);
      }
      $me    = & CopixConfig::instance ();
      $group = & $me->_getGroupConfig ($select->getQualifier ());
      return $group->set ($id, $value);
   }
   /**
   * gets a CopixGroupConfig. Handle single instance to avoid multiple loadings.
   * @param $kind - the kind of group we wants to load (moduleName, copix:, plugin:name, ..., ...)
   * @return CopixConfigGroup
   */
   function & _getGroupConfig ($kind){
      if (isset ($this->_configGroup[$kind])){
         return $this->_configGroup[$kind];
      }else{
         $this->_configGroup[$kind] = & new CopixGroupConfig ($kind);
         return $this->_configGroup[$kind];
      }
   }
}
?>
