<?php
  // we could also make a db query, but I'm too lazy at this point ;-)
  $groups = array('', 'Admins', 'GroupA', 'GroupB');
//print "<H1><".__FILE__.",".__LINE__."><br\>".print_r($this)."</H1>";
//ob_flush();
//exit(0);
$userGroups = array();
  foreach ($LU->getProperty('groupIds') as $id) {
      $userGroups[] = $groups[$id];
  }

  $tpl->setVariable(array('user'         => $LU->getProperty('handle'),
                          'group'        => implode(', ', $userGroups),
                          'lastLogin'    => date('d.m.Y H:i', $LU->getProperty('lastLogin'))));
  $tpl->touchBlock($tpl->currentBlock);
  $tpl->show();
  
?>