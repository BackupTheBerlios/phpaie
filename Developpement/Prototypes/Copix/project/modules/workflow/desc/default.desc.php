<?php
/**
* @package	phpaie
* @subpackage   workflow
* @version	
* @author	Pierre Raoul
*               see www.phpaie.fr for other contributors.
* @copyright    2003-2004 Pierre Raoul
* @link		http://www.phpaie.fr
* @licence      http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public Licence, see LICENCE file
*/

$workspace        = & new CopixAction( 'Workflow'
                                     , 'getWorkspace'
                                     , array( 'Auth' => 10 )
                                     );
$showBranchList   = & new CopixAction( 'Workflow'
                                     , 'getShowBranchList'
                                     , array( 'Auth' => 10 )
                                     );
$showWorkerList   = & new CopixAction( 'Workflow'
                                     , 'getShowWorkerList'
                                     , array( 'Auth' => 10 )
                                     );
$showContractList = & new CopixAction( 'Workflow'
                                     , 'getShowContractList'
                                     , array( 'Auth' => 10 )
                                     );
$manageBranchData   = & new CopixAction( 'Workflow'
                                     , 'getManageBranchData'
                                     , array( 'Auth' => 10 )
                                     );
$manageWorkerData   = & new CopixAction( 'Workflow'
                                     , 'getManageWorkerData'
                                     , array( 'Auth' => 10 )
                                     );
$manageContractData = & new CopixAction( 'Workflow'
                                     , 'getManageContractData'
                                     , array( 'Auth' => 10 )
                                     );
$storeBranchData   = & new CopixAction( 'Workflow'
                                     , 'getStoreBranchData'
                                     , array( 'Auth' => 10 )
                                     );
$storeWorkerData   = & new CopixAction( 'Workflow'
                                     , 'getStoreWorkerData'
                                     , array( 'Auth' => 10 )
                                     );
$storeContractData = & new CopixAction( 'Workflow'
                                     , 'getStoreContractData'
                                     , array( 'Auth' => 10 )
                                     );
$default          = & $workspace;
?>
