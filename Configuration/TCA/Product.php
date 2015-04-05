<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_promoshop_domain_model_product'] = array(
	'ctrl' => $TCA['tx_promoshop_domain_model_product']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, short_description, long_description, price, quantity, categorie, image, file',
	),
	'types' => array(
		'1' => array('showitem' => 
							'title, 
							short_description, 
							long_description;;;richtext:rte_transform[mode=ts_css], 
							price,
							quantity,
							--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.media,
							image, 
							--palette--;LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_palettes.image_settings;image_settings,
							file,
							file_title,
							--div--;LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_tabs.categories,
							categorie,
							--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,
							hidden;;1'
			),
	),
	'palettes' => array(
		'image_settings' => array(
			'showitem' => 'image_zoom;LLL:EXT:cms/locallang_ttc.xml:image_zoom_formlabel,image_title',
			'canNotCollapse' => 1,
		),
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
				'foreign_table' => 'tx_promoshop_domain_model_product',
				'foreign_table_where' => 'AND tx_promoshop_domain_model_product.pid=###CURRENT_PID### AND tx_promoshop_domain_model_product.sys_language_uid IN (-1,0)',
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
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
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
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'short_description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.short_description',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'long_description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.long_description',
			'config' => array(
				"type" => "text",
                "cols" => "30",
                "rows" => "5",
                "wizards" => Array(
                    "_PADDING" => 2,
                    "RTE" => array(
                        "notNewRecords" => 1,
                        "RTEonly" => 1,
                        "type" => "script",
                        "title" => 'LLL:EXT:cms/locallang_ttc.php:bodytext.W.RTE',
                        "icon" => "wizard_rte2.gif",
                        "script" => "wizard_rte.php",
                    ),
                ),
			),
		),
		'price' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.price',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			),
		),
		'quantity' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.quantity',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'categorie' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.categorie',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_promoshop_domain_model_productcategorie',
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
		'image' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.image',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_promoshop',
				'show_thumbs' => 1,
				'size' => 1,
				'maxitems' => '1',
				'minitems' => '0',
				'autoSizeMax' => 40,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'image_title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.image.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'image_zoom' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:cms/locallang_ttc.xml:image_zoom',
			'config' => array(
				'type' => 'check',
				'items' => array (
					'1'	=> array(
						'0' => 'LLL:EXT:lang/locallang_core.xml:labels.enabled',
					),
				),
			),
		),
		'file' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.file',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_promoshop',
				'allowed' => '*',
				'disallowed' => 'php',
				'size' => 1,
				'maxitems' => '1',
				'minitems' => '0',
			),
		),
		'file_title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product.file.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	),
);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>