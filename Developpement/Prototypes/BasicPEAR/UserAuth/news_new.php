<?php
// print ">".__FILE__.":".__LINE__."< <br>";
  // CREATING ENVIRONMENT
//`echo PASSE news_new require_once main before >> test.txt`;
// print getEnv('DOCUMENT_ROOT');  
// exit (0);
//  require_once getEnv('DOCUMENT_ROOT') . '/main.inc.php';
// print ">".__FILE__.":".__LINE__."< <br>";
  require_once 'main.inc.php';
//`echo PASSE news_new require_once main after >> test.txt`;

// print ">".__FILE__.":".__LINE__."< <br>";
  // If the user hasn't the right to write news -> access denied.
  if (!$LU->checkRight(RIGHT_NEWS_NEW)) {
// print ">".__FILE__.":".__LINE__."< <br>";
      $tpl->loadTemplatefile('news_notallowed.tpl.php');
//      include_once WEB_ROOT . '/finish.inc.php';
      include_once 'finish.inc.php';
     exit();
  }

 print ">".__FILE__.":".__LINE__."< <br>";
  $tpl->loadTemplatefile('news_new.tpl.php');

  // Read form data.
  $news     = isset($_POST['news'])     ? $_POST['news'] : '';
  $valid_to = isset($_POST['valid_to']) ? (int)$_POST['valid_to'] : '';
  $group    = isset($_POST['group_id']) ? (int)$_POST['group_id'] : '';

// print ">".__FILE__.":".__LINE__."< <br>";

  // If $news is not empty, we have something to work.
  if (!empty($news)) {

      if (!ereg('^[1-9][0-9]?$', $valid_to)) {
          $tpl->setVariable('script_msg', '<p><font color="red">Only numbers between 1 and 99 are allowed here.</font></p>');
      }

      elseif (!$LU->checkRightLevel(RIGHT_NEWS_NEW, $LU->getProperty('permUserId'), $group)) {
          $tpl->setVariable('script_msg', '<p><font color="red">You don\'t have the right to post news for this group.</font></p>');
      }

      // Form seems to be correct. Write data into the db.
      else {
          $news = str_replace("\r\n",'<br>',$news);

          $db->query('INSERT INTO
                      news (
                          created_at,
                          valid_to,
                          news,
                          owner_user_id,
                          owner_group_id
                      )
                      VALUES (
                          NOW(),
                          '.$db->quote(date('Y.m.d H:i:s', time()+60*60*24*7*$valid_to)).',
                          '.$db->quote(addslashes($news)).',
                          '.$db->quote($LU->getProperty('permUserId')).',
                          '.$group.')');

          $tpl->setVariable('script_msg', '<p><b>News has been added.</b></p>');

          // NULL form data.
          $news     = '';
          $valid_to = '';
          $group    = '';
      }
  }

// print ">".__FILE__.":".__LINE__."< <br>";
  $tpl->setVariable('form_action', 'news_new.php');

  if (!empty($news)) {
      $tpl->setVariable('message', $news);
  }

  if (!empty($valid_to)) {
      $tpl->setVariable('valid', $valid_to);
  } else {
      $tpl->setVariable('valid', '2');
  }

  // If the user is member in more than one group, show them.
  if (count($LU->getProperty('groupIds')) > 1) {
      $res = $db->query('SELECT
                             group_id,
                             group_comment
                         FROM
                             liveuser_group_names
                         WHERE
                             group_id IN ('.implode(', ', $LU->getProperty('groupIds')).')
                         ORDER BY
                             group_id');

      while ($row = $res->fetchRow()) {
          $tpl->setCurrentBlock('choose_group');
          $tpl->setVariable(array('value' => $row['group_id'],
                                  'label' => $row['group_comment']));
          if ($group == $row['group_id']) {
              $tpl->setVariable('selected', 'selected');
          }
          $tpl->parseCurrentBlock();
      }

  } else {
      $tpl->setCurrentBlock('set_group');
      $tpl->setVariable('group_id', current($LU->getProperty('groupIds')));
      $tpl->parseCurrentBlock();
  }
//      include_once WEB_ROOT . '/finish.inc.php';
// print ">".__FILE__.":".__LINE__."< <br>";
      include_once 'finish.inc.php';
?>
