<?php
/**
 * @package      Phpaie
 * @subpackage   core
 *
 * @version  
 * @origine      Combine project (http://combine.giffin.org)
 * @author       David Giffin <david@giffin.org>
 * @since        PHP 4.0
 * @copyright    Copyright (c) 2000-2003 David Giffin : LGPL - See LICENCE
 * @dependency   Properties class
 */

/* 
 * Chaque service dispose d'un objet "Properties" qui permet de gérer
 * ses propriétés. Ces dernières sont chargées à partir d'un fichier au format 
 *    nom = valeur
 * Ni le nom ni la valeur ne sont entre guillemets.
 * Nota : CopixCoordination a son propre système de paramètres de configuration,
 * chargés dans un objet CopixConfig à partir d'un fichier PHP.
 */

/**
 * The Base Service Object
 *
 * The base class for all Services. The class deals with Service
 * instances, Properties and provides abstract init and shutdown 
 * methods.
 *
 *<code>
 *<?php
 *
 * require_once(FULL_PATH .'Service.php');
 *
 * $logger =& Service::instance('Logger');
 * $logger->log('Log Something . . . ');
 *
 *?>
 *</code>
 *
 * @author   David Giffin <david@giffin.org>
 * @origine  Combine
 */
class Service {

	var $initialized = false;
	var $properties  = null;

	/**
	 * Set the Properties for this Service
	 *
	 * @param mixed A Properties or Array of values to use for the Properties
	 */
	function setProperties(& $properties) {
		if (is_array($properties)) {
			$this->properties = new Properties();
			$this->properties->setFromArray($properties);
		} else if (is_object($properties) && is_a($properties, 'Properties')) {
			$this->properties = $properties;
		}
	}


	/**
	 * Initalize the Service
	 *
	 * @abstract
	 */
	function init() {
	}

	/**
	 * ShutDown the Service
	 *
	 * @abstract
	 */
	function shutdown() {
	}


	/**
	 * Set the initilized state for this Service
	 *
	 * @param boolean $value The new initialized state
	 */
	function setInit($value) {
		$this->initialized = $value;
	}


	/**
	 * Get the initilized state for this Service
	 *
	 * @return boolean The initialized state
	 */
	function getInit() {
		return $this->initialized;
	}


	/**
	 * Get an instance of a specific class
	 *
	 * @param string $class The name of the class
	 * @param string $key   The key to get an instance of the class (by default,
	 *                      it's the class name)
	 * @return object An instance of the class
	 */
	function &instance( $class, $key = null ) {
		static $_instances;

		if (!$_instances) {
			$_instances = array();
		}
		// Logger and LoGGer are the same class...
		$class = strtolower($class);
		if ( ! $key ) $key = $class;
		else $key = strtolower($key);

		if ( !(isSet($_instances[$key]) && $_instances[$key]) ) { 
			$_instances[$key] = new $class();
		}
		return $_instances[$key];
	}

}

?>
