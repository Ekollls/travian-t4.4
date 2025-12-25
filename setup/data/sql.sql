SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL,
  `lastmedal` int(11) NOT NULL,
  `lastioasisUpdate` int(11) NOT NULL,
  `lastAchiev` int(11) NOT NULL,
  `regstatus` int(11) NOT NULL,
  `global` longtext NOT NULL,
  `SERVER_NAME` text NOT NULL,
  `DEFAULT_GOLD` int(11) NOT NULL,
  `AUCTIONTIME` int(11) NOT NULL,
  `GP_LOCATE` text NOT NULL,
  `OPENING` int(11) NOT NULL,
  `OASISX` int(11) NOT NULL,
  `SPEED` int(11) NOT NULL,
  `MOMENT_TRAIN` tinyint(1) NOT NULL,
  `ARTEFACTS` int(11) NOT NULL,
  `WW_PLAN` int(11) NOT NULL,
  `CRANNY_CAP` int(11) NOT NULL,
  `ADV_TIME` int(11) NOT NULL,
  `TRAPPER_CAPACITY` int(11) NOT NULL,
  `STORAGE_MULTIPLIER` int(11) NOT NULL,
  `INCREASE_SPEED` int(11) NOT NULL,
  `PROTECTIOND` int(11) NOT NULL,
  `TRADER_CAPACITY` int(11) NOT NULL,
  `PLUS_TIME` int(11) NOT NULL,
  `PLUS_PRODUCTION` int(11) NOT NULL,
  `HOMEPAGE` text NOT NULL,
  `adminMail` text NOT NULL,
  `Plus` int(11) NOT NULL,
  `goldClub` int(11) NOT NULL,
  `addonProduction` int(11) NOT NULL,
  `plusFeatures` int(11) NOT NULL,
  `storageUpgrade` int(11) NOT NULL,
  `25pFaster` int(11) NOT NULL,
  `allSmithy` int(11) NOT NULL,
  `searchAll` int(11) NOT NULL,
  `resources01` int(11) NOT NULL,
  `resources02` int(11) NOT NULL,
  `resources03` int(11) NOT NULL,
  `protect01` int(11) NOT NULL,
  `protect02` int(11) NOT NULL,
  `protect03` int(11) NOT NULL,
  `resources01A` int(11) NOT NULL,
  `resources02A` int(11) NOT NULL,
  `resources03A` int(11) NOT NULL,
  `Lang` text NOT NULL,
  `fvillage` int(11) NOT NULL,
  `fvillaged` int(11) NOT NULL,
  `catapult_c` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `servers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `link` (`link`);

ALTER TABLE `servers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

