<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "promoshop".
 *
 * Auto generated 15-04-2015 18:24
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
	'title' => 'Promoshop',
	'description' => 'Plugin for booking promotional equipment.',
	'category' => 'plugin',
	'author' => 'Guenter Sommer',
	'author_email' => 'sommer@agentur-milchmaedchen.de',
	'author_company' => 'Milchmaedchen',
	'state' => 'stable',
	'uploadfolder' => 1,
	'createDirs' => 'uploads/tx_promoshop/bookings',
	'clearCacheOnLoad' => 0,
	'version' => '2.1.2',
	'dependencies' => 'extbase,fluid',
	'constraints' => 
	array (
		'depends' => 
		array (
			'extbase' => '6.2.0',
			'fluid' => '6.2.0',
		),
		'conflicts' => 
		array (
		),
		'suggests' => 
		array (
		),
	),
);

?>