<?php
/**
* @package	copix
* @subpackage generaltools
* @version	$Id: CopixEMailer.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* encapsule un email
* @package	copix
* @subpackage generaltools
*/
class CopixEMail {
   /**
   * The message.
   */
   var $message;
   /**
   * subject of the message
   */
   var $subject;
   /**
   * recipient
   */
   var $to;
   /**
   * carbon copy
   */
   var $cc;
   /**
   * hidden carbon copy
   */
   var $cci;
   /**
   * Sender
   */
   var $from;

   /**
   * l'objet de configuration du mailer.
   */
   var $_config;

   function CopixEMail ($to, $cc, $cci, $subject, $message){
      $plugin = & $GLOBALS['COPIX']['COORD']->getPlugin ('CopixMailer');
      if ($plugin === null){
         trigger_error (CopixI18N::get('copix:copix.error.plugin.unregistered','copixmailer'), E_USER_ERROR);
      }
      $this->_config = & $plugin->config;
      $this->from     = $this->_config->mailFrom;
      $this->fromName = $this->_config->mailFromName;

      $this->to = $to;
      $this->cc = $cc;
      $this->cci = $cci;
      $this->message = $message;
      $this->subject = $subject;
   }

   /**
   * Fonction d'envois
   */
   function send ($from = null, $fromName = null){
//      static $mailer = null;
//      if ($mailer === null){
         $mailer = new CopixEMailer ();
//      }
      return $mailer->send ($this);
   }

   /**
   * Checks if we can send an email with the given configuration.
   */
   function & check (){
      $error = & new CopixErrorObject ();
      if ($this->to === null){
         $error->addError ('to', 'Aucune valeur donnée à destinataire.');
      }
      if ($this->from === null){
         $error->addError ('from', 'Aucune valeur expéditeur');
      }
      return $error;
   }
}

/**
* encapsule un email Mail au format HTML
* @package	copix
* @subpackage generaltools
*/
class CopixHTMLEMail extends CopixEMail {
   var $textEquivalent = 'HTML message';
   function CopixHTMLEMail ($to, $cc, $cci, $subject, $message, $textEquivalent=null){
      parent::CopixEMail ($to, $cc, $cci, $subject, $message);
      $this->textEquivalent = $textEquivalent;
   }
}

/**
* Mail au format texte
* @package	copix
* @subpackage generaltools
*/
class CopixTextEMail extends CopixEMail{
   function CopixTextEMail ($to, $cc, $cci, $subject, $message){
      parent::CopixEMail ($to, $cc, $cci, $subject, $message);
   }
}

/**
* Le géstionnaire de mail
* @package	copix
* @subpackage generaltools
*/
class CopixEMailer {
   /**
   * MailerObject
   */
   var $_mailer = null;
   
   /**
   * l'objet de configuration
   */
   var $_config;

   /**
   * Constructeur qui permet de définir un emplacement disque pour stocker les
   *   mails si l'on fonctionne en "simulation".
   */
   function CopixEMailer (){
      $plugin = & $GLOBALS['COPIX']['COORD']->getPlugin ('CopixMailer');
      if ($plugin === null){
         trigger_error (CopixI18N::get('copix:copix.error.plugin.unregistered','copixmailer'), E_USER_ERROR);
      }
      $this->_config = & $plugin->config;
   }

   /**
   * send an email.
   */
   function send ($copixEMail){
      //check if we wants to write the message on the hard drive.
      if ($this->_config->mailToDisk === true){
         $this->_writeOnDisk ($copixEMail);
      }
      //check if we've been asked not to send the emails.
      if ($this->_config->mailEnable !== true){
         return;
      }

      $mailer = & $this->_createMailer();

      //check the HTML content, if any.
      if (strtolower (get_class ($copixEMail)) == strtolower ('CopixHTMLEMail')){
         $mailer->setHtml($copixEMail->message, $copixEMail->textEquivalent);
      }else{
         $mailer->setText ($copixEMail->message);
      }
      $mailer->setSubject($copixEMail->subject);
      return $mailer->send((array) $copixEMail->to, $this->_config->mailMethod);
   }
   /**
   * Writes the email on the harddrive
   */
   function _writeOnDisk (&$copixEmail){
      $mailFilePath = $this->_config->mailFilePath . UniqId ('mail_');
      //Writes the mail into the file
      $f = fopen ($mailFilePath, "w");
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, 'To: ');
      foreach ((array) $copixEMail->to as $adr){
         fwrite ($f, $adr."\n");
      }
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, 'cc: ');
      foreach ((array) $copixEMail->cc as $adr){
         fwrite ($f, $adr."\n");
      }
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, 'cci: ');
      foreach ((array) $copixEMail->cc as $adr){
         fwrite ($f, $adr."\n");
      }
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, 'Subject: '.$copixEMail->subject."\n");
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, 'Text content'."\n");
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, $copixEMail->message."\n");
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, 'HTML content'."\n");
      fwrite ($f, '________________________________________________________'."\n");
      fwrite ($f, $copixEMail->messageHTML."\n");
      fclose ($f);
   }
   /**
   * creates a mailer object
   * we only wants to create the object once....
   * @return htmlMimeMail
   */
   function & _createMailer () {
      if ($this->_mailer === null){
         $mail = & new htmlMimeMail ();
         $mail->setReturnPath($this->_config->mailFrom);
         $mail->setFrom('"'.$this->_config->mailFromName.'" <'.$this->_config->mailFrom.'>');
         $mail->setHeader('X-Mailer', 'COPIX (http://copix.aston.fr) with HTML Mime mail class (http://www.phpguru.org)');
         $mail->setReturnPath($this->_config->mailFrom);

         if ($this->_config->mailMethod == 'smtp'){
           $mail->setSMTPParams($this->_config->mailSmtpHost);
         }

         $this->_mailer = & $mail;
      }
      return $this->_mailer;
   }
}
?>
