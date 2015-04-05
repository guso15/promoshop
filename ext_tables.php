<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Pi1',
	'Vodafone Promoshop'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'txeventplatformM1',	 // Make module a submodule of 'txeventplatformM1'
		'promoshop',	// Submodule key
		'',						// Position
		array(
			'Booking' => 'list, show, new, create, edit, update, delete','Product' => 'list, show, new, create, edit, update, delete','Bookingitem' => 'list, show, new, create, edit, update, delete','Productcategorie' => 'list, show, new, create, edit, update, delete',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_promoshop.xml',
		)
	);

}

/**
 * Register Plugin as Page Content and register flexform
 */
$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';  
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/Flexform.xml');

/**
 * Register static Typoscript Template
 */
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Vodafone Promoshop');

/*
 * Extend fe_user table
 */
$tempColumns = array (
    'mobile' => array(
    	'exclude' => 1,
    	'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_customer.mobile:',
    	'config' => array(
    		'type' => 'input',
    		'eval' => 'trim',
    		'size' => '20',
    		'max' => '20'
    	 )
      ),
    'gender' => array(
    	'exclude' => 1,
    	'label' => 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_customer.gender:',
		'config'  => array( 'type'  => 'select',
			'items'	=> array(
				array('LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_customer.gender.1', 1),
				array('LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_customer.gender.2', 2)
			)
		)
	)
);

// Add new fields to fe_users
t3lib_div::loadTCA("fe_users");
t3lib_extMgm::addTCAcolumns("fe_users",$tempColumns,1);

//$TCA['fe_users']['types']['Tx_Promoshop_Domain_Model_Customer'] = $TCA['fe_users']['types']['0'];
$TCA['fe_users']['types']['Tx_Promoshop_Domain_Model_Customer'] = array('showitem' => '
			disable,username;;;;1-1-1, password, usergroup, lastlogin;;;;1-1-1,
			--div--;LLL:EXT:cms/locallang_tca.xml:fe_users.tabs.personelData, company;;;;1-1-1, gender;;2;;2-2-2, address;;3;;2-2-2, telephone;;4;;2-2-2, email,
			--div--;LLL:EXT:cms/locallang_tca.xml:fe_users.tabs.access, starttime, endtime,
			--div--;LLL:EXT:cms/locallang_tca.xml:fe_users.tabs.extended, tx_extbase_type
		');
$TCA['fe_users']['palettes']['2'] = array('showitem' => 'first_name,last_name');
$TCA['fe_users']['palettes']['3'] = array('showitem' => 'zip,city');
$TCA['fe_users']['palettes']['4'] = array('showitem' => 'mobile,fax');

array_push($TCA['fe_users']['columns']['tx_extbase_type']['config']['items'], array('LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:fe_users.tx_extbase_type.Tx_Promoshop_Domain_Model_Customer', 'Tx_Promoshop_Domain_Model_Customer'));

			t3lib_extMgm::addLLrefForTCAdescr('tx_promoshop_domain_model_booking', 'EXT:promoshop/Resources/Private/Language/locallang_csh_tx_promoshop_domain_model_booking.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_promoshop_domain_model_booking');
			$TCA['tx_promoshop_domain_model_booking'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_booking',
					'label' => 'customer',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,

					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Booking.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_promoshop_domain_model_booking.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_promoshop_domain_model_product', 'EXT:promoshop/Resources/Private/Language/locallang_csh_tx_promoshop_domain_model_product.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_promoshop_domain_model_product');
			$TCA['tx_promoshop_domain_model_product'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_product',
					'label' => 'title',
					'label_alt' => 'categorie',
        			'label_alt_force' => 0,
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,

					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'default_sortby' => 'ORDER BY title',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Product.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_promoshop_domain_model_product.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_promoshop_domain_model_bookingitem', 'EXT:promoshop/Resources/Private/Language/locallang_csh_tx_promoshop_domain_model_bookingitem.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_promoshop_domain_model_bookingitem');
			$TCA['tx_promoshop_domain_model_bookingitem'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_bookingitem',
					'label' => 'product',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,

					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Bookingitem.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_promoshop_domain_model_bookingitem.gif'
				),
			);
			
			t3lib_extMgm::addLLrefForTCAdescr('tx_promoshop_domain_model_productcategorie', 'EXT:promoshop/Resources/Private/Language/locallang_csh_tx_promoshop_domain_model_productcategorie.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_promoshop_domain_model_productcategorie');
			$TCA['tx_promoshop_domain_model_productcategorie'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:promoshop/Resources/Private/Language/locallang_db.xml:tx_promoshop_domain_model_productcategorie',
					'label' => 'title',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,

					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'default_sortby' => 'ORDER BY title',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Productcategorie.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_promoshop_domain_model_productcategorie.gif'
				),
			);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
?>