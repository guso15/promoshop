<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_promoshop_domain_model_booking'] = array(
	'ctrl' => $TCA['tx_promoshop_domain_model_booking']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, delivery, bookingitems, customer',
	),
	'types' => array(
		'1' => array('showitem' => '
							delivery, 
							customer, 
							vbname;;4,
							file,
							--div--;LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.bookingitems,
							bookingitems,
							--div--;LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.destination, 
							company, 
							gender;;1, 
							address;;2, 
							telephone;;3, 
							email,
							--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, 
							endtime'
					),
	),
	'palettes' => array(
		'1' => array('showitem' => 'first_name, last_name'),
		'2' => array('showitem' => 'zip, city'),
		'3' => array('showitem' => 'fax, mobile'),
		'4' => array('showitem' => 'vbphone'),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_promoshop_domain_model_booking',
				'foreign_table_where' => 'AND tx_promoshop_domain_model_booking.pid=###CURRENT_PID### AND tx_promoshop_domain_model_booking.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'delivery' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.delivery',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.delivery.fetch','1'),
					array('LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.delivery.deliver','2'),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'bookingitems' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.bookingitems',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_promoshop_domain_model_bookingitem',
				'foreign_field' => 'booking',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'customer' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.customer',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => "AND fe_users.tx_extbase_type='Tx_Promoshop_Domain_Model_Customer'",
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'company' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.company',
			'config' => array(
				'type' => 'input',
				'size' => '50',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'gender' => array(
	    	'exclude' => 1,
    		'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.gender:',
			'config'  => array( 'type'  => 'select',
				'items'	=> array(
					array('Herr', 1),
					array('Frau', 2)
				)
			)
		),
		'first_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.first_name',
			'config' => array(
				'type' => 'input',
				'size' => '25',
				'eval' => 'trim',
				'max' => '50'
			)
		),
		'last_name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.last_name',
			'config' => array(
				'type' => 'input',
				'size' => '25',
				'eval' => 'trim',
				'max' => '50'
			)
		),
		'address' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.address',
			'config' => array(
				'type' => 'text',
				'cols' => '20',
				'rows' => '3'
			)
		),
		'zip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.zip',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
				'size' => '10',
				'max' => '10'
			)
		),
		'city' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.city',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max' => '50'
			)
		),
		'telephone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.phone',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max' => '20'
			)
		),
		'fax' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.fax',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max' => '20'
			)
		),
		'mobile' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_customer.mobile',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max' => '20'
			)
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.email',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'eval' => 'trim',
				'max' => '80'
			)
		),
		'vbname' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.vbname',
			'config' => array(
				'type' => 'input',
				'size' => '50',
				'eval' => 'trim',
				'max' => '100'
			)
		),
		'vbphone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.vbphone',
			'config' => array(
				'type' => 'input',
				'eval' => 'trim',
				'size' => '20',
				'max' => '20'
			)
		),
		'file' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking.file',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_promoshop/bookings',
				'allowed' => 'pdf',
				'disallowed' => '*',
				'maxitems' => 1,
				'size' => 1
			),
		),
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>