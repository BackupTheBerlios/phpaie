<?php
/**
* @package	copix
* @subpackage project
* @version	$Id: i18n.plugin.php,v 1.1 2004/07/25 22:12:59 j-charles Exp $
* @author	Croes Gérald, Jouanneau Laurent
*           see copix.aston.fr for other contributors.
* @copyright 2001-2004 Aston S.A.
* @link		http://copix.aston.fr
* @licence  http://www.gnu.org/licenses/gpl.html GNU General Public Licence, see LICENCE file
*/

/**
 * plugin gerant automatiquement la langue et la monnaie de l'utilisateur
 */

class PluginI18n extends CopixPlugin {

	/**
     *
	 * @param	class	$config		objet de configuration du plugin
     */
	function PluginI18n($config){
        parent::CopixPlugin($config);
	}

	/**
     * traitements à faire avant execution du coordinateur de page
	 */
	function beforeProcess(&$pageActionDesc){

		//-------- on determine la langue que l'on utilise

        if(isset($_SESSION['COPIXLANG'])){
            $languageCode=$_SESSION['COPIXLANG']['code'];
            $languageData=$_SESSION['COPIXLANG'];
        }else{
            $languageCode='';
            $languageData=array();
        }

		$isLanguageAsked=false;


		if($this->config->enableUserLanguageChoosen){ // si la detection est activée

            if(isset($this->coordination->vars[$this->config->urlParamNameLanguage])){ // si le parametre language est donné dans l'url
				// recuperation des données de la langue
                $languageData=$this->_getLanguageData($this->coordination->vars[$this->config->urlParamNameLanguage]);
				if(count($languageData)>0){
				    $isLanguageAsked=true;
					$languageCode=$this->coordination->vars[$this->config->urlParamNameLanguage];
				}
			}
		}

		if(!$isLanguageAsked){ // si il n'y a pas eu de parametre langue dans l'url...
            if(!isset($_SESSION['COPIXLANG'])){ // y a t il les données de la langue en session ?
			    // non -> on detecte automatiquement la langue puis on stocke en session
				if($this->config->useDefaultLanguageBrowser){
					if( $languageData=$this->_getBrowserLanguage() )
					    $languageCode=$languageData['code'];
				}

				if($languageCode==''){ // si code language browser inactif ou non trouve, utilisation du language par defaut
					$languageCode = $this->config->defaultLanguageCode;
					$languageData = $this->_getLanguageData($languageCode);
				}
            }

		}

        $_SESSION['COPIXLANG']=$languageData;
        $GLOBALS['COPIX']['CONFIG']->tpl_sub_dirs[]=$languageCode;

		//------ on determine la monnaie à utiliser
		$currencyCode='';
        $currencyData=array();
		$isCurrencyAsked=false;
		// on regarde si l'utilisateur peut choisir sa monnaie, et donc si il y a ce qu'il faut dans l'url
		if($this->config->enableUserCurrencyChoosen){
            if(isset($this->coordination->vars[$this->config->urlParamNameCurrency])){
                $currencyData=$this->_getCurrencyData($this->coordination->vars[$this->config->urlParamNameCurrency]);
				if($currencyData){
				    $isCurrencyAsked=true;
					$currencyCode=$this->coordination->vars[$this->config->urlParamNameCurrency];
				}
			}
		}

		// on rempli la variable en session
		if(!$isCurrencyAsked){
            if(!isset($_SESSION['COPIXCURRENCY'])){
				$_SESSION['COPIXCURRENCY']= $this->_getCurrencyData($this->config->defaultCurrencyCode);
		    }
		}else{
            $_SESSION['COPIXCURRENCY']=$currencyData;
        }
		
		// on rempli la variable en session contenant la monnaie alternative (pour double affichage)
		if(!isset($_SESSION['COPIXCURRENCYALT'])){
			$_SESSION['COPIXCURRENCYALT']= $this->_getCurrencyData($this->config->defaultAlternateCurrencyCode);
		}



	}


