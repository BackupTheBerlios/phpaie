<?php 
//********************************************************************
// phpaie 
//------------------------------------------------------------------
// Version: 0.1
//
// Copyright (c) 2002 by Jean-Charles Gibier (~Le Mulot Fou~)
// (http://www.phpaie.net)
// (webmaster@machinbidule.com)
//
// Support �ventuel sur www.phpaie.net
//*********************************************************************
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as 
// published by the Free Software Foundation.
//*********************************************************************
// InitForm ins�re le formulaire correctement form� dans l'objet page.
// & $page  -> objet Html Pear (passage par adresse)
// $object	-> noeud pricipal contient les infos 
// $definition -> array d�finissant la pr�sentation
// $action -> action d�clench�e si formulaire valid�

function InitForm(& $page, $object, $definition, $action)
{
// Bo�te � liens
$links_array = array();
// Bo�te � boutons
$buttons_array = array();
// Affectations d'usage
$vars = $object->vars;
$titles = $object->titles;
require_once ("../common/Defrenderer.php");
// Instanciation du formulaire
$form = new HTML_QuickForm($definition['HTML_QuickForm_def']['formName'], $definition['HTML_QuickForm_def']['method'], (isset($object->anchor)  && !empty ($object->anchor)) ? '#'.$object->anchor : '');
// R�initialisation du message d'avertissement Quickform
$form->_requiredNote = '<span style="font-size:80%; color:#ff0000;">*</span>
						<span style="font-size:80%;">: champs obligatoires.</span>';
//Affectation du renderer propre � notre application
$renderer =& new  Phpaie_Renderer_Default ();

// G�n�rer les contr�les du formulaire
foreach ( $definition['Content'] as $value ) {
// Nom de la ressource courante
	$vname = $value['name'];

// affecter le message d'erreur s'il y a lieu
	if ($vname == 'MSG_STATUS') {
		$value['addElement']['args'] = $object->message_status;
		}

// Pour chaque variable on affecte la valeur par d�faut
	if ( isset($vars[$vname]) && $vars[$vname]) {
		$defaultValues[$vname] = $vars[$vname];
		}

// Pour chaque d�finition dans le container du formulaire on ajoute  1 �l�ment 
	if ( ! isset ($titles[$vname]) ) {
		// si les titres sont ind�finis dans la pr�sentation (cas des statics ou des textes divers)
		$titles[$vname] = 
		( isset ($value['addElement']['label']) && $value['addElement']['label'] != '' ) ?
		explode('~', $value['addElement']['label']) : array();
		}
	// si les titres des �l�ments sont d�finis dans l'objet (radio btn ou  chkbox)
	if ($value['addElement']['type'] == 'radio' || $value['addElement']['type'] == 'checkbox') {
		$form->addElement($value['addElement']['type'], $vname, array_shift($titles[$vname]), '', $value['addElement']['args'] );
		} else {
		$form->addElement($value['addElement']['type'], $vname, array_shift($titles[$vname]), $value['addElement']['args'] );
		}

// Pour chaque variable on affecte la r�gle si elle existe
	if($value['nbArgsRule'] > 0) {
		switch ($value['nbArgsRule']) {
				case 2 :
					list($message, $type) =  $object->inputs[$vname]['field_match'];
					$form->addRule($vname, $message, $type);
				break;
				case 3 :
					list($message, $type , $format) =  $object->inputs[$vname]['field_match'];
					$form->addRule($vname, $message, $type , $format);
				break;
				case 4 :
					list($message, $type , $format, $validation) =  $object->inputs[$vname]['field_match'];
					$form->addRule($vname, $message, $type , $format, $validation);
				break;
				case 5 :
					list($message, $type , $format, $validation, $reset) =  $object->inputs[$vname]['field_match'];
					$form->addRule($vname, $message, $type , $format, $validation, $reset);
				break;
				case 6 :
					list($message, $type , $format, $validation, $reset, $force) =  $$object->inputs[$vname]['field_match'];
					$form->addRule($vname, $message, $type , $format, $validation, $reset, $force);
				break;
			}
		}
	}
// boucle sur les boutons de validation
foreach ( $definition['Buttons'] as $value )	{
	$tmpForm = & HTML_QuickForm::createElement($value[0], $value[1], $value[2]);
	array_push ($buttons_array, $tmpForm);
	}
$form->addGroup($buttons_array, '', '', '');


// boucle sur les r�f�rences de liens externes
foreach ( $definition['Links'] as $value )	{
// on contruit une URI (de mani�re equivalente � http_build_query)
	$NewUri = $value['Args'][2];
	if (isset($value['Paires']) && count($value['Paires'])) {
		$uri_array = array();
		foreach ( $value['Paires'] as $key => $str) {
			array_push ($uri_array , urlencode ($key ."=". $str));
			}
		$NewUri .= "?".implode ('&', $uri_array);
		}
	$tmpLink = & HTML_QuickForm::createElement('link', $value['Args'][0], $value['Args'][1], $NewUri , $value['Args'][3], $value['Args'][4]);
	array_push ($links_array, $tmpLink);
	}
$form->addGroup($links_array, '', '', '');
// Modification de la pr�sentation -- pas l'endroit id�al -- � revoir
$renderer->setGroupTemplate('<table class="formGroupLink" ><tr>{content}</tr></table>', 'LINKS');
$renderer->setGroupElementTemplate('<td>{element}</td>', 'LINKS');
// 1 - v�rification de la validit� du formulaire
if($object->isFormValidated() && ($form->validate() == 0))	{
	$object->invalidateStatus();
	}

// 2 - Est-ce un affichage suite � une validation du formulaire ?
if ($object->isFormValidated()) {
// action est un trigger (une fonction de la classe objet � executer si validation).
	if ( $action != "") {
// habituellement il s'agit d'enregistrer l'objet.
		$object->$action();
		}
	}

// 3 - Valeurs fix�es par l'action 
// (pas orthodoxe dans l'utilisation des fcts internes)
$id_name = $object->getIdName();
$form->_submitValues ['RETURN_STATUS'] = $object->vars['RETURN_STATUS'];
$form->_submitValues [$id_name] = $object->vars[$id_name];

// 4 - Valeurs pass�es en param�tres
if (isset($defaultValues)) {
	$form->setDefaults($defaultValues);
	}

// 5 - affichage et affectation du renderer
$form->accept($renderer);

// 6 - copie du contenu html du formulaire dans l'objet 'page'
$page->addBodyContent($renderer->tohtml());
//fin du formulaire
}
?>
