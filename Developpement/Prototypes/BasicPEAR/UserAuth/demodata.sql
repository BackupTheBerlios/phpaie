# phpMyAdmin MySQL-Dump
# version 2.4.0
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Mar 16, 2003 at 11:12 PM
# Server version: 3.23.52
# PHP Version: 4.2.0
# Database : `test`
# --------------------------------------------------------

#
# Table structure for table `liveuser_application_names`
#

CREATE TABLE liveuser_application_names (
  application_id int(10) unsigned NOT NULL default '0',
  language_id smallint(5) unsigned NOT NULL default '0',
  application_name varchar(20) NOT NULL default '',
  application_comment varchar(255) default NULL,
  KEY IDX_liveuser_application_names_application_id (application_id),
  KEY IDX_liveuser_application_names_language_id (language_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_application_names`
#

INSERT INTO liveuser_application_names VALUES (1, 1, 'BACKOFFICE', 'BackOffice for testing');
# --------------------------------------------------------

#
# Table structure for table `liveuser_applications`
#

CREATE TABLE liveuser_applications (
  application_id int(10) unsigned NOT NULL default '0',
  application_define_name varchar(20) NOT NULL default '',
  PRIMARY KEY  (application_id),
  UNIQUE KEY UC_application_define_name (application_define_name)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_applications`
#

INSERT INTO liveuser_applications VALUES (1, 'BACKOFFICE');
# --------------------------------------------------------

#
# Table structure for table `liveuser_area_admin_areas`
#

CREATE TABLE liveuser_area_admin_areas (
  area_id int(10) unsigned NOT NULL default '0',
  perm_user_id bigint(20) unsigned NOT NULL default '0',
  KEY IDX_liveuser_area_admin_areas_area_id (area_id),
  KEY IDX_liveuser_area_admin_areas_user_id (perm_user_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_area_admin_areas`
#

# --------------------------------------------------------

#
# Table structure for table `liveuser_area_names`
#

CREATE TABLE liveuser_area_names (
  area_id int(10) unsigned NOT NULL default '0',
  language_id smallint(5) unsigned NOT NULL default '0',
  area_name varchar(20) NOT NULL default '',
  area_comment varchar(255) default NULL,
  KEY IDX_liveuser_area_names_area_id (area_id),
  KEY IDX_liveuser_area_names_language_id (language_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_area_names`
#

INSERT INTO liveuser_area_names VALUES (1, 1, 'NEWS', 'News');
# --------------------------------------------------------

#
# Table structure for table `liveuser_areas`
#

CREATE TABLE liveuser_areas (
  area_id int(10) unsigned NOT NULL default '0',
  application_id int(10) unsigned NOT NULL default '0',
  area_define_name varchar(20) NOT NULL default '',
  PRIMARY KEY  (area_id),
  UNIQUE KEY UC_area_id (area_id),
  KEY IDX_liveuser_areas_application_id (application_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_areas`
#

INSERT INTO liveuser_areas VALUES (1, 1, 'NEWS');
# --------------------------------------------------------

#
# Table structure for table `liveuser_group_names`
#

CREATE TABLE liveuser_group_names (
  group_id int(11) NOT NULL default '0',
  language_id smallint(5) unsigned NOT NULL default '0',
  group_name varchar(20) NOT NULL default '',
  group_comment varchar(255) default NULL,
  KEY IDX_liveuser_group_names_group_id (group_id),
  KEY IDX_liveuser_group_names_language_id (language_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_group_names`
#

INSERT INTO liveuser_group_names VALUES (1, 1, 'ADMINS', 'The admin group can change everything.');
INSERT INTO liveuser_group_names VALUES (2, 1, 'GroupA', 'Standard user group.');
INSERT INTO liveuser_group_names VALUES (3, 1, 'GroupB', 'Another group.');
# --------------------------------------------------------

#
# Table structure for table `liveuser_group_subgroups`
#

CREATE TABLE liveuser_group_subgroups (
  group_id int(11) NOT NULL default '0',
  subgroup_id int(11) NOT NULL default '0',
  KEY IDX_liveuser_group_subgroups_group_id (group_id),
  KEY IDX_liveuser_group_subgroups_subgroup_id (subgroup_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_group_subgroups`
#

# --------------------------------------------------------

#
# Table structure for table `liveuser_grouprights`
#

CREATE TABLE liveuser_grouprights (
  group_id int(11) NOT NULL default '0',
  right_id int(10) unsigned NOT NULL default '0',
  right_level tinyint(3) unsigned default NULL,
  KEY IDX_liveuser_grouprights_group_id (group_id),
  KEY IDX_liveuser_grouprights_right_id (right_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_grouprights`
#

INSERT INTO liveuser_grouprights VALUES (1, 3, 3);
INSERT INTO liveuser_grouprights VALUES (2, 3, 2);
INSERT INTO liveuser_grouprights VALUES (3, 2, 1);
# --------------------------------------------------------

#
# Table structure for table `liveuser_groups`
#

CREATE TABLE liveuser_groups (
  group_id int(11) NOT NULL default '0',
  owner_user_id bigint(20) unsigned NOT NULL default '0',
  owner_group_id int(11) NOT NULL default '0',
  is_active char(1) NOT NULL default 'N',
  group_define_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (group_id),
  UNIQUE KEY UC_group_id (group_id),
  KEY IDX_liveuser_groups_owner_user_id (owner_user_id),
  KEY IDX_liveuser_groups_owner_group_id (owner_group_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_groups`
#

INSERT INTO liveuser_groups VALUES (1, 0, 0, 'Y', 'ADMINS');
INSERT INTO liveuser_groups VALUES (2, 0, 0, 'Y', 'GroupA');
INSERT INTO liveuser_groups VALUES (3, 0, 0, 'Y', 'GroupB');
# --------------------------------------------------------

#
# Table structure for table `liveuser_groupusers`
#

CREATE TABLE liveuser_groupusers (
  perm_user_id bigint(20) unsigned NOT NULL default '0',
  group_id int(11) NOT NULL default '0',
  KEY IDX_liveuser_groupusers_user_id (perm_user_id),
  KEY IDX_liveuser_groupusers_group_id (group_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_groupusers`
#

INSERT INTO liveuser_groupusers VALUES (1, 1);
INSERT INTO liveuser_groupusers VALUES (2, 2);
INSERT INTO liveuser_groupusers VALUES (2, 3);
INSERT INTO liveuser_groupusers VALUES (3, 2);
INSERT INTO liveuser_groupusers VALUES (4, 3);
# --------------------------------------------------------

#
# Table structure for table `liveuser_language_names`
#

CREATE TABLE liveuser_language_names (
  language_id smallint(5) unsigned NOT NULL default '0',
  native_language_id smallint(5) unsigned NOT NULL default '0',
  native_name varchar(50) default NULL,
  KEY IDX_liveuser_language_names_language_id (language_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_language_names`
#

INSERT INTO liveuser_language_names VALUES (1, 1, 'English');
# --------------------------------------------------------

#
# Table structure for table `liveuser_languages`
#

CREATE TABLE liveuser_languages (
  language_id smallint(5) unsigned NOT NULL default '0',
  two_letter_name char(2) default NULL,
  native_name varchar(50) default NULL,
  PRIMARY KEY  (language_id),
  UNIQUE KEY UC_language_id (language_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_languages`
#

INSERT INTO liveuser_languages VALUES (1, 'en', 'English');
# --------------------------------------------------------

#
# Table structure for table `liveuser_perm_users`
#

CREATE TABLE liveuser_perm_users (
  perm_user_id bigint(20) unsigned NOT NULL default '0',
  auth_user_id varchar(32) NOT NULL default '0',
  type tinyint(3) unsigned default NULL,
  auth_container_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (perm_user_id),
  UNIQUE KEY UC_user_id (perm_user_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_perm_users`
#

INSERT INTO liveuser_perm_users VALUES (1, 'c14cbf141ab1b7cd009356f555b607dc', 1, '');
INSERT INTO liveuser_perm_users VALUES (2, '185cd5095e899ab43a225e42d7232807', 1, '');
INSERT INTO liveuser_perm_users VALUES (3, '11551a03b7de857163fd2e519c16a960', 1, '');
INSERT INTO liveuser_perm_users VALUES (4, '7ddf260b66b9a5c182a91a413f1aa461', 1, '');
# --------------------------------------------------------

#
# Table structure for table `liveuser_right_implied`
#

CREATE TABLE liveuser_right_implied (
  right_id int(10) unsigned NOT NULL default '0',
  implied_right_id int(10) unsigned NOT NULL default '0',
  KEY IDX_liveuser_right_implied_right_id (right_id),
  KEY IDX_liveuser_right_implied_implied_right_id (implied_right_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_right_implied`
#

INSERT INTO liveuser_right_implied VALUES (2, 1);
INSERT INTO liveuser_right_implied VALUES (3, 2);
# --------------------------------------------------------

#
# Table structure for table `liveuser_right_scopes`
#

CREATE TABLE liveuser_right_scopes (
  right_id int(10) unsigned NOT NULL default '0',
  type tinyint(3) unsigned NOT NULL default '0',
  KEY IDX_liveuser_right_scopes_right_id (right_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_right_scopes`
#

# --------------------------------------------------------

#
# Table structure for table `liveuser_rights`
#

CREATE TABLE liveuser_rights (
  right_id int(10) unsigned NOT NULL default '0',
  area_id int(10) unsigned NOT NULL default '0',
  right_define_name varchar(50) NOT NULL default '',
  has_implied char(1) NOT NULL default 'N',
  has_level char(1) NOT NULL default 'N',
  has_scope char(1) NOT NULL default 'N',
  PRIMARY KEY  (right_id),
  UNIQUE KEY UC_right_id (right_id),
  KEY IDX_liveuser_rights_area_id (area_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_rights`
#

INSERT INTO liveuser_rights VALUES (1, 1, 'NEW', 'N', 'N', 'N');
INSERT INTO liveuser_rights VALUES (2, 1, 'CHANGE', 'Y', 'Y', 'N');
INSERT INTO liveuser_rights VALUES (3, 1, 'DELETE', 'Y', 'Y', 'N');
# --------------------------------------------------------

#
# Table structure for table `liveuser_rights_names`
#

CREATE TABLE liveuser_rights_names (
  right_id int(10) unsigned NOT NULL default '0',
  language_id smallint(5) unsigned NOT NULL default '0',
  right_name varchar(20) NOT NULL default '',
  right_comment varchar(255) default NULL,
  KEY IDX_liveuser_rights_names_right_id (right_id),
  KEY IDX_liveuser_rights_names_language_id (language_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_rights_names`
#

INSERT INTO liveuser_rights_names VALUES (1, 1, 'NEW', 'Write news');
INSERT INTO liveuser_rights_names VALUES (2, 1, 'CHANGE', 'Change news');
INSERT INTO liveuser_rights_names VALUES (3, 1, 'DELETE', 'Delete news');
# --------------------------------------------------------

#
# Table structure for table `liveuser_userrights`
#

CREATE TABLE liveuser_userrights (
  perm_user_id bigint(20) unsigned NOT NULL default '0',
  right_id int(10) unsigned NOT NULL default '0',
  right_level tinyint(3) unsigned default NULL,
  KEY IDX_liveuser_userrights_user_id (perm_user_id),
  KEY IDX_liveuser_userrights_right_id (right_id)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_userrights`
#

INSERT INTO liveuser_userrights VALUES (2, 2, 3);
# --------------------------------------------------------

#
# Table structure for table `liveuser_users`
#

CREATE TABLE liveuser_users (
  auth_user_id varchar(32) NOT NULL default '0',
  handle varchar(32) NOT NULL default '',
  passwd varchar(32) NOT NULL default '',
  currentlogin datetime default NULL,
  lastlogin datetime default NULL,
  owner_user_id bigint(20) unsigned default NULL,
  owner_group_id int(11) unsigned default NULL,
  is_active char(1) NOT NULL default 'N',
  UNIQUE KEY auth_user_id (auth_user_id,handle),
  KEY auth_user_id_2 (auth_user_id,handle)
) TYPE=MyISAM;

#
# Dumping data for table `liveuser_users`
#

INSERT INTO liveuser_users VALUES ('c14cbf141ab1b7cd009356f555b607dc', 'admin', '098f6bcd4621d373cade4e832627b4f6', '2003-03-16 23:02:06', '1999-11-30 00:00:00', NULL, NULL, 'Y');
INSERT INTO liveuser_users VALUES ('185cd5095e899ab43a225e42d7232807', 'userA', '098f6bcd4621d373cade4e832627b4f6', '2003-03-16 23:01:56', '2003-03-16 22:34:44', NULL, NULL, 'Y');
INSERT INTO liveuser_users VALUES ('11551a03b7de857163fd2e519c16a960', 'userB', '098f6bcd4621d373cade4e832627b4f6', '2003-03-16 23:01:45', '2003-03-16 22:16:44', NULL, NULL, 'Y');
INSERT INTO liveuser_users VALUES ('7ddf260b66b9a5c182a91a413f1aa461', 'userC', '098f6bcd4621d373cade4e832627b4f6', '2003-03-16 22:53:23', '2003-03-16 22:43:29', NULL, NULL, 'Y');
# --------------------------------------------------------

#
# Table structure for table `news`
#

CREATE TABLE news (
  news_id int(11) NOT NULL auto_increment,
  created_at datetime NOT NULL default '0000-00-00 00:00:00',
  valid_to datetime NOT NULL default '0000-00-00 00:00:00',
  news text NOT NULL,
  owner_user_id bigint(20) NOT NULL default '0',
  owner_group_id int(11) NOT NULL default '0',
  PRIMARY KEY  (news_id),
  KEY news_id (news_id),
  KEY valid_to (valid_to)
) TYPE=MyISAM PACK_KEYS=1;

#
# Dumping data for table `news`
#

INSERT INTO news VALUES (1, '2003-03-16 22:17:21', '2003-03-30 23:17:21', 'Just testing my rights.', 3, 2);
INSERT INTO news VALUES (2, '2003-03-16 21:53:41', '2003-04-13 22:53:41', 'Another test ;-)', 1, 1);
INSERT INTO news VALUES (3, '2003-03-16 22:42:27', '2003-04-06 23:42:27', 'Yeah! I can make some test postings here', 2, 2);
INSERT INTO news VALUES (4, '2003-03-16 23:00:29', '2003-03-23 23:00:29', 'LiveUser is really a cool tool :-)', 4, 3);