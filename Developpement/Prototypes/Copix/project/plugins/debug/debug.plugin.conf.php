<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: debug.plugin.conf.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Jouanneau Laurent
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

class PluginConfigDebug {

    /**
    * niveau de débugage souhaité:
    * 0 : Erreures fatales uniquement
    * 1 : Erreures fatales et avertissement
    * 2 : Erreures fatales, avertissements, information
    * 3 : Tout
        * @var  integer $DebugLevel
    */
    var $level = 3;
 
        /**
         * Indique si on souhaite qu'il y ait un filtrage par IP
         * et donc que le debuggage se fasse uniqement pour certain poste ou non.
         * @var boolean $DebugIpFilter
         */
    var $ipFilter = false;
 
        /**
         * Indique la liste des IP sur lesquelles le debuggage est actif
         * @var array   $DebugIpArray
         */
    var $ipArray = array ();
 
        /**
         * Indique si on souhaite logguer les messages de debuggage
         * @var boolean $DebugUseLogFile
         */
    var $useLogFile = true;


        /**
        * Nom du fichier de débuggage.
        * Si on veut un fichier par IP, ajouter le tag %ip% dans le nom.
        * @var string   $DebugLogFile
    */
    var $logFile = 'debug_file_%ip%.log';
 
    /**
         * format du message de debuggage enregistré dans les fichiers de log
         * tag à inclure dans le format :
         *  %date%  pour y mettre la date
         *  %ip%    ip du poste
         *  %from%  origine du message (indiqué lors du addInfo)
         *  %msg%   message
         * @var string  $DebugMessageFormat
         */
   var $messageFormat = "%date%\t%ip%\t%from%\t%msg%\n";
 
        /**
         * indique si on affiche ou pas les messages de debuggage
         * @var boolean $DebugDisplay
         */
   var $toDisplay = false;
   
   /**
   	* indique si il faut afficher le contenu en detail des infos de type tableaux et objets
	* @var boolean $dumpArrayObject
	*/
	var $dumpArrayObject = true;

        /**
         * format du message de debuggage pour affichage
         * tag à inclure dans le format :
         *  %ip%    ip du poste
         *  %from%  origine du message (indiqué lors du addInfo)
         *  %msg%   message
         * @var string  $DebugMessageFormatDisplay
         */
    var $messageFormatDisplay = "<p style=\"margin:0;\"><b>[ DEBUG ]</b> (%ip%) %from% : %msg%</p>\n";
}
?>