    function _getBrowserLanguage() {
        $languages = array('ar' => 'ar([-_][[:alpha:]]{2})?|arabic', // arabic
                               'bg-win1251' => 'bg|bulgarian', // bulgarian-win1251
                               'bg-koi8r' => 'bg|bulgarian', // bulgarian-koi8
                               'ca' => 'ca|catalan', // catala
                               'cs-iso' => 'cs|czech',  // czech-iso
                               'cs-win1250' => 'cs|czech',  // czech-win1250
                               'da' => 'da|danish', // danish
                               'de' => 'de([-_][[:alpha:]]{2})?|german', // german
                               'el' => 'el|greek', // greek
                               'en' => 'en([-_][[:alpha:]]{2})?|english', // english
                               'es' => 'es([-_][[:alpha:]]{2})?|spanish', // spanish
                               'et' => 'et|estonian', // estonian
                               'fi' => 'fi|finnish',  // finnish
                               'fr' => 'fr([-_][[:alpha:]]{2})?|french', // french
                               'gl' => 'gl|galician', // galician
                               'he' => 'he|hebrew', // hebrew
                               'hu' => 'hu|hungarian', // hungarian
                               'id' => 'id|indonesian', // indonesian
                               'it' => 'it|italian', // italian
                               'ja-euc' => 'ja|japanese',  // japanese-euc
                               'ja-sjis' => 'ja|japanese',  // japanese-sjis
                               'ko' => 'ko|korean',  // korean
                               'ka' => 'ka|georgian',  // georgian
                               'lt' => 'lt|lithuanian',  // lithuanian
                               'lv' => 'lv|latvian',  // latvian
                               'nl' => 'nl([-_][[:alpha:]]{2})?|dutch',  // dutch
                               'no' => 'no|norwegian',  // norwegian
                               'pl' => 'pl|polish',  // polish
                               'pt-br' => 'pt[-_]br|brazilian portuguese',  // brazilian_portuguese
                               'pt' => 'pt([-_][[:alpha:]]{2})?|portuguese',  // portuguese
                               'ro' => 'ro|romanian',  // romanian
                               'ru-koi8r' => 'ru|russian',  // russian-koi8
                               'ru-win1251' => 'ru|russian',  // russian-win1251
                               'sk' => 'sk|slovak',  // slovak-iso
                               'sk-win1250' => 'sk|slovak',  // slovak-win1250
                               'sr-win1250' => 'sr|serbian',  // serbian-win1250
                               'sv' => 'sv|swedish',  // swedish
                               'th' => 'th|thai',  // thai
                               'tr' => 'tr|turkish',  // turkish
                               'uk-win1251' => 'uk|ukrainian',  // ukrainian-win1251
                               'zh-tw' => 'zh[-_]tw|chinese traditional',  // chinese_big5
                               'zh' => 'zh|chinese simplified',  // chinese_gb
							   );


      $browser_languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

	  foreach($browser_languages as $bl){
        foreach($languages as $code=>$regexp){

          if (eregi('^(' . $regexp . ')(;q=[0-9]\\.[0-9])?$', $bl)) {
		    if($data=$this->_getLanguageData($code))
                return $data;
          }
        }
      }
	  return false;
    }


	/**
	 * recupere les données de la langue disponible en base de donnée
     * @todo supprimer le languages_id quand base sera modifiée
	 */
    function _getLanguageData($code){

        include(realpath(dirname(__FILE__).'/../config/i18n.plugin.datas.php'));
        if(isset($i18n_languages[$code])){
            $l=&$i18n_languages[$code];
            return array('code'=>$code,
                    'name'=>$l[0],
                    'default_currency' => $l[1],
                    'languages_id'=>$l[2]
                    );
        }else
		    return false;
	}

	/**
	 * recupere les données de la monnaie, disponible en base de donnée
	 */
	function _getCurrencyData($code){
        include(realpath(dirname(__FILE__).'/../config/i18n.plugin.datas.php'));
        if(isset($i18n_currencies[$code])){
           $l=&$i18n_currencies[$code];
            return array('code'=>$code,
                    'name'=>$l[0],
                    'symbol_left' => $l[1],
                    'symbol right' => $l[2],
                    'decimal point' => $l[3],
                    'thousands point' => $l[4],
                    'decimal_places' => $l[5],
                    'value' => $l[6],
                    'last_updated' => $l[7]
                    );
	    }else
		    return false;

	}

}
?>
