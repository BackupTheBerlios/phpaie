<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixActionReturn.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* Contient les infos de retour des actions d'un coordinateur de page
*
* Cet objet permet à CopixCoordination de savoir quoi faire apres une action.
* Il contient un code retour, et des données associées à ce code retour.
* Dans les traitements par défaut, ce code est un entier.
*
* <code>
*  $tpl= & new CopixTpl();
*  //...
*  return new CopixActionReturn ( COPIX_AR_DISPLAY, $tpl);
* </code>
*
* @package	copix
* @subpackage core
* @see CopixPage
* @see CopixCoordination
* @see CopixCoordination::_processResult
*/
class CopixActionReturn{
   /**
   * code de retour. vaut une des constantes COPIX_AR_*
   * @var int
   */
   var $code;
   /**
   * paramètre pour le traitement du retour. sa nature dépend du code retour
   * @var mixed
   */
   var $data;
   /**
   * paramètre supplémentaire pour le traitement du retour. sa nature et sa présence dépend du code retour
   * @var mixed
   */
   var $more;
   /**
   * Contruction et initialisation du descripteur.
   * @param int    $pCode  	le code du type de retour
   * @param mixed  $pData      parametre pour le traitement du retour
   * @param mixed  $pMore      paramètre supplémentaire facultatif
   */
	function CopixActionReturn ($pCode, $pData=null, $pMore=null){
      $this->data = $pData;
      $this->more = $pMore;
      $this->code = $pCode;
	}
}
?>
