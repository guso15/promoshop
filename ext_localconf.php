<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Guso.' . $_EXTKEY,
	'Pi1',
	array(
		'Product' => 'index,list, show, new, create, edit, update, delete',
		'Productcategorie' => 'list, show, new, create, edit, update, delete',
		'Booking' => 'new, list, show, exit, create, edit, update, delete',
		'Bookingitem' => 'list, show, new, create, edit, update, delete',
		'Customer' => 'list'
		
	),
	// non-cacheable actions
	array(
		'Product' => 'index,list, show, new, create, edit, update, delete',
		'Productcategorie' => 'list, show, new, create, edit, update, delete',
		'Booking' => 'new, list, show, exit, create, edit, update, delete',
		'Bookingitem' => 'list, show, new, create, edit, update, delete',
		'Customer' => 'list'
	)
);

$TYPO3_CONF_VARS['FE']['eID_include']['availableProducts'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY).'Resources/Public/Php/EidAvailableProducts.php';
?>