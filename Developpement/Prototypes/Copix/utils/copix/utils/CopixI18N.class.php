<?php
/**
* Ensemble de classe pour gérer l'internationalisation.
*
* glossaire
*	bundle :
*	ressource :	nom du lieu de stockage de la ressource = "plugin", "copix" ou rien (= module ou projet)
*
* Les identifiants des éléments des ressources ont le format suivant :
*     [type:][module|]bundleid.stringId
*
*     [resource:][module|]id.for.the.bundle
*     if a resource is given, then we won't check for a module.
*     if a module is given, it will be checked for an overloaded string in the project.
*     the first part (the string before the first dot) will be considered as the file id.
*     eg in our example: id_lang_COUNTRY.properties.
*
*     for a given lang_COUNTRY, lang_LANG will be the defaults values if no
*     key is specified in lang_COUNTRY.
*
*     the loading process is the following:
*
*     Loading in the module lang_LANG
*     Loading in the module lang_COUNTRY
*     loading overloaded keys in the project for lang_LANG
*     loading overloaded keys in the project for lang_COUNTRY
*
* @package	copix
* @subpackage copixtools
* @version	$Id: CopixI18N.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/*
* Contient un ensemble de traductions concernant une langue donnée
* (et pour tout les pays concernés)
*/
class CopixBundle {
   var $fic;
   var $lang;

   var $_loadedCountries = array ();
   var $_messages;

	/**
    * constructor
    * @param CopixFileSelector	$file
    * @param string				$lang  		the language we wants to load
	 */
   function CopixBundle ($file, $lang){
      $this->fic= $file;
      $this->lang = $lang;
      //creates, we load the defaults.
      $this->_loadLocales ($lang, strtoupper($lang));
   }

   /**
    * get the translation
    */
   function get ($key, $country){
      $country = strtoupper ($country);

      if (!in_array ($country, $this->_loadedCountries)){
         $this->_loadLocales ($this->lang, $country);
      }

      // check if the key exists for the specified country
      if (isset ($this->_messages[$country][$key])){
         return $this->_messages[$country][$key];
      }elseif ($country !== strtoupper ($this->lang)){
         // the key doesn't exist for the specified country,
         // so get the key of the native country
         return $this->get ($key, $this->lang);
      }else{
         return null;
      }
   }

