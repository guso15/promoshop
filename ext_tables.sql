#
# Table structure for table 'tx_promoshop_domain_model_booking'
#
CREATE TABLE tx_promoshop_domain_model_booking (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	delivery int(11) DEFAULT '0' NOT NULL,
	bookingitems int(11) unsigned DEFAULT '0' NOT NULL,
	customer int(11) unsigned DEFAULT '0',
	
	company varchar(80) DEFAULT '' NOT NULL,
	gender varchar(1) NOT NULL default '',
	first_name varchar(50) DEFAULT '' NOT NULL,
	last_name varchar(50) DEFAULT '' NOT NULL,
	address varchar(255) DEFAULT '' NOT NULL,
	zip varchar(10) DEFAULT '' NOT NULL,
  	city varchar(50) DEFAULT '' NOT NULL,	
  	telephone varchar(20) DEFAULT '' NOT NULL,
  	fax varchar(20) DEFAULT '' NOT NULL,
  	mobile varchar(20) DEFAULT '' NOT NULL,
  	email varchar(80) DEFAULT '' NOT NULL,
  	vbname varchar(100) DEFAULT '' NOT NULL,
  	vbphone varchar(20) DEFAULT '' NOT NULL,
  	file text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_promoshop_domain_model_product'
#
CREATE TABLE tx_promoshop_domain_model_product (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	short_description varchar(255) DEFAULT '' NOT NULL,
	long_description text NOT NULL,
	price double(11,2) DEFAULT '0.00' NOT NULL,
	quantity int(11) DEFAULT '0' NOT NULL,
	categorie int(11) DEFAULT '0' NOT NULL,
	image text NOT NULL,
	image_title text NOT NULL,
	image_zoom tinyint(3) unsigned DEFAULT '0' NOT NULL,
	file text NOT NULL,
	file_title text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_promoshop_domain_model_bookingitem'
#
CREATE TABLE tx_promoshop_domain_model_bookingitem (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	booking int(11) unsigned DEFAULT '0' NOT NULL,

	quantity int(11) DEFAULT '0' NOT NULL,
	product int(11) unsigned DEFAULT '0',
	booking int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_promoshop_domain_model_productcategorie'
#
CREATE TABLE tx_promoshop_domain_model_productcategorie (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	
	title varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3_origuid int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table "fe_users"
#
CREATE TABLE fe_users (
  gender varchar(1) NOT NULL default '',
  mobile varchar(50) default ''
) ENGINE=MyISAM;
