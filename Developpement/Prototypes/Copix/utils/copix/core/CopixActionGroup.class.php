<?php
/**
* @package	copix
* @subpackage core
* @version	$Id: CopixActionGroup.class.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes G�rald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
* Il implemente les actions li�es � une page, et renvoi au coordinateur de module
* des informations concernant la cinematique � suivre apr�s action.
* Il faut donc imperativement instancier cette page pour implementer les methodes
* correspondantes � chaque action
*
* @package	copix
* @subpackage core
* @abstract
* @see CopixActionReturn
* @see CopixCoordination
*/
class CopixActionGroup {
    /**
	 * Alias de $GLOBALS['COPIX']['COORD']->vars. Initialis� lors du constructeur de l'ActionGroup
     * @var array
     */
    var $vars;

	/**
     * Constructeur
     *
     * s'enregistre dans $GLOBALS['COPIX']['ACTIONGROUP'] comme �tant le dernier
     * �l�ment ActionGroup cr�e.
     * D�finit l'alias $this->vars
     */
    function CopixActionGroup (){
       $GLOBALS['COPIX']['ACTIONGROUP'] = & $this;
       $this->vars = & $GLOBALS['COPIX']['COORD']->vars;

    }

    /**
     * alias pour le processZone du coordinateur
     */
	 function processZone($name, $params=array ()){
   	return $GLOBALS['COPIX']['COORD']->processZone ($name, $params);
	 }

	/*
	 function getAffichage() {
	    //exemple de fonction dont l'objet est d'afficher des �l�ments.
	    //Par convention, tous les noms des m�thodes "actions" dont l'objectif
	    // est d'afficher des �l�ments (r�sultant en une page HTML "physique")
	    // commencent par "get"

        $tpl = new & CopixTpl ();
        $ceQueJeVeuxAfficher = $GLOBALS['COPIX']['COORD']->processZone ('maZoneBandeau'); // on recupere le contenu d'une zone
	    $tpl->assign('MAIN', $ceQueJeVeuxAfficher); // on assigne une valeur de variable au template

        return new CopixActionReturn (COPIX_AR_DISPLAY, $tpl);//demande d'affichage
        //pour la liste des codes retours compl�te, r�f�rez vous en � la documentation (http://copix.aston.fr)
	 }
	*/

	/*
     function doTraitementEtRedirection () {
       //exemple de fonction dont l'objet est d'effectuer un traitement (ajout /
       //  suppression / modification / ...)
       //  A chaque fois que nous effectuerons un traitement de ce type,
       //   nous effectuerons une redirection et NON un affichage.
       //   Le risque d'effectuer un affichage dans ce genre de situation
       //   est de dupliquer un traitement par l'action de rafraichissement de
       //   la page par l'utilisateur.

       //Par convention, tous les noms des m�thodes "actions" dont l'objectif
       // est d'effectuer un traitement, puis de rediriger vers une autre action
       // commencent par "do"

       $tpl = new & CopixTpl ();
       //Effectuer des traitements particuliers, exemple un ajout [...]

       return new CopixActionReturn (COPIX_AR_REDIRECT, 'index.php?action=autreChose');
       //pour la liste des codes retours compl�te, r�f�rez vous en � la documentation (http://copix.aston.fr)
     }
	*/
}
?>
