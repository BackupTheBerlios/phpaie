<?php
/**
* @package	copix
* @subpackage generaltools
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/
class CopixHTMLHeader {
   var $_CSSLink = array ();
   var $_Styles  = array ();
   var $_JSLink  = array ();
   var $_JSCode  = array ();
   var $_Others  = array ();

   function & _getInstance (){
      static $instance = false;
      if ($instance === false){
         $instance = new CopixHTMLHeader ();
      }
      return $instance;
   }
   
   function addJSLink ($src, $params=array()){
      $me = & CopixHTMLHeader::_getInstance ();
      if (!in_array ($src, $me->_JSLink)){
         $me->_JSLink[] = array ($src, $params);
      }
   }
   function addCSSLink ($src, $params=array ()){
      $me = & CopixHTMLHeader::_getInstance ();
      if (!in_array ($src, $me->_CSSLink)){
         $me->_CSSLink[] = array ($src, $params);
      }
   }
   function addStyle ($name, $def){
      $me = & CopixHTMLHeader::_getInstance ();
      if (!in_array ($name, array_keys ($me->_Styles))){
         $me->_Styles[$name] = $def;
      }
   }
   function addOthers ($content){
      $me = & CopixHTMLHeader::_getInstance ();
      $me->_Others[] = $content;
   }

   function addJSCode ($code){
      $me = & CopixHTMLHeader::_getInstance ();
      $me->_JSCode[] = $code;
   }

   function getOthers (){
      $me = & CopixHTMLHeader::_getInstance ();
      return implode ("\n\r", $me->_Others);
   }

   function getJSCode (){
      $me = & CopixHTMLHeader::_getInstance ();
      if(($js= implode ("\n", $me->_JSCode)) != '')
         return '<script type="text/javascript"><!--
         '.$js.'
         //--></script>';
      else
         return '';
   }

   function get (){
      $me = & CopixHTMLHeader::_getInstance ();
      return $me->getCSSLink () . "\n\r" . $me->getJSLink () . "\n\r" . $me->getStyles ()."\n\r" .$me->getJSCode ().$me->getOthers ();

   }

   function getStyles (){
      $me = & CopixHTMLHeader::_getInstance ();
      $built = array ();
      foreach ($me->_Styles as $name=>$value){
         if (strlen (trim($value))){
            //il y a une paire clef valeur.
            $built[] = $name.'{'.$value.'}';
         }else{
            //il n'y a pas de valeur, c'est peut être simplement une commande.
            //par exemple @import qqchose, ...
            $built[] = $name;
         }
      }
      if(($css=implode ("\n", $built)) != '')
         return '<style type="text/css"><!--
         '.$css.'
         //--></style>';
      else
         return '';
   }

   function getCSSLink (){
      $built = array ();
      $me = & CopixHTMLHeader::_getInstance ();
      foreach ($me->_CSSLink as $elems){
         //the extra params we may found in there.
         $more = '';
         foreach ($elems[1] as $param_name=>$param_value){
            $more .= $param_name.'="'.$param_value.'" ';
         }
         $built[] = '<link rel="stylesheet" type="text/css" href="'.$elems[0].'" '.$more.' />';
      }
      return implode ("\n\r", $built);
   }

   function getJSLink (){
      $built = array ();
      $me = & CopixHTMLHeader::_getInstance ();
      foreach ($me->_JSLink as $elems){
         //the extra params we may found in there.
         $more = '';
         foreach ($elems[1] as $param_name=>$param_value){
            $more .= $param_name.'="'.$param_value.'" ';
         }
         $built[] = '<script type="text/javascript" src="'.$elems[0].'" '.$more.'></script>';
      }
      return implode ("\n\r", $built);
   }

   function clear ($what){
      $cleanable = array ('CSSLink', 'Styles', 'JSLink', 'JSCode', 'Others');
      foreach ($what as $elem){
         if (in_array ($elem, $cleanable)){
            $name = '_'.$elem;
            $this->$name = array ();
         }
      }
   }
}
?>
