<?php
/**
* @package     phpaie
* @subpackage  plugins
* @version    
* @author      Jouanneau Laurent
* @copyright   2001-2004 Aston S.A.
* @link           http://copix.aston.fr
* @licence     http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/


class PluginConfigI18n {

    /**
     * codes des langages disponibles sur le site
     */
    var $availableLanguageCode = array('fr','en');

    /**
     * code language par defaut
     */
    var $defaultLanguageCode='fr';

    /**
     * code monnaie par defaut
     */
    var $defaultCurrencyCode='EUR';

    /**
     * deuxieme code monnaie par defaut  (utile pour le double affichage)
     * chaine vide : pas de seconde monnaie
     */
    var $defaultAlternateCurrencyCode='FRF';

    /**
     * utilisation du language indiqué dans le navigateur
     */
    var $useDefaultLanguageBrowser=false;

    /**
     * active la detection du changement de language via l'url fournie
     */
    var $enableUserLanguageChoosen=true;
    /**
     * active la detection du changement de monnaie via l'url fournie
     */
    var $enableUserCurrencyChoosen=true;

    /**
     * indique le nom du parametre url qui contient la langue choisie par l'utilisateur
     */
    var $urlParamNameLanguage='lang';

    /**
     * indique le nom du parametre url qui contient la monnaie choisie par l'utilisateur
     */
    var $urlParamNameCurrency='curr';

}


?>
