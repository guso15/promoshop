<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Pi1',
	array(
		'Product' => 'index,list, show, new, create, edit, update, delete',
		'Productcategorie' => 'list, show, new, create, edit, update, delete',
		'Booking' => 'new,list, show, exit, create, edit, update, delete',
		'Bookingitem' => 'list, show, new, create, edit, update, delete',
		'Customer' => 'list'
		
	),
	// non-cacheable actions
	array(
		'Product' => 'create, update, delete',
		'Productcategorie' => 'create, update, delete',
		'Booking' => 'create, update, delete',
		'Bookingitem' => 'create, update, delete',
		
	)
);

$TYPO3_CONF_VARS['FE']['eID_include']['availableProducts'] = t3lib_extMgm::extPath($_EXTKEY).'Resources/Public/Scripts/Eid/class.tx_promoshop_eid_availableproducts.php';

?>