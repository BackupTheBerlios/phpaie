<?php
/**
* @package    copix
* @subpackage core
* @version    $Id: CopixFileSelector.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author    Laurent Jouanneau
* @copyright 2001-2004 Aston S.A.
* @link        http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
class CopixSelectorFactory {
    function & create ($id){
        $match=null;

        if(preg_match("/^((plugin|copix):)?(.*)$/",$id,$match)){
            switch($match[2]){
            case '':
                    return new CopixModuleFileSelector($id);
            case 'plugin':
                    return new CopixPluginFileSelector($id);
            case 'copix':
                    return new CopixCopixFileSelector($id);
            }
            return null;
        }else{
            return null;
        }
   }
}

class CopixFileSelector {
    var $type=null;
    var $typeValue=null;
    var $fileName=null;
    var $isValid=false;
    function getPath ($directory=''){ return null; }
    function getOverloadedPath ($directory=''){ return null; }
    function getSelector (){ return null; }
    /**
     * @abstract
     */
    function getQualifier (){}
}

class CopixModuleFileSelector extends CopixFileSelector {

   var $module=null; // si vaut '' ou null = projet

   function CopixModuleFileSelector($selector){
        $this->type='module';
      $match=null;

         if(preg_match("/^(([_0-9a-zA-Z-]*)\|)?(.*)$/",$selector,$match)){
         if($match[1]!=''){
            $this->module=$match[2];
         }
         $this->fileName=$match[3];  //le nom correspond � tout ce qui suit l'�ventuel s�parateur

         if($this->module===null){
            $this->module = CopixContext::get();
         }
         $this->isValid=true;
      }
   }
   
    /*
     * Renvoie un chemin se terminant par $directory et pr�c�d� soit du r�pertoire du module 
     * s'il est sp�cifi� sinon directement celui du r�pertoire projet 
     */
    function getPath($directory=''){
        if($this->module===null || $this->module=='' ){
            return COPIX_PROJECT_PATH.$directory;
        }else{
            return COPIX_MODULE_PATH.$this->module.'/'.$directory;
        }
    }

    /*
     * Renvoie un chemin se terminant par le r�pertoire du module et pr�c�d� du  
     * r�pertoire $directory 
     */
    function getOverloadedPath($directory=''){
        if($this->module !='' ){
            return COPIX_PROJECT_PATH.$directory.$this->module.'/';
        }else{
            return null;
        }
    }

    function getSelector(){
        return $this->module.'|'.$this->fileName;
    }

    function getQualifier (){
       return $this->module.'|';
    }
}


class CopixPluginFileSelector extends CopixFileSelector {

    var $pluginName=null;
    var $module=null;

    function CopixPluginFileSelector($selector){
       $this->type='plugin';
       $match=null;
        if(preg_match("/^plugin:([_0-9a-zA-Z-]*)\/(([_0-9a-zA-Z-]*)\|)?(.*)$/",$selector,$match)){
         if($match[2]!=''){
            $this->module=$match[3];
         }
         $this->pluginName=$match[1];
         $this->fileName=$match[4];
            $this->isValid=true;
      }
   }

    function getPath($directory=''){
      if($this->module===null || $this->module=='' ){
        return COPIX_PLUGINS_PATH.$this->pluginName.'/';
      }else{
        return COPIX_MODULE_PATH.$this->module.'/'.COPIX_PLUGINS_DIR.$this->pluginName.'/';
      }
   }

   function getSelector(){
        return 'plugin:'.$this->pluginName.'/'. ($this->module !== null ? $this->module.'/':'').$this->fileName;
   }

   function getQualifier (){
      return 'plugin:'.$this->pluginName.($this->module !== null ? '/'.$this->module : '');
   }
}

class CopixCopixFileSelector extends CopixFileSelector {
   function CopixCopixFileSelector($selector){
        $this->type='copix';
      $match=null;
        if(preg_match("/^copix:(.*)$/",$selector,$match)){
         $this->fileName=$match[1];
            $this->isValid=true;
      }
   }

    function getPath($directory=''){
        return COPIX_PATH.$directory;
   }

   function getSelector(){
        return 'copix:'.$this->fileName;
   }

   function getQualifier (){
      return 'copix:';
   }
}
?>
