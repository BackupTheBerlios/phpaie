<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     messageI18n
 * Version:  1.0
 * Date:     24/11/2003
 * Author:	 gérald croes <gerald@phpside.org>
 * Purpose:  I18N interface for CopiX.
 *
 * Input:    key      = (required  name of the select box
 *           bundle   = (optional) values to display the values captions will be
 *                        html_escaped, not the ids
 *           lang      = (optional) id of the selected element
 *           assign   = (optional) name of the template variable we'll assign
 *                      the output to instead of displaying it directly
 *
 * Examples:
 */
function smarty_function_i18n($params, &$this) {
   extract($params);
   if (empty ($key)){
     $smarty->_trigger_fatal_error("[smarty i18n] Missing key parameter");
     return;
   }
   return CopixI18N::get ($key);
}
?>