   /**
   * Loads the resources for a given lang/country.
   * will automatically loads the default (lang lang)
   * @param string $lang 	 the language
   * @param string $country the country
   */
   function _loadLocales ($lang, $country){
      $this->_loadedCountries[] = $country;


      //file names for different cases.
      $bundleLang     = $this->fic->fileName.'_'.$lang.'.properties';
      $bundleCountry  = $this->fic->fileName.'_'.$lang.'_'.$country.'.properties';

      $path=$this->fic->getPath(COPIX_RESOURCES_DIR);
      $toLoad[] = array('file'=>$path .$bundleLang, 'lang'=>$lang,'country'=>$lang);
      $toLoad[] = array('file'=>$path .$bundleCountry, 'lang'=>$lang,'country'=>$country);

      $overloadedPath =$this->fic->getOverloadedPath(COPIX_RESOURCES_DIR);
      if($overloadedPath !== null){
         $toLoad[] = array('file'=>$overloadedPath .$bundleLang, 'lang'=>$lang,'country'=>$lang);
         $toLoad[] = array('file'=>$overloadedPath .$bundleCountry, 'lang'=>$lang,'country'=>$country);
      }

      // check if we have a compiled version of the ressources
      if ($GLOBALS['COPIX']['CONFIG']->compile_resource){
         $_compileResourceId = $this->_getCompileId ($lang, $country);
         if (is_readable ($_compileResourceId)){

            // on verifie que les fichiers de ressources sont plus anciens que la version compilée
            $compiledate=filemtime($_compileResourceId);
            $okcompile=true;
            foreach ($toLoad as $infos){
               if(is_readable ($infos['file']) && filemtime($infos['file']) > $compiledate){
                  $okcompile=false;
                  break;
               }
            }
            if($okcompile){
               include ($_compileResourceId);
               $this->_messages[$country] = $_loaded;
               return;
            }
         }
      }

      //loads the founded resources.
      foreach ($toLoad as $infos){
         if (is_readable ($infos['file'])){
            $this->_loadResources ($infos['file'], $infos['lang'], $infos['country']);
         }
      }

      //check if we wants to compile the file.
      if ($GLOBALS['COPIX']['CONFIG']->compile_resource){
         //we want to use the PHP compilation of the resources.
         $first = true;
         $_resources = '<?php $_loaded=array (';
         if (isset ($this->_messages[$country])){
            foreach ($this->_messages[$country] as $key=>$elem){
               if (!$first){
                  $_resources .= ', ';
               }
               $_resources .= '\''.str_replace ("'", "\\'", $key).'\'=>\''.str_replace ("'", "\\'", $elem).'\'';
               $first = false;
            }
         }
         $_resources .= '); ?>';
         require_once (COPIX_UTILS_PATH . 'CopixFileLocker.class.php');
         $objectWriter = & new CopixFileLocker ();
         $objectWriter->write ($_compileResourceId, $_resources, 'w');
      }
   }
   /**
   * Récupération de l'identifiant de compilation d'une ressource pour une langue / pays
   */
   function _getCompileId ($lang, $country){
      return $GLOBALS['COPIX']['CONFIG']->compile_resource_dir.str_replace (array (':', '|'), array ('_RESOURCE_', '_MODULE_'), strtolower ($this->fic->getSelector()).'_FOR_BUNDLE_'.$lang.'_'.$country).'.php';
   }

   /**
   * loads a given resource from its path.
   * Will be considered as lang_country
   *
   * @param string $path 	 the path to the properties file.
   * @param string $lang 	 the language
   * @param string $country the country
   */
   function _loadResources ($path, $lang, $country){
      $country = strtoupper ($country);

      if (($f = fopen ($path, 'r')) !== false) {
         $multiline=false;
         $linenumber=0;
         while (!feof($f)) {
            if($line=fgets($f,1024)){ // length required for php < 4.2
               $linenumber++;

               if($multiline){
                  if(preg_match("/^([^#]+)(\#?.*)$/", $line, $match)){ // toujours vrai en fait
                     $value=trim($match[1]);
                     if (strpos( $value,"\\u" ) !== false){
                       $value=$this->_utf16( $value );
                     }
                     if($multiline= (substr($value,-1) =="\\"))
                        $this->_messages[$country][$key].=substr($value,0,-1);
                     else
                        $this->_messages[$country][$key].=$value;
                  }
               }elseif(preg_match("/^\s*(([^#=]+)=([^#]+))?(\#?.*)$/",$line, $match)){
                  if($match[1] != ''){ // on a bien un cle=valeur
                     $value=trim($match[3]);
                     if($multiline= (substr($value,-1) =="\\"))
                        $value=substr($value,0,-1);

                     $key=trim($match[2]);

                     if (strpos( $match[1],"\\u" ) !== false){
                        $key=$this->_utf16( $key );
                        $value=$this->_utf16( $value );
                     }
                     $this->_messages[$country][$key] =$value;
                  }else{
                     if($match[4] != '' && substr($match[4],0,1) != '#')
                        trigger_error('Syntaxe error in file properties '.$path.' line '.$linenumber, E_USER_NOTICE);
                  }
               }else {
                  trigger_error('Syntaxe error in file properties '.$path.' line '.$linenumber, E_USER_NOTICE);
               }
            }
         }
         fclose ($f);
      }else{
         trigger_error ('Cannot load the resource '.$path, E_USER_ERROR);
      }
   }

