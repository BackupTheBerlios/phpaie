# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# Serveur: localhost
# Généré le : Samedi 01 Mai 2004 à 23:36
# Version du serveur: 4.00.13
# Version de PHP: 4.3.1
# Base de données: `CopixWebApp`
# --------------------------------------------------------

#
# Structure de la table `test_copix_branch`
#

DROP TABLE IF EXISTS `test_copix_branch`;
CREATE TABLE `test_copix_branch` (
  `branch_id` int(11) NOT NULL auto_increment,
  `branch_name` char(30) NOT NULL default '',
  `branch_status` char(30) NOT NULL default '',
  `branch_email` char(80) default '',
  UNIQUE KEY `branch_id_index` (`branch_id`),
  KEY `branch_name_index` (`branch_name`)
) TYPE=InnoDB;

#
# Contenu de la table `test_copix_branch`
#

INSERT INTO `test_copix_branch` (`branch_id`, `branch_name`, `branch_status`, `branch_email`) VALUES (1, 'Les torchons déchaînés', 'SARL', 'dent@les-torchons-dechaines.com');
INSERT INTO `test_copix_branch` (`branch_id`, `branch_name`, `branch_status`, `branch_email`) VALUES (2, 'Trop cool', 'SA', 'pas.fou@tropcool.com');
# --------------------------------------------------------

#
# Structure de la table `test_copix_branch_id_seq`
#

DROP TABLE IF EXISTS `test_copix_branch_id_seq`;
CREATE TABLE `test_copix_branch_id_seq` (
  `sequence` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`sequence`)
) TYPE=MyISAM;

#
# Contenu de la table `test_copix_branch_id_seq`
#

INSERT INTO `test_copix_branch_id_seq` (`sequence`) VALUES (2);
# --------------------------------------------------------

#
# Structure de la table `test_copix_contract`
#

DROP TABLE IF EXISTS `test_copix_contract`;
CREATE TABLE `test_copix_contract` (
  `contract_id` int(11) NOT NULL auto_increment,
  `worker_id` int(11) NOT NULL default '0',
  `branch_id` int(11) NOT NULL default '0',
  `wage` int(11) default '0',
  `begin_date` datetime default NULL,
  `end_date` datetime default NULL,
  UNIQUE KEY `contract_id_index` (`contract_id`)
) TYPE=InnoDB;

#
# Contenu de la table `test_copix_contract`
#

INSERT INTO `test_copix_contract` (`contract_id`, `worker_id`, `branch_id`, `wage`, `begin_date`, `end_date`) VALUES (1, 1, 1, 1000, '2004-01-01 00:00:00', NULL);
INSERT INTO `test_copix_contract` (`contract_id`, `worker_id`, `branch_id`, `wage`, `begin_date`, `end_date`) VALUES (2, 2, 1, 2000, '2003-02-01 00:00:00', NULL);
INSERT INTO `test_copix_contract` (`contract_id`, `worker_id`, `branch_id`, `wage`, `begin_date`, `end_date`) VALUES (3, 3, 2, 3000, '2002-12-31 00:00:00', NULL);
# --------------------------------------------------------

#
# Structure de la table `test_copix_contract_id_seq`
#

DROP TABLE IF EXISTS `test_copix_contract_id_seq`;
CREATE TABLE `test_copix_contract_id_seq` (
  `sequence` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`sequence`)
) TYPE=MyISAM;

#
# Contenu de la table `test_copix_contract_id_seq`
#

INSERT INTO `test_copix_contract_id_seq` (`sequence`) VALUES (3);
# --------------------------------------------------------

#
# Structure de la table `test_copix_user`
#

DROP TABLE IF EXISTS `test_copix_user`;
CREATE TABLE `test_copix_user` (
  `user_id` int(11) NOT NULL default '0',
  `user_name` char(30) NOT NULL default '',
  `user_login` char(30) NOT NULL default '',
  `user_password` char(32) NOT NULL default '',
  `user_level` int(11) NOT NULL default '0',
  UNIQUE KEY `user_id_index` (`user_id`),
  UNIQUE KEY `user_login_index` (`user_login`),
  KEY `user_name_index` (`user_name`)
) TYPE=InnoDB;

#
# Contenu de la table `test_copix_user`
#

INSERT INTO `test_copix_user` (`user_id`, `user_name`, `user_login`, `user_password`, `user_level`) VALUES (1, 'Pierre', 'admin', '43e9a4ab75570f5b', 10);
INSERT INTO `test_copix_user` (`user_id`, `user_name`, `user_login`, `user_password`, `user_level`) VALUES (2, 'Laurent', 'patron', '54ee44527e8c24f9', 10);
INSERT INTO `test_copix_user` (`user_id`, `user_name`, `user_login`, `user_password`, `user_level`) VALUES (3, 'Laurence', 'chef', '309e6910634ab429', 10);
# --------------------------------------------------------

#
# Structure de la table `test_copix_user_id_seq`
#

DROP TABLE IF EXISTS `test_copix_user_id_seq`;
CREATE TABLE `test_copix_user_id_seq` (
  `sequence` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`sequence`)
) TYPE=MyISAM;

#
# Contenu de la table `test_copix_user_id_seq`
#

INSERT INTO `test_copix_user_id_seq` (`sequence`) VALUES (3);
# --------------------------------------------------------

#
# Structure de la table `test_copix_worker`
#

DROP TABLE IF EXISTS `test_copix_worker`;
CREATE TABLE `test_copix_worker` (
  `worker_id` int(11) NOT NULL auto_increment,
  `worker_first_name` char(40) default NULL,
  `worker_last_name` char(40) NOT NULL default '',
  `worker_email` char(60) default NULL,
  UNIQUE KEY `worker_id_index` (`worker_id`),
  KEY `worker_last_name_index` (`worker_last_name`)
) TYPE=InnoDB;

#
# Contenu de la table `test_copix_worker`
#

INSERT INTO `test_copix_worker` (`worker_id`, `worker_first_name`, `worker_last_name`, `worker_email`) VALUES (1, 'Laurence', 'Lafeuille', NULL);
INSERT INTO `test_copix_worker` (`worker_id`, `worker_first_name`, `worker_last_name`, `worker_email`) VALUES (2, 'Adrien', 'Tournet', NULL);
INSERT INTO `test_copix_worker` (`worker_id`, `worker_first_name`, `worker_last_name`, `worker_email`) VALUES (3, 'Mike', 'Garnet', NULL);
# --------------------------------------------------------

#
# Structure de la table `test_copix_worker_id_seq`
#

DROP TABLE IF EXISTS `test_copix_worker_id_seq`;
CREATE TABLE `test_copix_worker_id_seq` (
  `sequence` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`sequence`)
) TYPE=MyISAM;

#
# Contenu de la table `test_copix_worker_id_seq`
#

INSERT INTO `test_copix_worker_id_seq` (`sequence`) VALUES (3);

