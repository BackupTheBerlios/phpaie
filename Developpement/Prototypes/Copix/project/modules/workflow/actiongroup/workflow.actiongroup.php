<?php
/**
* @package      phpaie
* @subpackage   workflow
* @version      
* @author       Pierre Raoul
*               see www.phpaie.net for other contributors.
* @copyright    2004 Pierre Raoul
* @link         http://www.phpaie.net
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/


/**
 * handle the welcome pages: information, registration, legal notice...
 */
class ActionGroupWorkFlow extends CopixActionGroup {

    /**
     * Gets the workspace page
     */
    function getWorkspace(){

        $_view = & new MenuTpl('Workspace page');

        $_view->assign( 'MAIN', $this->processZone( 'workspace' ) );

        return new CopixActionReturn(COPIX_AR_DISPLAY, $_view);
    }

    /**
     * For Branch, gets the list of array( Title, Variable name )
     * 
     * @access private
     * @return array of array( Title, Variable name )
     */
    function getBranchDataList(){
        return array( 'id'     => array( 'label'     => CopixI18N::get ('views.branch.list.id')
                                 , 'var'       => 'branch_id'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'no'
                                 )
                    , 'name'   => array( 'label'      => CopixI18N::get ('views.branch.list.name')
                                 , 'var'       => 'branch_name'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'status' => array( 'label'      => CopixI18N::get ('views.branch.list.status')
                                 , 'var'       => 'branch_status'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'email'  => array( 'label'      => CopixI18N::get ('views.branch.list.email')
                                 , 'var'       => 'branch_email'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                                 );
    }

    /**
     * For Worker, gets the list of array( Title, Variable name )
     * 
     * @private
     * @return array of array( Title, Variable name )
     */
    function getWorkerDataList(){
        return array( 'id'         => array( 'label' => CopixI18N::get ('views.worker.list.id')
                                 , 'var'       => 'worker_id'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'no'
                                 )
                    , 'first_name' => array('label'  => CopixI18N::get ('views.worker.list.first_name')
                                 , 'var'       => 'first_name'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'last_name'  => array('label'  => CopixI18N::get ('views.worker.list.last_name')
                                 , 'var'       => 'last_name'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'email'      => array('label'  => CopixI18N::get ('views.worker.list.email')
                                 , 'var'       => 'email'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                                 );
    }

    /**
     * For Contract, gets the list of array( Title, Variable name )
     * 
     * @private
     * @return array of array( Title, Variable name )
     */
    function getContractDataList(){
        return array( 'id'          => array( 'label' => CopixI18N::get ('views.contract.list.id')
                                 , 'var'       => 'worker_id'
                                 , 'type'      => 'integer'
                                 , 'mutabled'  => 'no'
                                 )
                    , 'branch_name' => array('label'  => CopixI18N::get ('views.contract.list.branch_name')
                                 , 'var'       => 'branch_name'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'first_name'  => array('label'  => CopixI18N::get ('views.contract.list.first_name')
                                 , 'var'       => 'worker_first_name'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'branch_name' => array('label'  => CopixI18N::get ('views.contract.list.branch_name')
                                 , 'var'       => 'worker_last_name'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'wage'        => array('label'  => CopixI18N::get ('views.contract.list.wage')
                                 , 'var'       => 'wage'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'begin_date'  => array('label'  => CopixI18N::get ('views.contract.list.begin_date')
                                 , 'var'       => 'begin_date'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                    , 'end_date'    => array('label'  => CopixI18N::get ('views.contract.list.end_date')
                                 , 'var'       => 'end_date'
                                 , 'type'      => 'text'
                                 , 'mutabled'  => 'yes'
                                 )
                                 );
    }

    /**
     * Gets a list page
     * 
     * Generate the HTML page for a list
     * 
     * @private
     * @param  string $entityName Name of the class
     * @param  array  $dataList   Array of array( Title, Variable name )
     * @param  array  $list       Array of objects
     * @param  array  $selected   Array of selected object ids
     * @param  array  $msgList    Array of strings
     * @return CopixActionReturn
     */
    function showList( $entityName, $dataList, & $list, $tagged = null, $msgList = null, $requestUrl = null ){
        $_view = new MenuTpl($entityName .' list page');
        
        $_main = '';
        foreach($msgList as $_message) {
            $_main .= '<p>' .$_message .'</p>' ."\n";
        }
        $_main .= $this->processZone( 'showList'
                                    , array( 'list'      => $list 
                                           , 'tagged'    => $tagged
                                           , 'dataList'  => $dataList
                                           , 'requestUrl'=> $requestUrl
                                           ) );

        $_view->assign( 'MAIN', $_main );

        return new CopixActionReturn(COPIX_AR_DISPLAY, $_view);
    }

    /**
     * Gets an entity list page
     * 
     * Common data treatment for all the list actions, 
     * 
     * @access private
     * @param  string  $entityName Name of the entity
     * @param  array   $tagged     Array of selected object ids
     * @return CopixActionReturn
     */
    function showEntityList( $entityName, $criteria = null, $tagged = null ){

        $_session = & HttpSession::instance();        

        if ( $_session->getAttribute( 'ENTITY_NAME' ) != $entityName ) {
            $_session->setAttribute( 'ENTITY_NAME', $entityName );
            $_session->setAttribute( 'TAGGED', $tagged );
        }
        else {
            // cas où on reste avec la même entité métier
            if ( ! $tagged ) {
                $tagged = $_session->getAttribute('TAGGED');
            }
            else {
                $_session->setAttribute( 'TAGGED', $tagged );
            }
        }
        
        if ( ! $criteria ) {
            $criteria = $_session->getAttribute('CRITERIA');
        }
        else {
            $_session->setAttribute( 'CRITERIA', $criteria );
        }
        
        $_session->setAttribute( 'INDEX', 0 ); //index to iterate on multi-tagged list

        $_dao = & CopixDAOFactory::create($entityName); 
        if ( ! $criteria ) $_list = & $_dao->findAll();
        else echo "Not yet implemented.<br>";
        
        $_name = 'get' .$entityName .'DataList';
        $_dataList = $this->$_name(); 
        
        $_msgList[] = CopixI18N::get ('views.' .strtolower($entityName) .'.list.choice');

        $_requestUrl = new ProjectUrl ( 'manage' .$entityName .'Data', null, 'workflow');
        return $this->showList( $entityName, $_dataList, $_list, $tagged, $_msgList, $_requestUrl );
    }

    /**
     * Gets the branch list page
     *
     * @access public
     */
    function getShowBranchList(){
        return $this->showEntityList( 'Branch' );
    }

    /**
     * Gets the Worker list page
     *
     * @access public
     */
    function getShowWorkerList(){
        return $this->showEntityList( 'Worker' );
    }

    /**
     * Gets the Contract list page
     *
     * @access public
     */
    function getShowContractList(){
        return $this->showEntityList( 'Contract' );
    }

    /**
     * Manage data
     *
     * @access private
     */
    function manageData($_entityName){
        $_entityName = $_entityName;
        $_view = new MenuTpl($_entityName .' data page');
        
        //list of variable names with their labels 
        $_name = 'get' .$_entityName .'DataList';
        $_dataList = $this->$_name(); 

        $_httpRequest = & HttpRequest::instance();
        $_session = & HttpSession::instance();

        $_main  = '';
        if ( $_httpRequest->getAttribute('quit') ) {
            $_session->setAttribute( 'TAGGED', null );
            $_session->setAttribute( 'ENTITY_NAME', null );

            $_requestUrl = new ProjectUrl ( 'workspace', null, 'workflow' );
            $_actionReturn = new CopixActionReturn( COPIX_AR_REDIRECT, $_requestUrl->getUrl(false) );
        }
        
elseif ($_entityName=='Contract') {
    echo "<b>Not yet implemented.</b><br><br><br><br>";
    $_requestUrl = new ProjectUrl ( 'show' .$_entityName .'List', null, 'workflow'); 
    $_actionReturn = new CopixActionReturn( COPIX_AR_REDIRECT, $_requestUrl->getUrl(false) );
    return $_actionReturn;
}
        elseif ( $_httpRequest->getAttribute('update') ) {
            $_index = $_session->getAttribute('INDEX');
            $_tagged = $_httpRequest->getAttribute('TAGGED');

            if ( $_tagged == null ) {
            	$_tagged = array();
            }
            elseif ( is_array($_tagged) ) {
            	// nothing to do...
            }
            else {
                $_tagged = array($_tagged);
            }
            $_session->setAttribute( 'TAGGED', $_tagged );
            
            if ( $_index < sizeOf($_tagged) ) {    // at least one selected item
                $_dao = & CopixDAOFactory::create($_entityName); 
                $_entity = & $_dao->get($_tagged[$_index]); 
                $_session->setAttribute( 'ENTITY', $_entity ); // use to check if any change

                $_name = 'get' .$_entityName .'DataList';
                $_dataList = $this->$_name(); 
         
                $_msgList[] = CopixI18N::get ('views.' .strtolower($_entityName) .'.data.show');
                foreach($_msgList as $_message) {
                    $_main .= '<p>' .$_message .'</p>' ."\n";
// TODO : Arghhh, du HTML ici !!!!
                }

                $_requestUrl = new ProjectUrl ( 'store' .$_entityName .'Data', null, 'workflow');
                $_main .= $this->processZone( 'showData'
                                            , array( 'entity'    => $_entity
                                                   , 'dataList'  => $_dataList
                                                   , 'requestUrl'=> $_requestUrl
                                                   ) );
                $_view->assign( 'MAIN', $_main );
                $_actionReturn = new CopixActionReturn(COPIX_AR_DISPLAY, $_view);
            }
            else { // no selection or end of it.
                $_requestUrl = new ProjectUrl ( 'show' .$_entityName .'List', null, 'workflow'); 
                $_actionReturn = new CopixActionReturn( COPIX_AR_REDIRECT, $_requestUrl->getUrl(false) );
            }  
        }
        elseif ( $_httpRequest->getAttribute('create') ) {

            $_session->setAttribute('INDEX', -1);// don't bother with TAGGED and tell to store function it's a creation
            $_index = $_session->getAttribute('INDEX');
            $_tagged = $_httpRequest->getAttribute('TAGGED');

            if ( $_tagged == null ) {
            	$_tagged = array();
            }
            elseif ( is_array($_tagged) ) {
            	// nothing to do...
            }
            else { 
                $_tagged = array($_tagged);
            }
            $_session->setAttribute( 'TAGGED', $_tagged );

//            if ( $_index < sizeOf($_tagged) ) {    // at least one selected item            
//                $_dao = & CopixDAOFactory::create($_entityName); 
//                $_entity = & $_dao->get($_tagged[$_index]); 
                $_entity = & CopixDAOFactory::createRecord($_entityName); 
/*
//                $_connection = & CopixDbFactory::getConnection();
//                $_Id = $_connection->lastId();
//                $_name = 'get' .$_entityName .'DataList';
//                $_dataList = $this->$_name(); 
//                $_idLabel = $_dataList['id']['var'];
//                $_entity->$_idLabel = $_Id;
 */
                $_session->setAttribute( 'ENTITY', $_entity ); // use to check if any change
         
                $_msgList[] = CopixI18N::get ('views.' .strtolower($_entityName) .'.data.new');
                foreach($_msgList as $_message) {
                    $_main .= '<p>' .$_message .'</p>' ."\n";
// TODO : Arghhh, du HTML ici !!!!
                }

                $_requestUrl = new ProjectUrl ( 'store' .$_entityName .'Data', null, 'workflow');
                $_main .= $this->processZone( 'showData'
                                            , array( 'entity'    => $_entity
                                                   , 'dataList'  => $_dataList
                                                   , 'requestUrl'=> $_requestUrl
                                                   ) );
                $_view->assign( 'MAIN', $_main );
                $_actionReturn = new CopixActionReturn(COPIX_AR_DISPLAY, $_view);
//            }
//            else { // no selection!
//                $_requestUrl = new ProjectUrl ( 'show' .$_entityName .'List', null, 'workflow'); 
//                $_actionReturn = new CopixActionReturn( COPIX_AR_REDIRECT, $_requestUrl->getUrl(false) );
//            }  
        }
        elseif ( $_httpRequest->getAttribute('delete') ) {

            $_index = $_session->getAttribute('INDEX');
            $_tagged = $_httpRequest->getAttribute('TAGGED');

            if ( $_tagged == null ) {
            	$_tagged = array();
            }
            elseif ( is_array($_tagged) ) {
            	// nothing to do...
            }
            else {
                $_tagged = array($_tagged);
            }
            $_session->setAttribute( 'TAGGED', $_tagged );
            if ( $_index < sizeOf($_tagged) ) {    // at least one selected item
                $_dao = & CopixDAOFactory::create($_entityName); 

                foreach($_tagged as $_key => $_id) {
                    $_dao->delete($_id); 
                    unset($_tagged[$_key]);
                }         

            $_session->setAttribute( 'TAGGED', $_tagged );

            }
            else { // no selection!
                // nothing to do: return to the list  
            }  
            $_requestUrl = new ProjectUrl ( 'show' .$_entityName .'List', null, 'workflow'); 
            $_actionReturn = new CopixActionReturn( COPIX_AR_REDIRECT, $_requestUrl->getUrl(false) );
        }
        else { //we stay on the list page
            $_requestUrl = new ProjectUrl ( 'show' .$_entityName .'List', null, 'workflow');                
            $_actionReturn = new CopixActionReturn( COPIX_AR_REDIRECT, $_requestUrl->getUrl(false) );
        }

        return $_actionReturn;
    }

    /**
     * Manage Branch data
     *
     * @access public
     */
    function getManageBranchData(){
        return $this->manageData( 'Branch' );
    }

    /**
     * Manage Worker data
     *
     * @access public
     */
    function getManageWorkerData(){
        return $this->manageData( 'Worker' );
    }

    /**
     * Manage Contract data
     *
     * @access public
     */
    function getManageContractData(){
        return $this->manageData( 'Contract' );
    }

    /**
     * Store data
     *
     * @access private
     */
    function storeData($entityName){
        $_entityName = $entityName;
        
        $_httpRequest = & HttpRequest::instance();
        $_session = & HttpSession::instance();
        $_tagged = $_session->getAttribute('TAGGED');
        $_index = $_session->getAttribute('INDEX');       
        $_create = ($_index < 0);       

        $_next = false;  
        if ( $_httpRequest->getAttribute('accept') ) {
            $_httpRequest->removeAttribute('accept');

            $_new = $_httpRequest->getAttribute('ENTITY');

            foreach ( $_session->getAttribute('ENTITY') as $_key => $_value ) {
               $_old[$_key] = $_value;
            }

            $_equal = true;
            foreach ( $_new as $_key => $_value ) {
            	
                if ($_value !== $_old[$_key]) {                    
    	            $_updated[$_key] = $_value;
                    $_equal = false;
    	        }
    	        else $_updated[$_key] = $_old[$_key];
            }

            if( ! $_equal ) {
                $_dao = & CopixDAOFactory::create($_entityName); 

                if ( $_create ) {
                    $_entity = & CopixDAOFactory::createRecord($_entityName); 

                    foreach ( $_updated as $_key => $_value ) {
                        $_entity->$_key = $_value;
                    }

            	    $_dao->insert($_entity);

                    $_connection = & CopixDbFactory::getConnection();
                    $_tagged[] = $_connection->lastId();

                }
                else {// update
                    $_dlname = 'get' .$_entityName .'DataList';
                    $_dataList = $this->$_dlname(); 
                    $_idLabel = $_dataList['id']['var'];
                    $_entity = $_dao->get($_updated[$_idLabel]);

                    foreach ( $_updated as $_key => $_value ) {
                        $_entity->$_key = $_value;
                    }

                    $_dao->update($_entity);            	
                }
            }
            
            ++$_index;// next one ?
            $_next = $_create || ( $_index < sizeOf($_tagged) );    
        }
        elseif ( $_httpRequest->getAttribute('cancel') ) {
            $_httpRequest->removeAttribute('cancel');
            ++$_index;// next one ?
            $_next = (! $_create) && ( $_index < sizeOf($_tagged) );    
        }
        else {
            // always return to the list
        }
        
        if ($_next) {
            $_session->setAttribute( 'INDEX', $_index );

            $_httpRequest->removeAttribute('ENTITY');
            $_forward = $_create?'create':'update';
            $_httpRequest->setAttribute($_forward, $_forward);
            // $_httpRequest->setAttribute('TAGGED', $_tagged);
            // TODO: la méthode CopixUrl::getUrl ne gère pas correctement les tableaux, d'où :
            foreach($_tagged as $_key => $_Id) {
                $_httpRequest->setAttribute('TAGGED['.$_key.']', $_Id);
            }

            $_requestUrl = new ProjectUrl ( 'manage'. $_entityName .'Data', null, 'workflow', $_httpRequest->toArray() );
        }
        else {
            $_requestUrl = new ProjectUrl ( 'show'. $_entityName .'List', null, 'workflow' );
        }
        return new CopixActionReturn( COPIX_AR_REDIRECT, $_requestUrl->getUrl(false) );
    }

    /**
     * Store Branch data
     *
     * @access public
     */
    function getStoreBranchData(){
        return $this->storeData( 'Branch' );
    }

    /**
     * Store Worker data
     *
     * @access public
     */
    function getStoreWorkerData(){
        return $this->storeData( 'Worker' );
    }

    /**
     * Store Contract data
     *
     * @access public
     */
    function getStoreContractData(){
        return $this->storeData( 'Contract' );
    }
}
?>