   /**
   * converts an utf16 string to html string.
   * @param	string $str	string to convert
   * @return	string	string converted to html
   */
   function _utf16 ( $str ) {
      while (ereg( "\\\\u[0-9A-F]{4}",$str,$unicode )) {
         $repl="&#".hexdec( $unicode[0] ).";";
         $str=str_replace( $unicode[0],$repl,$str );
      }
      return $str;
   }


}

class CopixI18N {
   var $_bundles;//[module][lang]

   function & instance (){
      static $instance = false;
      if (!$instance){
         $instance = new CopixI18N ();
      }
      return $instance;
   }

   /**
   * TODO: Actuellement uniquement français..... ce qui est un peu domage dirons
   *   nous.
   */
   function dateToBD ($date){
      if ($date == ''){
         return '';
      }
      $tmp = explode ('/', $date);
      return $tmp[2].$tmp[1].$tmp[0];
   }

   /**
   * gets the correct string, for a given language.
   *   if it can't get the correct language, it will try to gets the string
   *   from the default language.
   *   if both fails, it will raise a fatal_error.
   */
   function get ($key, $args=null, $locale=null) {
      $me = & CopixI18N::instance();

      //finds out required lang / coutry
      if ($locale === null){
         $plug    = & $GLOBALS['COPIX']['COORD']->getPlugin ('i18n');
         if ($plug === null){
            $lang    = $GLOBALS['COPIX']['CONFIG']->default_language;
            $country = $GLOBALS['COPIX']['CONFIG']->default_country;
         }else{
            $lang    = $plug->getLang ();
            $country = $plug->getCountry ();
         }
      }else{
         $ext = explode ('_', $locale);
         if (count($ext) > 1){
            $lang    = $ext[0];
            $country = $ext[1];
         }else{
            $lang    = $ext[0];
            $country = $ext[0];
         }
      }

      //Gets the bundle for the given language.
      $trans = & CopixSelectorFactory::create($key);
      if(!$trans->isValid){
         trigger_error (CopixI18N::get ('copix:copix.error.i18n.keyNotExists', $key), E_USER_ERROR);
      }

      $messageId=$trans->fileName;
      $trans->fileName=substr($trans->fileName, 0, strpos($trans->fileName,'.'));

      $bundle = & $me->getBundle ($trans, $lang);

      //try to get the message from the bundle.
      $string = $bundle->get ($messageId, $country);
      if ($string === null){
         //if the message was not found, we're gonna
         //use the default language and country.
         if ($lang    == $GLOBALS['COPIX']['CONFIG']->default_language &&
             $country == $GLOBALS['COPIX']['CONFIG']->default_country){
               if ($key == 'copix:copix.error.i18n.keyNotExists'){
                  $msg = 'Can\'t find message key (which should actually be THIS message): '.$key;
               }else{
                  $msg = CopixI18N::get ('copix:copix.error.i18n.keyNotExists',$key);
               }
               trigger_error ($msg, E_USER_ERROR);
         }
         return $me->get ($key, $args, $GLOBALS['COPIX']['CONFIG']->default_language.'_'.$GLOBALS['COPIX']['CONFIG']->default_country);
      }else{
         //here, we know the message
         if($args!==null){
            $string = call_user_func_array('sprintf', array_merge ($string, $args));
/*
//            if(is_array($args)){
               switch(count($args)){
                  case 1: $string=sprintf($string,$args[0]); break;
                  case 2: $string=sprintf($string,$args[0],$args[1]); break;
                  case 3: $string=sprintf($string,$args[0],$args[1],$args[2]); break;
               }
//            }else
//               $string=sprintf($string,$args);
*/
         }
         return $string;
      }
   }

   /**
   * gets the bundle for a given language.
   */
   function & getBundle ($bundle, $lang){
      $s=$bundle->getSelector();
      if (!isset ($this->_bundles[$s][$lang])){
         $this->_bundles[$s][$lang] = & new CopixBundle ($bundle, $lang);
      }
      return $this->_bundles[$s][$lang];
   }
}
?>
