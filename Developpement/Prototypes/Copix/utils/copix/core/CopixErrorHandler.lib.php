<?php
/**
* @subpackage core
* @package	copix
* @version	$Id: CopixErrorHandler.lib.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

error_reporting (E_ALL);

/**
 * Gestionnaire d'erreur du framework
 * Remplace le gestionnaire par defaut du moteur PHP
 * @param   integer     $errno      code erreur
 * @param   string      $errmsg     message d'erreur
 * @param   string      $filename   nom du fichier où s'est produit l'erreur
 * @param   integer     $linenum    numero de ligne
 * @param   array       $vars       variables de contexte
 * @todo format de message different selon si on est en debug ou non, ou selon si on affiche ou log (inclure plus d'info dans les logs)
 * @todo inclure l'url dans les logs
 */
function CopixErrorHandler($errno, $errmsg, $filename, $linenum, $vars){
    $configData = & $GLOBALS['COPIX']['CONFIG'];

    if(in_array ('debug', $configData->plugins)){
        $conf=&$configData->errorDebugOn;
    }else{
        $conf=&$configData->errorDebugOff;
    }

	if(isset($conf[$errno])){
      $action= $conf[$errno];
   }else{
      $action= $configData->errorDefaultAction;
   }

	// formatage du message
    $messageLog=strtr($configData->errorMessageFormat, array(
	                                 '%date%' => date("Y-m-d H:i:s"),
												'%code%' => $configData->errorCodeString[$errno],
												'%msg%'  => $errmsg,
												'%file%' => $filename,
												'%line%' => $linenum
												));
    $messageToDisplay=strtr($configData->errorMessageFormatDisplay, array(
	                                 '%date%' => date("Y-m-d H:i:s"),
												'%code%' => $configData->errorCodeString[$errno],
												'%msg%'  => $errmsg,
												'%file%' => $filename,
												'%line%' => $linenum
												));

    // traitement du message
	if($action & ERR_MSG_ECHO){
        echo $messageToDisplay;
        flush();
	}
	if($action & ERR_MSG_LOG_FILE){
	    error_log($messageLog,3, COPIX_LOG_DIR.$configData->errorLogFile);
	}
	if($action & ERR_MSG_LOG_MAIL){
        error_log($messageLog,1, $configData->errorEmail, $configData->errorEmailHeaders);
	}
	if($action & ERR_MSG_LOG_SYSLOG){
        error_log($messageLog,0);
	}

	// action
	if($action & ERR_ACT_REDIRECT){
      header('location: '.$configData->errorRedirect);
      exit;
   }

	if($action & ERR_ACT_EXIT){
		exit;
	}
}
?>
