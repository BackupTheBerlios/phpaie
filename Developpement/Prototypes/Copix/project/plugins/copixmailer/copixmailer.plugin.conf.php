<?php
/**
* @package	copix
* @subpackage plugins
* @version	$Id: copixmailer.plugin.conf.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

require_once (COPIX_PATH.'../htmlMimeMail-2.5.0/htmlMimeMail.php');
require_once (COPIX_UTILS_PATH.'CopixEMailer.class.php');

class PluginConfigCopixMailer {
   /**
   * @var boolean     autorisation d'envoyer des email.
   */
   var $mailEnable = true;
   /**
   * @var string  de qui proviennent les mails ?
   */
   var $mailFrom     = 'gcroes@aston.fr';
   /**
   * @var string  Le nom de l'application. (celui qui envois le mail)
   */
   var $mailFromName = 'Copix';
   /**
   * @var  boolean    si on autorise l'envois de mail par autre que nous même.
   */
   var $mailFromOverrideEnable = false;
   // -- divers paramètres de fonctionnement pour le mail.
   /**
   * @var string  mail ou smtp
   */
   var $mailMethod  = 'smtp';
   /**
   * @var string  ip du smtp
   */
   var $mailSmtpHost = '10.3.5.60';
   //var $mailSmtpHost = '213.41.78.25';//Adresse externe du serveur ASTON
   /**
   * @var string  port du smtp
   */
   var $mailSmtpPort = null;
   /**
   * @var string  helo du smtp
   */
   var $mailSmtpHelo = null;
   /**
   * @var boolean authentification auprés du smtp
   */
   var $mailSmtpAuth = false;
   /**
   * @var string  login pour acceder au smtp
   */
   var $mailSmtpUser = null;
   /**
   * @var string  mot de passe pour le smtp
   */
   var $mailSmtpPass = null;
}
?>
