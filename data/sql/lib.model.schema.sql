
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- contact
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contact`;


CREATE TABLE `contact`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`alias` VARCHAR(255)  NOT NULL,
	`email` VARCHAR(255)  NOT NULL,
	`special` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `contact_name_index`(`name`),
	KEY `contact_alias_index`(`alias`),
	KEY `contact_email_index`(`email`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- contact_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contact_group`;


CREATE TABLE `contact_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`alias` VARCHAR(255)  NOT NULL,
	`special` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `contact_group_name_index`(`name`),
	KEY `contact_group_alias_index`(`alias`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- group_to_contact
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `group_to_contact`;


CREATE TABLE `group_to_contact`
(
	`group_id` INTEGER  NOT NULL,
	`contact_id` INTEGER  NOT NULL,
	PRIMARY KEY (`group_id`,`contact_id`),
	CONSTRAINT `group_to_contact_FK_1`
		FOREIGN KEY (`group_id`)
		REFERENCES `contact_group` (`id`)
		ON DELETE CASCADE,
	INDEX `group_to_contact_FI_2` (`contact_id`),
	CONSTRAINT `group_to_contact_FK_2`
		FOREIGN KEY (`contact_id`)
		REFERENCES `contact` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- os
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `os`;


CREATE TABLE `os`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`image` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- host
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `host`;


CREATE TABLE `host`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`group_id` INTEGER  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`alias` VARCHAR(255)  NOT NULL,
	`address` VARCHAR(255)  NOT NULL,
	`special` TEXT,
	`os_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `host_name_index`(`name`),
	KEY `host_alias_index`(`alias`),
	INDEX `host_FI_1` (`group_id`),
	CONSTRAINT `host_FK_1`
		FOREIGN KEY (`group_id`)
		REFERENCES `host_group` (`id`)
		ON DELETE CASCADE,
	INDEX `host_FI_2` (`os_id`),
	CONSTRAINT `host_FK_2`
		FOREIGN KEY (`os_id`)
		REFERENCES `os` (`id`)
		ON DELETE SET NULL
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- host_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `host_group`;


CREATE TABLE `host_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`alias` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `host_group_name_index`(`name`),
	KEY `host_group_alias_index`(`alias`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- host_service_param
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `host_service_param`;


CREATE TABLE `host_service_param`
(
	`host_id` INTEGER  NOT NULL,
	`service_id` INTEGER  NOT NULL,
	`parameter` VARCHAR(255),
	`special` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`host_id`,`service_id`),
	CONSTRAINT `host_service_param_FK_1`
		FOREIGN KEY (`host_id`)
		REFERENCES `host` (`id`)
		ON DELETE CASCADE,
	INDEX `host_service_param_FI_2` (`service_id`),
	CONSTRAINT `host_service_param_FK_2`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- host_to_contact_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `host_to_contact_group`;


CREATE TABLE `host_to_contact_group`
(
	`host_id` INTEGER  NOT NULL,
	`contact_group_id` INTEGER  NOT NULL,
	PRIMARY KEY (`host_id`,`contact_group_id`),
	CONSTRAINT `host_to_contact_group_FK_1`
		FOREIGN KEY (`host_id`)
		REFERENCES `host` (`id`)
		ON DELETE CASCADE,
	INDEX `host_to_contact_group_FI_2` (`contact_group_id`),
	CONSTRAINT `host_to_contact_group_FK_2`
		FOREIGN KEY (`contact_group_id`)
		REFERENCES `contact_group` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `template`;


CREATE TABLE `template`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` INTEGER default 0 NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`alias` VARCHAR(255)  NOT NULL,
	`content` TEXT  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `template_type_index`(`type`),
	KEY `template_name_index`(`name`),
	KEY `template_alias_index`(`alias`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- service
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `service`;


CREATE TABLE `service`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`alias` VARCHAR(255)  NOT NULL,
	`command_id` INTEGER  NOT NULL,
	`port` INTEGER,
	`special` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `service_name_index`(`name`),
	KEY `service_alias_index`(`alias`),
	KEY `service_port_index`(`port`),
	INDEX `service_FI_1` (`command_id`),
	CONSTRAINT `service_FK_1`
		FOREIGN KEY (`command_id`)
		REFERENCES `command` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- service_to_host
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `service_to_host`;


CREATE TABLE `service_to_host`
(
	`service_id` INTEGER  NOT NULL,
	`host_id` INTEGER  NOT NULL,
	PRIMARY KEY (`service_id`,`host_id`),
	CONSTRAINT `service_to_host_FK_1`
		FOREIGN KEY (`service_id`)
		REFERENCES `service` (`id`)
		ON DELETE CASCADE,
	INDEX `service_to_host_FI_2` (`host_id`),
	CONSTRAINT `service_to_host_FK_2`
		FOREIGN KEY (`host_id`)
		REFERENCES `host` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- command
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `command`;


CREATE TABLE `command`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`alias` VARCHAR(255)  NOT NULL,
	`command` TEXT  NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `command_name_index`(`name`),
	KEY `command_alias_index`(`alias`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
