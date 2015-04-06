<?php
namespace Guso\Promoshop\Service;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 *  Copyright notice
 *
 * (c) 2012 Guenter Sommer <sommer@agentur-milchmaedchen.de>
 *
 */

/**
 * Settings service. Provides access to the plugin settings
 * coming from TypoScript, Flexform and the Plugin content element.
 */
class SettingsService implements \TYPO3\CMS\Core\SingletonInterface {

   	/**
	 * Initializes the configuration manager interface
	 *
	 * @return void
	 */
    public function init() {
        $objectManager = GeneralUtility::makeInstance('Tx_Extbase_Object_ObjectManager');
		$configurationManager = $objectManager->get('Tx_Extbase_Configuration_ConfigurationManagerInterface');
		
		$this->frameworkConfiguration = $configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
		);
    }

    /**
     * Returns all persistance settings.
     *
     * @return array
     */
    public function getPersistanceSettings() {
    	$this->init();
        $this->persistence = $this->frameworkConfiguration['persistence'];

        return $this->persistence;
    }

}

?>