<?php
require_once 'HTML/Page.php';
class FrameHtmlPage extends HTML_Page {

    var $frameset = '';
    
	function addFramesetContent ( $values ) {
	$this->frameset .= $values . $lnEnd;
	}
    
    function toHTML() {
        // get line endings
        $lnEnd = $this->_getLineEnd();
        // get the doctype declaration
        $strDoctype = $this->_getDoctype();
        // This determines how the doctype is declared
        if ($this->_simple) {
            $strHtml= '<html>' . $lnEnd;
        } elseif ($this->_doctype['type'] == 'xhtml') {
            
            // get the namespace if not already set
            if (!$this->_namespace){
                $this->_namespace = $this->_getNamespace();
            }
            
            $strHtml= $strDoctype . $lnEnd;
            $strHtml.= '<html xmlns="' . $this->_namespace . '" xml:lang="' . $this->_language . '">' . $lnEnd;

            // check whether the XML prolog should be prepended
            if ($this->_xmlProlog){
                $strHtml = '<?xml version="1.0" encoding="' . $this->_charset . '"?>' . $lnEnd . $strHtml;
            }
            
        } else {
            
            $strHtml = $strDoctype . $lnEnd;
            $strHtml.= '<html>' . $lnEnd;
            
        }

        $strHtml.= $this->_generateHead();
        if ($this->_doctype['variant'] == 'frameset') {
            $strHtml.= $this->frameset. $lnEnd;
            $strHtml.= '<noframes>'.$lnEnd;
            $strHtml.= $this->_generateBody();
            $strHtml.= '</noframes>'.$lnEnd;
        } else {
            $strHtml.= $this->_generateBody();
        }
        $strHtml.= '</html>';
        return $strHtml;
    } // end func toHtml

    function display() {
    $this->toHTML();
    parent::display();
    }
}
?>