CREATE TABLE IF NOT EXISTS `buygold` (
`id` int(11) unsigned NOT NULL,
  `email` varchar(40) NOT NULL,
  `tarif` varchar(1) NOT NULL,
  `gold` int(11) unsigned NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `buygold` ADD PRIMARY KEY (`id`);

ALTER TABLE `buygold` MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
 
CREATE TABLE IF NOT EXISTS `odemeler` (
`id` int(11) unsigned NOT NULL,
  `email` varchar(150) NOT NULL,
  `durum` varchar(255) NOT NULL,
  `aciklama` varchar(255) NOT NULL,
  `tip` varchar(50) NOT NULL,
  `miktar` int(11) unsigned NOT NULL,
  `anahtar` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `odemeler` ADD PRIMARY KEY (`id`);

ALTER TABLE `odemeler` MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

CREATE TABLE `paketler` (
  `id` int(11) NOT NULL,
  `paketadi` varchar(250) NOT NULL,
  `fiyat` decimal(15,2) NOT NULL DEFAULT '0.00',
  `miktar` int(11) NOT NULL DEFAULT '0',
  `cark` int(11) NOT NULL DEFAULT '0',
  `tip` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `paketler` (`id`, `paketadi`, `fiyat`, `miktar`, `cark`, `tip`) VALUES
(1, '10 ÇARK ÇEVİRME', '30.00', 10, 0, 'cark'),
(2, '20 ÇARK ÇEVİRME', '60.00', 20, 0, 'cark'),
(3, '30 ÇARK ÇEVİRME', '90.00', 30, 0, 'cark'),
(4, '40 ÇARK ÇEVİRME', '120.00', 40, 0, 'cark'),
(5, '50 ÇARK ÇEVİRME', '140.00', 50, 0, 'cark'),
(6, '100 ALTIN', '10.00', 10, 1, 'gold'),
(7, '250 ALTIN', '20.00', 250, 2, 'gold'),
(8, '600 ALTIN', '40.00', 600, 3, 'gold'),
(9, '1600 ALTIN', '100.00', 1600, 4, 'gold'),
(10, '3300 ALTIN', '200.00', 3300, 5, 'gold');

ALTER TABLE `paketler`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `paketler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `email` varchar(30) NOT NULL,
  `gold` int(11) unsigned NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `server` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `newproc` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `npw` varchar(45) NOT NULL,
  `nemail` varchar(45) NOT NULL,
  `act` varchar(10) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `proc` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `achiev` (
  `uid` int(11) NOT NULL,
  `a1` tinyint(3) NOT NULL DEFAULT '0',
  `a2` tinyint(3) NOT NULL DEFAULT '0',
  `a3` tinyint(3) NOT NULL DEFAULT '0',
  `a4` tinyint(3) NOT NULL DEFAULT '0',
  `a5` smallint(5) NOT NULL DEFAULT '0',
  `a6` tinyint(3) NOT NULL DEFAULT '0',
  `a7` tinyint(3) NOT NULL DEFAULT '0',
  `a8` tinyint(3) NOT NULL DEFAULT '0',
  `a9` tinyint(3) NOT NULL DEFAULT '0',
  `a10` tinyint(3) NOT NULL DEFAULT '0',
  `reward1` varchar(3) NOT NULL DEFAULT '0',
  `reward2` varchar(3) NOT NULL DEFAULT '0',
  `reward3` varchar(3) NOT NULL DEFAULT '0',
  `reward4` varchar(3) NOT NULL DEFAULT '0',
  `points` tinyint(3) NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sitters` (
  `uid` mediumint(5) NOT NULL,
  `s1` int(11) NOT NULL DEFAULT '1',
  `s2` int(11) NOT NULL DEFAULT '1',
  `s3` int(11) NOT NULL DEFAULT '1',
  `s4` int(11) NOT NULL DEFAULT '0',
  `s5` int(11) NOT NULL DEFAULT '1',
  `s6` int(11) NOT NULL DEFAULT '0',
  `s21` int(11) NOT NULL DEFAULT '1',
  `s22` int(11) NOT NULL DEFAULT '1',
  `s23` int(11) NOT NULL DEFAULT '1',
  `s24` int(11) NOT NULL DEFAULT '0',
  `s25` int(11) NOT NULL DEFAULT '1',
  `s26` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `a2b` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ckey` varchar(255) NOT NULL,
  `time_check` int(11) unsigned NOT NULL DEFAULT '0',
  `to_vid` int(11) unsigned NOT NULL,
  `u1` bigint(19) NOT NULL,
  `u2` bigint(19) NOT NULL,
  `u3` bigint(19) NOT NULL,
  `u4` bigint(19) NOT NULL,
  `u5` bigint(19) NOT NULL,
  `u6` bigint(19) NOT NULL,
  `u7` bigint(19) NOT NULL,
  `u8` bigint(19) NOT NULL,
  `u9` bigint(19) NOT NULL,
  `u10` tinyint(1) NOT NULL,
  `u11` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ckey` (`ckey`,`time_check`),
  KEY `to_vid` (`to_vid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `map_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` smallint(5) NOT NULL,
  `hash` text NOT NULL,
  `x0` smallint(4) NOT NULL,
  `x1` smallint(4) NOT NULL,
  `y0` smallint(4) NOT NULL,
  `y1` smallint(4) NOT NULL,
  `version` smallint(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `prisoners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  `t11` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `abdata` (
  `vref` int(11) unsigned NOT NULL,
  `a1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `activate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `access` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `act` varchar(10) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `location` tinyint(1) NOT NULL,
  `act2` varchar(10) NOT NULL,
  `ref` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `act` (`act`,`act2`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `adventure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `dif` tinyint(1) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `x` smallint(4) NOT NULL DEFAULT '0',
  `y` smallint(4) NOT NULL DEFAULT '0',
  `time` int(11) unsigned NOT NULL,
  `end` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `alidata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `leader` int(11) unsigned NOT NULL,
  `notice` text NOT NULL,
  `desc` text NOT NULL,
  `max` tinyint(2) unsigned NOT NULL,
  `ap` bigint(255) unsigned NOT NULL DEFAULT '0',
  `dp` bigint(255) unsigned NOT NULL DEFAULT '0',
  `Rc` bigint(255) unsigned NOT NULL DEFAULT '0',
  `RR` bigint(255) NOT NULL DEFAULT '0',
  `Aap` bigint(255) unsigned NOT NULL DEFAULT '0',
  `Adp` bigint(255) unsigned NOT NULL DEFAULT '0',
  `clp` bigint(255) NOT NULL DEFAULT '0',
  `oldrank` bigint(255) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ali_invite` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `accept` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ali_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ali_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `rank` varchar(100) NOT NULL,
  `opt1` int(1) unsigned NOT NULL DEFAULT '0',
  `opt2` int(1) unsigned NOT NULL DEFAULT '0',
  `opt3` int(1) unsigned NOT NULL DEFAULT '0',
  `opt4` int(1) unsigned NOT NULL DEFAULT '0',
  `opt5` int(1) unsigned NOT NULL DEFAULT '0',
  `opt6` int(1) unsigned NOT NULL DEFAULT '0',
  `opt7` int(1) unsigned NOT NULL DEFAULT '0',
  `opt8` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `antimult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(40) CHARACTER SET latin1 NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `artefacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `size` tinyint(1) unsigned NOT NULL,
  `conquered` int(11) unsigned NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `attacks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `t1` bigint(11) NOT NULL,
  `t2` bigint(11) NOT NULL,
  `t3` bigint(11) NOT NULL,
  `t4` bigint(11) NOT NULL,
  `t5` bigint(11) NOT NULL,
  `t6` bigint(11) NOT NULL,
  `t7` bigint(11) NOT NULL,
  `t8` bigint(11) NOT NULL,
  `t9` int(11) NOT NULL,
  `t10` int(11) NOT NULL,
  `t11` int(11) NOT NULL,
  `attack_type` tinyint(1) NOT NULL,
  `ctar1` tinyint(3) NOT NULL,
  `ctar2` tinyint(3) NOT NULL,
  `spy` tinyint(3) NOT NULL,
  `artefact` smallint(3) NOT NULL DEFAULT '0',
  `add` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `vref` (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `auction` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `itemid` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `btype` int(11) unsigned NOT NULL,
  `type` int(11) unsigned NOT NULL,
  `num` int(11) unsigned NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `bids` int(11) NOT NULL,
  `silver` int(11) NOT NULL,
  `newsilver` int(11) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `finish` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `banlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `reason` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `end` varchar(10) NOT NULL,
  `admin` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `bdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) unsigned NOT NULL,
  `field` tinyint(2) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `loopcon` tinyint(1) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `master` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `wid` (`wid`),
  KEY `master` (`master`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `demolition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `buildnumber` int(11) unsigned NOT NULL DEFAULT '0',
  `timetofinish` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `diplomacy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `alli1` int(11) unsigned NOT NULL,
  `alli2` int(11) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `accepted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `enforcement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `u1` bigint(19) NOT NULL DEFAULT '0',
  `u2` bigint(19) NOT NULL DEFAULT '0',
  `u3` bigint(19) NOT NULL DEFAULT '0',
  `u4` bigint(19) NOT NULL DEFAULT '0',
  `u5` bigint(19) NOT NULL DEFAULT '0',
  `u6` bigint(19) NOT NULL DEFAULT '0',
  `u7` bigint(19) NOT NULL DEFAULT '0',
  `u8` bigint(19) NOT NULL DEFAULT '0',
  `u9` int(11) NOT NULL DEFAULT '0',
  `u10` int(11) NOT NULL DEFAULT '0',
  `u11` tinyint(1) NOT NULL DEFAULT '0',
  `from` int(11) unsigned NOT NULL DEFAULT '0',
  `vref` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from` (`from`),
  KEY `vref` (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `farmlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `laststart` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `fdata` (
  `vref` int(11) unsigned NOT NULL,
  `f1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f1t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `wwname` varchar(100) NOT NULL DEFAULT 'WW',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

CREATE TABLE IF NOT EXISTS `hero` (
  `heroid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `wref` int(11) unsigned NOT NULL,
  `level` mediumint(3) unsigned NOT NULL,
  `speed` int(2) unsigned NOT NULL,
  `points` int(3) unsigned NOT NULL,
  `experience` int(11) NOT NULL,
  `dead` tinyint(1) NOT NULL,
  `health` float(12,9) unsigned NOT NULL,
  `power` int(11) unsigned NOT NULL,
  `itempower` int(11) unsigned NOT NULL,
  `offBonus` tinyint(3) unsigned NOT NULL,
  `defBonus` tinyint(3) unsigned NOT NULL,
  `product` tinyint(3) unsigned NOT NULL,
  `r0` tinyint(1) unsigned NOT NULL,
  `r1` tinyint(1) unsigned NOT NULL,
  `r2` tinyint(1) unsigned NOT NULL,
  `r3` tinyint(1) unsigned NOT NULL,
  `r4` tinyint(1) unsigned NOT NULL,
  `autoregen` tinyint(3) NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `lastadv` int(11) unsigned NOT NULL,
  `hash` varchar(45) NOT NULL,
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `revivetime` int(11) NOT NULL,
  PRIMARY KEY (`heroid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `heroface` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `beard` smallint(2) NOT NULL,
  `ear` smallint(2) NOT NULL,
  `eye` smallint(2) NOT NULL,
  `eyebrow` smallint(2) NOT NULL,
  `face` smallint(2) NOT NULL,
  `hair` smallint(2) NOT NULL,
  `mouth` smallint(2) NOT NULL,
  `nose` smallint(2) NOT NULL,
  `color` smallint(2) NOT NULL,
  `foot` int(3) unsigned NOT NULL,
  `helmet` int(3) unsigned NOT NULL,
  `horse` int(3) unsigned NOT NULL,
  `leftHand` int(3) NOT NULL,
  `rightHand` int(3) NOT NULL,
  `body` int(3) NOT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `heroinventory` (
  `uid` smallint(5) unsigned NOT NULL,
  `helmet` int(11) NOT NULL,
  `leftHand` int(11) NOT NULL,
  `rightHand` int(11) NOT NULL,
  `body` int(11) NOT NULL,
  `horse` int(11) NOT NULL,
  `shoes` int(11) NOT NULL,
  `bag` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `heroitems` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `btype` int(11) unsigned NOT NULL,
  `type` int(11) unsigned NOT NULL,
  `num` bigint(19) NOT NULL,
  `proc` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(25) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(150) NOT NULL,
  `pos` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `market` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `gtype` tinyint(1) unsigned NOT NULL,
  `gamt` int(11) unsigned NOT NULL,
  `wtype` tinyint(1) unsigned NOT NULL,
  `wamt` int(11) unsigned NOT NULL,
  `accept` tinyint(1) unsigned NOT NULL,
  `maxtime` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `merchant` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `critical_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `work` varchar(30) NOT NULL,
  `work_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `mdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `target` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `topic` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL,
  `send` tinyint(1) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  `deltarget` int(11) unsigned NOT NULL,
  `delowner` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `player` int(11) unsigned NOT NULL,
  `coor` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`),
  KEY `target` (`target`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `medal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) unsigned NOT NULL,
  `categorie` int(11) unsigned NOT NULL,
  `plaats` int(11) unsigned NOT NULL,
  `week` int(11) unsigned NOT NULL,
  `points` varchar(15) NOT NULL,
  `img` varchar(10) NOT NULL,
  `allycheck` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `movement` (
  `moveid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `sort_type` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `from` int(11) unsigned NOT NULL DEFAULT '0',
  `to` int(11) unsigned NOT NULL DEFAULT '0',
  `ref` int(11) unsigned NOT NULL DEFAULT '0',
  `merchant` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `proc` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `send` tinyint(1) unsigned NOT NULL,
  `wood` bigint(19) unsigned NOT NULL,
  `clay` bigint(19) unsigned NOT NULL,
  `iron` bigint(19) unsigned NOT NULL,
  `crop` bigint(19) unsigned NOT NULL,
  PRIMARY KEY (`moveid`),
  UNIQUE KEY `from_2` (`from`,`ref`),
  KEY `from` (`from`),
  KEY `to` (`to`),
  KEY `ref` (`ref`),
  KEY `proc` (`proc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `ndata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `toWref` int(11) unsigned NOT NULL,
  `ally` int(11) unsigned NOT NULL,
  `ntype` tinyint(1) unsigned NOT NULL,
  `data` text NOT NULL,
  `data1` text NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `del` tinyint(1) unsigned NOT NULL,
  `topic` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `toWref` (`toWref`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `odata` (
  `wref` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `conqured` int(11) unsigned NOT NULL,
  `wood` int(11) unsigned NOT NULL,
  `iron` int(11) unsigned NOT NULL,
  `clay` int(11) unsigned NOT NULL,
  `maxstore` int(11) unsigned NOT NULL,
  `crop` int(11) unsigned NOT NULL,
  `maxcrop` int(11) unsigned NOT NULL,
  `lastupdated` int(11) unsigned NOT NULL,
  `loyalty` int(11) NOT NULL DEFAULT '100',
  `owner` int(11) unsigned NOT NULL DEFAULT '2',
  PRIMARY KEY (`wref`),
  KEY `owner` (`owner`),
  KEY `conqured` (`conqured`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `online` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `uid` int(11) unsigned NOT NULL,
  `time` varchar(32) NOT NULL,
  `sit` tinyint(1) unsigned NOT NULL,
  `sessid` varchar(100) NOT NULL,
  `ip` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `palevo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `infa` text NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `from` text NOT NULL,
  `browser` text NOT NULL,
  `sit` tinyint(1) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `password` (
  `uid` int(11) unsigned NOT NULL,
  `npw` varchar(100) NOT NULL,
  `cpw` varchar(100) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `jobID` int(11) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `start` int(10) unsigned NOT NULL,
  `finish` int(10) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `if1` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `raidlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL,
  `towref` int(11) unsigned NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `distance` varchar(5) NOT NULL DEFAULT '0',
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `referals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `research` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `tech` varchar(3) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `route` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `wid` int(11) unsigned NOT NULL,
  `from` int(11) unsigned NOT NULL,
  `wood` int(5) unsigned NOT NULL,
  `clay` int(5) unsigned NOT NULL,
  `iron` int(5) unsigned NOT NULL,
  `crop` int(5) unsigned NOT NULL,
  `start` tinyint(2) unsigned NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `deliveries` tinyint(1) unsigned NOT NULL,
  `merchant` int(11) unsigned NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `timetogo` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `spravka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tdata` (
  `vref` int(11) unsigned NOT NULL,
  `t2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t8` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t9` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `training` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `unit` tinyint(2) unsigned NOT NULL,
  `amt` bigint(19) NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL,
  `eachtime` decimal(10,5) unsigned NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vref` (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `units` (
  `vref` int(11) unsigned NOT NULL,
  `u1` bigint(19) NOT NULL DEFAULT '0',
  `u2` bigint(19) NOT NULL DEFAULT '0',
  `u3` bigint(19) NOT NULL DEFAULT '0',
  `u4` bigint(19) NOT NULL DEFAULT '0',
  `u5` bigint(19) NOT NULL DEFAULT '0',
  `u6` bigint(19) NOT NULL DEFAULT '0',
  `u7` bigint(19) NOT NULL DEFAULT '0',
  `u8` bigint(19) NOT NULL DEFAULT '0',
  `u9` bigint(19) NOT NULL DEFAULT '0',
  `u10` bigint(19) NOT NULL DEFAULT '0',
  `u11` bigint(19) NOT NULL DEFAULT '0',
  `u99` bigint(19) NOT NULL DEFAULT '0',
  `o99` bigint(19) NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `access` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `gold` int(9) unsigned NOT NULL DEFAULT '0',
  `dgold` int(9) unsigned NOT NULL DEFAULT '0',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `location` text NOT NULL,
  `desc1` text NOT NULL,
  `desc2` text NOT NULL,
  `cark` int(11) unsigned NOT NULL DEFAULT '0',
  `carksay` int(11) unsigned NOT NULL DEFAULT '0',
  `plus` int(11) unsigned NOT NULL DEFAULT '0',
  `b1` int(11) unsigned NOT NULL DEFAULT '0',
  `b2` int(11) unsigned NOT NULL DEFAULT '0',
  `b3` int(11) unsigned NOT NULL DEFAULT '0',
  `b4` int(11) unsigned NOT NULL DEFAULT '0',
  `goldclub` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sit1` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sit2` smallint(5) unsigned NOT NULL DEFAULT '0',
  `alliance` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `ap` bigint(19) unsigned NOT NULL DEFAULT '0',
  `apall` bigint(19) unsigned NOT NULL DEFAULT '0',
  `dp` bigint(19) unsigned NOT NULL DEFAULT '0',
  `dpall` bigint(19) unsigned NOT NULL DEFAULT '0',
  `herxp` bigint(19) unsigned NOT NULL DEFAULT '0',
  `merch` bigint(19) unsigned NOT NULL DEFAULT '0',
  `protect` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `cp` float(14,5) unsigned NOT NULL DEFAULT '1.00000',
  `lastupdate` int(11) unsigned NOT NULL,
  `RR` bigint(19) NOT NULL DEFAULT '0',
  `Rc` bigint(19) NOT NULL DEFAULT '0',
  `ok` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `clp` bigint(255) NOT NULL DEFAULT '0',
  `oldrank` bigint(255) unsigned NOT NULL DEFAULT '0',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0',
  `ptime` int(11) unsigned NOT NULL DEFAULT '0',
  `arena100` int(11) unsigned NOT NULL DEFAULT '0',
  `gtop` int(11) unsigned NOT NULL DEFAULT '0',
  `topg` int(11) unsigned NOT NULL DEFAULT '0',
  `invited` smallint(5) unsigned NOT NULL DEFAULT '0',
  `deleting` int(11) unsigned NOT NULL,
  `brewery` text NOT NULL,
  `silver` int(11) unsigned NOT NULL DEFAULT '0',
  `evasion` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `evasiontime` int(11) unsigned NOT NULL DEFAULT '0',
  `quest` tinyint(2) NOT NULL DEFAULT '1',
  `advtime` int(11) NOT NULL DEFAULT '0',
  `lang` text NOT NULL,
  `msg` int(11) unsigned NOT NULL DEFAULT '0',
  `vid` int(11) unsigned NOT NULL DEFAULT '0',
  `stime` int(11) unsigned NOT NULL DEFAULT '0',
  `tformat` int(11) unsigned NOT NULL DEFAULT '0',
  `rutbe` int(11) NOT NULL DEFAULT '0',
  `rutbe_seviye` int(11) NOT NULL DEFAULT '0',
  `unvan` int(11) NOT NULL DEFAULT '1',
  `unvan_say` int(11) NOT NULL DEFAULT '1',
  `vip` int(11) NOT NULL DEFAULT '0',
  `ulke` varchar(11) NOT NULL DEFAULT 'TR',
  `envanter0` int(11) NOT NULL DEFAULT '10',
  `envanter1` int(11) NOT NULL DEFAULT '0',
  `envanter2` int(11) NOT NULL DEFAULT '0',
  `envanter3` int(11) NOT NULL DEFAULT '0',
  `envanter4` int(11) NOT NULL DEFAULT '0',
  `envanter5` int(11) NOT NULL DEFAULT '0',
  `envanter6` int(11) NOT NULL DEFAULT '0',
  `envanter7` int(11) NOT NULL DEFAULT '0',
  `envanter8` int(11) NOT NULL DEFAULT '0',
  `envantersay` int(11) NOT NULL DEFAULT '0',
  `chatrank` varchar(255) NOT NULL DEFAULT 'LV1',
  `chatcolor` varchar(255) NOT NULL,
  `chatsay` int(11) NOT NULL DEFAULT '0',
  `chatmute` int(11) NOT NULL DEFAULT '0',
  `chatglobal` int(11) NOT NULL DEFAULT '0',
  `oyver` int(11) NOT NULL DEFAULT '0',
  `bonusver` int(11) NOT NULL DEFAULT '0',
  `unvangoster` int(11) NOT NULL DEFAULT '1',
  `top10kapat` int(11) NOT NULL DEFAULT '1',
  `bitti` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `alliance` (`alliance`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;


INSERT INTO `users` (`id`, `username`, `password`, `email`, `tribe`, `access`, `gold`, `gender`, `birthday`, `location`, `desc1`, `desc2`, `plus`, `b1`, `b2`, `b3`, `b4`, `goldclub`, `sit1`, `sit2`, `alliance`, `timestamp`, `ap`, `apall`, `dp`, `dpall`, `herxp`, `merch`, `protect`, `cp`, `lastupdate`, `RR`, `Rc`, `ok`, `clp`, `oldrank`, `regtime`, `invited`, `deleting`, `brewery`, `silver`, `evasion`, `evasiontime`, `quest`) VALUES
(2, 'Nature', '', 'nature@turkeytravian.com', 4, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1.00000, 0, -386169, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0);

CREATE TABLE IF NOT EXISTS `vdata` (
  `wref` int(11) unsigned NOT NULL,
  `owner` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `capital` tinyint(1) unsigned NOT NULL,
  `pop` int(11) unsigned NOT NULL,
  `cp` int(11) unsigned NOT NULL,
  `celebration` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `wood` bigint(19) NOT NULL,
  `clay` bigint(19) NOT NULL,
  `iron` bigint(19) NOT NULL,
  `maxstore` bigint(19) unsigned NOT NULL,
  `crop` bigint(19) NOT NULL,
  `maxcrop` bigint(19) unsigned NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `loyalty` float(9,6) unsigned NOT NULL DEFAULT '100',
  `exp1` int(11) NOT NULL,
  `exp2` int(11) NOT NULL,
  `exp3` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `natar` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `vx` int(11) NOT NULL,
  `vy` int(11) NOT NULL,
  `vtype` tinyint(2) NOT NULL,
  PRIMARY KEY (`wref`),
  KEY `owner` (`owner`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `wdata` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fieldtype` tinyint(2) unsigned NOT NULL,
  `oasistype` tinyint(2) unsigned NOT NULL,
  `x` smallint(5) NOT NULL,
  `y` smallint(5) NOT NULL,
  `occupied` tinyint(1) NOT NULL,
  `image` varchar(3) NOT NULL,
  `oasisimg` tinyint(1) NOT NULL DEFAULT '0',
  `partimg` varchar(30) NOT NULL,
  `adv` tinyint(1) NOT NULL DEFAULT '0',
  `type_of` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `x` (`x`,`y`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `codeNum` text NOT NULL,
  `goldAmount` int(11) NOT NULL,
  `isUsed` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);
  ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

  CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `pMethod` text NOT NULL,
  `idTrans` text NOT NULL,
  `dTrans` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `gAmount` int(11) NOT NULL,
  `cost` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
  
CREATE TABLE `autorenewals` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `plus` int(11) NOT NULL,
  `productionboostWood` int(11) NOT NULL,
  `productionboostClay` int(11) NOT NULL,
  `productionboostIron` int(11) NOT NULL,
  `productionboostCrop` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `autorenewals`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `autorenewals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `quests` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `quest` int(11) NOT NULL,
  `isFinished` int(11) NOT NULL,
  `step1` int(11) NOT NULL,
  `step2` int(11) NOT NULL,
  `skipped` int(11) NOT NULL,
  `battle1` varchar(11) NOT NULL,
  `battle2` varchar(11) NOT NULL,
  `economy1` varchar(11) NOT NULL,
  `economy2` varchar(11) NOT NULL,
  `world1` varchar(11) NOT NULL,
  `world2` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `quests`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `deleted` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 NOT NULL,
  `gold` int(11) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `deleted`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `deleted`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `ignore` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `uignored` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `ignore`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `ignore`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE `plusaddons` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `storage` int(11) NOT NULL,
  `fasterTraining` int(11) NOT NULL,
  `addonprotection` int(11) NOT NULL,
  `abonus` int(11) NOT NULL,
  `dbonus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `plusaddons`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `plusaddons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

CREATE TABLE `pnews` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `nid` int(11) NOT NULL,
  `ncontent` longtext NOT NULL,
  `hidden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `pnews`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `pnews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

  CREATE TABLE `storage` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `storagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `storage`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `storage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `server` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `category` text NOT NULL,
  `message` text NOT NULL,
  `sdate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

DROP TABLE IF EXISTS `oduller`;
CREATE TABLE IF NOT EXISTS `oduller` (
  `id` int NOT NULL AUTO_INCREMENT,
  `odul` varchar(250) NOT NULL,
  `miktar` int NOT NULL DEFAULT '0',
  `tip` varchar(20) NOT NULL DEFAULT 'gold',
  `bonus` int NOT NULL DEFAULT '0',
  `durum` int NOT NULL DEFAULT '0',
  `oran` int NOT NULL DEFAULT '1',
  `pozisyon` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;


INSERT INTO `oduller` (`id`, `odul`, `miktar`, `tip`, `bonus`, `durum`, `oran`, `pozisyon`) VALUES
(1, '10000 Altın', 10000, 'gold', 0, 1, 1, '1.00'),
(2, '1000 Gümüş', 1000, 'silver', 0, 1, 1, '70.00'),
(3, '10 Altın', 10, 'gold', 0, 1, 1, '50.00'),
(4, '+2 Çark Çevirme', 2, 'cark', 0, 1, 1, '42.50'),
(5, '20000 Gümüş', 20000, 'silver', 0, 1, 1, '28.00'),
(6, '10 Altın', 10, 'gold', 0, 1, 1, '10.00'),
(7, 'PASS', 0, 'pass', 0, 1, 1, '360.00'),
(8, '20000 Gümüş', 20000, 'silver', 0, 1, 1, '340.00'),
(9, '10 Altın', 10, 'gold', 0, 1, 1, '330.00'),
(10, '1000 Gümüş', 1000, 'silver', 0, 1, 1, '310.00'),
(11, '3200 Altın', 3200, 'gold', 0, 1, 1, '300.00'),
(12, '10 Altın', 10, 'gold', 0, 1, 1, '280.00'),
(13, '1600 Altın', 1600, 'gold', 0, 1, 1, '270.00'),
(14, '20000 Gümüş', 20000, 'silver', 0, 1, 1, '255.00'),
(15, '1000 Gümüş', 1000, 'silver', 0, 1, 1, '240.00'),
(16, '+5 Çark Çevirme', 5, 'cark', 0, 1, 1, '225.00'),
(17, '10 Altın', 10, 'gold', 0, 1, 1, '210.00'),
(18, '400000 Gümüş', 400000, 'silver', 0, 1, 1, '200.00'),
(19, '10 Altın', 10, 'gold', 0, 1, 1, '180.00'),
(20, '100000 Gümüş', 100000, 'silver', 0, 1, 1, '170.00'),
(21, '20000 Gümüş', 20000, 'silver', 0, 1, 1, '155.00'),
(22, '1000 Gümüş', 1000, 'silver', 0, 1, 1, '140.00'),
(23, '100 Altın', 100, 'gold', 0, 1, 1, '125.00'),
(24, '+3 Çark Çevirme', 3, 'cark', 0, 1, 1, '115.00'),
(25, '1000 Gümüş', 1000, 'silver', 0, 1, 1, '100.00');
COMMIT;