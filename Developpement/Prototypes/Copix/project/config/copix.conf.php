<?php
/**
* @package    phpaie
* @subpackage project/config
* @version    
* @author     Croes G�rald, Jouanneau Laurent
*             see copix.aston.fr for other contributors.
* @copyright  2001-2004 Aston S.A.
* @link       http://copix.aston.fr
* @licence    http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/*

 Configuration du framework

 Certains param�tres sont en commentaire. Si vous voulez changer leur valeur par
 d�faut, d�commentez les.

 Tout les param�tres ne sont pas forc�ment �nonc� ici. Regardez le
 fichier utils/copix/core/CopixConfig.class.php pour savoir
 tous les param�tres existants.

*/

//define the path to the configuration file we use.
define ('COPIX_CONFIG_PATH', dirname (__FILE__).'/');

$config = & CopixConfig::instance();

/**
 * ======== plugins ========
 *
 */

// il faut la classe definissant le plugin, dans le repertoire plugin de copix
//$config->registerPlugin('nomduplugin');

if ( ! defined('PROJECT_PLUGIN_AUTH') ) define( 'PROJECT_PLUGIN_AUTH', 'auth|auth' );

// plugin � activer si les magic_quotes sont activ�s ou si vous n'etes pas s�r de l'activation des magic_quotes
// il est recommand� de d�sactiv� les magic_quotes pour un developpement ais� et de meilleurs performances.
//$config->registerPlugin ('MagicQuotes');

$config->registerPlugin ('copixdb');     //support des Bases de donn�es.
//$config->registerPlugin ('debug');       // debuggage, tracage du code
$config->registerPlugin (PROJECT_PLUGIN_AUTH);   // Authentification
//$config->registerPlugin( 'Profile');     // gestion des profiles
//$config->registerPlugin ('CopixMailer'); // envoi de Mails

/**
 * ======= Param�tres d'autorisation de modules ========
 */

// activation de l'autorisation des modules
//$config->checkTrustedModules = false;

// liste des modules autoris�s
//$config->trustedModules = array('exemple'=>true, 'welcome'=>true);


/**
 * ======== parametres traitement des erreurs =======
 */

/**
 * configuration du handler de message, lorsque le mode debuggage est actif
 * le tableau indique, pour chaque code erreur, les actions � effectuer
 * pour traiter les messages, et ce qu'il faut faire apres traitement du message
 * la valeur indiquant tout �a est une des constantes ERR_*, ou une combinaison
 * de celle-ci (ou logique entre les constantes)
 */
$config->errorDebugOn = array (
    E_ERROR           => ERR_MSG_ECHO | ERR_ACT_EXIT,
    E_WARNING         => ERR_MSG_ECHO,
    E_NOTICE          => ERR_MSG_ECHO,
    E_USER_ERROR      => ERR_MSG_ECHO_EXIT,
    E_USER_WARNING    => ERR_MSG_ECHO,
    E_USER_NOTICE     => ERR_MSG_ECHO 
);

/**
* Action par defaut lorsque le code erreur n'existe pas
*/
$config->errorDefaultAction = ERR_MSG_ECHO_EXIT;

/**
* chaine de formatage pour l'enregistrement des messages et leur affichage
*/
$config->errorMessageFormat = "%date%\t[%code%]\t%msg%\t%file%\t%line%\n";
$config->errorMessageFormatDisplay = "<p style=\"margin:0;\"><b>[%code%]</b> <span style=\"color:#FF0000\">%msg%</span> \t%file%\t%line%</p>\n";

/**
* fichier o� sont stock�es les erreurs si l'enregistrement est demand�
*/
$config->errorLogFile='cpx_error.log';

/**
* url de redirection quand une redirection est demand� lorsque une erreur survient
*/
//$config->errorRedirect='conditions.php';
$config->errorRedirect='errors.php';

/**
* addresse email o� envoyer un email d'avertissement lorsque une erreur survient
*/
$config->errorEmail='root@localhost';

/**
* entete du mail
*/
$config->errorEmailHeaders="From: webmaster@yoursite.com\nX-Mailer: Copix\nX-Priority: 1 (Highest)\n";



/**
 * ======= Param�trage du cache ========
 */

/**
* Si la fonctionnalit� de cache est autoris�e ?
*/
$config->cacheEnabled = true;

/**
* Cache par d�faut.
*/
$config->defaultCache = 'Default';

/**
* Liste des autorisation de cache.
*/
$config->cacheTypeEnabled = array ('Zones'=>true,
                                   'Default'=>false
                                  );

/**
* R�pertoires des diff�rents types de cache..
* terminer le nom par un / ou \
* n'indiquer que le chemin relatif au chemin des caches d�finit dans la constante COPIX_CACHE_PATH
*/
$config->cacheTypeDir = array ('Zones'=>'zones/',
                               'Default'=>'default/'
                              );

/**
* Utilisation d'un syst�me de lock ?
*/
$config->useLockFile = true;

/**
* Automatic DAO
*/
$config->compile_dao_dir   = COPIX_CACHE_PATH.'dao_compile/';
$config->compile_dao_check = true;
$config->compile_dao_forced = true;

/**
* ======= Internationalisation (I18N) =======
*/

//$config->default_language = 'fr';
//$config->default_country  = 'FR';
//$config->compile_resource = true;//compilation des ressources ?

/**
* ======== CopixTpl (for Smarty)  =========
*/
$config->template_dir   = COPIX_PROJECT_PATH.'templates/';
$config->compile_dir    = COPIX_CACHE_PATH.'tpl_compile/';
$config->config_dir     = './configs';
$config->debugging      = false;
$config->compile_check  = true;
$config->force_compile  = false;
$config->caching        = 0;
$config->cache_dir      = COPIX_CACHE_PATH.'tpl_cache/';
$config->use_sub_dirs   = true;

/**
* the main template.
*/
$config->mainTemplate   = 'main.tpl';

?>
