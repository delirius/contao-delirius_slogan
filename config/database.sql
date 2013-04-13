-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************


-- --------------------------------------------------------


--
-- Table `tl_slogan_category`
--

CREATE TABLE `tl_slogan_category` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `published` char(1) NOT NULL default '',
  `title` varchar(128) NULL default '',
  PRIMARY KEY  (`id`),
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- 
-- Table `tl_slogan_data`
-- 

CREATE TABLE `tl_slogan_data` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `published` char(1) NULL default '',
  `title` varchar(255) NULL default '',
  `author` varchar(255) NULL default '',
  `teaser` text NULL,
  `slogan` text NULL,
  `image` varchar(128) NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `tl_module` (
  `delirius_slogan_number` int(10) unsigned NOT NULL default '0',
  `delirius_slogan_site` text NULL,
  `delirius_slogan_category` text NULL,
  `delirius_slogan_template` varchar(128) NOT NULL default '',
  `delirius_slogan_css` varchar(128) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;