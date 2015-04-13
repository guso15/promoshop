<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

/** @var \Guso\Promoshop\Utility\Eid\EidBootstrapUtility $bootstrap */
$bootstrap = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Guso\Promoshop\Utility\Eid\EidBootstrapUtility', 'availableProducts');

// Use the Extbase bootstrap object to load the correct typoscript config, including storagePids for classes.
$configuration = array(
    'vendorName' => 'Guso',
    'extensionName' => 'Promoshop',
    'extensionKey' => 'tx_promoshop',
    'pluginName' => 'Pi1'
);
$bootstrap->setExtensionConfiguration($configuration);
$bootstrap->initialize();

// Need to create the object manager here so it is available for everything else.
$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Object\ObjectManager'); 

$webService = $objectManager->get('Guso\Promoshop\Service\WebService');
$webService->handle();
?>