<?php
/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     wiki<br>
 * Date:     18/01/2004
 * Purpose:  convert a formated wiki text to html text
 * Input:
 * Example:  {$text|wiki}  {$text|wiki:"myModule|mywiki.conf.php"}
 * @version  1.0
 * @author	 Laurent Jouanneau
 * @param string  $string  string to convert
 * @param string  $config_file_selector   config to use with wiki renderer
 * @return string
 */
function smarty_modifier_wiki($string, $config_file_selector = '')
{
    require_once(COPIX_UTILS_PATH.'CopixWikiRenderer.lib.php');
    if($config_file_selector == '' )
      $wiki= new CopixWikiRenderer();
    else
      $wiki= new CopixWikiRenderer($config_file_selector);
    return $wiki->render($string);
}


?>
